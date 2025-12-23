<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
       
        <form action="{{ route('application_logs.update', $log->id) }}" method="POST"
            class="space-y-6 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
        <!-- Header -->
            <div class="relative mb-6">
                <!-- Kiri: Judul dan deskripsi -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-0">
                        Edit Log Pengembangan Aplikasi
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
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600"">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($log->application_id == $app->id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block font-medium mb-1">Judul Perubahan</label>
                <input type="text" name="title" value="{{ $log->title }}" required
                    class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            {{-- Jenis Perubahan --}}
            <div>
                <label class="block font-medium mb-1">Jenis Perubahan</label>
                <select name="change_type" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                    @foreach (['penambahan', 'perbaikan', 'penghapusan', 'lainnya'] as $type)
                        <option value="{{ $type }}" @selected($log->change_type == $type)>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                        placeholder="Contoh: Menambahkan validasi data baru dan memperbaiki error pada fitur login."
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">{{ $log->description }}</textarea>
            </div>

            {{-- Versi dan Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Versi Terakhir (Referensi)</label>
                    <input type="text"
                        value="{{ $latestVersion->version_code ?? 'Belum ada versi' }}"
                        readonly
                        class="w-full border rounded p-2 text-sm text-gray-600 cursor-not-allowed">
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal Perubahan</label>
                    <input type="date" name="date" value="{{ $log->date }}"
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
            </div>

            {{-- Reviewer & Status Persetujuan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Reviewer</label>
                    <select name="reviewed_by" class="w-full border rounded p-2 text-sm text-gray-600">
                        <option value="">-- Pilih Reviewer --</option>
                        @foreach ($reviewers as $rev)
                            <option value="{{ $rev->id }}" @selected($log->reviewed_by == $rev->id)>
                                {{ $rev->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Status Persetujuan</label>
                    <select name="approved_st" class="w-full border rounded p-2 text-sm text-gray-600">
                        @foreach (['disetujui', 'diproses', 'ditolak'] as $value)
                            <option value="{{ $value }}" {{ $log->approved_st === $value ? 'selected' : '' }}>
                                {{ ucfirst ($value) }}
                            </option>
                        @endforeach
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
</x-app-layout>
