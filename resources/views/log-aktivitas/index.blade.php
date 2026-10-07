<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-3"><div><p class="sa-eyebrow">Jejak finansial</p><h1 class="font-display text-2xl font-extrabold text-[#183b2a] dark:text-white">Riwayat transaksi</h1></div><a href="{{ route('exports.excel') }}" class="sa-secondary-button !py-2 text-sm">Unduh laporan</a></div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="rounded-[1.5rem] bg-[#183b2a] p-6 text-white sm:p-8"><p class="text-xs font-bold uppercase tracking-[0.2em] text-[#b8d9ba]">Semua aktivitas tabungan</p><div class="mt-3 flex flex-wrap items-end justify-between gap-3"><h2 class="font-display text-3xl font-extrabold">{{ $aktivitas->total() }} transaksi</h2><span class="rounded-full bg-white/10 px-3 py-1 text-sm text-[#d0e0d1]">Setoran & aktivitas rencana</span></div></div>
            <div class="sa-card overflow-hidden">
                @forelse($aktivitas as $log)
                    <div class="flex gap-4 border-b border-slate-100 p-5 transition hover:bg-slate-50 last:border-0 dark:border-slate-800 dark:hover:bg-slate-800/60">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl {{ $log->aktivitas === 'setoran' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }} text-lg font-bold">{{ $log->aktivitas === 'setoran' ? '↓' : '✦' }}</div>
                        <div class="min-w-0 flex-1"><div class="flex flex-wrap items-start justify-between gap-2"><div><h3 class="font-bold capitalize text-slate-800 dark:text-white">{{ $log->aktivitas }}</h3>@if($log->tabungan)<p class="mt-1 text-sm font-semibold text-emerald-600">{{ $log->tabungan->judul }}</p>@endif</div><time class="text-xs font-medium text-slate-400" datetime="{{ $log->created_at->toIso8601String() }}">{{ $log->created_at->translatedFormat('d F Y, H:i') }}</time></div><p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $log->deskripsi }}</p><p class="mt-2 text-xs text-slate-400">Sumber dana: {{ $log->user?->nama ?? 'Akun saya' }}</p></div>
                    </div>
                @empty
                    <div class="p-12 text-center text-slate-500"><div class="mb-3 text-5xl">◷</div><p>Belum ada transaksi. Setoran pertamamu akan muncul di sini.</p></div>
                @endforelse
            </div>
            <div>{{ $aktivitas->links() }}</div>
        </div>
    </div>
</x-app-layout>
