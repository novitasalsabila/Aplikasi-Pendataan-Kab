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
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
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

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-fixed text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="px-3 py-3 text-center w-10">No</th>
                        <th class="px-4 py-3 text-left  w-40">Aplikasi</th>
                        <th class="px-4 py-3 text-left  w-1/3">Deskripsi</th>
                        <th class="px-4 py-3 text-center w-20">Tipe</th>
                        <th class="px-4 py-3 text-center w-24">Tingkat</th>
                        <th class="px-4 py-3 text-left  w-32">Sumber</th>
                        <th class="px-4 py-3 text-center w-28">Status</th>
                        <th class="px-4 py-3 text-left  w-32">Tindak Lanjut</th>
                        <th class="px-4 py-3 text-center w-32">Tanggal Ditemukan</th>
                        <th class="px-4 py-3 text-center w-20">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($findings as $index => $f)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-3 py-3 text-center align-middle">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-4 py-3 align-middle">
                                {{ $f->application->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 align-middle">
                                {{ Str::limit($f->description, 100) }}
                            </td>

                            <td class="px-4 py-3 text-center align-middle">
                                {{ ucfirst($f->type) }}
                            </td>

                            <td class="px-4 py-3 text-center align-middle">
                                @php
                                    $severity = strtolower($f->severity);

                                    $styles = [
                                        'tinggi' => 'bg-red-100 text-red-600',
                                        'sedang' => 'bg-yellow-100 text-yellow-600',
                                        'rendah' => 'bg-blue-100 text-blue-600',
                                    ];

                                    $class = $styles[$severity] ?? 'bg-gray-100 text-gray-600';
                                @endphp

                                <span class="px-3 py-1 rounded-md text-sm font-semibold {{ $class }}">
                                    {{ $severity }}
                                </span>
                            </td>


                            <td class="px-4 py-3 align-middle">
                                {{ ucfirst(str_replace('_', ' ', $f->source)) }}
                            </td>

                            <td class="px-4 py-3 text-center align-middle">
                                @php
                                    $statusText = [
                                        'open' => 'buka',
                                        'in_progress' => 'proses',
                                        'resolved' => 'selesai'
                                    ][$f->status] ?? $f->status;
                                @endphp
                                <span class="inline-flex items-center gap-1 text-sm font-medium whitespace-nowrap
                                    @if($f->status == 'open') text-red-600
                                    @elseif($f->status == 'in_progress') text-yellow-600
                                    @else text-green-600 @endif">

                                    {{-- Ikon sesuai status --}}
                                    @if($f->status == 'open')
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4 lucide lucide-circle-x"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="m15 9-6 6"/>
                                            <path d="m9 9 6 6"/>
                                        </svg>

                                    @elseif($f->status == 'in_progress')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>

                                    @else {{-- resolved --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="w-4 h-4 lucide lucide-circle-check"
                                            viewBox="0 0 24 24" 
                                            fill="none" 
                                            stroke="currentColor" 
                                            stroke-width="2" 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
>
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="m9 12 2 2 4-4"/>
                                        </svg>
                                    @endif

                                    {{ $statusText }}
                                </span>
                            </td>


                            <td class="px-4 py-3 align-middle">
                                {{ $f->follow_up_action ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $f->follow_up_date
                                    ? \Carbon\Carbon::parse($f->follow_up_date)->format('Y-m-d')
                                    : '-' }}
                            </td>

                            <td class="px-4 py-3 text-center align-middle">
                                <div class="flex items-center justify-center divide-x divide-gray-300">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('application_findings.edit', $f->id) }}"
                                    class="inline-flex items-center justify-center p-1.5 rounded-l text-yellow-500 hover:text-yellow-600 transition"
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

                                    {{-- Tombol Hapus + Modal --}}
                                    <div class="inline-flex items-center justify-center p-1.5 rounded-r">
                                        <button type="button"
                                                onclick="openModal('{{ $f->id }}')"
                                                class="inline-flex items-center justify-center text-red-500 hover:text-red-600 transition"
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
                                    </div>

                                    {{-- Modal Konfirmasi --}}
                                    <div id="confirmModal-{{ $f->id }}"
                                        class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
                                        <div class="bg-white rounded-xl shadow-lg p-6 w-auto text-center">
                                            <h4 class="text-md font-semibold mb-2">Konfirmasi Hapus Temuan</h4>
                                            <p class="text-sm text-gray-600 mb-5">
                                                Apakah kamu yakin ingin menghapus temuan pada
                                                <strong>{{ $f->application->name ?? '-' }}</strong>?
                                            </p>
                                            <div class="flex justify-center gap-2">
                                                <form id="deleteForm-{{ $f->id }}"
                                                    action="{{ route('application_findings.destroy', $f->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                                                        Ya, Hapus
                                                    </button>
                                                </form>

                                                <button type="button"
                                                        onclick="closeModal('{{ $f->id }}')"
                                                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm font-medium">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-6 text-center text-gray-500">
                                Belum ada data temuan aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
