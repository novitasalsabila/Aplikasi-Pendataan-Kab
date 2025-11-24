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
                                placeholder="Cari nama atau email OPD"
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
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Nama OPD</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Kepala OPD</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Kontak</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($departments as $index => $dept)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-800 dark:text-gray-100">{{ $dept->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $dept->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $dept->head_name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $dept->head_phone }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Tombol Edit -->
                            <a href="{{ route('departments.edit', $dept->id) }}"
                            class="text-yellow-600 hover:text-yellow-700 font-semibold inline-flex items-center px-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
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
                    </a>
                    <!-- Tombol Hapus -->
                    <form id="deleteForm-{{ $dept->id }}" 
                    action="{{ route('departments.destroy', $dept->id) }}" 
                    method="POST" class="inline px-3">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                        onclick="openModal('{{ $dept->id }}')" 
                        class="text-red-600 hover:text-red-700 font-semibold inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="m14.74 9-.346 9m-4.788 0L9.26 9
                                m9.968-3.21c.342.052.682.107 1.022.166
                                m-1.022-.165L18.16 19.673
                                a2.25 2.25 0 0 1-2.244 2.077H8.084
                                a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79
                                m14.456 0a48.108 48.108 0 0 0-3.478-.397
                                m-12 .562c.34-.059.68-.114 1.022-.165
                                m0 0a48.11 48.11 0 0 1 3.478-.397
                                m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201
                                a51.964 51.964 0 0 0-3.32 0
                                c-1.18.037-2.09 1.022-2.09 2.201v.916
                                m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                    </button>
                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
