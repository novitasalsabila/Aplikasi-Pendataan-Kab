<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">

        <!-- Judul -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">
            📄 Detail Versi Aplikasi
        </h2>

        <!-- Card Detail -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">

            <div class="mb-5">
                <h3 class="text-gray-600 dark:text-gray-300 text-sm">Nama Aplikasi</h3>
                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $version->application->name ?? '-' }}
                </p>
            </div>

            <div class="mb-5">
                <h3 class="text-gray-600 dark:text-gray-300 text-sm">Kode Versi</h3>
                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $version->version_code }}
                </p>
            </div>

            <div class="mb-5">
                <h3 class="text-gray-600 dark:text-gray-300 text-sm">Tanggal Rilis</h3>
                <p class="text-gray-900 dark:text-gray-100">
                    {{ $version->release_date ? \Carbon\Carbon::parse($version->release_date)->format('d M Y') : '-' }}
                </p>
            </div>

            <div class="mb-2">
                <h3 class="text-gray-600 dark:text-gray-300 text-sm">Catatan Perubahan (Changelog)</h3>
                <p class="text-gray-900 dark:text-gray-100 whitespace-pre-line mt-1">
                    {{ $version->changelog ?? '-' }}
                </p>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex gap-3">

            <a href="{{ route('application_versions.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                ⬅ Kembali
            </a>

            @if(auth()->user()->role === 'diskominfo')
                <a href="{{ route('application_versions.edit', $version->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                    ✏ Edit
                </a>

                <form action="{{ route('application_versions.destroy', $version->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus versi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        🗑 Hapus
                    </button>
                </form>
            @endif

        </div>

    </div>
</x-app-layout>
