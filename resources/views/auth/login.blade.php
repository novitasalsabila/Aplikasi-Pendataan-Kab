<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <img src="{{ asset('images/Logo-Kabupaten-Bantul.png') }}" 
            alt="Logo Kabupaten Bantul"
            class="mx-auto w-24 h-auto md:w-32 lg:w-40 object-contain" />

        <h1 class="text-xl md:text-2xl font-bold text-gray-900 text-center" font-poppins>
            Sistem Pendataan Aplikasi OPD
        </h1>


        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Masukkan Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" placeholder="Masukkan Sandi" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            
            <!-- Ikon Mata -->
                <img src="{{ asset('icons/eye.svg') }}" 
                alt="Show Password" 
                id="togglePassword"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 cursor-pointer opacity-70 hover:opacity-100" />
            </div>
            
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4 mb-2">
            @if (Route::has('password.request'))
                <a class="no-underline text-sm text-gray-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Lupa Sandi Anda?') }}
                </a>
            @endif
        </div>

        <x-primary-button size="md" class="w-full">
                {{ __('Masuk') }}
        </x-primary-button>
    </form>

    <!-- Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            this.src = isPassword 
                ? '{{ asset('icons/eye-off.svg') }}'  
                : '{{ asset('icons/eye.svg') }}';
        });
    });
    </script>
</x-guest-layout>
