<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">➕ Tambah Pengguna</h2>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div>
                <label class="block font-medium mb-1">Nama</label>
                <input type="text" name="name" required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">NoTelepon</label>
                <input type="phone" name="phone" required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Jabatan Pengguna</label>
                <input type="position" name="position" required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full border rounded p-2 dark:bg-gray-700 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Role</label>
                <select name="role" required class="w-full border rounded p-2 dark:bg-gray-700">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">OPD (jika role OPD)</label>
                <select name="department_id" class="w-full border rounded p-2 dark:bg-gray-700">
                    <option value="">-- Tidak Ada --</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
