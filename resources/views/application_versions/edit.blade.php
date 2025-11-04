<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">✏️ Edit Versi Aplikasi</h2>

        <form action="{{ route('application_versions.update', $version->id) }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <select name="application_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($app->id == $version->application_id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Kode Versi</label>
                <input type="text" name="version_code" value="{{ $version->version_code }}"
                       required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Rilis</label>
                <input type="date" name="release_date" value="{{ $version->release_date }}"
                       class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Catatan Perubahan (Changelog)</label>
                <textarea name="changelog" rows="4"
                          class="w-full border rounded p-2 dark:bg-gray-700">{{ $version->changelog }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_versions.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
