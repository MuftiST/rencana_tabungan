<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f6f8f4">
    <title>{{ config('app.name', 'SimpanAja') }}</title>
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
    @if (!file_exists(public_path('build/manifest.json')) && !file_exists(public_path('hot')))
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
</head>
<body class="font-sans antialiased text-slate-800 dark:text-slate-100">
    <div class="min-h-screen bg-[#f6f8f4] transition-colors duration-300 dark:bg-[#101812]">
        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-[#e7ece4] bg-white dark:border-[#25362a] dark:bg-[#151f18]">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="min-h-[calc(100vh-15rem)]">
            {{ $slot }}
        </main>

        <footer class="border-t border-[#e7ece4] bg-white dark:border-[#25362a] dark:bg-[#151f18]">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-7 text-sm sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="font-display text-lg font-extrabold text-[#183b2a] dark:text-[#e8f0e8]">Simpan<span class="text-[#438b55] dark:text-[#a9d2ad]">Aja</span></a>
                <p class="text-slate-500 dark:text-slate-400">Atur rencana, bangun kebiasaan, capai tujuan.</p>
                <span class="text-xs text-slate-400">© {{ now()->year }} SimpanAja</span>
            </div>
        </footer>
    </div>
</body>
</html>
