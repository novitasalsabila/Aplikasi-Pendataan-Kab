<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">🧾 Daftar Versi Aplikasi</h2>

            {{-- Tombol tambah hanya untuk admin dan diskominfo --}}
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'diskominfo')
                <a href="{{ route('application_versions.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                   + Tambah Versi
                </a>
            @endif
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
                        <th class="px-4 py-2">Versi</th>
                        <th class="px-4 py-2">Tanggal Rilis</th>
                        <th class="px-4 py-2">Perubahan</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($versions as $index => $ver)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $ver->application->name ?? '-' }}</td>
                            <td class="px-4 py-2 font-semibold">{{ $ver->version_code }}</td>
                            <td class="px-4 py-2">
                                {{ $ver->release_date ? \Carbon\Carbon::parse($ver->release_date)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-4 py-2">{{ Str::limit($ver->changelog, 50) ?? '-' }}</td>
                            <td class="px-4 py-2 flex justify-center gap-2">

                                {{-- Semua role bisa lihat detail --}}
                                <a href="{{ route('application_versions.show', $ver->id) }}"
                                   class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                   Detail
                                </a>

                                {{-- Diskominfo boleh edit & hapus --}}
                                @if(auth()->user()->role === 'diskominfo')
                                    <a href="{{ route('application_versions.edit', $ver->id) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                       Edit
                                    </a>

                                    <form action="{{ route('application_versions.destroy', $ver->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus versi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                Belum ada data versi aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
