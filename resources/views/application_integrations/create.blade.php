<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Integrasi Aplikasi</h2>

        <form action="{{ route('application_integrations.store') }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div>
                <label class="block font-medium mb-1">Aplikasi Sumber</label>
                <select name="source_app_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                    <option value="">-- Pilih Aplikasi Sumber --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Contoh: Sistem Kepegawaian</p>
            </div>

            <div>
                <label class="block font-medium mb-1">Aplikasi Tujuan</label>
                <select name="target_app_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                    <option value="">-- Pilih Aplikasi Tujuan --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Contoh: Dashboard Integrasi Data</p>
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Integrasi</label>
                <select name="type" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach ($types as $t)
                        <option value="{{ $t }}">{{ $t }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Contoh: API, Database, File, Manual</p>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4" placeholder="Contoh: Integrasi API REST untuk pertukaran data pegawai."
                          class="w-full border rounded p-2 dark:bg-gray-700"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_integrations.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
