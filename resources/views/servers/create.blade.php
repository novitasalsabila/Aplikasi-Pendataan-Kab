<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
         
        <form action="{{ route('servers.store') }}" method="POST" class="space-y-5 bg-white shadow-md rounded-lg p-6">
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
                <h1 class="text-2xl font-bold text-gray-800">
                    Tambah Server Baru
                </h1>
                <p class="text-sm text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi Server di bawah ini
                </p>
            </div>


            <div>
                <label class="block font-medium mb-1">Hostname</label>
                <input type="text" name="hostname" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">IP Address</label>
                <input type="text" name="ip_address" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Sistem Operasi</label>
                <input type="text" name="os"
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block font-medium mb-1">Lokasi</label>
                    <input type="text" name="location"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
                <div>
                    <label class="block font-medium mb-1">Dikelola Oleh</label>
                    <input type="text" name="managed_by"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Status Server</label>
                <select name="status" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                    <option value="">-- Pilih Status --</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                    <option value="maintenance">Maintenance</option>
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
