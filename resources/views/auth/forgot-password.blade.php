<x-guest-layout>
    <div class="mb-6 text-sm text-gray-600">
        <h2 class="font-bold text-gray-800 mb-1 text-xl">
            Lupa Kata Sandi?
        </h2>
        <p>
            Masukkan alamat email terdaftar untuk menerima tautan pengaturan ulang kata sandi.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Alamat Email" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                placeholder="Masukkan email Anda"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-end">
            <x-primary-button class="px-6 py-2">
                Kirim Tautan Reset
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
