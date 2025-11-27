<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6 space-y-6">

        {{-- ========================================================= --}}
        {{-- ======================= ADMIN =========================== --}}
        {{-- ========================================================= --}}
        @if(auth()->user()->role === 'admin' && isset($appsPerDepartment))

            <h1 class="font-bold text-2xl text-gray-800 leading-tight md:mt-0 sm:mt-20">
                {{ __('Dashboard Admin') }}
            </h1>
            <p class="text-sm text-gray-500 mt-0">Manajemen Aplikasi OPD</p>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                <x-stat-card 
                    color="blue"
                    title="Total Aplikasi"
                    :value="$totalApps"
                    detail="6 aktif . 1 maintenance"
                    icon="aplikasi"
                />

                <x-stat-card 
                    color="green"
                    title="OPD/Dinas"
                    :value="$activeApps"
                    detail="Perangkat daerah tercatat"
                    icon="building"
                />

                <x-stat-card 
                    color="indigo"
                    title="Server & Pengguna"
                    :value="$findingsCount"
                    detail="5 penguna aktif"
                    icon="server"
                />

                <x-stat-card 
                    color="red"
                    title="Temuan Kritis"
                    :value="$inactiveApps"
                    detail="1 temuan terbuka"
                    icon="warning"
                />
            </div>

            <div class="flex gap-6">

                {{-- Bagian kiri --}}
                <div class="w-1/2">
<x-dashboard-section title="Aktivitas Terbaru">

    <div class="space-y-3">

        @forelse ($recentActivities as $activity)
            <div class="flex items-start justify-between p-3 bg-white rounded-lg border shadow-sm">

                {{-- Kiri --}}
                <div class="w-3/4">
                    <h3 class="text-gray-900 font-semibold text-sm leading-tight">
                        {{ $activity->title }}
                    </h3>

                    <p class="text-xs text-gray-600 mt-1">
                        {{ $activity->application->name ?? '-' }}
                    </p>

                    {{-- Badge --}}
                    <div class="mt-2 flex gap-2">
                        <span class="px-2 py-0.5 text-[10px] rounded-full bg-gray-100 text-gray-700 border">
                            v{{ $activity->version ?? '-' }}
                        </span>

                        @php
                            $cat = $activity->category ?? 'lainnya';
                            $clr = [
                                'penambahan' => 'bg-green-100 text-green-700',
                                'perbaikan'  => 'bg-blue-100 text-blue-700',
                                'penghapusan'=> 'bg-red-100 text-red-700',
                            ][$cat] ?? 'bg-gray-100 text-gray-700';
                        @endphp

                        <span class="px-2 py-0.5 text-[10px] rounded-full {{ $clr }} capitalize border">
                            {{ $cat }}
                        </span>
                    </div>
                </div>

                {{-- Tanggal --}}
                <p class="text-xs text-gray-500">
                    {{ $activity->date ?? $activity->created_at->format('Y-m-d') }}
                </p>
            </div>

        @empty
            <p class="text-gray-500 text-center py-4 text-sm">Belum ada aktivitas.</p>
        @endforelse

    </div>

</x-dashboard-section>


                </div>

                {{-- Bagian kanan --}}
                <div class="w-1/2">
