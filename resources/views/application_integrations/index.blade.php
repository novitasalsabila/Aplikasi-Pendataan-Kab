<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6 md:mt-0 sm:mt-20">
        <!-- Header -->
        <div class="relative mb-6">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role !== 'opd')
                <a href="{{ route('application_integrations.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Integrasi</span>
                </a>
            @endif
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Integrasi Antar Aplikasi
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Hubungan dan integrasi antar sistem') }} 
                </p>

            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2500)"
                class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <h1 class="text-lg font-semibold text-gray-800 pt-2 pb-2 mb-3 ml-4 mt-3">
                Daftar Integrasi ({{ $integrations->count() }})
            </h1>
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-white border-b-2 border-t-2">
                    <tr>
                        <th class="px-4 py-3 text-left w-12">No</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Aplikasi Sumber</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Aplikasi Tujuan</th>
                        <th class="px-4 py-3 text-left min-w-[150px]">Tipe Integrasi</th>
                        <th class="px-4 py-3 text-left min-w-[250px]">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($integrations as $index => $integration)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- Nomor --}}
                            <td class="px-4 py-3">{{ $index + 1 }}</td>

                            {{-- Aplikasi Sumber --}}
                            <td class="px-4 py-3 font-medium text-gray-900">
                                {{ $integration->sourceApp->name ?? '-' }}
                            </td>

                            {{-- Aplikasi Tujuan --}}
                            <td class="px-4 py-3">
                                {{ $integration->targetApp->name ?? '-' }}
                            </td>

                            {{-- Badge Tipe Integrasi --}}
                            <td class="px-4 py-3">
                                @php
                                    $badgeColor = match(strtolower($integration->type)) {
                                        'api' => 'bg-blue-100 text-blue-700',
                                        'database' => 'bg-green-100 text-green-700',
                                        'manual' => 'bg-purple-100 text-purple-700',
                                        default => 'bg-gray-100 text-gray-600'
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $badgeColor }}">
                                    {{ $integration->type }}
                                </span>
                            </td>

                            {{-- Deskripsi --}}
                            <td class="px-4 py-3 text-gray-700">
                                {{ $integration->description }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <x-action-buttons
                                    :id="$integration->id"
                                    :showRoute="route('application_integrations.show', $integration->id)"
                                    :editRoute="route('application_integrations.edit', $integration->id)"
                                    :deleteRoute="route('application_integrations.destroy', $integration->id)"
                                    itemName="{{ $integration->sourceApp->name }}"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">
                                Belum ada data integrasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
