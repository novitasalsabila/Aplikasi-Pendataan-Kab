<x-app-layout>
        <div class="max-w-7xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        <!-- Header -->
        <div class="relative mb-6">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role === 'admin')
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

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Catatan perubahan dan pengembangan aplikasi') }} 
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

 <!-- Search + Filter dalam 1 kotak -->
        <div class="p-4 bg-white shadow-none rounded-lg border border-gray-200 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-3 w-full">
                    <!-- Form Search & Filter -->
                    <form action="{{ route('application_logs.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                        <!-- Input + Tombol Search -->
                        <div class="relative flex-1">
                            <input 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama aplikasi"
                                class="w-full truncate px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 overflow-hidden text-ellipsis whitespace-nowrap"/>
                            <!-- Tombol Search -->
                            <button 
                                type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.9-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                                </svg>
                            </button>
                        </div>         
                    </form>
                </div>
        </div>


        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Log ({{ $logs->count() }})
                </h1>
            </div>
            <table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead>
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3 min-w-[180px]">Aplikasi</th>
                        <th class="px-4 py-3 min-w-[220px]">Judul</th>
                        <th class="px-4 py-3 min-w-[170px]">Jenis Perubahan</th>
                        <th class="px-4 py-3 min-w-[120px]">Versi</th>
                        <th class="px-4 py-3 min-w-[120px]">Tanggal</th>
                        <th class="px-4 py-3 min-w-[160px]">Reviewer</th>
                        <th class="px-4 py-3 min-w-[120px]">Status</th>
                        <th class="px-4 py-3 text-center min-w-[120px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($logs as $index => $log)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $log->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->title }}</td>
                            <td class="px-4 py-3">{{ $log->change_type }}</td>
                            <td class="px-4 py-3">
                                <span class="bg-gray-50 px-2 py-1 rounded border font-semibold">{{ optional($log->application->versions->first())->version_code ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-3">{{ $log->date ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $log->reviewer->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusText = [
                                        'approved' => 'Disetujui',
                                        'pending' => 'Diproses',
                                        'rejected' => 'Ditolak',
                                    ][$log->approved_st] ?? $log->approved_st;
                                @endphp
                                <span class="px-3 py-1 rounded-md text-xs font-semibold
                                    @if($log->approved_st == 'approved')
                                        bg-green-100 text-green-700
                                    @elseif($log->approved_st == 'rejected')
                                        bg-red-100 text-red-700
                                    @else
                                        bg-yellow-100 text-yellow-700
                                    @endif">

                                    {{ $statusText }}

                                </span>
                            </td>

                            <td class="px-3 py-3 text-center">
                                <x-action-buttons
                                    :id="$log->id"
                                    :showRoute="route('application_logs.show', $log->id)"
                                    :editRoute="route('application_logs.edit', $log->id)"
                                    :deleteRoute="route('application_logs.destroy', $log->id)"
                                    itemName="{{ $log->name }}"
                                />
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
