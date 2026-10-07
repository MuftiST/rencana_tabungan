<x-guest-layout>
    <div class="mb-7"><p class="text-sm font-bold uppercase tracking-[0.2em] text-emerald-600">Mulai hari ini</p><h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-800">Buat akun baru</h1><p class="mt-2 text-sm text-slate-500">Satu langkah kecil untuk target besar.</p></div>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nama -->
        <div>
            <x-input-label for="nama" value="Nama" />
            <x-text-input id="nama" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password (minimal 8 karakter)" />

            <x-text-input id="password" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-3">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 rounded-xl bg-emerald-700 px-5 py-3 text-sm font-bold hover:bg-emerald-800">
                Daftar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
