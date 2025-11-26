<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        {{-- <x-page-header 
            title="Edit Informasi Server"
            subtitle="Lengkapi informasi server di bawah ini."
        /> --}}


        <form action="{{ route('servers.update', $server->id) }}" method="POST" class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Edit Informasi Server
                </h1>
                <p class="text-sm text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi Server di bawah ini
                </p>
            </div>

            <div>
                <label class="block font-medium mb-1">Hostname</label>
                <input type="text" name="hostname" value="{{ $server->hostname }}" required
                       class="w-full border rounded p-2 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">IP Address</label>
                <input type="text" name="ip_address" value="{{ $server->ip_address }}" required
                       class="w-full border rounded p-2 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Sistem Operasi</label>
                <input type="text" name="os" value="{{ $server->os }}"
                       class="w-full border rounded p-2 text-sm text-gray-600">
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block font-medium mb-1">Lokasi</label>
                    <input type="text" name="location" value="{{ $server->location }}"
                           class="w-full border rounded p-2 text-sm text-gray-600">
                </div>
                <div>
                    <label class="block font-medium mb-1">Dikelola Oleh</label>
                    <input type="text" name="managed_by" value="{{ $server->managed_by }}"
                           class="w-full border rounded p-2 text-sm text-gray-600">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Status</label>
                <select name="status" required class="w-full border rounded p-2 text-sm text-gray-600">
                    @foreach (['aktif', 'nonaktif', 'maintenance'] as $status)
                        <option value="{{ $status }}" {{ $server->status == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('servers.index') }}"
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
