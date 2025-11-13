<nav 
    x-ref="sidebar"
    class="
        {{-- MOBILE: Fixed menimpa seluruh layar, w-64, h-screen --}}
        fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-xl border-r border-gray-100 h-screen
        flex flex-col justify-between transition-transform duration-300 ease-in-out
        
        {{-- DESKTOP: Tetap w-64, relative, full height (w-64 = 256px) --}}
        md:relative md:flex-shrink-0 md:translate-x-0 md:w-64 md:h-full-md
    "
    {{-- Mengontrol Transisi Sidebar (Meluncur dari Kiri ke Kanan) --}}
    :class="{ 
        'translate-x-0': open, 
        '-translate-x-full': !open && isMobile,
        'shadow-2xl': open && isMobile // Tambahkan shadow tebal di mobile saat terbuka
    }"
    @click.away="if(isMobile) open = false" 
>
     <!-- Header Sidebar (Logo + Tombol X) -->
     <div class="flex items-center justify-between px-2 py-4 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/Logo-Kabupaten-Bantul.png') }}" class="w-8 h-auto" alt="Logo">
            <span class="font-semibold text-gray-800 text-lg">Pendataan Aplikasi</span>
        </div>
        
        {{-- Tombol X untuk menutup (Hanya di Mobile) --}}
        <button 
            @click="open = false" 
            class="p-2 rounded-md hover:bg-gray-100 transition md:hidden"
        >
            {{-- Close Icon X --}}
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>


    <!-- Navigasi Utama -->
    <div class="flex-1 overflow-y-auto px-3 py-4 text-sm h-screen">
        @if(Auth::check() && auth()->user()->role === 'admin')
            
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menu Admin</p>
            
            {{-- Tambahkan @click="if(isMobile) open = false" agar menu tertutup setelah klik di mobile --}}
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 transition group"
                @click="if(isMobile) open = false">
                <img src="{{ asset('icons/dashboard.svg') }}" alt="Dashboard" class="w-5 h-5">
                <span class="font-medium text-gray-700 group-hover:text-blue-600">Dashboard</span>
            </x-nav-link>

            <x-nav-link :href="route('applications.index')" :active="request()->routeIs('applications.*')" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 transition group"
                @click="if(isMobile) open = false">
                <img src="{{ asset('icons/aplikasi.svg') }}" alt="Aplikasi" class="w-5 h-5">
                <span class="font-medium text-gray-700 group-hover:text-blue-600">Aplikasi Saya</span>
            </x-nav-link>

            <x-nav-link :href="route('developers.index')" :active="request()->routeIs('developers.*')" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 transition group"
                @click="if(isMobile) open = false">
                <img src="{{ asset('icons/developer.svg') }}" alt="Pengembang" class="w-5 h-5">
                <span class="font-medium text-gray-700 group-hover:text-blue-600">Pengembang</span>
            </x-nav-link>

            <x-nav-link :href="route('departments.index')" :active="request()->routeIs('departments.*')" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 transition group"
                @click="if(isMobile) open = false">
                <img src="{{ asset('icons/opd.svg') }}" alt="OPD" class="w-5 h-5">
                <span class="font-medium text-gray-700 group-hover:text-blue-600">OPD / Department</span>
            </x-nav-link>

            <x-nav-link :href="route('application_findings.index')" :active="request()->routeIs('application_findings.*')" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 transition group"
                @click="if(isMobile) open = false">
                <img src="{{ asset('icons/warning.svg') }}" alt="Temuan" class="w-5 h-5">
                <span class="font-medium text-gray-700 group-hover:text-blue-600">Temuan / Bug</span>
            </x-nav-link>

            <x-nav-link :href="route('application_versions.index')" :active="request()->routeIs('application_versions.*')">
                <img src="{{ asset('icons/warning.svg') }}" alt="Versi Aplikasi" class="w-5 h-5">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ __('Versi Aplikasi') }}
            </x-nav-link>

            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" 
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 transition group"
                @click="if(isMobile) open = false">
                <img src="{{ asset('icons/user.svg') }}" alt="Pengguna" class="w-5 h-5">
                <span class="font-medium text-gray-700 group-hover:text-blue-600">Pengguna</span>
            </x-nav-link>
        @elseif(auth()->user()->role === 'diskominfo')
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menu Diskominfo</p>

            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <img src="{{ asset('icons/dashboard.svg') }}" alt="Dashboard" class="w-5 h-5">
                <i class="fa-solid fa-gauge"></i> {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('applications.index')" :active="request()->routeIs('applications.*')">
                <img src="{{ asset('icons/aplikasi.svg') }}" alt="Aplikasi Dikerjakan" class="w-5 h-5">
                <i class="fa-solid fa-layer-group"></i> {{ __('Aplikasi Dikerjakan') }}
            </x-nav-link>

            <x-nav-link :href="route('application_logs.index')" :active="request()->routeIs('application_logs.*')">
                <img src="{{ asset('icons/activity.svg') }}" alt="Log Pengembangan" class="w-5 h-5">
                <i class="fa-solid fa-code"></i> {{ __('Log Pengembangan') }}
            </x-nav-link>

            <x-nav-link :href="route('application_findings.index')" :active="request()->routeIs('application_findings.*')">
                <img src="{{ asset('icons/warning.svg') }}" alt="Temuan" class="w-5 h-5">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ __('Temuan') }}
            </x-nav-link>

            <x-nav-link :href="route('application_versions.index')" :active="request()->routeIs('application_versions.*')">
                <img src="{{ asset('icons/version.svg') }}" alt="Versi Aplikasi" class="w-5 h-5">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ __('Versi Aplikasi') }}
            </x-nav-link>

            <x-nav-link :href="route('application_versions.index')" :active="request()->routeIs('application_versions.*')">
                <img src="{{ asset('icons/database.svg') }}" alt="Versi Aplikasi" class="w-5 h-5">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ __('Aplikasi Backups') }}
            </x-nav-link>

        @elseif(auth()->user()->role === 'opd')
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menu OPD</p>

            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <img src="{{ asset('icons/dashboard.svg') }}" alt="Dashboard" class="w-5 h-5">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('applications.index')" :active="request()->routeIs('applications.*')">
                <img src="{{ asset('icons/aplikasi.svg') }}" alt="Dashboard" class="w-5 h-5">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ __('Aplikasi Saya') }}
            </x-nav-link>
            <x-nav-link :href="route('application_versions.index')" :active="request()->routeIs('application_versions.*')">
                <img src="{{ asset('icons/version.svg') }}" alt="Versi Aplikasi" class="w-5 h-5">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ __('Versi Aplikasi') }}
            </x-nav-link>   
        @endif
    </div>

    <!-- Profil User -->
    <div class="border-t border-gray-100 p-4">
        <div class="flex items-center justify-between gap-3">
            <a href="{{ Auth::check() ? route('profile.edit') : '#' }}" class="flex items-center gap-3 group no-underline">
                 @if(Auth::check())
                    {{-- <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/profile-picture.png') }}" 
                        class="w-9 h-9 rounded-full object-cover border border-gray-200" alt="User"> --}}
                    <x-avatar :name="auth()->user()->name" size="9" />
                    <div>
                        <p class="text-xs font-semibold text-gray-800 group-hover:text-blue-600 transition mt-2 mb-1">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                    </div>
                @else
                    <p class="text-sm text-gray-500">Guest</p>
                @endif
            </a>
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <button type="submit" id="logout-button" title="Logout" class="p-2 rounded-md bg-blue-50 hover:bg-blue-100 transition">
                         {{-- Logout Icon --}}
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            @endif
        </div>
    </div>
</nav>