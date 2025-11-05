<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-6 space-y-8">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Detail Aplikasi
            </h1>
            <a href="{{ route('applications.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-gray-700 transition">
                ← Kembali
            </a>
        </div>

        <!-- Informasi Utama -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $application->name }}</h2>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full text-xs font-medium capitalize">
                    {{ $application->category }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-700 dark:text-gray-300">
                <p><strong>Sensitivitas:</strong> {{ ucfirst($application->data_sensitivity) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>
                <p><strong>Developer:</strong> {{ $application->developer->name ?? '-' }}</p>
                <p><strong>OPD:</strong> {{ $application->department->name ?? '-' }}</p>
                <p><strong>Server:</strong> {{ $application->server->hostname ?? '-' }}</p>
                <p><strong>Update Terakhir:</strong> {{ $application->last_update ? \Carbon\Carbon::parse($application->last_update)->format('d M Y') : '-' }}</p>
            </div>

            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-sm text-gray-700 dark:text-gray-300">
                <strong>Deskripsi:</strong>
                <p class="mt-2 whitespace-pre-line">{{ $application->description ?? 'Tidak ada deskripsi tersedia.' }}</p>
            </div>

            @if(auth()->user()->role !== 'opd')
                <div class="flex space-x-2">
                    <a href="{{ route('applications.edit', $application->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-yellow-600 transition text-sm">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus {{ $application->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-red-600 transition text-sm">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Log Pengembangan -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                🧰 Log Pengembangan
            </h2>

            @if($application->logs->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada log pengembangan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Deskripsi</th>
                                <th class="px-4 py-2 text-left">Dibuat Oleh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($application->logs as $log)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</td>
                                    <td class="px-4 py-2">{{ $log->description }}</td>
                                    <td class="px-4 py-2">{{ $log->user->name ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Temuan -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">
                ⚠️ Temuan Keamanan / Bug
            </h2>

            @if($application->findings->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-sm">Tidak ada temuan untuk aplikasi ini.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Kategori</th>
                                <th class="px-4 py-2 text-left">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($application->findings as $finding)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($finding->created_at)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $finding->category ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $finding->description ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
