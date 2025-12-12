<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        
        <form action="{{ route('applications.store') }}" method="POST"
            class="space-y-8 bg-white shadow-md rounded-lg p-8">
            @csrf

            <!-- HEADER -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Tambah Aplikasi Baru
                </h2>
                <p class="text-sm text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi aplikasi di bawah ini.
                </p>
            </div>

            <!-- NAMA -->
            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <input type="text" name="name" required
                    class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700">
            </div>

            <!-- KATEGORI & DATA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="category" required
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="">-- Pilih --</option>
                        <option value="web">Web</option>
                        <option value="mobile">Mobile</option>
                        <option value="desktop">Desktop</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-1">Sensitivitas Data</label>
                    <select name="data_sensitivity" required
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="">-- Pilih --</option>
                        <option value="publik">Publik</option>
                        <option value="internal">Internal</option>
                        <option value="rahasia">Rahasia</option>
                    </select>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="3"
                        placeholder="Jelaskan fungsi dan tujuan aplikasi"
                        class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700"></textarea>
            </div>

            <!-- OPD - DEV - SERVER -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block font-medium mb-1">OPD</label>
                    <select name="department_id" required
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="">-- Pilih OPD --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-1">Developer</label>
                    <select name="developer_id"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="">-- Pilih Developer --</option>
                        @foreach ($developers as $dev)
                            <option value="{{ $dev->id }}">{{ $dev->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-1">Server</label>
                    <select name="server_id"
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="">-- Pilih Server --</option>
                        @foreach ($servers as $srv)
                            <option value="{{ $srv->id }}">{{ $srv->hostname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- STATUS + VERSION -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium mb-1">Status</label>
                    <select name="status" required
                            class="w-full border rounded-lg p-2.5 text-sm text-gray-700">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                        <option value="maintenance">Dalam Perbaikan</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium mb-1">Versi Aplikasi</label>
                        <input type="text" name="version_code"
                            class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700">
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Tanggal Rilis</label>
                        <input type="date" name="release_date"
                            class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700">
                    </div>
                </div>
            </div>

            <!-- CHANGELOG -->
            <div>
                <label class="block font-medium mb-1">Catatan Versi</label>
                <textarea name="changelog" rows="3"
                        placeholder="Perubahan pada versi ini..."
                        class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700"></textarea>
            </div>

            {{-- <!-- LAST UPDATE -->
            <div>
                <label class="block font-medium mb-1">Terakhir Update</label>
                <input type="date" name="last_update"
                    class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 text-sm text-gray-700">
            </div> --}}

            <!-- BUTTONS -->
            <div class="flex justify-end gap-3 pt-3">
                <a href="{{ route('applications.index') }}"
                class="bg-gray-200 no-underline text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    Simpan Aplikasi
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
