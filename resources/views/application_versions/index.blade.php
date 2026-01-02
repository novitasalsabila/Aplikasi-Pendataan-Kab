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

        <form method="GET"
            action="{{ route('application_versions.index') }}"
            class="rounded-lg mb-6 flex flex-col sm:flex-row w-full sm:w-auto">

            <select name="application_id"
                    id="app-filter"
                    class="px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 text-sm text-gray-600 w-[250px] truncate block outline-non">
                <option value="">Semua Aplikasi</option>
                @foreach($applications as $app)
                    <option value="{{ $app->id }}"
                        {{ request('application_id') == $app->id ? 'selected' : '' }}>
                        {{ $app->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <div class="px-4 py-3">
                <h1 class="text-xl font-bold">
                    Daftar Versi ({{ $versions->count() }})
                </h1>
            </div>
          
            <div id="table-container">
                @include('application_versions.partials.table')
            </div>
        </div>
    </div>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
            const filter = document.getElementById('app-filter');
            const tableContainer = document.getElementById('table-container');

            filter.addEventListener('change', function() {
                // ambil nilai yang dipilih
                const appId = this.value;
                
                // URL dengan query string
                const url = new URL(window.location.origin + window.location.pathname);
                if (appId) {
                    url.searchParams.set('application_id', appId);
                }

                // efek visual data diproses
                tableContainer.style.opacity = '0.5';

                // update URL di browser tanpa reload (agar jika di-refresh filter tetap aktif)
                window.history.pushState({}, '', url);

                // ambil data dari server via AJAX
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Respon jaringan tidak baik');
                    return response.text();
                })
                .then(html => {
                    // masukkan potongan HTML tabel ke container
                    tableContainer.innerHTML = html;
                    tableContainer.style.opacity = '1';
                })
                .catch(error => {
                    console.error('Error:', error);
                    tableContainer.style.opacity = '1';
                });
            });
        });
    </script>
</x-app-layout>
