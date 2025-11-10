<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                Daftar Aplikasi
            </h1>

            {{-- Tombol tambah hanya untuk admin dan diskominfo --}}
            @if(auth()->user()->role !== 'opd')
                <a href="{{ route('applications.create') }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
                    + Tambah Aplikasi
                </a>
            @endif
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
                        <th class="px-3 py-3 text-left w-12">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Sensitivitas</th>
                        <th class="px-4 py-3 text-left">OPD</th>
                        <th class="px-4 py-3 text-left">Developer</th>
                        <th class="px-4 py-3 text-left">Server</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Terakhir Update</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($applications as $index => $app)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-3 py-3 w-12">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $app->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $app->category }}</td>
                            <td class="px-4 py-3 capitalize">{{ $app->data_sensitivity }}</td>
                            <td class="px-4 py-3">{{ $app->department->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $app->developer->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $app->server->hostname ?? '-' }}</td>
                            <td class="px-4 py-3 capitalize">{{ $app->status }}</td>
                            <td class="px-4 py-3">
                                {{ $app->last_update ? \Carbon\Carbon::parse($app->last_update)->format('d M Y') : '-' }}
                            </td>

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
