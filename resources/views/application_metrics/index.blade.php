<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">📈 Daftar Metrik Aplikasi</h2>
            <a href="{{ route('application_metrics.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
               + Tambah Data
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Aplikasi</th>
                        <th class="px-4 py-2">Tanggal Cek</th>
                        <th class="px-4 py-2">Uptime (%)</th>
                        <th class="px-4 py-2">Response (s)</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Catatan</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($metrics as $index => $m)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $m->application->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($m->check_date)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $m->uptime ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $m->response_time ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-white
                                    @if($m->status == 'normal') bg-green-600
                                    @elseif($m->status == 'lambat') bg-yellow-500
                                    @else bg-red-600 @endif">
                                    {{ ucfirst($m->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $m->note ?? '-' }}</td>
                            <td class="px-4 py-2 flex justify-center gap-2">
                                <a href="{{ route('application_metrics.edit', $m->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('application_metrics.destroy', $m->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center text-gray-500">Belum ada data metrik aplikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
