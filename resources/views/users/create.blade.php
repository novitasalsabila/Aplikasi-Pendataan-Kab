<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">

        <!-- TAMBAH PENGGUNA BARU -->        

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf

             {{-- Judul + teks bawah --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-0">
                    Tambah Pengguna Baru
                </h2>
                <p class="text-sm text-gray-500 w-3/4 sm:w-auto -mt-1 mb-10">
                    {{ __('Lengkapi informasi Pengguna di bawah ini.') }}
                </p>
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" required 
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" required
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Nomor Telepon</label>
                <input type="phone" name="phone" required 
                placeholder="08xxxxxxxxxx"
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Jabatan</label>
                <input type="position" name="position" required 
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Peran</label>
                <select name="role" required class="w-full border rounded p-2 text-sm text-gray-600">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
            <label class="block font-medium mb-1">Kata Sandi</label>
            <input type="password" name="password" required 
                placeholder="Masukkan kata sandi"
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
        </div>

        <div>
            <label class="block font-medium mb-1">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" required 
                placeholder="Ulangi kata sandi"
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
        </div>
        <div>
            <label class="block font-medium mb-1">OPD</label>
            <select name="department_id" required class="w-full border rounded p-2 text-sm text-gray-600">
                <option value="">-- Pilih OPD --</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
        </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('users.index') }}"
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
