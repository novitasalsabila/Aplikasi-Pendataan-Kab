<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                👨‍💻 Daftar Pengembang
            </h1>
            <a href="{{ route('developers.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
               + Tambah Pengembang
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

        <!-- Table -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Tipe</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Telepon</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($developers as $index => $dev)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $dev->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $dev->developer_type }}</td>
                            <td class="px-4 py-3">{{ $dev->contact_email ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $dev->contact_phone ?? '-' }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('developers.show', $dev->id) }}"
                    class="text-blue-600 hover:text-blue-700 font-semibold">Lihat</a>
                                <a href="{{ route('developers.edit', $dev->id) }}"
                                   class="text-yellow-600 hover:text-yellow-700 font-semibold">
                                   Edit
                                </a>
                                <form action="{{ route('developers.destroy', $dev->id) }}" method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus {{ $dev->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-700 font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data pengembang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
