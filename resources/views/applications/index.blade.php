<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">

        <!-- Header -->
<<<<<<< HEAD
        <div class="flex justify-between items-center mb-6">
            <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                Manajemen Aplikasi
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Daftar seluruh aplikasi yang dikelola Pemkab
            </p>
            </div>

            {{-- Tombol tambah hanya untuk admin dan diskominfo --}}
            @if(auth()->user()->role !== 'opd')
=======
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
           @if(auth()->user()->role !== 'opd')
>>>>>>> e96f52f587663a7ec957cc8947a03cca41bc3009
                <a href="{{ route('applications.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Aplikasi</span>
                </a>
            @endif


            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    Manajemen Aplikasi
                </h1>
<<<<<<< HEAD
                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Daftar aplikasi yang dikelola ') }} 
                    @if(auth()->user()->role !== 'admin')
                     {{ ' oleh ' . (auth()->user()->department->name ?? 'Tidak ada departemen') }}
              @endif
                </p>
=======
                {{ __('Daftar aplikasi yang dikelola ') }} 
                    @if(auth()->user()->role !== 'admin')
                     {{ ' oleh ' . (auth()->user()->department->name ?? 'Tidak ada departemen') }}
                    @endif
>>>>>>> e3db7f5 (Update tampilan index & navigation)
            </div>
        </div>

        <!-- Search dan Filter -->
        <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-3 w-full">
            <!-- Form Search & Filter -->
            <form action="{{ route('applications.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                <!-- Input + Tombol Search -->
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau deskripsi aplikasi"
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
                    <!-- Filter Status -->
                    <select name="status"
                        class="px-auto py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 w-full sm:w-auto">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>

                    <!-- Filter Kategori -->
                    <select name="kategori"
                        class="px-auto py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 w-full sm:w-auto">
                        <option value="">Semua Kategori</option>
                        <option value="web" {{ request('kategori') == 'web' ? 'selected' : '' }}>Web</option>
                        <option value="mobile" {{ request('kategori') == 'mobile' ? 'selected' : '' }}>Mobile</option>
                    </select>
                </div>
            </form>
        </div>
        <!-- Alert sukses -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-xs text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
<<<<<<< HEAD
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Aplikasi</th>
=======
                        <th class="px-3 py-3 text-left w-12">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Sensitivitas</th>
>>>>>>> e96f52f587663a7ec957cc8947a03cca41bc3009
                        <th class="px-4 py-3 text-left">OPD</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Sensitivitas Data</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <!-- <th class="px-4 py-3 text-left">Developer</th> -->
                        <!-- <th class="px-4 py-3 text-left">Server</th> -->
                        <th class="px-4 py-3 text-left">Terakhir Update</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($applications as $index => $app)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-3 py-3 w-12">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $app->name }}</td>
                            <td class="px-4 py-3">{{ $app->department->name ?? '-' }}</td>
                            <!-- <td class="px-4 py-3 capitalize">{{ $app->category }}</td> -->
                             <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $app->category }}
                                </span>
                            </td>
                            <!-- <td class="px-4 py-3 capitalize">{{ $app->data_sensitivity }}</td> -->
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $app->data_sensitivity }}
                                </span>
</td>
                            <td class="px-4 py-3 capitalize">{{ $app->status }}</td>
                            <!-- <td class="px-4 py-3">{{ $app->developer->name ?? '-' }}</td> -->
                            <!-- <td class="px-4 py-3">{{ $app->server->hostname ?? '-' }}</td> -->
                            <td class="px-4 py-3">
                                {{ $app->last_update ? \Carbon\Carbon::parse($app->last_update)->format('d M Y') : '-' }}
                            </td>

<<<<<<< HEAD
                            <!-- Kolom Aksi -->
                            <!-- <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('applications.show', $app->id) }}"
                                   class="text-blue-600 hover:text-blue-700 font-semibold">
                                   Lihat
=======
                        <!-- Kolom Aksi -->
                        <td class="px-3 py-3 text-center">
                            <div class="flex items-center justify-center divide-x divide-gray-300">

                                {{-- Tombol Lihat --}}
                                <a href="{{ route('applications.show', $app->id) }}" 
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
>>>>>>> e96f52f587663a7ec957cc8947a03cca41bc3009
                                </a>

                                {{-- Tombol Edit & Hapus hanya untuk admin/diskominfo --}}
                                @if(auth()->user()->role !== 'opd')
                                    <a href="{{ route('applications.edit', $app->id) }}"
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

                                    <form id="deleteForm-{{ $app->id }}" 
                                        action="{{ route('applications.destroy', $app->id) }}" 
                                        method="POST" class="inline px-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                            onclick="openModal('{{ $app->id }}')" 
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
<<<<<<< HEAD
                                @endif
                            </td> -->
                            <td class="px-4 py-3 text-center space-x-3">
    <!-- Tombol Lihat -->
    <a href="{{ route('applications.show', $app->id) }}"
       class="inline-block hover:scale-110 transition-transform">
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="currentColor" viewBox="0 0 24 24"
             class="w-5 h-5 text-gray-800 hover:text-gray-600 inline">
            <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7Zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z"/>
            <circle cx="12" cy="12" r="2.5" fill="white"/>
        </svg>
    </a>

    {{-- Tombol Edit & Hapus hanya untuk admin/diskominfo --}}
    @if(auth()->user()->role !== 'opd')
        <!-- Tombol Edit -->
        <a href="{{ route('applications.edit', $app->id) }}"
           class="inline-block hover:scale-110 transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="currentColor" viewBox="0 0 24 24"
                 class="w-5 h-5 text-gray-800 hover:text-gray-600 inline">
                <path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
            </svg>
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('applications.destroy', $app->id) }}" method="POST"
              class="inline"
              onsubmit="return confirm('Yakin ingin menghapus {{ $app->name }}?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="currentColor" viewBox="0 0 24 24"
                     class="w-5 h-5 text-gray-800 hover:text-gray-600 inline">
                    <path d="M9 3v1H4v2h16V4h-5V3H9zm-2 6h2v9H7V9zm8 0h2v9h-2V9zm-4 0h2v9h-2V9z"/>
                </svg>
            </button>
        </form>
    @endif
</td>

=======
                                    <!-- Modal Konfirmasi -->
                                        <div id="confirmModal-{{ $app->id }}" 
                                            class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
                                            <div class="bg-white rounded-xl shadow-lg p-6 w-auto text-center">
                                                <h4 class="text-md font-semibold mb-2">Konfirmasi Hapus Aplikasi</h4>
                                                <p class="text-lg text-gray-600 mb-5">Apakah kamu yakin ingin menghapus <strong>{{ $app->name }}</strong>?</p>
                                                <div class="flex justify-center gap-2">
                                                    <button onclick="confirmDelete('{{ $app->id }}')" 
                                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                                                        Ya, Hapus
                                                    </button>
                                                    <button onclick="closeModal('{{ $app->id }}')" 
                                                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm font-medium">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
>>>>>>> e96f52f587663a7ec957cc8947a03cca41bc3009
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
