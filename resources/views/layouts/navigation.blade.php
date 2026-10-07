<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-[#e7ece4]/90 bg-white/95 backdrop-blur-xl dark:border-[#25362a] dark:bg-[#151f18]/95">
    <div class="mx-auto flex min-h-[4.5rem] max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2.5" aria-label="SimpanAja - Beranda">
            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-[#e8f3e8]">
                <img src="{{ asset('img/icons/unicons/logo.png') }}" alt="" class="h-8 w-8 object-contain">
            </span>
            <span class="font-display text-xl font-extrabold tracking-tight text-[#183b2a] dark:text-[#e8f0e8]">Simpan<span class="text-[#438b55] dark:text-[#a9d2ad]">Aja</span></span>
        </a>

        <div class="hidden items-center gap-1 md:flex">
            @foreach([['home', 'Beranda', '⌂'], ['statistics.index', 'Statistik', '↗'], ['log-aktivitas.index', 'Riwayat', '◷'], ['profile.edit', 'Profil', '○']] as $link)
                <a href="{{ route($link[0]) }}" @class([
                    'rounded-xl px-3.5 py-2.5 text-sm font-semibold transition',
                    'bg-[#edf5ed] text-[#27633a] dark:bg-[#24372a] dark:text-[#a9d2ad]' => request()->routeIs($link[0], $link[0].'*'),
                    'text-slate-600 hover:bg-slate-50 hover:text-[#27633a] dark:text-slate-300 dark:hover:bg-[#202d23]' => !request()->routeIs($link[0], $link[0].'*'),
                ])><span class="mr-1.5 text-base" aria-hidden="true">{{ $link[2] }}</span>{{ $link[1] }}</a>
            @endforeach
        </div>

        <div class="flex shrink-0 items-center gap-2">
            <a href="{{ route('menabung.create') }}" class="hidden rounded-xl border border-[#dce8dc] px-3.5 py-2.5 text-sm font-bold text-[#315f3a] transition hover:border-[#438b55] hover:bg-[#f4f8f3] dark:border-[#344b39] dark:text-[#c2dec4] dark:hover:bg-[#202d23] sm:inline-flex">+ Setor</a>
            <a href="{{ route('tabungan.create') }}" class="hidden rounded-xl bg-[#34794a] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#28633b] focus:outline-none focus:ring-2 focus:ring-[#70a779] focus:ring-offset-2 sm:inline-flex">+ Buat Rencana</a>
            <button id="theme-toggle" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl text-lg text-slate-500 transition hover:bg-slate-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#438b55] dark:text-slate-300 dark:hover:bg-[#24372a]" title="Ganti ke tema gelap" aria-label="Ganti ke tema gelap" aria-pressed="false">☾</button>
            <a href="{{ route('notifications.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-xl text-lg text-slate-500 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-[#24372a]" aria-label="Notifikasi">
                ♧
                @if(auth()->user()->unreadNotifications()->count())
                    <span class="absolute right-1 top-1 flex h-2.5 w-2.5 rounded-full bg-[#e5a642] ring-2 ring-white dark:ring-[#151f18]"></span>
                @endif
            </a>
            <button type="button" @click="open = !open" class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#e7ece4] text-xl text-slate-600 dark:border-[#344b39] dark:text-slate-200 md:hidden" :aria-expanded="open.toString()" aria-label="Buka menu">
                <span x-show="!open" aria-hidden="true">☰</span><span x-show="open" x-cloak aria-hidden="true">×</span>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak x-transition class="border-t border-[#e7ece4] bg-white px-4 pb-4 pt-2 dark:border-[#25362a] dark:bg-[#151f18] md:hidden">
        <div class="grid grid-cols-2 gap-2">
            @foreach([['home', 'Beranda'], ['statistics.index', 'Statistik'], ['log-aktivitas.index', 'Riwayat'], ['profile.edit', 'Profil']] as $link)
                <a href="{{ route($link[0]) }}" class="rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-[#edf5ed] dark:text-slate-200 dark:hover:bg-[#24372a]">{{ $link[1] }}</a>
            @endforeach
            <a href="{{ route('tabungan.create') }}" class="rounded-xl bg-[#34794a] px-4 py-3 text-center text-sm font-bold text-white">+ Buat Rencana</a>
            <a href="{{ route('menabung.create') }}" class="rounded-xl border border-[#dce8dc] px-4 py-3 text-center text-sm font-bold text-[#315f3a] dark:border-[#344b39] dark:text-[#c2dec4]">+ Tambah Setoran</a>
            <button type="button" @click="$dispatch('open-modal', 'confirm-logout'); open = false" class="col-span-2 rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30">Keluar dari akun</button>
        </div>
    </div>

    <x-modal name="confirm-logout" focusable>
        <form method="POST" action="{{ route('logout') }}" class="p-6">
            @csrf
            <h2 class="font-display text-xl font-extrabold text-slate-900 dark:text-white">Yakin ingin keluar?</h2>
            <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Kamu perlu masuk kembali untuk melihat dan mengelola rencana tabungan.</p>
            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">Batal</x-secondary-button>
                <x-danger-button type="submit">Keluar</x-danger-button>
            </div>
        </form>
    </x-modal>
</nav>
