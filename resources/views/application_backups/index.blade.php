<x-app-layout>
    @php
        $colors = [
            'manual'   => 'bg-green-100 text-green-700 border-green-300',
            'mingguan' => 'bg-yellow-100 text-yellow-700 border-yellow-300',
            'bulanan'  => 'bg-orange-100 text-orange-700 border-orange-300',
            'harian'   => 'bg-blue-100 text-blue-700 border-blue-300',
        ];
    @endphp

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
                    Daftar Backup ({{ $backups->count() }})
                </h1>
            </div>
            
            <table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left min-w-[250px]">Aplikasi</th>
                        <th class="px-4 py-3 text-left  min-w-[220px]">Tanggal Pencadangan</th>
                        <th class="px-4 py-3 text-left  min-w-[220px]">Waktu Pencadangan</th>
                        <th class="px-4 py-3 text-left  min-w-[200px]">Tipe Pencadangan</th>
                        <th class="px-4 py-3 text-left  min-w-[350px]">Lokasi Penyimpanan</th>
                        <th class="px-4 py-3 text-left">Terverifikasi</th>
                        {{-- Kolom Aksi hanya untuk admin dan diskominfo--}}
                        @if (auth()->user()?->role === 'admin' || auth()->user()->role === 'diskominfo')
                            <th class="px-4 py-3 text-center">Aksi</th>
                        @endif
                    </tr>
                </thead >
                
                <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white">
                    @forelse ($backups as $index => $b)
                        <tr class="hover:bg-gray-50 transition align-top">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $b->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($b->backup_date)->timezone('Asia/Jakarta')->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($b->backup_date)->timezone('Asia/Jakarta')->format('H:i A') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-lg border text-sm font-semibold
                                    {{ $colors[$b->backup_type] ?? 'bg-gray-50 text-gray-600 border-gray-300' }}">
                                    {{ ucfirst($b->backup_type) }}
                                </span>
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
                                <x-action-buttons
                                        :id="$b->id"
                                        :editRoute="route('application_backups.edit', $b->id)"
                                        itemName="{{ $b->application->name }}"
                                />
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
