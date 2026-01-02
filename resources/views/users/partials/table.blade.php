<table class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
    <thead >
        <tr>
            <th class="px-4 py-3 text-left">No</th>
            <th class="px-4 py-3 text-left min-w-[200px]">Nama</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left min-w-[200px]">Jabatan</th>
            <th class="px-4 py-3 text-left">Peran</th>
            <th class="px-4 py-3 text-left min-w-[350px]">OPD</th>
            <th class="px-4 py-3 text-left min-w-[180px]">Nomor Telepon</th>
            <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white">
        @forelse ($users as $index => $user)
            <tr class="border-b hover:bg-gray-50 ">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3">{{ $user->name }}</td>
                <td class="px-4 py-3">{{ $user->email }}</td>
                <td class="px-4 py-3">{{ $user->position }}</td>
                @php
                    $roleColors = [
                        'admin' => 'bg-red-100 text-red-600',
                        'diskominfo' => 'bg-blue-100 text-blue-600',
                        'opd' => 'bg-green-100 text-green-600',
                    ];
                @endphp

                <td class="px-4 py-3">
                    <span class="px-3 py-1 rounded-md text-xs font-semibold
                        {{ $roleColors[$user->role] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $user->department->name ?? '-' }}</td>
                <td class="px-4 py-3">{{ $user->phone }}</td>
                <td class="px-4 py-3 text-center">
                    <x-action-buttons
                        :id="$user->id"
                        :editRoute="route('users.edit', $user->id)"
                        :deleteRoute="route('users.destroy', $user->id)"
                        itemName="{{ $user->name }}"
                    />
                </td>            
            </tr>
        @empty
            <tr><td colspan="6" class="text-center py-4 text-gray-500">Belum ada pengguna.</td></tr>
        @endforelse
    </tbody>
</table>