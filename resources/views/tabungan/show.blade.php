<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="min-w-0">
                <p class="sa-eyebrow">Detail rencana</p>
                <h1 class="mt-1 break-words font-display text-2xl font-extrabold text-[#183b2a] dark:text-white">{{ $tabungan->judul }}</h1>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('home') }}" class="sa-secondary-button">← Kembali</a>
                @if($tabungan->user_id === auth()->id())
                    <a href="{{ route('tabungan.edit', $tabungan) }}" class="sa-secondary-button">Edit</a>
                    <form method="POST" action="{{ route('tabungan.destroy', $tabungan) }}" onsubmit="return confirm('Hapus tabungan ini beserta seluruh riwayat setoran?')">@csrf @method('DELETE')<button type="submit" class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-red-700">Hapus</button></form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="mx-auto max-w-5xl space-y-5 px-4 py-7 sm:px-6 sm:py-9 lg:px-8">
        @if(session('success'))
            <div role="status" class="rounded-2xl border border-[#d4e8d5] bg-[#edf7ed] px-5 py-4 text-sm font-semibold text-[#28633b]">{{ session('success') }}</div>
        @endif

        @if($tabungan->foto)
            <div class="overflow-hidden rounded-[1.25rem] border border-[#e7ece4] bg-white shadow-sm dark:border-[#293b2e] dark:bg-[#18231b]">
                <img src="{{ asset('storage/'.$tabungan->foto) }}" alt="Foto {{ $tabungan->judul }}" class="max-h-[28rem] w-full object-cover">
            </div>
        @endif

        @php
            $progress = min(100, max(0, (float) $tabungan->persentase_progress));
            $remaining = max(0, (float) $tabungan->target_nominal - (float) $tabungan->nominal_terkumpul);
        @endphp

        <section class="sa-card p-5 sm:p-7" aria-label="Ringkasan progres">
            <div class="grid gap-5 sm:grid-cols-3">
                <div><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Terkumpul</p><p class="mt-2 font-display text-2xl font-extrabold tracking-tight text-[#34794a] dark:text-[#a9d2ad]">Rp {{ number_format($tabungan->nominal_terkumpul, 0, ',', '.') }}</p></div>
                <div><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Target tabungan</p><p class="mt-2 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-white">Rp {{ number_format($tabungan->target_nominal, 0, ',', '.') }}</p></div>
                <div><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Sisa target</p><p class="mt-2 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-white">Rp {{ number_format($remaining, 0, ',', '.') }}</p></div>
            </div>
            <div class="mt-6 border-t border-[#eef1ed] pt-5 dark:border-[#293b2e]">
                <div class="flex items-center justify-between gap-3 text-sm"><span class="font-bold text-[#183b2a] dark:text-white">Progress rencana</span><span class="font-extrabold text-[#34794a] dark:text-[#a9d2ad]">{{ round($progress) }}%</span></div>
                <div class="sa-progress mt-3 h-3"><span style="width: {{ $progress }}%"></span></div>
                <p class="mt-3 text-xs text-slate-500 dark:text-slate-400">Target tanggal {{ $tabungan->target_tanggal->format('d F Y') }}</p>
            </div>
        </section>

        <div class="grid gap-5 lg:grid-cols-2">
            <section class="sa-card p-5 sm:p-6">
                <h2 class="font-display text-lg font-extrabold text-[#183b2a] dark:text-white">Kontributor</h2>
                <ul class="mt-4 divide-y divide-[#eef1ed] dark:divide-[#293b2e]">
                    <li class="flex items-center justify-between gap-3 py-3 first:pt-0"><span class="font-semibold text-slate-700 dark:text-slate-200">{{ $tabungan->user->nama }} <span class="text-slate-400">(pemilik)</span></span><span class="rounded-full bg-[#edf5ed] px-2.5 py-1 text-[10px] font-extrabold text-[#34794a] dark:bg-[#24372a] dark:text-[#a9d2ad]">PEMILIK</span></li>
                    @foreach($tabungan->collaborators as $person)
                        <li class="py-3">
                            <div class="flex items-center justify-between gap-3">
                                <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $person->nama }}</span>
                                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-extrabold uppercase text-slate-500 dark:bg-[#29362c] dark:text-slate-300">{{ $person->pivot->role === 'kontributor' ? 'Kontributor' : 'Pemilik' }}</span>
                            </div>
                            @if($tabungan->user_id === auth()->id())
                                <form method="POST" action="{{ route('collaboration.remove', [$tabungan, $person]) }}" class="mt-2 text-right">@csrf @method('DELETE')<button type="submit" class="text-xs font-semibold text-red-600 hover:underline">Hapus akses</button></form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="sa-card p-5 sm:p-6">
                <h2 class="font-display text-lg font-extrabold text-[#183b2a] dark:text-white">Riwayat setoran</h2>
                <ul class="mt-4 divide-y divide-[#eef1ed] dark:divide-[#293b2e]">
                    @forelse($tabungan->menabung as $deposit)
                        <li class="flex items-center justify-between gap-3 py-3 first:pt-0"><span class="text-sm text-slate-500 dark:text-slate-400">{{ $deposit->tanggal->format('d/m/Y') }}</span><strong class="text-sm font-extrabold text-[#34794a] dark:text-[#a9d2ad]">Rp {{ number_format($deposit->nominal, 0, ',', '.') }}</strong></li>
                    @empty
                        <li class="rounded-xl bg-[#f6f8f4] p-4 text-sm text-slate-500 dark:bg-[#101812] dark:text-slate-400">Belum ada setoran. Setoran pertamamu bisa dimulai kapan saja.</li>
                    @endforelse
                </ul>
            </section>
        </div>
    </div>
</x-app-layout>
