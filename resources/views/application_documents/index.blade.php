<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role !== 'opd')
                <a href="{{ route('application_documents.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Upload Dokumen</span>
                </a>
            @endif

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
                                        'tor' => 'bg-blue-100 text-blue-600',
                                        'manual' => 'bg-green-100 text-green-600',
                                        'kontrak' => 'bg-purple-100 text-purple-600',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $color }}">
                                    {{ ucfirst($doc->doc_type) }}
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
                                <x-action-buttons 
                                    :id="$doc->id"
                                    :fileRoute="asset('storage/' . $doc->file_path)"
                                    :editRoute="route('application_documents.edit', $doc->id)"
                                    :deleteRoute="route('application_documents.destroy', $doc->id)"
                                    itemName="{{ $doc->doc_name }}"
                                />
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
