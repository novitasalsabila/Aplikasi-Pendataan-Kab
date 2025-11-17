<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
                <a href="{{ route('application_findings.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Temuan</span>
                </a>
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    Temuan/Bug/Keamanan
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Catatan bug, kerentanan, dan masalah keamanan') }} 
                </p>

            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full table-fixed text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    <tr>
                        <th class="px-3 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Aplikasi</th>
                        <th class="px-4 py-3 text-center w-1/3">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Tipe</th>
                        <th class="px-4 py-3 text-center">Tingkat</th>
                        <th class="px-4 py-3 text-center">Sumber</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Tindak Lanjut</th>
                        <th class="px-4 py-3 text-center">Tanggal Tindak</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($findings as $index => $f)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 align-top">
                            <td class="px-3 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $f->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ Str::limit($f->description, 100) }}</td>
                            <td class="px-4 py-3">{{ ucfirst($f->type) }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded
                                    @if($f->severity == 'tinggi') text-red-600
                                    @elseif($f->severity == 'sedang') text-yellow-500
                                    @else text-blue-600 @endif">
                                    {{ ucfirst($f->severity) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ ucfirst(str_replace('_', ' ', $f->source)) }}</td>
                            <td class="px-4 py-3">
                                <span class="whitespace-nowrap rounded py-1 text-white
                                    @if($f->status == 'open') bg-red-500
                                    @elseif($f->status == 'in_progress') bg-yellow-400
                                    @else bg-green-500 @endif">
                                    {{ str_replace('_', ' ', ucfirst($f->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $f->follow_up_action ?? '-' }}</td>
                            <td class="px-4 py-3">
                                {{ $f->follow_up_date ? \Carbon\Carbon::parse($f->follow_up_date)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-4 py-2 flex items-center justify-center divide-x divide-gray-300">
                                {{-- Tombol Edit (icon pensil) --}}
                                <a href="{{ route('application_findings.edit', $f->id) }}"
                                class="inline-flex items-center justify-center p-1.5 rounded
                                        text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50
                                        transition"
                                title="Edit temuan">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652
                                            L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18
                                            l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z
                                            M19.5 7.125 16.862 4.487M18 14v4.75
                                            A2.25 2.25 0 0 1 15.75 21H5.25
                                            A2.25 2.25 0 0 1 3 18.75V8.25
                                            A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

                                {{-- Tombol Hapus (icon trash) --}}
                                <form action="{{ route('application_findings.destroy', $f->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center justify-center p-1.5 rounded
                                                text-red-600 hover:text-red-700 hover:bg-red-50
                                                transition"
                                            title="Hapus temuan">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5"
                                            class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9
                                                m9.968-3.21c.342.052.682.107 1.022.166
                                                m-1.022-.165L18.16 19.673
                                                a2.25 2.25 0 0 1-2.244 2.077H8.084
                                                a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79
                                                m14.456 0a48.108 48.108 0 0 0-3.478-.397
                                                m-12 .562c.34-.059.68-.114 1.022-.165
                                                m0 0a48.11 48.11 0 0 1 3.478-.397
                                                m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201
                                                a51.964 51.964 0 0 0-3.32 0
                                                c-1.18.037-2.09 1.022-2.09 2.201v.916
                                                m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                                <!-- Modal Konfirmasi -->
                                <div id="confirmModal-{{ $f->id }}" 
                                    class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
                                    <div class="bg-white rounded-xl shadow-lg p-6 w-auto text-center">
                                        <h4 class="text-md font-semibold mb-2">Konfirmasi Hapus Aplikasi</h4>
                                        <p class="text-lg text-gray-600 mb-5">Apakah kamu yakin ingin menghapus <strong>{{ $f->name }}</strong>?</p>
                                        <div class="flex justify-center gap-2">
                                            <button onclick="confirmDelete('{{ $f->id }}')" 
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                                                Ya, Hapus
                                            </button>
                                            <button onclick="closeModal('{{ $f->id }}')" 
                                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm font-medium">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-3 text-center text-gray-500">Belum ada data temuan aplikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
