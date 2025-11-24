<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">
            Edit OPD Baru
        </h2>

        <form action="{{ route('departments.update', $department->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1 text-gray-700 dark:text-gray-300">Nama OPD</label>
                <input type="text" name="name" value="{{ $department->name }}" required
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block font-semibold mb-1 text-gray-700 dark:text-gray-300">Email Resmi</label>
                <input type="email" name="email" value="{{ $department->email }}"
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block font-semibold mb-1 text-gray-700 dark:text-gray-300">Nama Kepala OPD</label>
                <input type="text" name="head_name" value="{{ $department->head_name }}"
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block font-semibold mb-1 text-gray-700 dark:text-gray-300">Nomor Telepon</label>
                <input type="text" name="head_phone" value="{{ $department->head_phone }}"
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('departments.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Batal</a>
                <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
