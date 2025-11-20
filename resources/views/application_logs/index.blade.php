<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
           @if(auth()->user()->role == 'diskominfo')
                <a href="{{ route('application_logs.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Log</span>
                </a>
            @endif


            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Log Pengembangan Aplikasi
                </h1>
            @if(auth()->user()->role === 'opd')
                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    Catatan perubahan dan pengembangan aplikasi 
                    {{ auth()->user()->department->name}}
                </p>
            @else
                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    Catatan perubahan dan pengembangan aplikasi 
                </p>
            @endif
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-3">No</th>
                        <th class="px-4 py-3">Aplikasi</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Jenis Perubahan</th>
                        <th class="px-4 py-3">Versi</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Reviewer</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($logs as $index => $log)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $log->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->title }}</td>
                            <td class="px-4 py-3 capitalize">{{ $log->change_type }}</td>
                            <td class="px-4 py-3">{{ $log->version ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->date ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->reviewer->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                    @if($log->approved_st == 'approved') bg-green-600
                                    @elseif($log->approved_st == 'rejected') bg-red-600
                                    @else bg-yellow-500 @endif">
                                    {{ ucfirst($log->approved_st) }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <div class="flex items-center justify-center gap-2 divide-x divide-gray-300">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('application_logs.edit', $log->id) }}"
                                    class="flex items-center justify-center pr-2 text-yellow-600 hover:text-yellow-700 font-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
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

                                    {{-- Tombol Delete + Form --}}
                                    <form
                                        id="deleteForm-{{ $log->id }}"
                                        action="{{ route('application_logs.destroy', $log->id) }}"
                                        method="POST"
                                        class="inline-flex items-center justify-center pl-2">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            onclick="openModal('{{ $log->id }}')"
                                            class="inline-flex items-center justify-center text-red-600 hover:text-red-700 font-semibold">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
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
                                </div>

                                {{-- Modal Konfirmasi --}}
                                <div id="confirmModal-{{ $log->id }}"
                                    class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-800 bg-opacity-50">
                                    <div class="bg-white rounded-xl shadow-lg p-6 w-auto text-center">
                                        <h4 class="text-md font-semibold mb-2">
                                            Konfirmasi Hapus Log Aplikasi
                                        </h4>

                                        <p class="text-lg text-gray-600 mb-5">
                                            Apakah kamu ingin menghapus Log aplikasi
                                            <strong>{{ $log->application->name ?? '-' }}</strong>?
                                        </p>

                                        <div class="flex justify-center gap-2">
                                            <button
                                                onclick="confirmDelete('{{ $log->id }}')"
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                                                Ya, Hapus
                                            </button>
                                            <button
                                                onclick="closeModal('{{ $log->id }}')"
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
                            <td colspan="9" class="text-center py-4 text-gray-500">
                                Belum ada data log aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
