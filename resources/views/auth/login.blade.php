<x-guest-layout>
    <div class="w-full max-w-lg bg-white p-10 rounded-2xl shadow-xl"> {{-- ubah max-w-md jadi max-w-lg --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
            Selamat Datang 👋
        </h2>
        <p class="text-center text-gray-500 mb-8">
            Silakan masuk untuk melanjutkan
        </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-indigo-600 hover:text-indigo-800">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Tombol -->
                    <x-primary-button
                        class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg transition ease-in-out duration-150">
                        {{ __('Masuk') }}
                    </x-primary-button>

            <!-- Link daftar -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">
                    Daftar sekarang
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>
