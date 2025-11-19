<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Memastikan full height di desktop (100% viewport height) */
        @media (min-width: 768px) {
            .h-full-md { height: 100vh; }
        }
    </style>
</head>

<body class="font-poppins antialiased bg-gray-50 dark:bg-gray-900 h-full">
    
    {{-- CONTAINER UTAMA --}}
    <div class="min-h-screen flex overflow-hidden"
        x-data="{ 
            // Variabel sidebar 'open' digunakan di navigation.blade.php
            open: window.innerWidth >= 768, 
            isMobile: window.innerWidth < 768,
            init() {
                // Listener untuk memperbarui status 'isMobile' saat ukuran layar berubah
                window.addEventListener('resize', () => {
                    this.isMobile = window.innerWidth < 768;
                    // Di desktop (non-mobile), paksa sidebar tetap terbuka
                    if (!this.isMobile) {
                        this.open = true;
                    }
                });
            }
        }">

        <!-- 🔹 HEADER UNTUK MOBILE (Fixed di atas konten dengan Z-index tertinggi) -->
        <header class="flex items-center justify-between bg-white border-b border-gray-100 p-4 md:hidden fixed top-0 left-0 right-0 z-50 shadow-md">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/Logo-Kabupaten-Bantul.png') }}" alt="Logo" class="w-8 h-auto">
                <span class="font-semibold text-gray-800 text-lg">Pendataan Aplikasi</span>
            </div>
            <button 
                @click="open = !open" {{-- Mengubah state 'open' --}}
                class="p-2 rounded-md hover:bg-gray-100 transition relative"
            >
                <template x-if="!open">
                    {{-- Hamburger Icon --}}
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </template>
                <template x-if="open">
                    {{-- Close Icon --}}
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </template>
            </button>
        </header>

        <!-- Backdrop/Overlay (Hanya di Mobile, akan menutup sidebar saat diklik) -->
        <div x-show="open && isMobile" 
            x-transition:enter="transition ease-out duration-300" 
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100" 
            x-transition:leave="transition ease-in duration-300" 
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden"
            @click="open = false">
        </div>
        
        {{-- Sidebar (navigation.blade.php) --}}
        @include('layouts.navigation')

        {{-- Konten utama --}}
        <div class="flex-1 flex flex-col overflow-y-auto h-screen">
            
            @isset($header)
                {{-- Header di Desktop (menggunakan $header slot) --}}
                <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 hidden md:block">
                    {{ $header }}
                </header>
                {{-- Padding atas khusus untuk mobile karena ada fixed header --}}
                <div class="md:hidden h-20"></div> 
            @endisset

            <main class="p-2 sm:p-8 lg:p-8 sm:mt-20 md:pt-8 mt-0"> {{-- Di mobile, padding top dikurangi karena header sudah fixed --}}
                {{ $slot }}
            </main>
        </div>
    </div>
    
    {{-- Script Logout Disesuaikan: menggunakan ID 'logout-button' yang harus ditambahkan di navigation.blade.php --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoutButton = document.getElementById('logout-button');
            if (logoutButton) {
                logoutButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah submit form langsung
                    Swal.fire({
                        title: 'Konfirmasi Log Out',
                        text: "Apakah Anda yakin ingin keluar?",
                        showCancelButton: true,
                        confirmButtonColor: '#000000', // Warna biru Tailwind (indigo-600)
                        cancelButtonColor: '#E6E7EB',
                        confirmButtonText: 'Ya, Keluar',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'px-6 py-2 rounded-lg w-32',
                            cancelButton: 'px-6 py-2 rounded-lg w-32 ml-2 text-gray-600'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                });
            }
        });
    </script>
    {{-- Hapus Aplikasi --}}
    <script>
        function openModal(id) {
            document.getElementById(`confirmModal-${id}`).classList.remove('hidden');
            document.getElementById(`confirmModal-${id}`).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(`confirmModal-${id}`).classList.add('hidden');
            document.getElementById(`confirmModal-${id}`).classList.remove('flex');
        }

        function confirmDelete(id) {
            document.getElementById(`deleteForm-${id}`).submit();
        }
    </script>
</body>
</html>