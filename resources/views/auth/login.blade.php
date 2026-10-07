<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8"><div class="mb-5 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700"><span class="h-2 w-2 animate-pulse rounded-full bg-emerald-500"></span>Ruang aman untuk targetmu</div><p class="text-xs font-extrabold uppercase tracking-[0.22em] text-emerald-600">Selamat datang kembali</p><h1 class="mt-2 font-serif text-4xl font-bold tracking-tight text-slate-800">Masuk ke SimpanAja</h1><p class="mt-3 text-sm leading-6 text-slate-500">Lanjutkan perjalanan menuju target finansialmu, satu setoran kecil setiap hari.</p></div>
    <form method="POST" action="{{ route('login') }}" class="space-y-5" data-login-form>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 py-3 transition focus:border-emerald-500 focus:ring-emerald-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 py-3 pr-24 transition focus:border-emerald-500 focus:ring-emerald-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-emerald-700 hover:text-emerald-900" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center rounded-xl bg-emerald-700 py-3.5 text-sm font-bold shadow-lg shadow-emerald-600/20 transition hover:-translate-y-0.5 hover:bg-emerald-800" data-login-submit>
                <span data-login-label>Masuk dengan aman</span>
            </x-primary-button>
        </div>
    </form>
    <div class="mt-7 grid grid-cols-3 gap-2 border-t border-slate-100 pt-5 text-center text-[11px] font-semibold text-slate-400"><span>🔒 Privat</span><span>⚡ Praktis</span><span>🌱 Konsisten</span></div>
    @if (Route::has('register'))
        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a class="font-bold text-emerald-700 underline decoration-emerald-300 underline-offset-2 hover:text-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2" href="{{ route('register') }}">
                Daftar sekarang
            </a>
        </p>
    @endif
</x-guest-layout>
<script>
document.querySelector('[data-login-form]')?.addEventListener('submit', function () {
    const button = this.querySelector('[data-login-submit]');
    const label = this.querySelector('[data-login-label]');
    if (button && label) {
        button.disabled = true;
        button.classList.add('cursor-wait', 'opacity-80');
        label.textContent = 'Memeriksa akun...';
    }
});
</script>
