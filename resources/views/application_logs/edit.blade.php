<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
       <div class="flex items-start gap-3">
            {{-- Tombol panah kembali --}}
            <button type="button"
                    onclick="history.back()"
                    class="mt-1 inline-flex items-center justify-center p-1
                        text-gray-700 hover:text-gray-900
                        dark:text-gray-200 dark:hover:text-white
                        rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                </svg>
            </button>

            {{-- Judul + teks bawah --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-0">
                    Edit Log Pengembangan Aplikasi
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Lengkapi informasi aplikasi di bawah ini.') }}
                </p>
            </div>
        </div>

        <form action="{{ route('application_logs.update', $log->id) }}" method="POST"
            class="space-y-6 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            {{-- Aplikasi --}}
            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($log->application_id == $app->id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Contoh: Sistem Informasi Kepegawaian</p>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block font-medium mb-1">Judul Perubahan</label>
                <input type="text" name="title" value="{{ $log->title }}" required
                    placeholder="Contoh: Penambahan fitur laporan bulanan"
                    class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Jenis Perubahan --}}
            <div>
                <label class="block font-medium mb-1">Jenis Perubahan</label>
                <select name="change_type" required
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    @foreach (['penambahan', 'perbaikan', 'penghapusan', 'lainnya'] as $type)
                        <option value="{{ $type }}" @selected($log->change_type == $type)>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">
                    Contoh: Pilih “Perbaikan” jika memperbaiki bug pada modul.
                </p>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                        placeholder="Contoh: Menambahkan validasi data baru dan memperbaiki error pada fitur login."
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">{{ $log->description }}</textarea>
            </div>

            {{-- Versi dan Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Versi</label>
                    <input type="text" name="version" value="{{ $log->version }}"
                        placeholder="Contoh: v2.3.1"
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal Perubahan</label>
                    <input type="date" name="date" value="{{ $log->date }}"
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Contoh: 2025-10-20</p>
                </div>
            </div>

            {{-- Reviewer & Status Persetujuan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Reviewer</label>
                    <select name="reviewed_by" class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Pilih Reviewer --</option>
                        @foreach ($reviewers as $rev)
                            <option value="{{ $rev->id }}" @selected($log->reviewed_by == $rev->id)>
                                {{ $rev->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Contoh: Admin Sistem / Kepala Divisi</p>
                </div>
                <div>
                    <label class="block font-medium mb-1">Status Persetujuan</label>
                    <select name="approved_st" class="w-full border rounded p-2 dark:bg-gray-700">
                        @foreach (['pending', 'approved', 'rejected'] as $status)
                            <option value="{{ $status }}" @selected($log->approved_st == $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">
                        Contoh: Pilih “Approved” jika sudah disetujui oleh reviewer.
                    </p>
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
