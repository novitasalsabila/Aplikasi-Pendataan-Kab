<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="relative mb-6 md:mt-0 sm:mt-20">
            <!-- Tombol kanan atas -->
                <a href="{{ route('application_findings.create') }}"
                    class="absolute top-0 right-0 bg-gray-800 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-900 transition no-underline flex items-center gap-2">
                    <img src="{{ asset('icons/plus.svg') }}" alt="Tambah"
                        class="w-5 h-5 filter invert brightness-0">
                    <span>Tambah Temuan</span>
                </a>
            <!-- Kiri: Judul dan deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-0">
                    Temuan / Bug
                </h1>

                <p class="text-sm text-gray-500 w-3/4 sm:w-auto">
                    {{ __('Catatan bug, kerentanan, dan masalah keamanan') }} 
                </p>

            {{-- Toast Notifikasi (statis, muncul di bawah judul) --}}
            @if (session('success'))
                <div x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="mt-3 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="mt-3 bg-red-600 text-white px-4 py-2 rounded shadow">
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Search + Filter dalam 1 kotak -->
            <div class="p-4 bg-white shadow-sm rounded-lg border-gray-200 mb-6">
                    <form action="{{ route('application_findings.index') }}" method="GET" class="w-full space-y-3">

                        <!-- SEARCH -->
                        <div class="relative w-full">
                            <input 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama aplikasi"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                                    focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"/>
                            <button 
                                type="submit"
                                class="absolute right-2 top-1/2 -translate-y-1/2 
                                    text-gray-600 hover:text-blue-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m1.9-5.4a7.5 7.5 0 11-15 0 
                                        7.5 7.5 0 0115 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- FILTER (TEPAT DI BAWAH SEARCH) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">

                            <select name="type" onchange="this.form.submit()"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 text-gray-600">
                                <option value="">Semua Tipe</option>
                                <option value="bug" {{ request('type') == 'bug' ? 'selected' : '' }}>Bug</option>
                                <option value="kerentanan" {{ request('type') == 'kerentanan' ? 'selected' : '' }}>Kerentanan</option>
                                <option value="peretasan" {{ request('type') == 'peretasan' ? 'selected' : '' }}>Peretasan</option>
                                <option value="lainnya" {{ request('type') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>

                            <select name="severity" onchange="this.form.submit()"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 text-gray-600">
                                <option value="">Semua Tingkat</option>
                                <option value="rendah" {{ request('severity') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ request('severity') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ request('severity') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>

                            <select name="source" onchange="this.form.submit()"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 text-gray-600">
                                <option value="">Semua Sumber</option>
                                <option value="pengguna" {{ request('source') == 'pengguna' ? 'selected' : '' }}>Pengguna</option>
                                <option value="monitoring" {{ request('source') == 'monitoring' ? 'selected' : '' }}>Monitoring</option>
                                <option value="audit" {{ request('source') == 'audit' ? 'selected' : '' }}>Audit</option>
                                <option value="laporan_masyarakat" {{ request('source') == 'laporan_masyarakat' ? 'selected' : '' }}>
                                    Laporan Masyarakat
                                </option>
                            </select>

                            <select name="status" onchange="this.form.submit()"
                                class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 text-sm text-gray-600">
                                <option value="">Semua Status</option>
                                <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>

                        </div>
                    </form>

                </div>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Temuan ({{ $findings->count() }})
                </h1>

            </div>
            <table class="min-w-full divide-y divide-gray-100 border-t border-b border-gray-100 bg-white text-sm">
                <thead class="bg-white text-gray-800 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-center w-10">No</th>
                        <th class="px-4 py-3 text-left   min-w-[250px]">Aplikasi</th>
                        <th class="px-4 py-3 text-left  min-w-[400px]">Deskripsi</th>
                        <th class="px-4 py-3 text-center w-28">Status</th>
                        <th class="px-4 py-3 text-center w-20">Tipe</th>
                        <th class="px-4 py-3 text-center w-24">Tingkat</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Sumber</th>
                        <th class="px-4 py-3 text-left   min-w-[180px]">Tindak Lanjut</th>
                        <th class="px-4 py-3 text-left min-w-[180px]">Tanggal Ditemukan</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($findings as $index => $f)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-3 py-3 text-center align-middle">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-4 py-3 align-middle">
                                {{ $f->application->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 align-middle ">
                                {{ Str::limit($f->description, 100) }}
                            </td>

                            <td class="px-4 py-3 text-center align-middle">
                                @php
                                    $status = strtolower($f->status);

                                    $styles = [
                                        'baru' => 'bg-red-100 text-red-600',
                                        'diproses' => 'bg-yellow-100 text-yellow-600',
                                        'selesai' => 'bg-blue-100 text-blue-600',
                                    ];

                                    $class = $styles[$status] ?? 'bg-gray-100 text-gray-600';
                                @endphp

                                <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $class }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center align-middle">
                            @php
                                $type = strtolower($f->type);

                                $styles = [
                                    'bug' => 'bg-red-100 text-red-700',
                                    'kerentanan' => 'bg-yellow-100 text-yellow-600',
                                    'peretasan' => 'bg-purple-100 text-purple-600',
                                ];
                            @endphp

                            <span class="px-3 py-1 rounded-md text-xs font-semibold 
                                {{ $styles[$type] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($type) }}
                            </span>
                        </td>


                            <td class="px-4 py-3 text-center align-middle">
                                @php
                                    $severity = strtolower($f->severity);

                                    $styles = [
                                        'tinggi' => 'bg-red-100 text-red-600',
                                        'sedang' => 'bg-orange-100 text-orange-600',
                                        'rendah' => 'bg-yellow-100 text-yellow-600',
                                    ];

                                    $class = $styles[$severity] ?? 'bg-gray-100 text-gray-600';
                                @endphp

                                <span class="px-3 py-1 rounded-md text-xs font-semibold {{ $class }}">
                                    {{ ucfirst($severity) }}
                                </span>
                            </td>


                            <td class="px-4 py-3 align-middle">
                                {{ ucfirst(str_replace('_', ' ', $f->source)) }}
                            </td>

                            <td class="px-4 py-3 align-middle">
                                {{ $f->follow_up_action ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $f->follow_up_date
                                    ? \Carbon\Carbon::parse($f->follow_up_date)->format('Y-m-d')
                                    : '-' }}
                            </td>

                            <td class="px-4 py-3 text-center align-middle">
                                <x-action-buttons
                                    :id="$f->id"
                                    :editRoute="route('application_findings.edit', $f->id)"
                                    :deleteRoute="route('application_findings.destroy', $f->id)"
                                    itemName="{{ $f->application->name }}"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-6 text-center text-gray-500">
                                Belum ada data temuan aplikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
