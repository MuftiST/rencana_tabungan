<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SimpanAja — Rencana tabunganmu</title>
    <script src="{{ asset('js/theme.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="{{ asset('css/simpanaja.css') }}" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>tailwind.config = { darkMode: 'selector', theme: { extend: { fontFamily: { display: ['Manrope', 'sans-serif'], sans: ['DM Sans', 'sans-serif'] } } } };</script>
    @endif
</head>
<body class="font-sans antialiased text-slate-800">
    <main class="auth-page relative flex min-h-screen items-center justify-center overflow-hidden bg-[#f6f8f4] px-4 py-8 sm:px-6">
        <div class="pointer-events-none absolute -left-24 -top-24 h-72 w-72 rounded-full bg-[#dcebdc]/70 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-32 -right-20 h-96 w-96 rounded-full bg-[#e8edd7]/80 blur-3xl"></div>
        <div class="auth-card relative grid w-full max-w-5xl overflow-hidden rounded-[1.75rem] border border-white bg-white shadow-[0_24px_80px_rgba(35,73,43,.12)] lg:grid-cols-[.88fr_1.12fr]">
            <section class="relative hidden flex-col justify-between overflow-hidden bg-[#183b2a] p-9 text-white lg:flex">
                <div class="pointer-events-none absolute -right-24 -top-20 h-72 w-72 rounded-full border-[1.5rem] border-white/5"></div>
                <div class="pointer-events-none absolute -bottom-16 -left-14 h-56 w-56 rounded-full bg-[#438b55]/25 blur-2xl"></div>
                <a href="/" class="relative flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#e8f3e8]"><img src="{{ asset('img/icons/unicons/logo.png') }}" alt="" class="h-9 w-9 object-contain"></span>
                    <span class="font-display text-xl font-extrabold">SimpanAja</span>
                </a>
                <div class="relative py-12">
                    <p class="text-xs font-extrabold uppercase tracking-[.18em] text-[#acd3ad]">Rencana kecil, hasil berarti</p>
                    <h1 class="mt-4 font-display text-3xl font-extrabold leading-tight">Tujuan finansial terasa lebih dekat saat kamu punya rencana.</h1>
                    <p class="mt-4 text-sm leading-6 text-[#d0e0d1]">Atur target, catat setoran, dan lihat langkah baikmu terus bertumbuh.</p>
                    <div class="mt-7 flex items-center gap-2 text-sm font-semibold text-[#d0e0d1]"><span class="flex h-7 w-7 items-center justify-center rounded-full bg-white/10 text-[#b7dcb8]">✓</span> Mulai dengan sederhana, lanjutkan dengan konsisten.</div>
                </div>
                <p class="relative text-xs text-[#b1c8b2]">Simpan Hari Ini, Nikmati Esok</p>
            </section>
            <section class="auth-content relative p-6 pt-16 sm:p-10 sm:pt-16 lg:p-12 lg:pt-16">
                <button id="theme-toggle" type="button" class="absolute right-5 top-5 flex h-10 w-10 items-center justify-center rounded-xl text-lg text-slate-500 transition hover:bg-slate-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#438b55] dark:text-slate-300 dark:hover:bg-[#24372a] sm:right-8 sm:top-8" title="Ganti ke tema gelap" aria-label="Ganti ke tema gelap" aria-pressed="false">☾</button>
                <a href="/" class="mb-8 inline-flex items-center gap-2.5 lg:hidden">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#e8f3e8]"><img src="{{ asset('img/icons/unicons/logo.png') }}" alt="" class="h-8 w-8 object-contain"></span>
                    <span class="font-display text-lg font-extrabold text-[#183b2a]">SimpanAja</span>
                </a>
                {{ $slot }}
            </section>
        </div>
    </main>
    <script>
        document.querySelectorAll('input[type="password"]').forEach((input) => {
            const wrapper = input.parentElement;
            if (!wrapper) return;
            wrapper.classList.add('relative');
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'absolute right-3 top-1/2 -translate-y-1/2 rounded-lg px-2 py-1 text-xs font-bold text-slate-500 transition hover:bg-[#edf5ed] hover:text-[#34794a]';
            button.textContent = 'Lihat';
            button.addEventListener('click', () => {
                const visible = input.type === 'text';
                input.type = visible ? 'password' : 'text';
                button.textContent = visible ? 'Lihat' : 'Sembunyikan';
            });
            wrapper.appendChild(button);
        });
    </script>
</body>
</html>
