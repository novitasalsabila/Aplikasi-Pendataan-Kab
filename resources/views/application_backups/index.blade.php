<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">💾 Daftar Backup Aplikasi</h1>
            <a href="{{ route('application_backups.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                + Tambah Backup
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Aplikasi</th>
                        <th class="px-4 py-3 text-left">Tanggal Backup</th>
                        <th class="px-4 py-3 text-left">Jenis Backup</th>
                        <th class="px-4 py-3 text-left">Lokasi Penyimpanan</th>
                        <th class="px-4 py-3 text-left">Terverifikasi</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($backups as $index => $b)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $b->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($b->backup_date)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 capitalize">{{ $b->backup_type }}</td>
                            <td class="px-4 py-3">{{ $b->storage_location }}</td>
                            <td class="px-4 py-3">
                                @if ($b->verified_st === 'ya')
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Ya</span>
                                @else
                                    <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('application_backups.edit', $b->id) }}"
                                   class="text-yellow-600 hover:text-yellow-700 font-semibold">Edit</a>
                                <form action="{{ route('application_backups.destroy', $b->id) }}" method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus backup ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-700 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data backup aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
