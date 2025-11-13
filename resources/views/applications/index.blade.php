<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">

        <!-- Header -->
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
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Aplikasi</th>
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
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
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

                            <!-- Kolom Aksi -->
                            <!-- <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('applications.show', $app->id) }}"
                                   class="text-blue-600 hover:text-blue-700 font-semibold">
                                   Lihat
                                </a>

                                {{-- Tombol Edit & Hapus hanya untuk admin/diskominfo --}}
                                @if(auth()->user()->role !== 'opd')
                                    <a href="{{ route('applications.edit', $app->id) }}"
                                       class="text-yellow-600 hover:text-yellow-700 font-semibold">
                                       Edit
                                    </a>

                                    <form action="{{ route('applications.destroy', $app->id) }}" method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus {{ $app->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-700 font-semibold">
                                            Hapus
                                        </button>
                                    </form>
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
