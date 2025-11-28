<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">
         <!-- Header -->
        <div class="relative mb-6">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('application_metrics.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Monitoring</span>
                </a>
            @endif
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Monitoring & Performa Aplikasi
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Data uptime dan response time aplikasi') }} 
                </p>

            </div>
        </div>


        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
             <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Monitoring ({{ $metrics->count() }})
                </h1>
            </div>
            <table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead>
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3 min-w-[200px]">Aplikasi</th>
                        <th class="px-4 py-3 min-w-[200px]">Tanggal Cek</th>
                        <th class="px-4 py-3 min-w-[150px]">Uptime (%)</th>
                        <th class="px-4 py-3 min-w-[150px]">Response (s)</th>
                        <th class="px-4 py-3 min-w-[150px]">Status</th>
                        <th class="px-4 py-3 min-w-[220px]">Catatan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white">
                    @forelse ($metrics as $index => $m)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $m->application->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($m->check_date)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $m->uptime ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $m->response_time ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded
                                    @if ($m->status === 'normal') bg-green-100 text-green-700
                                    @elseif ($m->status === 'lambat') bg-yellow-100 text-yellow-700
                                    @elseif ($m->status === 'down') bg-red-100 text-red-700
                                    @endif">
                                    {{ ucfirst($m->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3">{{ $m->note ?? '-' }}</td>
                            {{-- Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <x-action-buttons
                                    :id="$m->id"
                                    :showRoute="route('application_metrics.show', $m->id)"
                                    :editRoute="route('application_metrics.edit', $m->id)"
                                    :deleteRoute="route('application_metrics.destroy', $m->id)"
                                    itemName="{{ $m->application->name }}"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center text-gray-500">Belum ada data metrik aplikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
