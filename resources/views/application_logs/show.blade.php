<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-6 space-y-6 md:mt-0 sm:mt-20">

        {{-- HEADER --}}
        <div class="flex items-start gap-3">
            <button onclick="history.back()"
                class="p-1 rounded-full hover:bg-gray-100 text-gray-700">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"/>
                    <path d="M19 12H5"/>
                </svg>
            </button>

            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    {{ $log->title }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ $log->application->name ?? '-' }}
                </p>
            </div>
        </div>

        {{-- INFORMASI LOG --}}
        <div class="bg-white border rounded-lg p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">
                Detail Log Pengembangan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Jenis Perubahan --}}
                <x-detail-item
                    label="Jenis Perubahan"
                    :value="ucfirst($log->change_type)"
                />

                {{-- Versi --}}
                <x-detail-item
                    label="Versi Aplikasi"
                    :value="$log->version ?? '-'"
                />

                {{-- Tanggal --}}
                <x-detail-item
                    label="Tanggal Perubahan"
                    :value="$log->date
                        ? \Carbon\Carbon::parse($log->date)->format('d M Y')
                        : $log->created_at->format('d M Y')"
                />

                {{-- Reviewer --}}
                <x-detail-item
                    label="Reviewer"
                    :value="$log->reviewer->name ?? '-'"
                />

                {{-- Status --}}
                <div>
                    <span class="text-gray-500 text-sm block">Status Pengembangan</span>

                    @php
                        $status = $log->approved_st;
                        $statusClass = [
                            'approved' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                            'pending'  => 'bg-yellow-100 text-yellow-800',
                        ][$status] ?? 'bg-gray-100 text-gray-700';
                    @endphp

                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $statusClass }}">
                        {{ ucfirst($status) }}
                    </span>
                </div>

            </div>
        </div>

        {{-- DESKRIPSI --}}
        <div class="bg-white border rounded-lg p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">
                Deskripsi Perubahan
            </h2>

            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $log->description ?? 'Tidak ada deskripsi.' }}
            </p>
        </div>

    </div>
</x-app-layout>
