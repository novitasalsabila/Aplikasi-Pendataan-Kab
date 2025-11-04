<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Backup Aplikasi</h2>

        <form action="{{ route('application_backups.store') }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="block font-medium mb-1">Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Tanggal Backup</label>
                    <input type="datetime-local" name="backup_date" required
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Jenis Backup</label>
                    <select name="backup_type" required
                            class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Lokasi Penyimpanan</label>
                <input type="text" name="storage_location" required placeholder="/backup/app_01/"
                       class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Verifikasi</label>
                <select name="verified_st" required
                        class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                    <option value="ya">Ya</option>
                    <option value="tidak" selected>Tidak</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_backups.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
