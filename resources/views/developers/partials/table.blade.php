<table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
    <thead>
        <tr>
            <th class="px-4 py-3 text-left">No</th>
            <th class="px-4 py-3 text-left">Nama</th>
            <th class="px-4 py-3 text-left">Tipe</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Telepon</th>
            <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @forelse ($developers as $index => $dev)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3">{{ $dev->name }}</td>
                <td class="px-4 py-3">{{ $dev->developer_type }}</td>
                <td class="px-4 py-3">{{ $dev->contact_email ?? '-' }}</td>
                <td class="px-4 py-3">{{ $dev->contact_phone ?? '-' }}</td>             
                <td class="px-4 py-3 text-center">
                    <x-action-buttons
                        :id="$dev->id"
                        :showRoute="route('developers.show', $dev->id)"
                        :editRoute="route('developers.edit', $dev->id)"
                        :deleteRoute="route('developers.destroy', $dev->id)"
                        itemName="{{ $dev->name }}"
                    />
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">
                    Belum ada data pengembang.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>