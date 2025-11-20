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
                    Tambah Temuan Aplikasi
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Lengkapi informasi aplikasi di bawah ini.') }}
                </p>
            </div>
        </div>

        <form action="{{ route('application_findings.store') }}" method="POST"
              class="space-y-5 bg-white shadow-md rounded-lg p-6">
            @csrf

            <div>
                <label class="block font-medium mb-1">Nama Aplikasi</label>
                <select name="application_id" required class="w-full border rounded p-2">
                    <option value="">-- Pilih Aplikasi --</option>
                    @foreach ($applications as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium mb-1">Tipe Temuan</label>
                    <select name="type" required class="w-full border rounded p-2">
                        <option value="bug">Bug</option>
                        <option value="vulnerability">Kerentanan</option>
                        <option value="hack">Peretasan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Sumber</label>
                    <select name="source" required class="w-full border rounded p-2">
                        <option value="user">Pengguna</option>
                        <option value="monitoring">Monitoring</option>
                        <option value="audit">Audit</option>
                        <option value="laporan_masyarakat">Laporan Masyarakat</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium mb-1">Tingkat Keparahan</label>
                    <select name="severity" required class="w-full border rounded p-2">
                        <option value="rendah">Rendah</option>
                        <option value="sedang">Sedang</option>
                        <option value="tinggi">Tinggi</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi Temuan</label>
                <textarea name="description" rows="3" placeholder="Contoh: Sistem login tidak memvalidasi input dengan benar."
                          class="w-full border rounded p-2"></textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="open">Buka</option>
                    <option value="in_progress">Proses</option>
                    <option value="resolved">Selesai</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Tindak Lanjut (Opsional)</label>
                <textarea name="follow_up_action" rows="2" placeholder="Contoh: Patch diterapkan dan diuji ulang."
                          class="w-full border rounded p-2"></textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Ditemukan</label>
                <input type="date" name="follow_up_date" class="w-full border rounded p-2">
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('application_findings.index') }}"
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
