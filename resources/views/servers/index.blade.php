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
                                placeholder="Cari nama server atau IP address"
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
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Server ({{ $servers->count() }})
                </h1>
            </div>
            <table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead>
                    <tr class="bg-white border-b">
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Hostname</th>
                        <th class="px-4 py-3 text-left">IP Address</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">OS</th>
                        <th class="px-4 py-3 text-left min-w-[220px]">Lokasi</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Dikelola Oleh</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($servers as $index => $srv)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 w-10">{{ $index + 1 }}</td>

                            <td class="px-4 py-3 min-w-[180px]">
                                {{ $srv->hostname }}
                            </td>

                            <td class="px-4 py-3">{{ $srv->ip_address }}</td>
                            <td class="px-4 py-3 min-w-[180px]">{{ $srv->os ?? '-' }}</td>
                            <td class="px-4 py-3 min-w-[220px]">{{ $srv->location ?? '-' }}</td>
                            <td class="px-4 py-3 min-w-[180px]">{{ $srv->managed_by ?? '-' }}</td>

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
                                    <x-action-buttons
                                        :id="$srv->id"
                                        :editRoute="route('servers.edit', $srv->id)"
                                        :deleteRoute="route('servers.destroy', $srv->id)"
                                        itemName="{{ $srv->hostname }}"
                                    />
                            </td>
                        @endif  
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
