<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        
        <form action="{{ route('application_integrations.update', $integration->id) }}" method="POST"
              class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

        <!-- Header -->
            <div class="relative mb-6">
                <!-- Kiri: Judul dan deskripsi -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Integrasi Aplikasi</h1>
                    <p class="text-sm text-gray-500 -mt-1 mb-10">
                        Lengkapi informasi Integrasi Aplikasi di bawah ini
                    </p>

                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Aplikasi Sumber</label>
                <select name="source_app_id" required class="w-full border rounded p-2 text-sm text-gray-600">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($integration->source_app_id == $app->id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Aplikasi Tujuan</label>
                <select name="target_app_id" required class="w-full border rounded p-2 text-sm text-gray-600">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" @selected($integration->target_app_id == $app->id)>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Integrasi</label>
                <select name="type" required class="w-full border rounded p-2 text-sm text-gray-600">
                    @foreach ($types as $t)
                        <option value="{{ $t }}" @selected($integration->type == $t)>{{ $t }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded p-2 text-sm text-gray-600">{{ $integration->description }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_integrations.index') }}"
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
