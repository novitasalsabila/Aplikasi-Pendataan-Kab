<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            {{-- <!-- Tombol kanan atas -->
                <a href="{{ route('application_findings.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Cadangkan Aplikasi</span>
                </a> --}}
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-0">
                    Riwayat Backup Aplikasi
                </h1>

                <p class="text-md text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Catatan bug dan verifikasi data') }} 
                </p>

            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Aplikasi</th>
                        <th class="px-4 py-3 text-left">Waktu Backup</th>
                        <th class="px-4 py-3 text-left">Tipe Backup</th>
                        <th class="px-4 py-3 text-left">Lokasi Penyimpanan</th>
                        <th class="px-4 py-3 text-left">Terverifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($backups as $index => $b)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $b->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($b->backup_date)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 capitalize">{{ $b->backup_type }}</td>
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
