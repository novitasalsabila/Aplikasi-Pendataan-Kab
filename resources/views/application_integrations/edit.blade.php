<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">✏️ Edit Integrasi Aplikasi</h2>

        <form action="{{ route('application_integrations.update', $integration->id) }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Aplikasi Sumber</label>
                <select name="source_app_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($integration->source_app_id == $app->id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Aplikasi Tujuan</label>
                <select name="target_app_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($integration->target_app_id == $app->id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Integrasi</label>
                <select name="type" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach ($types as $t)
                        <option value="{{ $t }}" @selected($integration->type == $t)>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded p-2 dark:bg-gray-700">{{ $integration->description }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_integrations.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
