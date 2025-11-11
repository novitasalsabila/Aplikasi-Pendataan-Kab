<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- <div class="flex justify-end">
            <p class="text-sm text-gray-600 dark:text-gray-400 italic">
                Selamat datang, <span class="font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
            </p>
        </div>     --}}
        {{-- Statistik Umum
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-stat-card color="blue" title="Total Aplikasi" :value="$totalApps" />
            <x-stat-card color="green" title="Aktif" :value="$activeApps" />
            <x-stat-card color="red" title="Nonaktif" :value="$inactiveApps" />
            <x-stat-card color="yellow" title="Temuan Keamanan" :value="$findingsCount" />
        </div> --}}

        {{-- ADMIN: Jumlah Aplikasi per OPD --}}
        @if(auth()->user()->role === 'admin' && isset($appsPerDepartment))
            <x-dashboard-section title="📊 Jumlah Aplikasi per OPD">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Nama OPD</th>
                            <th>Jumlah Aplikasi</th>
                        </tr>
                    </x-slot>
                    @foreach($appsPerDepartment as $dept)
                        <tr>
                            <td>{{ $dept->name }}</td>
                            <td>{{ $dept->applications_count }}</td>
                        </tr>
                    @endforeach
                </x-table>
            </x-dashboard-section>
        @endif

        {{-- DISKOMINFO: Aplikasi yang Dikerjakan --}}
        @if(auth()->user()->role === 'diskominfo')
        <h1 class="font-bold text-xl text-gray-800 leading-tight md:mt-0 sm:mt-20">
                    {{ __('Dashboard') }}
                    {{ Auth::user()->role }}
            </h1>
            <p class="text-sm text-gray-500 mt-0">Manajemen Aplikasi Dinas Anda</p>
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
            <h1 class="font-bold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                    {{ Auth::user()->role }}
            </h1>
            <p class="text-sm text-gray-500 mt-0">Manajemen Aplikasi Dinas Anda</p>
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
