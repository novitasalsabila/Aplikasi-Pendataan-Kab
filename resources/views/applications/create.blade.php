<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Aplikasi</h2>

        <form action="{{ route('applications.store') }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <input type="text" name="name" required
                       class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="category" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Pilih --</option>
                        <option value="web">Web</option>
                        <option value="mobile">Mobile</option>
                        <option value="desktop">Desktop</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Sensitivitas Data</label>
                    <select name="data_sensitivity" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Pilih --</option>
                        <option value="publik">Publik</option>
                        <option value="internal">Internal</option>
                        <option value="rahasia">Rahasia</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium mb-1">OPD</label>
                    <select name="department_id" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Pilih OPD --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Developer</label>
                    <select name="developer_id" class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Pilih Developer --</option>
                        @foreach ($developers as $dev)
                            <option value="{{ $dev->id }}">{{ $dev->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Server</label>
                    <select name="server_id" class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="">-- Pilih Server --</option>
                        @foreach ($servers as $srv)
                            <option value="{{ $srv->id }}">{{ $srv->hostname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Status</label>
                    <select name="status" required class="w-full border rounded p-2 dark:bg-gray-700">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Terakhir Update</label>
                    <input type="date" name="last_update"
                           class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('applications.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
