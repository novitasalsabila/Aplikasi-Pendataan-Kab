<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">🔗 Daftar Integrasi Aplikasi</h2>
            <a href="{{ route('application_integrations.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
               + Tambah Integrasi
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
                        <th class="px-4 py-2">Aplikasi Sumber</th>
                        <th class="px-4 py-2">Aplikasi Tujuan</th>
                        <th class="px-4 py-2">Tipe Integrasi</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($integrations as $index => $integration)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $integration->sourceApp->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $integration->targetApp->name ?? '-' }}</td>
                            <td class="px-4 py-2 font-semibold">{{ $integration->type }}</td>
                            <td class="px-4 py-2">{{ Str::limit($integration->description, 50) ?? '-' }}</td>
                            <td class="px-4 py-2 flex justify-center gap-2">
                                <a href="{{ route('application_integrations.edit', $integration->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('application_integrations.destroy', $integration->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus integrasi ini?')">
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
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                Belum ada data integrasi aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
