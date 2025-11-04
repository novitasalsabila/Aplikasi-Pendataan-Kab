<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">✏️ Edit Server</h2>

        <form action="{{ route('servers.update', $server->id) }}" method="POST" class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Hostname</label>
                <input type="text" name="hostname" value="{{ $server->hostname }}" required
                       class="w-full border rounded p-2 dark:bg-gray-700">
            </div>

            <div>
                <label class="block font-medium mb-1">IP Address</label>
                <input type="text" name="ip_address" value="{{ $server->ip_address }}" required
                       class="w-full border rounded p-2 dark:bg-gray-700">
            </div>

            <div>
                <label class="block font-medium mb-1">Sistem Operasi</label>
                <input type="text" name="os" value="{{ $server->os }}"
                       class="w-full border rounded p-2 dark:bg-gray-700">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Lokasi</label>
                    <input type="text" name="location" value="{{ $server->location }}"
                           class="w-full border rounded p-2 dark:bg-gray-700">
                </div>
                <div>
                    <label class="block font-medium mb-1">Dikelola Oleh</label>
                    <input type="text" name="managed_by" value="{{ $server->managed_by }}"
                           class="w-full border rounded p-2 dark:bg-gray-700">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Status</label>
                <select name="status" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach (['aktif', 'nonaktif', 'maintenance'] as $status)
                        <option value="{{ $status }}" {{ $server->status == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('servers.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
