<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
                <a href="{{ route('application_documents.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Upload Dokumen</span>
                </a>

            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Dokumen Aplikasi
                </h1>
                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    TOR, kontrak, manual, dan dokumen pendukung lainnya 
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead>
                    <tr class="bg-white border-b">
                        <th class="px-4 py-3 text-left w-12">No</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Nama Dokumen</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Aplikasi</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Tipe Dokumen</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Diunggah Oleh</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Tanggal Upload</th>
                        <th class="px-4 py-3 text-center w-20">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($documents as $index => $doc)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- No -->
                            <td class="px-4 py-3">{{ $index + 1 }}</td>

                            <!-- Nama Dokumen + File Path -->
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $doc->doc_name }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ $doc->file_path ? '/documents/' . basename($doc->file_path) : '-' }}
                                </div>
                            </td>

                            <!-- Aplikasi -->
                            <td class="px-4 py-3">{{ $doc->application->name ?? '-' }}</td>

                            <!-- Tipe Dokumen (badge warna) -->
                            <td class="px-4 py-3">
                                @php
                                    $color = match($doc->doc_type) {
                                        'tor' => 'bg-blue-100 text-blue-700',
                                        'manual' => 'bg-green-100 text-green-700',
                                        'kontrak' => 'bg-purple-100 text-purple-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $color }}">
                                    {{ $doc->doc_type }}
                                </span>
                            </td>

                            <!-- Uploader -->
                            <td class="px-4 py-3">{{ $doc->uploader->name ?? '-' }}</td>

                            <!-- Tanggal Upload -->
                            <td class="px-4 py-3">
                                {{ $doc->created_at ? $doc->created_at->format('Y-m-d') : '-' }}
                            </td>

                            <!-- Aksi Ikon -->
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center divide-x divide-gray-300">

                                    {{-- Lihat --}}
                                    @if ($doc->file_path)
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" 
                                        target="_blank"
                                        class="text-gray-600 hover:text-black transition pl-3 pr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="20" height="20"
                                                viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" 
                                                stroke-linejoin="round">
                                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </a>
                                    @endif

                                    {{-- Download --}}
                                    @if ($doc->file_path)
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" 
                                        download
                                        class="text-gray-600 hover:text-black transition pl-3 pr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                width="20" height="20"
                                                viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 15V3"/>
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                                <path d="m7 10 5 5 5-5"/>
                                            </svg>
                                        </a>
                                    @endif

                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">
                                Belum ada dokumen aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
