<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Audit Keamanan</h2>

        <form action="{{ route('application_audits.store') }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <select name="application_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Auditor</label>
                <input type="text" name="auditor_name" placeholder="Contoh: Inayah Salsabila"
                       required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Audit</label>
                <input type="date" name="audit_date"
                       required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Level Risiko</label>
                <select name="risk_level" required class="w-full border rounded p-2 dark:bg-gray-700">
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Ringkasan Temuan</label>
                <textarea name="summary" rows="3" placeholder="Contoh: Sistem tidak memiliki enkripsi pada data login."
                          class="w-full border rounded p-2 dark:bg-gray-700"></textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Rekomendasi</label>
                <textarea name="recommendation" rows="3" placeholder="Contoh: Terapkan enkripsi SSL dan hash password."
                          class="w-full border rounded p-2 dark:bg-gray-700"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_audits.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
