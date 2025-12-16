<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
            
                <a href="{{ route('departments.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah OPD</span>
                </a>
           
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Manajemen OPD / Department
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Daftar Orgnisasi Perangkat Daerah') }} 
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

         <!-- Search + Filter dalam 1 kotak -->
        <div class="p-4 bg-white shadow-xs rounded-lg border border-gray-200 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-3 w-full">
                    <!-- Form Search & Filter -->
                    <form action="{{ route('departments.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                        <!-- Input + Tombol Search -->
                        <div class="relative flex-1">
                            <input 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama, email atau Kepala OPD"
                                class="w-full truncate px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 overflow-hidden text-ellipsis whitespace-nowrap"/>
                            <!-- Tombol Search -->
                            <button 
                                type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600 hover:text-blue-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.9-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                                </svg>
                            </button>
                        </div> 
                        
                    
                    </form>
                </div>
        </div>


<!-- Table -->
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <div class="px-4 py-3">
            <h1 class="text-xl font-bold">
                Daftar OPD ({{ $departments->count() }})
            </h1>
        </div>
    <table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
        <!-- Header -->
        <thead>
            <tr class="text-gray-800 text-medium tracking-wide">
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left min-w-[480px]">Nama OPD</th>
                <th class="px-4 py-3 text-left min-w-[180px]">Email</th>
                <th class="px-4 py-3 text-left min-w-[180px]">Kepala OPD</th>
                <th class="px-4 py-3 text-left min-w-[180px]">Kontak</th>
                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
            </tr>
        </thead>

        <!-- Body -->
        <tbody class="divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
            @forelse ($departments as $index => $dept)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>

                    <!-- Nama OPD -->
                    <td class="px-4 py-3">
                        {{ $dept->name }}
                    </td>

                    <!-- Email -->
                    <td class="px-4 py-3">
                        {{ $dept->email }}
                    </td>

                    <!-- Kepala OPD -->
                    <td class="px-4 py-3">
                        {{ $dept->head_name }}
                    </td>

                    <!-- Kontak -->
                    <td class="px-4 py-3">
                        {{ $dept->head_phone }}
                    </td>

                    <!-- Aksi -->
                    <td class="px-4 py-3 text-center">
                        <x-action-buttons
                            :id="$dept->id"
                            :editRoute="route('departments.edit', $dept->id)"
                            :deleteRoute="route('departments.destroy', $dept->id)"
                            itemName="{{ $dept->name }}"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-3 text-gray-500">
                        Belum ada data.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

    </div>
</x-app-layout>
