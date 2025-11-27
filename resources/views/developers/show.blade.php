<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6 space-y-8">

        {{-- HEADER --}}
        <x-page-header 
            title="Lihat Pengembang"
        />

        <!-- CARD PROFIL PENGEMBANG -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100">
            
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Informasi Pengembang
            </h2>

            <div class="border-t border-gray-200 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 text-gray-700 text-sm">
                    <!-- Nama -->
                    <div class="flex items-center">
                        <span class="w-32 font-medium text-gray-500">Nama</span>
                        <span class="text-gray-800">{{ $developer->name ?? '-' }}</span>
                    </div>

                    <!-- Tipe -->
                    <div class="flex items-center">
                        <span class="w-32 font-medium text-gray-500">Tipe</span>
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs">
                            {{ $developer->developer_type }}
                        </span>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center">
                        <span class="w-32 font-medium text-gray-500">Email</span>
                        <span class="text-gray-800">{{ $developer->contact_email ?? '-' }}</span>
                    </div>

                    <!-- Telepon -->
                    <div class="flex items-center">
                        <span class="w-32 font-medium text-gray-500">Telepon</span>
                        <span class="text-gray-800">{{ $developer->contact_phone ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR APLIKASI -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">Daftar Aplikasi</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead>
                        <tr class="border-b bg-gray-50 text-gray-600">
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($developer->applications as $index => $app)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium">{{ $app->name }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $categoryColors = [
                                            'web' => 'bg-blue-100 text-blue-800',
                                            'mobile' => 'bg-purple-100 text-purple-800',
                                        ];
                                    @endphp

                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $categoryColors[$app->category] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $app->category }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'aktif' => 'bg-green-100 text-green-800',
                                            'maintenance' => 'bg-yellow-100 text-yellow-800',
                                        ];
                                    @endphp

                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $statusColors[$app->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $app->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <x-action-buttons
                                        :id="$app->id"
                                        :showRoute="route('applications.show', $app->id)"
                                        :editRoute="route('applications.edit', $app->id)"
                                        :deleteRoute="route('applications.destroy', $app->id)"
                                        itemName="{{ $app->name }}"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">
                                    Tidak ada aplikasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-right">
            <a href="{{ route('developers.index') }}"
                class="text-gray-600 hover:text-gray-800 text-sm">
                ← Kembali ke Daftar
            </a>
        </div>

    </div>
</x-app-layout>
