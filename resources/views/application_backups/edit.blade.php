<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">✏️ Edit Backup Aplikasi</h2>

        <form action="{{ route('application_backups.update', $backup->id) }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" {{ $backup->application_id == $app->id ? 'selected' : '' }}>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Tanggal Backup</label>
                    <input type="datetime-local" name="backup_date"
                           value="{{ \Carbon\Carbon::parse($backup->backup_date)->format('Y-m-d\TH:i') }}" required
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Jenis Backup</label>
                    <select name="backup_type" required
                            class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                        @foreach (['harian', 'mingguan', 'bulanan', 'manual'] as $type)
                            <option value="{{ $type }}" {{ $backup->backup_type == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Lokasi Penyimpanan</label>
                <input type="text" name="storage_location"
                       value="{{ $backup->storage_location }}" required
                       class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Verifikasi</label>
                <select name="verified_st" required
                        class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                    <option value="ya" {{ $backup->verified_st === 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="tidak" {{ $backup->verified_st === 'tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_backups.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
