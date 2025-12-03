<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'diskominfo')
                <a href="{{ route('application_versions.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Versi Aplikasi</span>
                </a>
            @endif
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Riwayat Versi Aplikasi
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Catatan rilis dan catatan perubahan aplikasi') }} 
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


        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Versi ({{ $versions->count() }})
                </h1>
            </div>
          
            <table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead class="bg-white text-gray-800 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Aplikasi</th>
                        <th class="px-4 py-3">Versi</th>
                        <th class="px-4 py-3">Tanggal Rilis</th>
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
        </div>
    </div>
</x-app-layout>
