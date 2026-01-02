<table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
    <thead>
        <tr class="bg-white border-b">
            <th class="px-4 py-3 text-left">No</th>
            <th class="px-4 py-3 text-left min-w-[180px]">Hostname</th>
            <th class="px-4 py-3 text-left">IP Address</th>
            <th class="px-4 py-3 text-left min-w-[180px]">OS</th>
            <th class="px-4 py-3 text-left min-w-[220px]">Lokasi</th>
            <th class="px-4 py-3 text-left min-w-[180px]">Dikelola Oleh</th>
            <th class="px-4 py-3 text-left min-w-[180px]">Status</th>
            <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-gray-100">
        @forelse ($servers as $index => $srv)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-4 py-3 w-10">{{ $index + 1 }}</td>

                <td class="px-4 py-3 min-w-[180px]">
                    {{ $srv->hostname }}
                </td>

                <td class="px-4 py-3">{{ $srv->ip_address }}</td>
                <td class="px-4 py-3 min-w-[180px]">{{ $srv->os ?? '-' }}</td>
                <td class="px-4 py-3 min-w-[220px]">{{ $srv->location ?? '-' }}</td>
                <td class="px-4 py-3 min-w-[180px]">{{ $srv->managed_by ?? '-' }}</td>

                <td class="px-4 py-3">
                    @php
                        $color = match($srv->status) {
                            'aktif' => 'bg-green-100 text-green-600',
                            'dalam perbaikan' => 'bg-yellow-100 text-yellow-600',
                            'tidak aktif' => 'bg-red-100 text-red-600',
                            default => 'bg-gray-100 text-gray-600'
                        };
                    @endphp

                    <div class="flex justify-start">
                        <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $color }}">
                            {{ ucfirst($srv->status) }}
                        </span>
                    </div>
                </td>                                
                <td class="px-4 py-3 text-center">
                    @if(auth()->user()->role === 'admin')
                        <x-action-buttons
                            :id="$srv->id"
                            :editRoute="route('servers.edit', $srv->id)"
                            :deleteRoute="route('servers.destroy', $srv->id)"
                            itemName="{{ $srv->hostname }}"
                        />
                </td>
            @endif  
        @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-gray-500">
                    Belum ada data server.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>