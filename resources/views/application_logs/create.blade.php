<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        
        <form action="{{ route('application_logs.store') }}" method="POST"
              class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf

        <!-- Header -->
            <div class="relative mb-6">
                <!-- Kiri: Judul dan deskripsi -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-0">
                        Tambah Log Pengembangan Aplikasi
                    </h1>

                    <p class="text-sm text-gray-500 w-3/4 sm:w-auto -mt-1 mb-10">
                        {{ __('Lengkapi informasi Aplikasi di bawah ini') }} 
                    </p>

                </div>
            </div>

            {{-- Aplikasi --}}
            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block font-medium mb-1">Judul Perubahan</label>
                <input type="text" name="title" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600"></textarea>
            </div>
            
            {{-- Jenis Perubahan --}}
            <div class="space-y-1">
                <label class="block font-medium text-gray-700">Jenis Perubahan *</label>

                <select name="change_type" 
                        required
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    
                    <option value="">-- Pilih Jenis Perubahan --</option>

                    <option value="penambahan" 
                        {{ old('change_type', $change->change_type ?? '') === 'penambahan' ? 'selected' : '' }}>
                        Penambahan
                    </option>

                    <option value="perbaikan" 
                        {{ old('change_type', $change->change_type ?? '') === 'perbaikan' ? 'selected' : '' }}>
                        Perbaikan
                    </option>

                    <option value="penghapusan" 
                        {{ old('change_type', $change->change_type ?? '') === 'penghapusan' ? 'selected' : '' }}>
                        Penghapusan
                    </option>

                    <option value="lainnya" 
                        {{ old('change_type', $change->change_type ?? '') === 'lainnya' ? 'selected' : '' }}>
                        Lainnya
                    </option>
                </select>
            </div>


            {{-- Versi dan Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Versi Terakhir</label>
                    <input 
                        type="text" 
                        id="version-input"
                        name="version"
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600"
                    >
                    <p class="text-xs text-red-600">*Versi akan otomatis muncul setelah memilih aplikasi</p>
                </div>

                <div>
                    <label class="block font-medium mb-1">Tanggal Perubahan</label>
                    <input type="date" name="date"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
            </div>

            {{-- Reviewer & Status Persetujuan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Reviewer</label>
                    <select name="reviewed_by" class="w-full border rounded p-2 text-sm text-gray-600">
                        <option value="">-- Pilih Reviewer --</option>
                        @foreach ($reviewers as $rev)
                            <option value="{{ $rev->id }}">{{ $rev->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Status Persetujuan</label>
                    <select name="approved_st" class="w-full border rounded p-2 text-sm text-gray-600">
                        <option value="pending">Diproses</option>
                        <option value="approved">Diterima</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_logs.index') }}"
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
    
    <script>
    // Data versi terbaru dari controller (ubah ke JS object)
    const latestVersions = @json($latestVersions);

    const appSelect = document.querySelector('select[name="application_id"]');
    const versionInput = document.getElementById('version-input');

    appSelect.addEventListener('change', function () {
        let appId = this.value;

        if (latestVersions[appId]) {
            versionInput.value = latestVersions[appId].version_code;
        } else {
            versionInput.value = '';
        }
    });
</script>

</x-app-layout>
