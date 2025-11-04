<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                📋 Daftar OPD
            </h1>

            <!-- Tombol Tambah OPD -->
            <a href="{{ route('departments.create') }}"
               class="inline-flex items-center justify-center gap-2
                      bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500
                      text-white font-semibold px-4 py-2 rounded-lg shadow-md
                      hover:from-blue-600 hover:via-indigo-600 hover:to-purple-600
                      transition-all duration-300 transform hover:scale-105
                      focus:outline-none focus:ring-2 focus:ring-blue-300
                      !opacity-100 !cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah OPD
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Nama OPD</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Kepala OPD</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Kontak</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($departments as $index => $dept)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-100">{{ $dept->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $dept->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $dept->head_name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $dept->head_phone }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('departments.edit', $dept->id) }}"
                                       class="bg-yellow-400 text-gray-900 text-xs font-semibold px-3 py-1 rounded hover:bg-yellow-500">
                                        Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('departments.destroy', $dept->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus {{ $dept->name }}?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
