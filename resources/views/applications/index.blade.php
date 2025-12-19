<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">

        <!-- Header -->
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
           @if(auth()->user()->role !== 'opd')
                <a href="{{ route('applications.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Aplikasi</span>
                </a>
            @endif


            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Manajemen Aplikasi
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    @if(auth()->user()->role == 'opd')
                        {{ __('Daftar seluruh aplikasi') }}
                        {{ auth()->user()->department->name ?? 'Tidak ada departemen' }}

                    @else
                        {{ __('Daftar seluruh aplikasi yang dikelola') }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Search dan Filter -->
        <!-- Search + Filter dalam 1 kotak -->
        <div class="p-4 bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-3 w-full">
                    <!-- Form Search & Filter -->
                    <form action="{{ route('applications.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                        <!-- Input + Tombol Search -->
                        <div class="relative flex-1">
                            <input 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama aplikasi"
                                class="w-full truncate px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 overflow-hidden text-ellipsis whitespace-nowrap"
                            />
                            <!-- Tombol Search -->
                            <button 
                                type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-600 transition"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.9-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Dropdown filter (turun di mobile) -->
                        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">

                            <!-- Filter Kategori -->
                            <select name="kategori"
                                onchange="this.form.submit()"
                                class="sm:text-sm px-auto py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 w-full sm:w-auto max-w-[380px]">
                                <option value="">Semua Kategori</option>
                                <option value="web" {{ request('kategori') == 'web' ? 'selected' : '' }}>Web</option>
                                <option value="mobile" {{ request('kategori') == 'mobile' ? 'selected' : '' }}>Mobile</option>
                                <option value="dekstop" {{ request('kategori') == 'dekstop' ? 'selected' : '' }}>Dekstop</option>
                            </select>

                            <!-- Filter Sensitivitas Data -->
                            <select name="sensitivitas"
                                onchange="this.form.submit()"
                                class="sm:text-sm px-auto py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 w-full sm:w-auto max-w-[380px]">
                                <option value="">Semua Sensitivitas</option>
                                <option value="internal" {{ request('sensitivitas') == 'internal' ? 'selected' : '' }}>Internal</option>
                                <option value="publik" {{ request('sensitivitas') == 'publik' ? 'selected' : '' }}>Publik</option>
                                <option value="rahasia" {{ request('sensitivitas') == 'rahasia' ? 'selected' : '' }}>Rahasia</option>
                            </select>
                    
                            <!-- Filter Status -->
                            <select name="status" 
                                onchange="this.form.submit()"
                                class="sm:text-sm px-auto py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 w-full sm:w-auto max-w-[380px]">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                <option value="dalam perbaikan" {{ request('status') == 'dalam perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                            </select>
                        </div>
                    </form>
                </div>
        </div>
        @if (session('success'))
            <div x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        <!-- Tabel Data -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Aplikasi ({{ $applications->count() }})
                </h1>
            </div>
            <table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left w-12">No</th>
                        <th class="px-4 py-3 text-left min-w-[200px]">Nama Aplikasi</th>
                        <th class="px-4 py-3 text-left min-w-[270px]">OPD</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left min-w-[170px]">Sensitivitas Data</th>
                        <th class="px-4 py-3 text-left min-w-[170px]">Status</th>
                        <th class="px-4 py-3 text-left min-w-[170px]">Tanggal Rilis</th>
                        <th class="px-4 py-3 text-left min-w-[120px]">Versi</th>
                        <th class="px-4 py-3 text-center min-w-[170px]">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                    @forelse ($applications as $index => $app)
                        <tr class="hover:bg-gray-50 transition text-sm">
                            <td class="px-4 py-3 w-12">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $app->name }}</td>
                            <td class="px-4 py-3">{{ $app->department->name ?? '-' }}</td>
                             <td class="px-4 py-3 text-left">
                                @php
                                    $categoryColors = [
                                        'web' => 'bg-blue-100 text-blue-600',
                                        'mobile' => 'bg-purple-100 text-purple-600',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-xs font-semibold rounded-md
                                    {{ $categoryColors[$app->category] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($app->category) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-left">
                                @php
                                    $sensitivityColors = [
                                        'internal' => 'bg-yellow-100 text-yellow-600',
                                        'publik' => 'bg-green-100 text-green-600',
                                        'rahasia' => 'bg-red-100 text-red-600',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-xs font-semibold rounded-md
                                    {{ $sensitivityColors[$app->data_sensitivity] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($app->data_sensitivity) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-left">
                                @php
                                    $statusColors = [
                                        'aktif' => 'bg-green-100 text-green-600',
                                        'dalam perbaikan' => 'bg-yellow-100 text-yellow-600',
                                        'tidak aktif' => 'bg-red-100 text-red-600'
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-xs font-semibold rounded-md 
                                    {{ $statusColors[$app->status]}}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                {{ $app->created_at ? \Carbon\Carbon::parse($app->created_at)->format('Y-m-d') : '-' }}
                            </td>
                            
                            <td class="px-4 py-3">
                                @if($app->latestVersion)
                                    <span class="bg-gray-50 px-2 py-1 rounded border font-semibold">
                                        {{ $app->latestVersion->version_code }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">Belum ada</span>
                                @endif
                            </td>


                            <!-- Kolom Aksi -->
                            <td class="px-3 py-3 text-center">
                                <x-action-buttons
                                    :id="$app->id"
                                    :showRoute="route('applications.show', $app->id)"
                                    :editRoute="auth()->user()->role !== 'opd' ? route('applications.edit', $app->id) : null"
                                    :deleteRoute="auth()->user()->role !== 'opd' ? route('applications.destroy', $app->id) : null"
                                    itemName="{{ $app->name }}"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-500">
                                Belum ada data aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
