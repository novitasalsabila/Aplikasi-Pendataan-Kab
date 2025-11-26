<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Riwayat Backup Aplikasi
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Catatan backup dan verifikasi data') }} 
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


        <div class="overflow-x-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Temuan ({{ $backups->count() }})
                </h1>
            </div>
            <table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left min-w-[200px]">Aplikasi</th>
                        <th class="px-4 py-3 text-left  min-w-[250px]">Waktu Pencadangan</th>
                        <th class="px-4 py-3 text-left  min-w-[200px]">Tipe Pencadangan</th>
                        <th class="px-4 py-3 text-left  min-w-[350px]">Lokasi Penyimpanan</th>
                        <th class="px-4 py-3 text-left">Terverifikasi</th>
                        {{-- Kolom Aksi hanya untuk admin --}}
                        @if (auth()->user()?->role === 'admin' || auth()->user()->role === 'diskominfo')
                            <th class="px-4 py-3 text-left">Aksi</th>
                        @endif
                    </tr>
                </thead >
                
                <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white">
                    @forelse ($backups as $index => $b)
                        <tr class="hover:bg-gray-50 transition align-top">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $b->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($b->backup_date)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 capitalize
                                @if($b->backup_type === 'manual') text-gray-500
                                @elseif($b->backup_type === 'harian') text-green-600
                                @elseif($b->backup_type === 'mingguan') text-blue-600
                                @elseif($b->backup_type === 'bulanan') text-orange-500
                                @endif">
                                {{ $b->backup_type }}
                            </td>

                            <td class="px-4 py-3">{{ $b->storage_location }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($b->verified_st === 'ya')
                                    <span class="flex items-center text-green-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            class="w-4 h-4 mr-1">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293A1 1 0 006.293 10.707l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Ya
                                    </span>
                                @else
                                    <span class="flex items-center text-red-500 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            class="w-4 h-4 mr-1">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Tidak
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex items-center justify-center">
                                {{-- Tombol Edit (icon pensil) --}}
                                <a href="{{ route('application_backups.edit', $b->id) }}"
                                class="inline-flex items-center justify-center p-1.5 rounded
                                        text-yellow-500 hover:text-yellow-600 font-semibold
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data backup aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
