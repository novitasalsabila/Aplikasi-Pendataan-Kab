<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        <form action="{{ route('departments.update', $department->id) }}" method="POST" class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Edit OPD
                </h1>
                <p class="text-sm text-gray-500 -mt-1 mb-10">
                    Lengkapi informasi OPD di bawah ini
                </p>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Nama OPD</label>
                <input type="text" name="name" value="{{ $department->name }}" required
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-600">
            </div>
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Email Resmi</label>
                <input type="email" name="email" value="{{ $department->email }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-600">
            </div>
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Nama Kepala OPD</label>
                <input type="text" name="head_name" value="{{ $department->head_name }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-600">
            </div>
            <div>
                <label class="block font-semibold mb-1 text-gray-700">Nomor Telepon</label>
                <input type="text" name="head_phone" value="{{ $department->head_phone }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-600">
            </div>
            
            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('departments.index') }}"
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
