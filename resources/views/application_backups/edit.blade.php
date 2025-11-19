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
                    Edit Pencadangan Aplikasi
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Lengkapi informasi aplikasi di bawah ini.') }}
                </p>
            </div>
        </div>

        <form action="{{ route('application_backups.update', $backup->id) }}" method="POST"
              class="space-y-5 bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Aplikasi</label>
                <select name="application_id" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}" {{ $backup->application_id == $app->id ? 'selected' : '' }}>
                            {{ $app->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Tanggal Backup</label>
                    <input type="datetime-local" name="backup_date"
                           value="{{ \Carbon\Carbon::parse($backup->backup_date)->format('Y-m-d\TH:i') }}" required
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block font-medium mb-1">Jenis Backup</label>
                    <select name="backup_type" required
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                        @foreach (['harian', 'mingguan', 'bulanan', 'manual'] as $type)
                            <option value="{{ $type }}" {{ $backup->backup_type == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Lokasi Penyimpanan</label>
                <input type="text" name="storage_location"
                       value="{{ $backup->storage_location }}" required
                       class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Verifikasi</label>
                <select name="verified_st" required
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                    <option value="ya" {{ $backup->verified_st === 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="tidak" {{ $backup->verified_st === 'tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_backups.index') }}"
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
