<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <!-- Header -->
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('developers.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Pengembang</span>
                </a>
            @endif
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Manajemen Pengembang
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Daftar pengembang aplikasi (internal, vendor, freelance)') }} 
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
                    <form action="{{ route('developers.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                        <!-- Input + Tombol Search -->
                        <div class="relative flex-1">
                            <input 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama atau email pengembang"
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
        <!-- Table -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Tipe</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Telepon</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($developers as $index => $dev)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $dev->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $dev->developer_type }}</td>
                            <td class="px-4 py-3">{{ $dev->contact_email ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $dev->contact_phone ?? '-' }}</td>             
                            <td class="px-4 py-3 text-center space-x-3 flex items-center justify-center">
                                <div class="flex items-center justify-center divide-x divide-gray-300">

                                    {{-- Tombol Lihat --}}
                                    <a href="{{ route('applications.show', $dev->id) }}" 
                                        class="text-blue-500 hover:text-blue-700 font-semibold inline-flex items-center px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" 
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5
                                                c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639
                                                C20.577 16.49 16.64 19.5 12 19.5
                                                c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" 
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>

                                    {{-- Tombol Edit & Hapus hanya untuk admin/diskominfo --}}
                                    @if(auth()->user()->role !== 'opd')
                                        <a href="{{ route('applications.edit', $dev->id) }}"
                                            class="text-yellow-600 hover:text-yellow-700 font-semibold inline-flex items-center px-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
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

                                        <form id="deleteForm-{{ $dev->id }}" 
                                            action="{{ route('developers.destroy', $dev->id) }}" 
                                            method="POST" class="inline px-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                onclick="openModal('{{ $dev->id }}')" 
                                                class="text-red-600 hover:text-red-700 font-semibold inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                                    stroke-width="1.5" stroke="currentColor" class="size-5">
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
                                        </form>
                                        <!-- Modal Konfirmasi -->
                                            <div id="confirmModal-{{ $dev->id }}" 
                                                class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
                                                <div class="bg-white rounded-xl shadow-lg p-6 w-auto text-center">
                                                    <h4 class="text-md font-semibold mb-2">Konfirmasi Hapus Aplikasi</h4>
                                                    <p class="text-lg text-gray-600 mb-5">Apakah kamu yakin ingin menghapus <strong>{{ $dev->name }}</strong>?</p>
                                                    <div class="flex justify-center gap-2">
                                                        <button onclick="confirmDelete('{{ $dev->id }}')" 
                                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                                                            Ya, Hapus
                                                        </button>
                                                        <button onclick="closeModal('{{ $dev->id }}')" 
                                                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm font-medium">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                Belum ada data pengembang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
