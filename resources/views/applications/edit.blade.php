<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
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
                    Edit Aplikasi
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Lengkapi informasi aplikasi di bawah ini.') }}
                </p>
            </div>
        </div>

        <form action="{{ route('applications.update', $application->id) }}" method="POST"
              class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <input type="text" name="name" value="{{ $application->name }}" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded p-2 text-sm text-gray-600">{{ $application->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Kategori</label>
                    <select name="category" class="w-full border rounded p-2 text-sm text-gray-600">
                        @foreach (['web', 'mobile', 'desktop'] as $cat)
                            <option value="{{ $cat }}" {{ $application->category == $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Sensitivitas Data</label>
                    <select name="data_sensitivity" class="w-full border rounded p-2 text-sm text-gray-600">
                        @foreach (['publik', 'internal', 'rahasia'] as $sens)
                            <option value="{{ $sens }}" {{ $application->data_sensitivity == $sens ? 'selected' : '' }}>
                                {{ ucfirst($sens) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium mb-1">OPD Pemilik</label>
                    <select name="department_id" class="w-full border rounded p-2 text-sm text-gray-600">
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" {{ $application->department_id == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Pengembang</label>
                    <select name="developer_id" class="w-full border rounded p-2 text-sm text-gray-600">
                        <option value="">-- Kosong --</option>
                        @foreach ($developers as $dev)
                            <option value="{{ $dev->id }}" {{ $application->developer_id == $dev->id ? 'selected' : '' }}>
                                {{ $dev->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Server</label>
                    <select name="server_id" class="w-full border rounded p-2 text-sm text-gray-600">
                        <option value="">-- Kosong --</option>
                        @foreach ($servers as $srv)
                            <option value="{{ $srv->id }}" {{ $application->server_id == $srv->id ? 'selected' : '' }}>
                                {{ $srv->hostname }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Status</label>
                    <select name="status" class="w-full border rounded p-2 text-sm text-gray-600">
                        @foreach (['aktif', 'nonaktif', 'maintenance'] as $st)
                            <option value="{{ $st }}" {{ $application->status == $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="border-t pt-4">
    <h3 class="font-semibold text-gray-700 mb-3">Informasi Versi Aplikasi</h3>

    @if($latestVersion)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block font-medium mb-1">Version Code</label>
                <input type="text" name="version_code" value="{{ $latestVersion->version_code }}"
                       class="w-full border rounded p-2 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Rilis</label>
                <input type="date" name="release_date" value="{{ $latestVersion->release_date }}"
                       class="w-full border rounded p-2 text-sm text-gray-600">
            </div>

            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Changelog</label>
                <textarea name="changelog" rows="3"
                          class="w-full border rounded p-2 text-sm text-gray-600">{{ $latestVersion->changelog }}</textarea>
            </div>

        </div>
    @else
        <p class="text-gray-400 text-sm italic">Belum ada versi.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
            <div>
                <label class="block font-medium mb-1">Version Code</label>
                <input type="text" name="version_code"
                       class="w-full border rounded p-2 text-sm text-gray-600">
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Rilis</label>
                <input type="date" name="release_date"
                       class="w-full border rounded p-2 text-sm text-gray-600">
            </div>

            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Changelog</label>
                <textarea name="changelog" rows="3"
                          class="w-full border rounded p-2 text-sm text-gray-600"></textarea>
            </div>
        </div>
    @endif
</div>

                <div>
                    <label class="block font-medium mb-1">Terakhir Update</label>
                    <input type="date" name="last_update" value="{{ $application->last_update }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('applications.index') }}"
                class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition no-underline flex items-center gap-2">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    
</x-app-layout>
