<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        <form action="{{ route('developers.store') }}" method="POST" class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Tambah Pengembang Baru
                </h1>
                <p class="text-sm text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi pengembang dibawah ini
                </p>
            </div>
            <div>
                <label class="block font-medium mb-1">Nama Pengembang</label>
                <input type="text" name="name" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Pengembang</label>
                <select name="developer_type" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                    <option value="">-- Pilih Tipe --</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

           <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block font-medium mb-1">Email</label>
                    <input type="email" name="contact_email"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
                <div>
                    <label class="block font-medium mb-1">Nomor Telepon</label>
                    <input type="text" name="contact_phone"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('developers.index') }}"
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
