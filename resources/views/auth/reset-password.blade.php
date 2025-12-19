<x-guest-layout>
    <div class="mb-6 text-sm text-gray-600">
        <h2 class="text-xl font-bold text-gray-800 mb-1">
            Atur Ulang Kata Sandi
        </h2>
        <p>
            Silakan buat kata sandi baru untuk akun Anda.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <!-- Token Reset Password -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Alamat Email" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password Baru -->
        <div>
            <x-input-label for="password" value="Kata Sandi Baru" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end pt-2">
            <x-primary-button class="px-6 py-2">
                Simpan Kata Sandi Baru
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