<x-dashboard-section title="Temuan Terbaru">

    <div class="space-y-3">

        @forelse ($recentFindings as $finding)
            <div class="flex items-start p-3 bg-white rounded-lg border shadow-sm">

                {{-- Icon / Severity --}}
                <div class="mt-1">
                    @if(($finding->severity ?? '') === 'tinggi')
                        <span class="inline-block w-3 h-3 rounded-full bg-red-400"></span>
                    @elseif(($finding->severity ?? '') === 'sedang')
                        <span class="inline-block w-3 h-3 rounded-full bg-yellow-400"></span>
                    @else
                        <span class="inline-block w-3 h-3 rounded-full bg-green-400"></span>
                    @endif
                </div>

                <div class="ml-3 w-full">

                    <h3 class="text-gray-900 font-semibold text-sm leading-tight">
                        {{ $finding->title }}
                    </h3>

                    <p class="text-xs text-gray-600 mt-1">
                        {{ $finding->application->name ?? '-' }}
                    </p>

                    <div class="mt-2 flex gap-2">

                        @php
                            $sev = strtolower($finding->severity ?? 'rendah');
                            $sevClr = [
                                'tinggi' => 'bg-red-100 text-red-700',
                                'sedang' => 'bg-yellow-100 text-yellow-700',
                                'rendah' => 'bg-green-100 text-green-700',
                            ][$sev] ?? 'bg-gray-100 text-gray-700';
                        @endphp

                        <span class="px-2 py-0.5 text-[10px] rounded-full {{ $sevClr }} capitalize border">
                            {{ $sev }}
                        </span>

                        <span class="px-2 py-0.5 text-[10px] rounded-full bg-gray-100 text-gray-700 border capitalize">
                            {{ $finding->type ?? 'bug' }}
                        </span>
                    </div>
                </div>
            </div>

        @empty
            <p class="text-gray-500 text-center py-4 text-sm">Belum ada temuan.</p>
        @endforelse

    </div>

