<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Server</h2>

        <form action="{{ route('servers.store') }}" method="POST" class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            {{-- ✅ Tampilkan error kalau validasi gagal --}}
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
                <label class="block font-medium mb-1">Hostname</label>
                <input type="text" name="hostname" required
                       class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">IP Address</label>
                <input type="text" name="ip_address" required
                       placeholder="contoh: 192.168.0.10"
                       class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Sistem Operasi</label>
                <input type="text" name="os"
                       placeholder="misal: Ubuntu 22.04 LTS"
                       class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Lokasi</label>
                    <input type="text" name="location"
                           placeholder="misal: Data Center Dinas Kominfo"
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Dikelola Oleh</label>
                    <input type="text" name="managed_by"
                           placeholder="misal: Tim IT Diskominfo"
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Status Server</label>
                <select name="status" required
                        class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Status --</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('servers.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                    Kembali
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
