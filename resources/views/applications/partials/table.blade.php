<table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
    <thead>
        <tr>
            <th class="px-4 py-3 text-left w-12">No</th>
            <th class="px-4 py-3 text-left min-w-[200px]">Nama Aplikasi</th>
            <th class="px-4 py-3 text-left min-w-[270px]">OPD</th>
            <th class="px-4 py-3 text-left">Kategori</th>
            <th class="px-4 py-3 text-left min-w-[170px]">Sensitivitas Data</th>
            <th class="px-4 py-3 text-left min-w-[170px]">Status</th>
            <th class="px-4 py-3 text-left min-w-[170px]">Tanggal Rilis</th>
            <th class="px-4 py-3 text-left min-w-[120px]">Versi</th>
            <th class="px-4 py-3 text-center min-w-[170px]">Aksi</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
        @forelse ($applications as $index => $app)
            <tr class="hover:bg-gray-50 transition text-sm">
                <td class="px-4 py-3 w-12">{{ $index + 1 }}</td>
                <td class="px-4 py-3">{{ $app->name }}</td>
                <td class="px-4 py-3">{{ $app->department->name ?? '-' }}</td>
                  <td class="px-4 py-3 text-left">
                    @php
                        $categoryColors = [
                            'web' => 'bg-blue-100 text-blue-600',
                            'mobile' => 'bg-purple-100 text-purple-600',
                        ];
                    @endphp

                    <span class="px-2 py-1 text-xs font-semibold rounded-md
                        {{ $categoryColors[$app->category] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($app->category) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-left">
                    @php
                        $sensitivityColors = [
                            'internal' => 'bg-yellow-100 text-yellow-600',
                            'publik' => 'bg-green-100 text-green-600',
                            'rahasia' => 'bg-red-100 text-red-600',
                        ];
                    @endphp

                    <span class="px-2 py-1 text-xs font-semibold rounded-md
                        {{ $sensitivityColors[$app->data_sensitivity] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($app->data_sensitivity) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-left">
                    @php
                        $statusColors = [
                            'aktif' => 'bg-green-100 text-green-600',
                            'dalam perbaikan' => 'bg-yellow-100 text-yellow-600',
                            'tidak aktif' => 'bg-red-100 text-red-600'
                        ];
                    @endphp

                    <span class="px-2 py-1 text-xs font-semibold rounded-md 
                        {{ $statusColors[$app->status]}}">
                        {{ ucfirst($app->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    {{ $app->created_at ? \Carbon\Carbon::parse($app->created_at)->format('Y-m-d') : '-' }}
                </td>
                
                <td class="px-4 py-3">
                    @if($app->latestVersion)
                        <span class="bg-gray-50 px-2 py-1 rounded border font-semibold">
                            {{ $app->latestVersion->version_code }}
                        </span>
                    @else
                        <span class="text-gray-400 text-xs">Belum ada</span>
                    @endif
                </td>


                <!-- Kolom Aksi -->
                <td class="px-3 py-3 text-center">
                    <x-action-buttons
                        :id="$app->id"
                        :showRoute="route('applications.show', $app->id)"
                        :editRoute="auth()->user()->role !== 'opd' ? route('applications.edit', $app->id) : null"
                        :deleteRoute="auth()->user()->role !== 'opd' ? route('applications.destroy', $app->id) : null"
                        itemName="{{ $app->name }}"
                    />
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10" class="text-center py-4 text-gray-500">
                    Belum ada data aplikasi.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>