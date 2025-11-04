<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6 space-y-8">

        <!-- Profil Pengembang -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">
                👤 Profil Pengembang
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
                <div><strong>Nama:</strong> {{ $developer->name }}</div>
                <div><strong>Tipe:</strong> {{ ucfirst($developer->developer_type) }}</div>
                <div><strong>Email:</strong> {{ $developer->contact_email ?? '-' }}</div>
                <div><strong>Telepon:</strong> {{ $developer->contact_phone ?? '-' }}</div>
            </div>
        </div>

        <!-- Daftar Aplikasi -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">
                Daftar Aplikasi yang Dikembangkan
            </h2>

            @if($developer->applications->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Belum ada aplikasi yang dikembangkan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-700 dark:text-gray-300 border">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-4 py-3 text-left">No</th>
                                <th class="px-4 py-3 text-left">Nama Aplikasi</th>
                                <th class="px-4 py-3 text-left">Kategori</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-left">OPD Terkait</th>
                                <th class="px-4 py-3 text-left">Update Terakhir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($developer->applications as $index => $app)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $app->name }}</td>
                                    <td class="px-4 py-3">{{ ucfirst($app->category) }}</td>
                                    <td class="px-4 py-3">{{ ucfirst($app->status) }}</td>
                                    <td class="px-4 py-3">{{ $app->department->name ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        {{ $app->last_update ? \Carbon\Carbon::parse($app->last_update)->format('d M Y') : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="text-right">
            <a href="{{ route('developers.index') }}"
               class="bg-gray-600 text-gren px-4 py-2 rounded-lg hover:bg-gray-700 transition">
               ← Kembali ke Daftar
            </a>
        </div>

    </div>
</x-app-layout>
