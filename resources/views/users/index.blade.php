<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        <!-- Header -->
        <div class="relative mb-6">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('users.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Pengguna</span>
                </a>
            @endif
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Manajemen Pengguna
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Daftar pengguna sistem') }} 
                </p>

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
        <!-- Search + Filter dalam 1 kotak -->
        <div class="p-4 bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-3 w-full">
                    <!-- Form Search & Filter -->
                    <form action="{{ route('users.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                        <!-- Input + Tombol Search -->
                        <div class="relative flex-1">
                            <input 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama atau email pengguna"
                                class="w-full truncate px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 overflow-hidden text-ellipsis whitespace-nowrap"/>
                            <!-- Tombol Search -->
                            <button 
                                type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.9-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                                </svg>
                            </button>
                        </div> 
                           <!--Tombol Search berdasarkan tipe-->
                        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                            <select name="role" 
                                onchange="this.form.submit()"
                                class="sm:text-sm px-auto py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 w-full sm:w-auto max-w-[380px]">
                                <option value="">Semua Peran</option>
                                <option value="admin"  {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="opd"    {{ request('role') === 'opd' ? 'selected' : '' }}>OPD</option>
                                <option value="diskominfo" {{ request('role') === 'diskominfo' ? 'selected' : '' }}>Diskominfo</option>
                            </select>
                        </div>        
                    </form>
                </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Pengguna ({{ $users->count() }})
                </h1>
            </div>
            <table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead >
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left min-w-[200px]">Nama</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left min-w-[200px]">Jabatan</th>
                        <th class="px-4 py-3 text-left">Peran</th>
                        <th class="px-4 py-3 text-left min-w-[350px]">OPD</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Nomor Telepon</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white">
                    @forelse ($users as $index => $user)
                        <tr class="border-b hover:bg-gray-50 ">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">{{ $user->position }}</td>
                            @php
                                $roleColors = [
                                    'admin' => 'bg-red-100 text-red-700',
                                    'diskominfo' => 'bg-blue-100 text-blue-700',
                                    'opd' => 'bg-green-100 text-green-700',
                                ];
                            @endphp

                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-md text-xs font-semibold
                                    {{ $roleColors[$user->role] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $user->department->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $user->phone }}</td>
                            <td class="px-4 py-3 text-center">
                                <x-action-buttons
                                    :id="$user->id"
                                    :editRoute="route('users.edit', $user->id)"
                                    :deleteRoute="route('users.destroy', $user->id)"
                                    itemName="{{ $user->name }}"
                                />
                            </td>            
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-gray-500">Belum ada pengguna.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
