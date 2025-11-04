<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Dokumen Aplikasi</h2>

        <form action="{{ route('application_documents.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div>
                <label class="block font-medium mb-1">Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Dokumen</label>
                <input type="text" name="doc_name" required
                       class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Jenis Dokumen</label>
                <select name="doc_type" required
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    <option value="tor">TOR</option>
                    <option value="kontrak">Kontrak</option>
                    <option value="manual">Manual</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">File Dokumen</label>
                <input type="file" name="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt" required
                       class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Format: PDF, DOCX, PPTX, XLSX (maks. 2MB)</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_documents.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
