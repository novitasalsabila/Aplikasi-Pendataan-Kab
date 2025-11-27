<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'diskominfo')
                <a href="{{ route('application_versions.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Versi Aplikasi</span>
                </a>
            @endif
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Riwayat Versi Aplikasi
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Catatan rilis dan catatan perubahan aplikasi') }} 
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


        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Versi ({{ $versions->count() }})
                </h1>
            </div>
            <hr class="border-t-2 border-gray-300 mb-3">
            <table class="min-w-full text-sm text-left text-gray-700 ">
                <thead class="bg-white text-gray-800 border-b border-gray-200">
                    <tr>
                        <th class="px-3 py-1">No</th>
                        <th class="px-4 py-2">Aplikasi</th>
                        <th class="px-4 py-2">Versi</th>
                        <th class="px-4 py-2">Tanggal Rilis</th>
                        <th class="px-4 py-2">Perubahan</th>
                        @if(auth()->user()->role === 'diskominfo')
                        <th class="px-4 py-2 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($versions as $index => $ver)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $ver->application->name ?? '-' }}</td>
                            <!-- <td class="px-4 py-2 font-semibold">{{ $ver->version_code }}</td> -->
                             <td class="px-4 py-2">
                                <span class="bg-white px-2 py-1 rounded border font-semibold">
                                    {{ $ver->version_code }}
                                </span>
                            </td>

                            <td class="px-4 py-2">
                                {{ $ver->release_date
                                    ? \Carbon\Carbon::parse($ver->release_date)->format('Y-m-d')
                                    : '-' }}
                            </td>
                            <td class="px-4 py-2">{{ Str::limit($ver->changelog, 50) ?? '-' }}</td>

                            {{-- Aksi --}}
                            <td class="px-4 py-2 text-center">
                                <x-action-buttons
                                    :id="$ver->id"
                                    :editRoute="route('application_versions.edit', $ver->id)"
                                    :deleteRoute="route('application_versions.destroy', $ver->id)"
                                    itemName="{{ $ver->application->name }}"
                                />
                            </td>


                            @if(auth()->user()->role === 'diskominfo')
                            <td class="px-4 py-2">
                                {{-- Diskominfo boleh edit & hapus --}}
                                <div class="flex items-center justify-center divide-x divide-gray-300">
                                    <a href="{{ route('application_versions.edit', $ver->id) }}"
                                    class="text-yellow-500 hover:text-yellow-600 font-semibold inline-flex items-center px-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
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

                                    <form id="deleteForm-{{ $ver->id }}"
                                        action="{{ route('application_versions.destroy', $ver->id) }}"
                                        method="POST" class="inline px-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                onclick="openModal('{{ $ver->id }}')"
                                                class="text-red-500 hover:text-red-600 font-semibold inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
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
                                <div id="confirmModal-{{ $ver->id }}"
                                    class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
                                    <div class="bg-white rounded-xl shadow-lg p-6 w-auto text-center">
                                        <h4 class="text-md font-semibold mb-2">Konfirmasi Hapus Aplikasi</h4>
                                        <p class="text-lg text-gray-600 mb-5">
                                            Apakah kamu yakin ingin menghapus <strong>{{ $ver->name }}</strong>?
                                        </p>
                                        <div class="flex justify-center gap-2">
                                            <button onclick="confirmDelete('{{ $ver->id }}')"
                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium">
                                                Ya, Hapus
                                            </button>
                                            <button onclick="closeModal('{{ $ver->id }}')"
                                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-sm font-medium">
                                                Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                Belum ada data versi aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
