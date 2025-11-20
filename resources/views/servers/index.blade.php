<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">🖥️ Daftar Server</h1>
            <a href="{{ route('servers.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                + Tambah Server
            </a>
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

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Hostname</th>
                        <th class="px-4 py-3 text-left">IP Address</th>
                        <th class="px-4 py-3 text-left">OS</th>
                        <th class="px-4 py-3 text-left">Lokasi</th>
                        <th class="px-4 py-3 text-left">Dikelola Oleh</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($servers as $index => $srv)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $srv->hostname }}</td>
                            <td class="px-4 py-3">{{ $srv->ip_address }}</td>
                            <td class="px-4 py-3">{{ $srv->os ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $srv->location ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $srv->managed_by ?? '-' }}</td>
                            <td class="px-4 py-3 capitalize">{{ $srv->status }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('servers.edit', $srv->id) }}"
                                   class="text-yellow-600 hover:text-yellow-700 font-semibold">Edit</a>
                                <form action="{{ route('servers.destroy', $srv->id) }}" method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus {{ $srv->hostname }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-700 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data server.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
