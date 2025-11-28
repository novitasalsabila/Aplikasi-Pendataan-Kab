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
            <div x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Dokumen ({{ $documents->count() }})
                </h1>
            </div>
            <table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
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

                                    {{-- Edit --}}
                                    <a href="{{ route('application_documents.edit', $doc->id) }}"
                                        class="text-yellow-600 hover:text-yellow-700 transition pl-3 pr-3"
                                        title="Edit Dokumen">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                            <path d="M19.5 7.125 16.862 4.487"/>
                                        </svg>
                                    </a>


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
