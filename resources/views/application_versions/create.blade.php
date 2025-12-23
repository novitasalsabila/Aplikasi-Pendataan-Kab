<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">

        <form action="{{ route('application_versions.store') }}" method="POST"
              class="space-y-5 bg-white shadow-md rounded-lg p-6 text-sm">
            @csrf
        <!-- Header -->
        <div class="relative mb-6">
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Tambah Versi Aplikasi
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Lengkapi informasi Aplikasi di bawah ini') }} 
                </p>

            </div>
        </div>
            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <select name="application_id" required class="w-full border rounded p-2 text-sm text-gray-600">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Kode Versi</label>
                <input type="text" name="version_code" placeholder="Contoh: v1.0.0"
                       required class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Rilis</label>
                <input type="date" name="release_date"
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Catatan Perubahan</label>
                <textarea name="changelog" rows="4" placeholder="Contoh: Penambahan fitur baru dan perbaikan bug minor."
                          class="w-full border rounded p-2 text-sm text-gray-600"></textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_versions.index') }}"
                class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition no-underline flex items-center gap-2">
                    <span>Batal</span>
                </a>
                <button type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
