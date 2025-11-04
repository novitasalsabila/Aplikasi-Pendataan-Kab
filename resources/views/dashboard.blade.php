<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6 space-y-6">
        <div class="flex justify-end">
            <p class="text-sm text-gray-600 dark:text-gray-400 italic">
                Selamat datang, <span class="font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
            </p>
        </div>    {{-- Statistik Umum --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-stat-card color="blue" title="Total Aplikasi" :value="$totalApps" />
            <x-stat-card color="green" title="Aktif" :value="$activeApps" />
            <x-stat-card color="red" title="Nonaktif" :value="$inactiveApps" />
            <x-stat-card color="yellow" title="Temuan Keamanan" :value="$findingsCount" />
        </div>

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
            <x-dashboard-section title="🧰 Aplikasi yang Dikerjakan">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Nama Aplikasi</th>
                            <th>Status</th>
                            <th>Update Terakhir</th>
                        </tr>
                    </x-slot>
                    @forelse($recentLogs as $log)
                        <tr>
                            <td>{{ $log->application->name ?? '-' }}</td>
                            <td>{{ ucfirst($log->application->status ?? '-') }}</td>
                            <td>{{ $log->created_at?->format('d M Y H:i') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-gray-500 py-4">Belum ada data</td></tr>
                    @endforelse
                </x-table>
            </x-dashboard-section>
        @endif

        {{-- OPD: Aplikasi Milik Sendiri --}}
        @if(auth()->user()->role === 'opd')
            <x-dashboard-section title="🏢 Aplikasi OPD Anda">
                <x-table>
                    <x-slot name="head">
                        <tr>
                            <th>Nama Aplikasi</th>
                            <th>Status</th>
                            <th>Update Terakhir</th>
                        </tr>
                    </x-slot>
                    @forelse($recentLogs as $log)
                        <tr>
                            <td>{{ $log->application->name ?? '-' }}</td>
                            <td>{{ ucfirst($log->application->status ?? '-') }}</td>
                            <td>{{ $log->created_at?->format('d M Y H:i') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-gray-500 py-4">Belum ada data</td></tr>
                    @endforelse
                </x-table>
            </x-dashboard-section>
        @endif

        {{-- Log Aktivitas Terakhir --}}
        <x-dashboard-section title="🕒 Aktivitas Terakhir">
            @forelse ($recentLogs as $log)
                <p class="text-gray-700 dark:text-gray-300 mb-2">• {{ $log->description ?? 'Tidak ada deskripsi log' }}</p>
            @empty
                <p class="text-gray-500 dark:text-gray-400">Belum ada aktivitas tercatat.</p>
            @endforelse
        </x-dashboard-section>
    </div>
</x-app-layout>
