<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">

            <!-- EDIT PENGGUNA BARU --> 

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
             {{-- Judul + teks bawah --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-0">
                    Edit Pengguna Baru
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Lengkapi informasi Pengguna di bawah ini.') }}
                </p>
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                placeholder="Nama Lengkap"
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                placeholder="admin@pemkab.go.id"
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Nomor Telepon *</label>
                <input type="phone" name="phone" value="{{ old('phone', $user->phone) }}" required 
                placeholder="08xxxxxxxxxx"
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
            </div>

             <div>
                <label class="block font-medium mb-1">Jabatan *</label>
                <input type="position" name="position" value="{{ old('position', $user->position) }}" required 
                placeholder="Contoh : Staf IT"
                class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Role *</label>
                <select name="role" required class="w-full border rounded p-2">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
            </div> -->


            <!-- <div>
                <label class="block font-medium mb-1">OPD</label>
                <select name="department_id" class="w-full border rounded p-2 dark:bg-gray-700">
                    <option value="">-- Tidak Ada --</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $user->department_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div> -->

            <div class="flex justify-end space-x-3">
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
