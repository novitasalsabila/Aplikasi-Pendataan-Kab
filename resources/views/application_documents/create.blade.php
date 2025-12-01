<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 sm:mt-20 md:mt-0">
        <form action="{{ route('application_documents.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-6 bg-white shadow-md rounded-lg p-6 border border-gray-500 text-sm">
            @csrf
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Tambah Dokumen Baru
                </h1>
                <p class="text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi Dokumen di bawah ini
                </p>
            </div>
            <div>
                <label class="block font-medium mb-1">Nama Dokumen</label>
                <input type="text" name="doc_name" required
                       class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class= font-medium mb-1">Aplikasi</label>
                <select name="application_id" required
                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-600">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Dokumen</label>
                <select name="doc_type" required
                        class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-600">
                    <option value="tor">TOR</option>
                    <option value="kontrak">Kontrak</option>
                    <option value="manual">Manual</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">File Dokumen</label>
                <input type="file" name="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt" required
                       class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-600">
                <p class="text-xs text-gray-500 mt-1">Format: PDF, DOCX, PPTX, XLSX (maks. 20MB)</p>
            </div>
            {{-- Tombol --}}
            <div class="flex justify-end space-x-3 text-md">
                <a href="{{ route('application_documents.index') }}"
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
