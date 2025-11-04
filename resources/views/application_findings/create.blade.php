<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Temuan Aplikasi</h2>

        <form action="{{ route('application_findings.store') }}" method="POST"
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium mb-1">Tipe Temuan</label>
                    <select name="type" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="bug">Bug</option>
                        <option value="vulnerability">Vulnerability</option>
                        <option value="hack">Hack</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Sumber</label>
                    <select name="source" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="user">User</option>
                        <option value="monitoring">Monitoring</option>
                        <option value="audit">Audit</option>
                        <option value="laporan_masyarakat">Laporan Masyarakat</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tingkat Keparahan</label>
                    <select name="severity" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi Temuan</label>
                <textarea name="description" rows="3" placeholder="Contoh: Sistem login tidak memvalidasi input dengan benar."
                          class="w-full border rounded p-2 dark:bg-gray-700"></textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2 dark:bg-gray-700">
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Tindak Lanjut (Opsional)</label>
                <textarea name="follow_up_action" rows="2" placeholder="Contoh: Patch diterapkan dan diuji ulang."
                          class="w-full border rounded p-2 dark:bg-gray-700"></textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Tindak Lanjut</label>
                <input type="date" name="follow_up_date" class="w-full border rounded p-2 dark:bg-gray-700">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_findings.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
