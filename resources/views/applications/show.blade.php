<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Detail Aplikasi</h1>
            <a href="{{ route('applications.index') }}"
               class="bg-gray-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-gray-600 transition text-sm">
               Kembali
            </a>
        </div>

        <!-- Card Utama -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-5 space-y-5">

            <!-- Nama & Kategori -->
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $application->name }}</h2>
                <span class="px-3 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs font-medium capitalize">
                    {{ $application->category }}
                </span>
            </div>

            <!-- Grid Informasi Aplikasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700 dark:text-gray-300 text-sm">
                <div class="flex justify-between"><span class="font-medium">Sensitivitas:</span> <span>{{ $application->data_sensitivity }}</span></div>
                <div class="flex justify-between"><span class="font-medium">OPD:</span> <span>{{ $application->department->name ?? '-' }}</span></div>
                <div class="flex justify-between"><span class="font-medium">Status:</span> <span class="capitalize">{{ $application->status }}</span></div>
                <div class="flex justify-between"><span class="font-medium">Terakhir Update:</span> <span>{{ $application->last_update ? \Carbon\Carbon::parse($application->last_update)->format('d M Y') : '-' }}</span></div>
                <div class="flex justify-between"><span class="font-medium">Developer:</span> <span>{{ $application->developer->name ?? 'Tidak tersedia' }}</span></div>
                <div class="flex justify-between"><span class="font-medium">Server:</span> <span>{{ $application->server->hostname ?? 'Tidak tersedia' }}</span></div>
            </div>

            <!-- Deskripsi Aplikasi -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3 text-gray-700 dark:text-gray-300 text-sm whitespace-pre-line">
                <span class="font-medium">Deskripsi Aplikasi:</span>
                <p class="mt-1">{{ $application->description ?? 'Tidak ada deskripsi tersedia.' }}</p>
            </div>

            <!-- Tombol Aksi -->
            @if(auth()->user()->role !== 'opd')
                <div class="flex space-x-2 mt-4 text-sm">
                    <a href="{{ route('applications.edit', $application->id) }}"
                       class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-yellow-600 transition">
                        Edit
                    </a>

                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus {{ $application->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-red-600 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
