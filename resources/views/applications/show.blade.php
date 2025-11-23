<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6 space-y-8 md:mt-0 sm:mt-20">

        {{-- HEADER --}}
        <div class="flex items-start gap-3">
            <button onclick="history.back()" 
                class="p-1 rounded-full hover:bg-gray-100 text-gray-700">
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
            </button>

            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">{{ $application->name }}</h1>
                <p class="text-sm text-gray-500"><?=$application->description?></p>
            </div>

            @if(auth()->user()->role !== 'opd')
                <a href="{{ route('applications.edit', $application->id) }}"
                    class="ml-auto bg-gray-800 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-gray-900 flex items-center gap-2 no-underline">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" viewBox="0 0 24 24" 
                        stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652
                            L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18
                            l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z
                            M19.5 7.125 16.862 4.487M18 14v4.75
                            A2.25 2.25 0 0 1 15.75 21H5.25
                            A2.25 2.25 0 0 1 3 18.75V8.25
                            A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit Aplikasi
                </a>
            @endif

        </div>

        {{-- 3 CARD ATAS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Informasi Umum --}}
            <div class="bg-white shadow-sm border rounded-lg p-5">

                {{-- Header + Garis --}}
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-3">
                    Informasi Umum
                </h2>

                {{-- Detail --}}
                <div class="grid grid-cols-1 gap-4">

                    {{-- Kategori --}}
                    <div>
                        <span class="text-gray-500 text-sm block">Kategori</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                            {{ $application->category }}
                        </span>
                    </div>

                    {{-- Sensitivitas --}}
                    <div>
                        <span class="text-gray-500 text-sm block">Sensitivitas</span>
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($application->data_sensitivity == 'internal') bg-yellow-100 text-yellow-800
                            @elseif($application->data_sensitivity == 'publik') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $application->data_sensitivity }}
                        </span>
                    </div>

                    {{-- Status --}}
                    <div>
                        <span class="text-gray-500 text-sm block">Status</span>
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($application->status == 'aktif') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ $application->status }}
                        </span>
                    </div>

                    {{-- Update Terakhir --}}
                    <x-detail-item 
                        label="Update Terakhir" 
                        :value="$application->last_update ? \Carbon\Carbon::parse($application->last_update)->format('d M Y') : '-'"
                    />

                    {{-- Dibuat --}}
                    <x-detail-item 
                        label="Dibuat" 
                        :value="$application->created_at->format('d M Y')"
                    />

                </div>
            </div>


            {{-- OPD Pemilik --}}
            <div class="bg-white shadow-sm border rounded-lg p-5">
                <div class="border-b border-gray-200 pb-2 mb-3">
                    <h2 class="text-xl font-semibold text-gray-800">OPD Pemilik</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    <x-detail-item label="Nama OPD" :value="$application->department->name" />
                    <x-detail-item label="Email" :value="$application->department->email" />
                    <x-detail-item label="Kepala OPD" :value="$application->department->head_name" />
                    <x-detail-item label="Kontak" :value="$application->department->head_phone" />
                </div>
            </div>

            {{-- Pengembang --}}
            <div class="bg-white shadow-sm border rounded-lg p-5">
                <div class="border-b border-gray-200 pb-2 mb-3">
                    <h2 class="text-xl font-semibold text-gray-800">Pengembang</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                    <x-detail-item label="Nama Pengembang" :value="$application->developer->name" />
                    <x-detail-item label="Tipe" :value="$application->developer->developer_type" />
                    <x-detail-item label="Email" :value="$application->developer->contact_email" />
                    <x-detail-item label="Telepon" :value="$application->developer->contact_phone" />
                </div>
            </div>

        </div>


        {{-- INFORMASI SERVER --}}
        <div class="bg-white shadow-sm border rounded-lg p-6">
            <div class="flex items-center gap-2 border-b border-gray-200 pb-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-5 h-5 text-orange-500"
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    stroke-linecap="round" 
                    stroke-linejoin="round">
                    <rect width="20" height="8" x="2" y="2" rx="2" ry="2"/>
                    <rect width="20" height="8" x="2" y="14" rx="2" ry="2"/>
                    <line x1="6" x2="6.01" y1="6" y2="6"/>
                    <line x1="10" x2="10.01" y1="6" y2="6"/>
                    <line x1="6" x2="6.01" y1="18" y2="18"/>
                    <line x1="10" x2="10.01" y1="18" y2="18"/>
                </svg>

                <h2 class="text-xl font-semibold text-gray-800">Informasi Server</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <x-detail-item label="Hostname" :value="$application->server->hostname" />
                <x-detail-item label="IP Address" :value="$application->server->ip_address" />
                <x-detail-item label="Sistem Operasi" :value="$application->server->os" />
                <x-detail-item label="Lokasi" :value="$application->server->location" />
                <x-detail-item label="Dikelola oleh" :value="$application->server->managed_by" />
            </div>
        </div>


        {{-- RIWAYAT VERSI --}}
        <div class="bg-white shadow-sm border rounded-lg p-6">

            <div class="border-b border-gray-200 pb-2 mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Riwayat Versi</h2>
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700 border-b">
                    <tr>
                        <th class="px-4 py-2 text-left">Versi</th>
                        <th class="px-4 py-2 text-left">Tanggal Rilis</th>
                        <th class="px-4 py-2 text-left">Catatan Perubahan</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($application->versions as $v)
                        <tr>
                            <td class="px-4 py-2 font-medium">{{ $v->version_code }}</td>
                            <td class="px-4 py-2">{{ $v->released_date->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ $v->changelog }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-3 text-gray-500 text-center">Belum ada versi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
