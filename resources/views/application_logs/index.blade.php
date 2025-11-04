<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">📊 Riwayat Log Aplikasi</h1>
            <a href="{{ route('application_logs.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                + Tambah Log
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
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Aplikasi</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Jenis Perubahan</th>
                        <th class="px-4 py-3">Versi</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Reviewer</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($logs as $index => $log)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $log->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->title }}</td>
                            <td class="px-4 py-3 capitalize">{{ $log->change_type }}</td>
                            <td class="px-4 py-3">{{ $log->version ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->date ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->reviewer->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-white text-xs
                                    @if($log->approved_st == 'approved') bg-green-600
                                    @elseif($log->approved_st == 'rejected') bg-red-600
                                    @else bg-yellow-500 @endif">
                                    {{ ucfirst($log->approved_st) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('application_logs.edit', $log->id) }}"
                                   class="text-yellow-600 hover:text-yellow-700 font-semibold">Edit</a>
                                <form action="{{ route('application_logs.destroy', $log->id) }}" method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-700 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data log aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
