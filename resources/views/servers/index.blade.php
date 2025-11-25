<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        <!-- Header -->
        <div class="relative mb-6">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('servers.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Server</span>
                </a>
            @endif
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Manajemen Server
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Daftar server infrastruktur aplikasi') }} 
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
                    <form action="{{ route('servers.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                        <!-- Input + Tombol Search -->
                        <div class="relative flex-1">
                            <input 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama server"
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
                    </form>
                </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead>
                    <tr class="bg-white border-b">
                        <th class="px-4 py-3 text-left font-semibold">No</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[180px]">Hostname</th>
                        <th class="px-4 py-3 text-left font-semibold">IP Address</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[180px]">OS</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[220px]">Lokasi</th>
                        <th class="px-4 py-3 text-left font-semibold min-w-[180px]">Dikelola Oleh</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($servers as $index => $srv)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 w-10">{{ $index + 1 }}</td>

                            <td class="px-4 py-3 font-medium text-gray-600 min-w-[180px]">
                                {{ $srv->hostname }}
                            </td>

                            <td class="px-4 py-3 text-gray-500">{{ $srv->ip_address }}</td>
                            <td class="px-4 py-3 text-gray-500 min-w-[180px]">{{ $srv->os ?? '-' }}</td>
                            <td class="px-4 py-3 min-w-[220px] text-gray-500">{{ $srv->location ?? '-' }}</td>
                            <td class="px-4 py-3 min-w-[180px] text-gray-500">{{ $srv->managed_by ?? '-' }}</td>

                            <td class="px-4 py-3">
                                @php
                                    $color = match($srv->status) {
                                        'aktif' => 'bg-green-100 text-green-700',
                                        'maintenance' => 'bg-yellow-100 text-yellow-700',
                                        'nonaktif' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp

                                <div class="flex justify-start">
                                    <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $color }}">
                                        {{ $srv->status }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if(auth()->user()->role === 'admin')
                                    <div class="flex items-center justify-center divide-x divide-gray-300">

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('servers.edit', $srv->id) }}"
                                            class="text-yellow-600 hover:text-yellow-700 transition pl-3 pr-3"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652
                                                    L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18
                                                    l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z
                                                    M19.5 7.125 16.862 4.487M18 14v4.75
                                                    A2.25 2.25 0 0 1 15.75 21H5.25
                                                    A2.25 2.25 0 0 1 3 18.75V8.25
                                                    A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>

                                        <!-- Tombol Delete -->
                                        <button type="button"
                                            onclick="openModal('{{ $srv->id }}')"
                                            class="text-red-600 hover:text-red-700 transition pl-3 pr-3"
                                            title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                                viewBox="0 0 24 24" stroke-width="1.5" 
                                                stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" 
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9
                                                    m9.968-3.21c.342.052.682.107 1.022.166
                                                    m-1.022-.165L18.16 19.673
                                                    a2.25 2.25 0 0 1-2.244 2.077H8.084
                                                    a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79
                                                    m14.456 0a48.108 48.108 0 0 0-3.478-.397
                                                    m-12 .562c.34-.059.68-.114 1.022-.165
                                                    m0 0a48.11 48.11 0 0 1 3.478-.397
                                                    m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201
                                                    a51.964 51.964 0 0 0-3.32 0
                                                    c-1.18.037-2.09 1.022-2.09 2.201v.916
                                                    m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>

                                        <!-- Form delete -->
                                        <form id="deleteForm-{{ $srv->id }}"
                                            action="{{ route('servers.destroy', $srv->id) }}"
                                            method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Konfirmasi -->
                        <div id="confirmModal-{{ $srv->id }}" 
                            class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
                            <div class="bg-white rounded-xl shadow-lg p-6 w-auto text-center">
                                <h4 class="text-md font-semibold mb-2">Konfirmasi Hapus Server</h4>
                                <p class="text-lg text-gray-600 mb-5">
                                    Apakah kamu yakin ingin menghapus 
                                    <strong>{{ $srv->hostname }}</strong>?
                                </p>
                                <div class="flex justify-center gap-2">
                                    <button onclick="confirmDelete('{{ $srv->id }}')" 
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                                        Ya, Hapus
                                    </button>
                                    <button onclick="closeModal('{{ $srv->id }}')" 
                                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm font-medium">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">
                                Belum ada data server.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
