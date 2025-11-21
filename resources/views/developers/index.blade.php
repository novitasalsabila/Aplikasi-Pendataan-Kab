<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                Manajemen Pengembang
            </h1>
            <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                Daftar pengembang aplikasi (internal, vendor, freelance)
            </p>
        </div>

            <a href="{{ route('developers.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
               + Tambah Pengembang
            </a>
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
<div class="p-4 bg-white shadow-sm rounded-lg border border-gray-200 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-3 w-full">
            <!-- Form Search & Filter -->
            <form action="{{ route('applications.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap gap-2 w-full">

                <!-- Input + Tombol Search -->
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau email pengembang"
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
            <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Tipe</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Telepon</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($developers as $index => $dev)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ $dev->name }}</td>
                            <td class="px-4 py-3 capitalize">{{ $dev->developer_type }}</td>
                            <td class="px-4 py-3">{{ $dev->contact_email ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $dev->contact_phone ?? '-' }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('developers.show', $dev->id) }}"
                    class="text-blue-600 hover:text-blue-700 font-semibold">Lihat</a>
                                <a href="{{ route('developers.edit', $dev->id) }}"
                                   class="text-yellow-600 hover:text-yellow-700 font-semibold">
                                   Edit
                                </a>
                                <form action="{{ route('developers.destroy', $dev->id) }}" method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus {{ $dev->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-700 font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                Belum ada data pengembang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
