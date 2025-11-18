<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6 space-y-6">
       <!-- <div class="mb-2"> 
    <h1 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100">
        Daftar Aplikasi
    </h1>  
</div>  -->

<!-- <div class="mb-4">  
    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300">
        Ringkasan Sistem Manajemen Aplikasi Pemkab
    </h2> 
</div> -->
        <!-- <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-stat-card color="blue" title="Total Aplikasi" :value="$totalApps" />
            <x-stat-card color="green" title="OPD/Dinas" :value="$activeApps" />
            <x-stat-card color="red" title="Server & Pengguna" :value="$inactiveApps" />
            <x-stat-card color="yellow" title="Temuan Bug" :value="$findingsCount" />
        </div> -->

        {{-- ADMIN: Jumlah Aplikasi per OPD --}}
        @if(auth()->user()->role === 'admin' && isset($appsPerDepartment))
        <h1 class="font-bold text-xl text-gray-800 leading-tight md:mt-0 sm:mt-20">
                    {{ __('Dashboard Admin') }}
            </h1>
            <p class="text-sm text-gray-500 mt-0">Manajemen Aplikasi OPD</p>
            {{-- KONTEN --}
        <div class="space-y-6 transition-all duration-300">

        {{-- STATISTIK (Grid 3 kolom) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
            {{-- Total Aplikasi --}}
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
                detail="Log pengembangan tercatat"
                icon="activity"
            />

            <x-stat-card 
                color="red"
                title="Temuan"
                :value="$findingsCount"
                detail="Perlu ditindak lanjut"
                icon="warning"
            />

            <x-stat-card 
                color="green"
                title="Status Keseluruhan"
                :value="$inactiveApps"
                detail="Aplikasi berjalan normal"
                icon="trending-up"
            />
        </div>
            <div class="flex gap-6"> 
    
    {{-- Bagian kiri --}}
    <div class="w-1/2">
    <x-dashboard-section title="📊 Aktivitas Terbaru">
        <x-table>
            <x-slot name="head">
                
            </x-slot>
            
        </x-table>
    </x-dashboard-section>
</div>


    {{-- Bagian kanan --}}
    <div class="w-1/2">
        <x-dashboard-section title="📈 Temuan Terbaru">
            <p>Isi konten di sini, misalnya log aktivitas atau grafik bar chart.</p>
        </x-dashboard-section>
    </div>
</div>

    {{-- Log Aktivitas Terakhir --}}
       <x-dashboard-section title="Distribusi Aplikasi per OPD">
    @php
        // Contoh data: bisa diganti dengan data real dari database
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
            <div class="flex justify-between mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                <span>{{ $item['opd'] }}</span>
                <span>{{ $persen }}%</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <div class="bg-blue-500 h-3 rounded-full" style="width: {{ $persen }}%"></div>
            </div>
        </div>
    @empty
        <p class="text-gray-500 dark:text-gray-400">Belum ada data OPD.</p>
    @endforelse
</x-dashboard-section>
</div>

            
        @endif

        {{-- DISKOMINFO: Aplikasi yang Dikerjakan --}}
        @if(auth()->user()->role === 'diskominfo')
        <h1 class="font-bold text-2xl text-gray-800 leading-tight md:mt-0 sm:mt-20">
                    {{ __('Dashboard') }}
                    {{ auth()->user()->department->name ?? 'Tidak ada OPD' }}
            </h1>
            <p class="text-md text-gray-500 mt-0">Daftar seluruh aplikasi yang dikelola Pemkab</p>
            {{-- KONTEN --}
        <div class="space-y-6 transition-all duration-300">

        {{-- STATISTIK (Grid 3 kolom) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
            {{-- Total Aplikasi --}}
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
            <x-dashboard-section title="Aplikasi yang Sedang Dikerjakan">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Nama Aplikasi</th>
                            <th>Nama OPD</th>
                            <th>Status</th>
                            <th>Update Terakhir</th>
                        </tr>
                    </x-slot>
                    @forelse($recentLogs as $log)
                        <tr>
                            <td>{{ $log->application->name ?? '-' }}</td>
                            <td>{{ $log->application->name ?? '-' }}</td>
                            <td>{{ ucfirst($log->application->status ?? '-') }}</td>
                            <td>{{ $log->created_at?->format('d M Y H:i') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-gray-500 py-4">-- Belum ada data --</td></tr>
                    @endforelse
                </x-table>
            </x-dashboard-section>
        @endif

        {{-- OPD: Aplikasi Milik Sendiri --}}
        @if(auth()->user()->role === 'opd')
            <h1 class="font-bold text-2xl text-gray-800 leading-tight md:mt-0 sm:mt-20">
                    {{ __('Dashboard') }}
                    {{ auth()->user()->department->name ?? 'Tidak ada OPD' }}

            </h1>
            <p class="text-md text-gray-500 mt-0">Manajemen Aplikasi Dinas Anda</p>
            {{-- KONTEN --}}
        <div class="space-y-6 transition-all duration-300">

        {{-- STATISTIK (Grid 3 kolom) --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
            {{-- Total Aplikasi --}}
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
            <x-dashboard-section title="Aplikasi OPD Anda">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Nama Aplikasi</th>
                            <th>Status</th>
                            <th>Update Terakhir</th>
                        </tr>
                    </x-slot>
                    @forelse($recentLogs as $log)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td>{{ $log->application->name ?? '-' }}</td>
                            <td>{{ ucfirst($log->application->status ?? '-') }}</td>
                            <td>{{ $log->created_at?->format('d M Y H:i') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-gray-500 py-4">Belum ada aplikasi yang terdaftar untuk OPD ini.</td></tr>
                    @endforelse
                </x-table>
            </x-dashboard-section>
        @endif

        {{-- Log Aktivitas Terakhir --}}
        <x-dashboard-section title="Aktivitas 1 Minggu Terakhir">
            @forelse ($recentLogs as $log)
                <p class="text-gray-700 dark:text-gray-300 mb-2">• {{ $log->description ?? 'Tidak ada deskripsi log' }}</p>
            @empty
                <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada aktivitas tercatat.</p>
            @endforelse
        </x-dashboard-section>
    </div>
</x-app-layout>
