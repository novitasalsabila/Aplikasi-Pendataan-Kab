<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Log Aplikasi</h2>

        <form action="{{ route('application_logs.store') }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            {{-- Aplikasi --}}
            <div>
                <label class="block font-medium mb-1">Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Contoh: Sistem Informasi Kepegawaian</p>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block font-medium mb-1">Judul</label>
                <input type="text" name="title" required
                       placeholder="Contoh: Penambahan fitur laporan bulanan"
                       class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Jenis Perubahan --}}
            <div>
                <label class="block font-medium mb-1">Jenis Perubahan</label>
                <select name="change_type" required
                        class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    <option value="penambahan">Penambahan</option>
                    <option value="perbaikan">Perbaikan</option>
                    <option value="penghapusan">Penghapusan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Contoh: Pilih “Perbaikan” jika memperbaiki bug pada modul.</p>
            </div>

            {{-- Versi dan Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Versi</label>
                    <input type="text" name="version" placeholder="Contoh: v2.3.1"
                           class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal</label>
                    <input type="date" name="date"
                           class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Contoh: 2025-10-20</p>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                          placeholder="Contoh: Memperbaiki error validasi data user pada halaman registrasi."
                          class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            {{-- Reviewer & Status Persetujuan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Reviewer</label>
                    <select name="reviewed_by" class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Pilih Reviewer --</option>
                        @foreach ($reviewers as $rev)
                            <option value="{{ $rev->id }}">{{ $rev->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Contoh: Admin Sistem / Kepala Divisi</p>
                </div>
                <div>
                    <label class="block font-medium mb-1">Status Persetujuan</label>
                    <select name="approved_st" class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Contoh: Pilih “Pending” jika masih menunggu verifikasi.</p>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_logs.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
