<table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
    <thead class="bg-white text-gray-800 border-b border-gray-200">
        <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Aplikasi</th>
            <th class="px-4 py-3">Versi</th>
            <th class="px-4 py-3 min-w-[150px]">Tanggal Rilis</th>
            <th class="px-4 py-3">Perubahan</th>
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'diskominfo')
            <th class="px-4 py-3 text-center">Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($versions as $index => $ver)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3">{{ $ver->application->name ?? '-' }}</td>
                <td class="px-4 py-3">
                    <span class="bg-gray-50 px-2 py-1 rounded border font-semibold">
                        {{ $ver->version_code }}
                    </span>
                </td>

                <td class="px-4 py-3">
                    {{ $ver->created_at
                        ? \Carbon\Carbon::parse($ver->created_at)->format('Y-m-d')
                        : '-' }}
                </td>
                <td class="px-4 py-3">{{ Str::limit($ver->changelog, 50) ?? '-' }}</td>

                {{-- Aksi --}}
                <td class="px-4 py-3 text-center">
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'diskominfo')

                        <x-action-buttons
                            :id="$ver->id"
                            :editRoute="route('application_versions.edit', $ver->id)"
                            :deleteRoute="route('application_versions.destroy', $ver->id)"
                            itemName="{{ $ver->application->name }}"
                        />
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                    Belum ada data versi aplikasi.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

