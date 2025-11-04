<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">✏️ Edit Log Aplikasi</h2>

        <form action="{{ route('application_logs.update', $log->id) }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            {{-- Aplikasi --}}
            <div>
                <label class="block font-medium mb-1">Aplikasi</label>
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
                <label class="block font-medium mb-1">Judul</label>
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
                <p class="text-xs text-gray-500 mt-1">Contoh: Pilih “Perbaikan” jika memperbaiki bug pada modul.</p>
            </div>

            {{-- Versi dan Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Versi</label>
                    <input type="text" name="version" value="{{ $log->version }}"
                           placeholder="Contoh: v2.3.1"
                           class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal</label>
                    <input type="date" name="date" value="{{ $log->date }}"
                           class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Contoh: 2025-10-20</p>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                          placeholder="Contoh: Menambahkan validasi data baru dan memperbaiki error pada fitur login."
                          class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">{{ $log->description }}</textarea>
            </div>

            {{-- Reviewer & Status Persetujuan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                    <p class="text-xs text-gray-500 mt-1">Contoh: Pilih “Approved” jika sudah disetujui oleh reviewer.</p>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_logs.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
