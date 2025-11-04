<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">✏️ Edit Pengembang</h2>

        <form action="{{ route('developers.update', $developer->id) }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ $developer->name }}" required
                       class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Pengembang</label>
                <select name="developer_type" required
                        class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                    @foreach ($types as $type)
                        <option value="{{ $type }}" {{ $developer->developer_type == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Nomor Kontrak</label>
                    <input type="text" name="contract_number" value="{{ $developer->contract_number }}"
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Tanggal Kontrak</label>
                    <input type="date" name="contract_date" value="{{ $developer->contract_date }}"
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
            </div> -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Email</label>
                    <input type="email" name="contact_email" value="{{ $developer->contact_email }}"
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Telepon</label>
                    <input type="text" name="contact_phone" value="{{ $developer->contact_phone }}"
                           class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('developers.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Kembali</a>
                <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