</x-dashboard-section>


                </div>
            </div>

            {{-- Distribusi Aplikasi --}}
            <x-dashboard-section title="Distribusi Aplikasi per OPD">
                @php
                    $data = [
                        ['opd' => 'Dinas Pendidikan', 'jumlah' => 40],
                        ['opd' => 'Dinas Kesehatan', 'jumlah' => 25],
                        ['opd' => 'Dinas Pertanian', 'jumlah' => 20],
                        ['opd' => 'Dinas Perhubungan', 'jumlah' => 15],
                    ];
                    $total = collect($data)->sum('jumlah');
                @endphp

                @forelse ($data as $item)
                    @php
                        $persen = ($total > 0) ? round(($item['jumlah'] / $total) * 100, 1) : 0;
                    @endphp

                    <div class="mb-4">
                        <div class="flex justify-between mb-1 text-sm font-medium text-gray-700">
                            <span>{{ $item['opd'] }}</span>
                            <span>{{ $persen }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-500 h-3 rounded-full" style="width: {{ $persen }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada data OPD.</p>
                @endforelse
            </x-dashboard-section>

        @endif
        {{-- ==================== END ADMIN ========================= --}}



        {{-- ========================================================= --}}
        {{-- ===================== DISKOMINFO ========================= --}}
        {{-- ========================================================= --}}
        @if(auth()->user()->role === 'diskominfo')

            <h1 class="font-bold text-2xl text-gray-800 leading-tight md:mt-0 sm:mt-20 mb-0">
                {{ __('Dashboard') }} {{ auth()->user()->department->name ?? 'Tidak ada OPD' }}
            </h1>
            <p class="text-md text-gray-500 mt-0">Daftar seluruh aplikasi yang dikelola Pemkab</p>

            <div class="space-y-6 transition-all duration-300">

                {{-- STATISTIK --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                    <x-stat-card 
                        color="blue"
                        title="Aplikasi Saya"
                        :value="$totalApps"
                        detail="Semua aplikasi OPD terdaftar"
                        icon="aplikasi"
                    />

                    <x-stat-card 
                        color="green"
                        title="Aktif"
                        :value="$activeApps"
                        detail="Aplikasi berjalan normal"
                        icon="activity"
                    />

                    <x-stat-card 
                        color="yellow"
                        title="Non Aktif"
                        :value="$inactiveApps"
                        detail="Aplikasi tidak aktif"
                        icon="square-x"
                    />

                    <x-stat-card 
                        color="red"
                        title="Temuan"
                        :value="$findingsCount"
                        detail="Perlu ditindak lanjut"
                        icon="warning"
                    />
                </div>

                {{-- Tabel Aplikasi --}}
                <x-dashboard-section title="Aplikasi yang Sedang Dikerjakan">
                    <x-table>

                        <x-slot name="head">
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-4 py-3 text-left font-bold tracking-wide">Nama Aplikasi</th>
                                <th class="px-4 py-3 text-left font-bold tracking-wide">Status</th>
                                <th class="px-4 py-3 text-left font-bold tracking-wide">Update Terakhir</th>
                            </tr>
                        </x-slot>

                        @forelse($recentLogs as $log)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-4 py-3 text-gray-800">{{ $log->application->name ?? '-' }}</td>

                                <td class="px-4 py-3">
                                    @php $status = strtolower($log->application->status ?? '-'); @endphp

                                    @if($status === 'aktif')
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Aktif</span>
                                    @elseif($status === 'nonaktif')
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Nonaktif</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">-</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-gray-800">
                                    {{ $log->created_at ? $log->created_at->locale('id')->diffForHumans() : '-' }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 py-4">
                                    Belum ada aplikasi yang terdaftar untuk OPD ini.
                                </td>
                            </tr>
                        @endforelse
                    </x-table>
                </x-dashboard-section>

            </div>

        @endif
        {{-- =================== END DISKOMINFO ===================== --}}



        {{-- ========================================================= --}}
        {{-- ========================== OPD =========================== --}}
        {{-- ========================================================= --}}
        @if(auth()->user()->role === 'opd')

            <h1 class="font-bold text-2xl text-gray-800 leading-tight md:mt-0 sm:mt-20 mb-0">
                {{ __('Dashboard') }} {{ auth()->user()->department->name ?? 'Tidak ada OPD' }}
            </h1>
            <p class="text-md text-gray-500 mt-0">Manajemen Aplikasi Dinas Anda</p>

            <div class="space-y-6 transition-all duration-300">

                {{-- STATISTIK --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                    <x-stat-card 
                        color="blue"
                        title="Aplikasi Saya"
                        :value="$totalApps"
                        detail="Semua aplikasi OPD terdaftar"
                        icon="aplikasi"
                    />

                    <x-stat-card 
                        color="green"
                        title="Aktif"
                        :value="$activeApps"
                        detail="Aplikasi berjalan normal"
                        icon="activity"
                    />

                    <x-stat-card 
                        color="yellow"
                        title="Non Aktif"
                        :value="$inactiveApps"
                        detail="Aplikasi tidak aktif"
                        icon="trending-up"
                    />

                    <x-stat-card 
                        color="red"
                        title="Temuan"
                        :value="$findingsCount"
                        detail="Perlu ditindak lanjut"
                        icon="warning"
                    />
                </div>

                {{-- Tabel Aplikasi --}}
                <x-dashboard-section title="Daftar Aplikasi Yang Dimiliki">
                    <x-table>

                        <x-slot name="head">
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-4 py-3 text-left font-bold tracking-wide">Nama Aplikasi</th>
                                <th class="px-4 py-3 text-left font-bold tracking-wide">Status</th>
                                <th class="px-4 py-3 text-left font-bold tracking-wide">Update Terakhir</th>
                            </tr>
                        </x-slot>

                    @forelse($opdApplications as $app)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 text-gray-800">{{ $app->name }}</td>

                            <td class="px-4 py-3">
                                @php $status = strtolower($app->status); @endphp

                                @if($status === 'aktif')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Aktif</span>
                                @elseif(in_array($status, ['nonaktif', 'non_aktif', 'non aktif']))
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Nonaktif</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">-</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-gray-800">
                                {{ $app->updated_at ? $app->updated_at->locale('id')->diffForHumans() : '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-4">
                                Belum ada aplikasi yang terdaftar untuk OPD ini.
                            </td>
                        </tr>
                    @endforelse

                    </x-table>
                </x-dashboard-section>

                {{-- Log Aktivitas --}}
                <x-dashboard-section title="Aktivitas 1 Minggu Terakhir">
                    @forelse ($recentLogs as $log)
                        <p class="text-gray-700 mb-2">• {{ $log->description ?? 'Tidak ada deskripsi log' }}</p>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada aktivitas tercatat.</p>
                    @endforelse
                </x-dashboard-section>

            </div>

        @endif
        {{-- ======================== END OPD ======================== --}}

    </div>
</x-app-layout>
