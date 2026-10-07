<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f6f8f4">
    <meta name="description" content="Atur target tabungan, pantau perkembangan, dan capai tujuanmu dengan lebih terencana bersama SimpanAja.">
    <title>SimpanAja — Wujudkan Rencana, SimpanAja.</title>
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
<body class="welcome-page font-sans antialiased text-slate-800">
    <div class="welcome-shell min-h-screen overflow-hidden bg-[#f6f8f4]">
        <header class="welcome-header sticky top-0 z-30 border-b border-[#e7ece4]/80 bg-[#f6f8f4]/90 backdrop-blur-xl">
            <nav class="mx-auto flex h-[4.5rem] max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8" aria-label="Navigasi utama">
                <a href="/" class="flex items-center gap-2.5" aria-label="SimpanAja, beranda">
                    <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#e8f3e8]"><img src="{{ asset('img/icons/unicons/logo.png') }}" alt="" class="h-8 w-8 object-contain"></span>
                    <span class="font-display text-xl font-extrabold tracking-tight text-[#183b2a] dark:text-[#e8f0e8]">Simpan<span class="text-[#438b55] dark:text-[#a9d2ad]">Aja</span></span>
                </a>
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="#cara-kerja" class="hidden rounded-xl px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-white sm:inline-flex">Cara kerja</a>
                    <a href="{{ route('login') }}" class="rounded-xl px-3 py-2.5 text-sm font-bold text-[#315f3a] transition hover:bg-white">Masuk</a>
                    <button id="theme-toggle" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl text-lg text-slate-600 transition hover:bg-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#438b55] dark:text-slate-200 dark:hover:bg-[#24372a]" title="Ganti ke tema gelap" aria-label="Ganti ke tema gelap" aria-pressed="false">☾</button>
                    <a href="{{ route('register') }}" class="rounded-xl bg-[#34794a] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#28633b]">Buat Akun</a>
                </div>
            </nav>
        </header>

        <main>
            <section class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 pb-16 pt-12 sm:px-6 sm:pb-24 sm:pt-16 lg:grid-cols-[1.03fr_.97fr] lg:gap-16 lg:px-8 lg:py-24">
                <div class="sa-enter relative z-10">
                    <span class="inline-flex items-center gap-2 rounded-full border border-[#dce9dc] bg-white/80 px-3.5 py-2 text-xs font-bold text-[#34794a] dark:border-[#344b39] dark:bg-[#18231b] dark:text-[#a9d2ad]"><span class="h-2 w-2 rounded-full bg-[#69a875]"></span>Teman menabung untuk tujuanmu</span>
                    <h1 class="mt-6 max-w-2xl font-display text-4xl font-extrabold leading-[1.12] tracking-[-.04em] text-[#183b2a] dark:text-[#e8f0e8] sm:text-5xl lg:text-[3.7rem]">Wujudkan Rencana,<br><span class="text-[#438b55] dark:text-[#a9d2ad]">SimpanAja.</span></h1>
                    <p class="mt-5 max-w-xl text-base leading-7 text-[#68766b] dark:text-[#b6c4b8] sm:text-lg sm:leading-8">Atur target tabunganmu, pantau perkembangan, dan capai tujuanmu dengan lebih terencana.</p>
                    <div class="mt-8 flex flex-col gap-3 min-[420px]:flex-row">
                        <a href="{{ route('register') }}" class="sa-primary-button px-6 py-3.5">Buat Rencana <span aria-hidden="true">→</span></a>
                        <a href="{{ route('login') }}" class="sa-secondary-button px-6 py-3.5">Lihat Rencana</a>
                    </div>
                    <div class="mt-8 flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-medium text-slate-600 dark:text-slate-300">
                    <span class="inline-flex items-center gap-2"><span class="text-[#438b55] dark:text-[#a9d2ad]">✓</span>Target lebih teratur</span>
                    <span class="inline-flex items-center gap-2"><span class="text-[#438b55] dark:text-[#a9d2ad]">✓</span>Progres mudah dipantau</span>
                    </div>
                </div>

                <div class="sa-enter relative mx-auto w-full max-w-lg lg:justify-self-end" style="animation-delay: 100ms">
                    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-[#dcebdc] blur-2xl dark:bg-[#24372a]"></div>
                    <div class="absolute -bottom-10 -left-8 h-36 w-36 rounded-full bg-[#e8edd7] blur-2xl dark:bg-[#303722]"></div>
                    <div class="sa-card relative rounded-[1.75rem] border border-white bg-white p-5 shadow-[0_24px_80px_rgba(35,73,43,.12)] sm:p-7">
                        <div class="flex items-center justify-between gap-4">
                            <div><p class="text-xs font-semibold text-slate-600 dark:text-slate-300">Rencana tabungan</p><h2 class="mt-1 font-display text-lg font-extrabold text-[#183b2a] dark:text-[#e8f0e8]">Liburan impian</h2></div>
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#edf5ed] text-xl dark:bg-[#24372a]" aria-hidden="true">✈️</span>
                        </div>
                        <div class="mt-7 rounded-2xl bg-[#f5f8f3] p-4 dark:bg-[#101812] sm:p-5">
                            <div class="flex items-end justify-between gap-3">
                                <div><p class="text-xs font-medium text-slate-600 dark:text-slate-300">Terkumpul</p><p class="mt-1 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-[#e8f0e8] sm:text-3xl">Rp 3.250.000</p></div>
                                <span class="rounded-full bg-[#e3f1e3] px-2.5 py-1 text-xs font-extrabold text-[#34794a] dark:bg-[#24372a] dark:text-[#a9d2ad]">65%</span>
                            </div>
                            <div class="mt-4 h-2.5 overflow-hidden rounded-full bg-[#e2e9e0] dark:bg-[#29362c]"><div class="h-full w-[65%] rounded-full bg-gradient-to-r from-[#438b55] to-[#82b88a]"></div></div>
                            <div class="mt-2 flex justify-between text-[11px] font-medium text-slate-600 dark:text-slate-300"><span>Rp 0</span><span>Target Rp 5.000.000</span></div>
                        </div>
                        <div class="mt-5 flex items-center justify-between border-t border-[#edf0eb] pt-5 dark:border-[#293b2e]">
                            <div class="flex -space-x-2" aria-hidden="true"><span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-[#dcebdc] text-sm dark:border-[#18231b]">🌱</span><span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-[#f5edda] text-sm dark:border-[#18231b]">✓</span><span class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-[#e8edf3] text-sm dark:border-[#18231b]">↗</span></div>
                            <p class="text-xs font-semibold text-slate-600 dark:text-slate-300">Setiap langkah berarti</p>
                        </div>
                    </div>
                    <div class="sa-card absolute -left-3 top-24 hidden rounded-2xl border border-[#edf0eb] bg-white px-4 py-3 shadow-lg sm:block">
                        <p class="text-[10px] font-semibold text-slate-600 dark:text-slate-300">Setoran bulan ini</p><p class="mt-1 text-sm font-extrabold text-[#34794a] dark:text-[#a9d2ad]">+ Rp 500.000</p>
                    </div>
                </div>
            </section>

            <section id="cara-kerja" class="welcome-section border-y border-[#e7ece4] bg-white py-16 sm:py-20">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="mx-auto max-w-xl text-center"><p class="sa-eyebrow">Sederhana dan terarah</p><h2 class="mt-3 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-[#e8f0e8] sm:text-3xl">Mulai dari niat, lanjutkan dengan kebiasaan.</h2><p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300 sm:text-base">SimpanAja membantumu menjaga rencana tetap terlihat dan langkah tetap terasa ringan.</p></div>
                    <div class="mt-10 grid gap-4 sm:grid-cols-3">
                        <article class="welcome-feature rounded-2xl border border-[#edf0eb] bg-[#fbfcfa] p-5 sm:p-6"><span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#edf5ed] text-xl text-[#34794a] dark:bg-[#24372a] dark:text-[#a9d2ad]" aria-hidden="true">◎</span><h3 class="mt-4 font-display text-base font-extrabold text-[#183b2a] dark:text-[#e8f0e8]">Tentukan tujuan</h3><p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Buat rencana untuk hal yang ingin kamu wujudkan, besar ataupun kecil.</p></article>
                        <article class="welcome-feature rounded-2xl border border-[#edf0eb] bg-[#fbfcfa] p-5 sm:p-6"><span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#f5f2e7] text-xl text-[#a27d2d] dark:bg-[#39321f] dark:text-[#f0d484]" aria-hidden="true">▤</span><h3 class="mt-4 font-display text-base font-extrabold text-[#183b2a] dark:text-[#e8f0e8]">Catat progres</h3><p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Pantau setoran dan lihat perkembangan tabunganmu dari waktu ke waktu.</p></article>
                        <article class="welcome-feature rounded-2xl border border-[#edf0eb] bg-[#fbfcfa] p-5 sm:p-6"><span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#eef2f8] text-xl text-[#56739b] dark:bg-[#263342] dark:text-[#b4c8e2]" aria-hidden="true">↗</span><h3 class="mt-4 font-display text-base font-extrabold text-[#183b2a] dark:text-[#e8f0e8]">Rayakan kemajuan</h3><p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Setiap konsistensi membawamu satu langkah lebih dekat ke target.</p></article>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 sm:py-20 lg:px-8">
                <div class="welcome-cta flex flex-col items-start justify-between gap-6 rounded-[1.5rem] bg-[#eaf3e8] p-6 sm:p-9 md:flex-row md:items-center">
                    <div><p class="sa-eyebrow">Mulai hari ini</p><h2 class="mt-2 font-display text-2xl font-extrabold text-[#183b2a] dark:text-[#e8f0e8] sm:text-3xl">Tujuanmu layak diperjuangkan.</h2><p class="mt-2 text-sm text-[#68766b] dark:text-[#c1cdc2]">Buat rencana pertamamu dan mulai menabung dengan lebih terarah.</p></div>
                    <a href="{{ route('register') }}" class="sa-primary-button shrink-0">Mulai gratis <span aria-hidden="true">→</span></a>
                </div>
            </section>
        </main>

        <footer class="welcome-footer border-t border-[#e7ece4] bg-white">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-7 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <div><a href="/" class="font-display text-lg font-extrabold text-[#183b2a] dark:text-[#e8f0e8]">Simpan<span class="text-[#438b55] dark:text-[#a9d2ad]">Aja</span></a><p class="mt-1 text-xs text-slate-600 dark:text-slate-300">Atur rencana, bangun kebiasaan, capai tujuan.</p></div>
                <div class="flex gap-5 text-sm font-semibold text-slate-600 dark:text-slate-300"><a href="#cara-kerja" class="transition hover:text-[#34794a] dark:hover:text-[#a9d2ad]">Tentang</a><a href="{{ route('login') }}" class="transition hover:text-[#34794a] dark:hover:text-[#a9d2ad]">Masuk</a><a href="{{ route('register') }}" class="transition hover:text-[#34794a] dark:hover:text-[#a9d2ad]">Daftar</a></div>
                <span class="text-xs text-slate-500 dark:text-slate-400">© {{ now()->year }} SimpanAja</span>
            </div>
        </footer>
    </div>
</body>
</html>
