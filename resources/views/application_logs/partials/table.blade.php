<table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
    <thead>
        <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3 min-w-[180px]">Aplikasi</th>
            <th class="px-4 py-3 min-w-[220px]">Judul</th>
            <th class="px-4 py-3 min-w-[170px]">Jenis Perubahan</th>
            <th class="px-4 py-3 min-w-[120px]">Versi</th>
            <th class="px-4 py-3 min-w-[120px]">Tanggal</th>
            <th class="px-4 py-3 min-w-[160px]">Reviewer</th>
            <th class="px-4 py-3 min-w-[120px]">Status</th>
            <th class="px-4 py-3 text-center min-w-[120px]">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse ($logs as $index => $log)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3">{{ $log->application->name ?? '-' }}</td>
                <td class="px-4 py-3">{{ $log->title }}</td>
                <td class="px-4 py-3">{{ $log->change_type }}</td>
                <td class="px-4 py-3">
                    <span class="bg-gray-50 px-2 py-1 rounded border font-semibold">{{ optional($log->application->versions->first())->version_code ?? '-' }}</span>
                </td>
                <td class="px-4 py-3">{{ $log->date ?? '-' }}</td>
                <td class="px-4 py-3">{{ $log->reviewer->name ?? '-' }}</td>
                <td class="px-4 py-3 text-left">
                    @php
                        $statusMap = [
                            'disetujui' => 'bg-green-100 text-green-600',
                            'ditolak' => 'bg-red-100 text-red-600',
                            'diproses' => 'bg-yellow-100 text-yellow-600'
                        ];
                    @endphp

                    <span class="px-2 py-1 text-xs font-semibold rounded-md
                        {{ $statusMap[$log->approved_st] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst ($log->approved_st) }}
                    </span>
                </td>


                <td class="px-3 py-3 text-center">
                    <x-action-buttons
                        :id="$log->id"
                        :showRoute="route('application_logs.show', $log->id)"
                        :editRoute="auth()->user()->role !== 'opd'
                            ? route('application_logs.edit', $log->id)
                            : null"
                        :deleteRoute="auth()->user()->role !== 'opd'
                            ? route('application_logs.destroy', $log->id)
                            : null"
                        :itemName="$log->title"
                    />
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center py-4 text-gray-500">
                    Belum ada data log aplikasi.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>