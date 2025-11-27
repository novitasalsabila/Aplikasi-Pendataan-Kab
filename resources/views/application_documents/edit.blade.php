<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <form action="{{ route('application_documents.update', $document->id) }}" method="POST" enctype="multipart/form-data"
              class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Edit Dokumen Aplikasi
                </h1>
                <p class="text-sm text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi Dokumen di bawah ini
                </p>
            </div>
            <div>
                <label class="block font-medium mb-1">Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($app->id == $document->application_id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Dokumen</label>
                <input type="text" name="doc_name" value="{{ $document->doc_name }}" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Jenis Dokumen</label>
                <select name="doc_type" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                    @foreach (['tor', 'kontrak', 'manual', 'lainnya'] as $type)
                        <option value="{{ $type }}" @selected($document->doc_type == $type)>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">File Dokumen</label>
                @if ($document->file_path)
                    <p class="text-sm text-gray-500 mb-1">File saat ini:
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                           class="text-blue-600 hover:underline">Lihat File</a>
                    </p>
                @endif
                <input type="file" name="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt"
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti file.</p>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
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
