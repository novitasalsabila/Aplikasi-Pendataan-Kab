<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">👥 Daftar Pengguna</h2>
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Tambah Pengguna</a>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">NoTelepon</th>
                        <th class="px-4 py-2 text-left">Jabatan Pengguna</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-left">OPD</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->phone }}</td>
                            <td class="px-4 py-2">{{ $user->position }}</td>
                            <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                            <td class="px-4 py-2">{{ $user->department->name ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('users.edit', $user) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-gray-500">Belum ada pengguna.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
