<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        <div class="flex items-start gap-3">
                {{-- Tombol panah kembali --}}
                <button type="button"
                        onclick="history.back()"
                        class="mt-1 inline-flex items-center justify-center p-1
                            text-gray-700 hover:text-gray-900
                            rounded-full hover:bg-gray-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            width="24" 
                            height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                    </svg>
                </button>

                {{-- Judul + teks bawah --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-0">
                        Edit Informasi Pengembang
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ __('Lengkapi informasi pengembang di bawah ini.') }}
                    </p>
                </div>
            </div>

        <form action="{{ route('developers.update', $developer->id) }}" method="POST"
              class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ $developer->name }}" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Pengembang</label>
                <select name="developer_type" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                    @foreach ($types as $type)
                        <option value="{{ $type }}" {{ $developer->developer_type == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block font-medium mb-1">Email</label>
                    <input type="email" name="contact_email" value="{{ $developer->contact_email }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
                <div>
                    <label class="block font-medium mb-1">Telepon</label>
                    <input type="text" name="contact_phone" value="{{ $developer->contact_phone }}"
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
