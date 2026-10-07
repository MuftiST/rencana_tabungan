<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="sa-eyebrow">Ringkasan tabungan</p>
                <h1 class="mt-2 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-white sm:text-3xl">Halo, {{ auth()->user()->nama }} <span aria-hidden="true">👋</span></h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sedikit demi sedikit, tujuanmu semakin dekat.</p>
            </div>
            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                <a href="{{ route('statistics.index') }}" class="sa-secondary-button">Lihat statistik</a>
                <a href="{{ route('tabungan.create') }}" class="sa-primary-button">+ Buat Rencana</a>
            </div>
        </div>
    </x-slot>

    @php
        $totalSaved = (float) $tabungan->sum('nominal_terkumpul');
        $totalTarget = (float) $tabungan->sum('target_nominal');
        $activeGoals = $tabungan->filter(fn ($goal) => $goal->status !== 'tercapai')->count();
        $overallProgress = $totalTarget > 0 ? min(100, (int) round(($totalSaved / $totalTarget) * 100)) : 0;
    @endphp

    <div class="py-7 sm:py-9" x-data="{ query: '', status: 'all', sort: 'latest', depositModal: false, activeGoal: null, sortGoals(value) { const grid = this.$refs.goalsGrid; [...grid.children].sort((a, b) => value === 'progress' ? Number(b.dataset.progress) - Number(a.dataset.progress) : (value === 'deadline' ? new Date(a.dataset.deadline) - new Date(b.dataset.deadline) : Number(a.dataset.order) - Number(b.dataset.order))).forEach(card => grid.appendChild(card)); } }">
        <div class="mx-auto max-w-7xl space-y-7 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div role="status" class="sa-enter flex items-center gap-3 rounded-2xl border border-[#d4e8d5] bg-[#edf7ed] px-5 py-4 text-sm font-semibold text-[#28633b] dark:border-[#36533c] dark:bg-[#1e3523] dark:text-[#c2dec4]"><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#34794a] text-white" aria-hidden="true">✓</span>{{ session('success') }}</div>
            @endif

            <section class="sa-enter relative overflow-hidden rounded-[1.6rem] bg-[#eaf3e8] px-6 py-7 dark:bg-[#1b2c20] sm:px-9 sm:py-9">
                <div class="relative z-10 max-w-xl">
                    <p class="sa-eyebrow">Perjalananmu dimulai dari sini</p>
                    <h2 class="mt-3 font-display text-2xl font-extrabold leading-tight tracking-tight text-[#183b2a] dark:text-[#e8f0e8] sm:text-3xl">Rencana yang baik membuat tujuan terasa lebih dekat.</h2>
                    <p class="mt-3 max-w-lg text-sm leading-6 text-[#627566] dark:text-[#b4c7b6]">Buat target, sisihkan secara rutin, lalu nikmati progres yang kamu bangun sendiri.</p>
                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ route('tabungan.create') }}" class="sa-primary-button">+ Buat Rencana</a>
                        <a href="#daftar-rencana" class="sa-secondary-button">Lihat Rencana <span aria-hidden="true">↓</span></a>
                    </div>
                </div>
                <div class="pointer-events-none absolute -right-4 bottom-0 hidden h-full w-[38%] items-end justify-center lg:flex" aria-hidden="true">
                    <div class="relative mb-8 flex h-40 w-64 items-end gap-3 rounded-3xl border border-white/80 bg-white/70 p-5 shadow-xl shadow-[#315f3a]/10">
                        <div class="absolute left-5 top-5 text-xs font-bold text-[#738076]">Progres tabungan</div>
                        <div class="h-[32%] flex-1 rounded-t-lg bg-[#c5dfc4]"></div><div class="h-[48%] flex-1 rounded-t-lg bg-[#a4cda6]"></div><div class="h-[66%] flex-1 rounded-t-lg bg-[#80b888]"></div><div class="h-[86%] flex-1 rounded-t-lg bg-[#438b55]"></div>
                        <div class="absolute -right-5 -top-7 flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-2xl shadow-lg">🌱</div>
                    </div>
                </div>
            </section>

            <section aria-label="Ringkasan" class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <article class="sa-card p-5">
                    <div class="flex items-center justify-between"><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total terkumpul</p><span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#edf5ed] text-lg text-[#34794a] dark:bg-[#24372a]">↗</span></div>
                    <p class="mt-4 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-white">Rp {{ number_format($totalSaved, 0, ',', '.') }}</p>
                    <p class="mt-1 text-xs text-slate-400">Dari semua rencana tabungan</p>
                </article>
                <article class="sa-card p-5">
                    <div class="flex items-center justify-between"><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total target</p><span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#f5f2e7] text-lg text-[#a27d2d] dark:bg-[#39321f]">◎</span></div>
                    <p class="mt-4 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-white">Rp {{ number_format($totalTarget, 0, ',', '.') }}</p>
                    <p class="mt-1 text-xs text-slate-400">Target dari semua rencana</p>
                </article>
                <article class="sa-card p-5">
                    <div class="flex items-center justify-between"><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Jumlah rencana</p><span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#eef2f8] text-lg text-[#56739b] dark:bg-[#263140]">▤</span></div>
                    <p class="mt-4 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-white">{{ $tabungan->count() }} <span class="text-sm font-semibold text-slate-500">rencana</span></p>
                    <p class="mt-1 text-xs text-slate-400">Tujuan yang kamu bangun</p>
                </article>
                <article class="sa-card p-5">
                    <div class="flex items-center justify-between"><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Rencana aktif</p><span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#edf5ed] text-lg text-[#34794a] dark:bg-[#24372a]">✓</span></div>
                    <p class="mt-4 font-display text-2xl font-extrabold tracking-tight text-[#183b2a] dark:text-white">{{ $activeGoals }} <span class="text-sm font-semibold text-slate-500">aktif</span></p>
                    <p class="mt-1 text-xs text-slate-400">Teruskan langkah kecilmu</p>
                </article>
            </section>

            <section class="sa-card flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#edf5ed] text-xl text-[#34794a] dark:bg-[#24372a]">◔</div>
                    <div><p class="text-sm font-bold text-[#183b2a] dark:text-white">Progress keseluruhan</p><p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $overallProgress }}% dari total target sudah terkumpul</p></div>
                </div>
                <div class="flex w-full items-center gap-3 sm:max-w-md">
                    <div class="sa-progress h-2.5 flex-1"><span style="width: {{ $overallProgress }}%"></span></div>
                    <strong class="min-w-12 text-right text-sm text-[#34794a] dark:text-[#a9d2ad]">{{ $overallProgress }}%</strong>
                </div>
            </section>

            <section id="daftar-rencana" class="scroll-mt-24">
                <div class="mb-4 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div><p class="sa-eyebrow">Tetap konsisten</p><h2 class="mt-1 font-display text-xl font-extrabold text-[#183b2a] dark:text-white sm:text-2xl">Rencana tabunganmu</h2><p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Pantau progres dan terus dekatkan diri pada tujuan.</p></div>
                    @if($tabungan->isNotEmpty())
                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-[minmax(10rem,1fr)_auto_auto]">
                            <label><span class="sr-only">Cari rencana</span><input x-model="query" type="search" placeholder="Cari rencana..." class="w-full rounded-xl border-[#dce5dc] bg-white px-3.5 py-2.5 text-sm focus:border-[#438b55] focus:ring-[#438b55] dark:border-[#344b39] dark:bg-[#18231b]"></label>
                            <label><span class="sr-only">Filter status</span><select x-model="status" class="w-full rounded-xl border-[#dce5dc] bg-white py-2.5 pl-3 pr-8 text-sm focus:border-[#438b55] focus:ring-[#438b55] dark:border-[#344b39] dark:bg-[#18231b]"><option value="all">Semua status</option><option value="tercapai">Tercapai</option><option value="on-track">On track</option><option value="tertinggal">Perlu dorongan</option></select></label>
                            <label><span class="sr-only">Urutkan rencana</span><select x-model="sort" @change="sortGoals(sort)" class="w-full rounded-xl border-[#dce5dc] bg-white py-2.5 pl-3 pr-8 text-sm focus:border-[#438b55] focus:ring-[#438b55] dark:border-[#344b39] dark:bg-[#18231b]"><option value="latest">Terbaru</option><option value="progress">Progress tertinggi</option><option value="deadline">Target terdekat</option></select></label>
                        </div>
                    @endif
                </div>

                @if($tabungan->isEmpty())
                    <div class="sa-card px-6 py-12 text-center sm:px-10">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#edf5ed] text-3xl dark:bg-[#24372a]" aria-hidden="true">🎯</div>
                        <h3 class="mt-5 font-display text-xl font-extrabold text-[#183b2a] dark:text-white">Belum ada rencana tabungan</h3>
                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500 dark:text-slate-400">Mulai buat target pertamamu dan SimpanAja sampai tujuan tercapai. Setiap langkah kecil tetap berarti.</p>
                        <a href="{{ route('tabungan.create') }}" class="sa-primary-button mt-6">+ Buat Rencana</a>
                    </div>
                @else
                    <div x-ref="goalsGrid" class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @foreach($tabungan as $item)
                            @php
                                $icon = str_contains(strtolower($item->judul), 'nikah') || str_contains(strtolower($item->judul), 'kawin') ? '💍' : (str_contains(strtolower($item->judul), 'kuliah') || str_contains(strtolower($item->judul), 'pendidikan') ? '📚' : (str_contains(strtolower($item->judul), 'libur') || str_contains(strtolower($item->judul), 'travel') ? '✈️' : '🎯'));
                                $progress = min(100, max(0, (float) $item->persentase_progress));
                                $remaining = max(0, (float) $item->target_nominal - (float) $item->nominal_terkumpul);
                            @endphp
                            <article data-progress="{{ $progress }}" data-deadline="{{ $item->target_tanggal->toDateString() }}" data-order="{{ $loop->index }}" x-show="(!query || @js(strtolower($item->judul)).includes(query.toLowerCase())) && (status === 'all' || status === @js($item->pace_status))" class="sa-card group overflow-hidden p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex min-w-0 items-start gap-3">
                                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-[#edf5ed] text-xl dark:bg-[#24372a]" aria-hidden="true">{{ $icon }}</span>
                                        <div class="min-w-0"><h3 class="break-words font-display text-base font-extrabold text-[#183b2a] dark:text-white">{{ $item->judul }}</h3><p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Target {{ $item->target_tanggal->format('d M Y') }}</p></div>
                                    </div>
                                    <span @class([
                                        'shrink-0 rounded-full px-2.5 py-1 text-[11px] font-bold',
                                        'bg-[#edf5ed] text-[#34794a] dark:bg-[#24372a] dark:text-[#a9d2ad]' => $item->pace_status === 'tercapai' || $item->pace_status === 'on-track',
                                        'bg-[#f8f1df] text-[#98702a] dark:bg-[#39321f] dark:text-[#e6c675]' => $item->pace_status === 'tertinggal',
                                    ])>{{ $item->pace_status === 'tercapai' ? 'Tercapai' : ($item->pace_status === 'tertinggal' ? 'Perlu dorongan' : 'On track') }}</span>
                                </div>

                                @if($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}" alt="Foto {{ $item->judul }}" class="mt-4 h-32 w-full rounded-xl object-cover">
                                @endif

                                <div class="mt-5 flex items-end justify-between gap-3">
                                    <div><p class="text-xs font-medium text-slate-500 dark:text-slate-400">Terkumpul</p><p class="mt-1 font-display text-xl font-extrabold tracking-tight text-[#183b2a] dark:text-white">Rp {{ number_format($item->nominal_terkumpul, 0, ',', '.') }}</p></div>
                                    <p class="text-right text-xs leading-5 text-slate-500 dark:text-slate-400">Target<br><strong class="text-slate-700 dark:text-slate-200">Rp {{ number_format($item->target_nominal, 0, ',', '.') }}</strong></p>
                                </div>
                                <div class="mt-4 flex items-center gap-3">
                                    <div class="sa-progress h-2 flex-1"><span style="width: {{ $progress }}%"></span></div>
                                    <span class="min-w-10 text-right text-xs font-extrabold text-[#34794a] dark:text-[#a9d2ad]">{{ round($progress) }}%</span>
                                </div>
                                <div class="mt-2 flex justify-between text-xs text-slate-500 dark:text-slate-400"><span>Sisa target</span><strong class="text-slate-700 dark:text-slate-200">Rp {{ number_format($remaining, 0, ',', '.') }}</strong></div>

                                <div class="mt-5 flex flex-wrap gap-2 border-t border-[#eef1ed] pt-4 dark:border-[#293b2e]">
                                    <a href="{{ route('tabungan.show', $item) }}" class="sa-secondary-button flex-1 !py-2.5 text-xs">Lihat detail</a>
                                    @if($item->status !== 'tercapai')
                                        <button type="button" @click="activeGoal = {{ $item->id }}; depositModal = true" class="sa-primary-button flex-1 !py-2.5 text-xs">+ Tambah setoran</button>
                                    @endif
                                </div>
                                @if($item->user_id === auth()->id())
                                    <div class="mt-3 flex justify-end gap-4 text-xs font-semibold">
                                        <a href="{{ route('tabungan.edit', $item) }}" class="text-slate-500 transition hover:text-[#34794a]">Edit</a>
                                        <form method="POST" action="{{ route('tabungan.destroy', $item) }}" onsubmit="return confirm('Hapus rencana ini beserta seluruh riwayat setoran?')">@csrf @method('DELETE')<button type="submit" class="text-slate-400 transition hover:text-red-600">Hapus</button></form>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                    <p x-show="query || status !== 'all'" x-cloak x-transition class="mt-5 rounded-xl bg-white p-5 text-center text-sm text-slate-500 dark:bg-[#18231b] dark:text-slate-400">Tidak ada rencana yang sesuai dengan pencarian atau filter.</p>
                @endif
            </section>
        </div>

        <div x-show="depositModal" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-[#122017]/55 px-4 py-6 backdrop-blur-sm" @keydown.escape.window="depositModal = false" @click.self="depositModal = false">
            <div x-show="depositModal" x-transition class="w-full max-w-md rounded-[1.5rem] bg-white p-6 shadow-2xl dark:bg-[#18231b] sm:p-7">
                <div class="flex items-start justify-between gap-4">
                    <div><p class="sa-eyebrow">Satu langkah lebih dekat</p><h3 class="mt-1 font-display text-xl font-extrabold text-[#183b2a] dark:text-white">Tambah setoran</h3><p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Catat tabunganmu tanpa meninggalkan halaman.</p></div>
                    <button type="button" @click="depositModal = false" class="rounded-xl px-3 py-2 text-xl text-slate-400 hover:bg-slate-100 dark:hover:bg-[#24372a]" aria-label="Tutup modal">×</button>
                </div>
                <form method="POST" action="{{ route('menabung.store') }}" class="mt-6 space-y-4">
                    @csrf
                    <input type="hidden" name="tabungan_id" x-model="activeGoal">
                    <input type="hidden" name="payment_method" value="manual">
                    <div><label for="quick_nominal" class="text-sm font-bold text-slate-700 dark:text-slate-200">Nominal setoran (Rp)</label><input id="quick_nominal" name="nominal" type="number" min="1" step="0.01" required class="mt-1 block w-full rounded-xl border-[#dce5dc] bg-[#f8faf7] py-3 focus:border-[#438b55] focus:ring-[#438b55] dark:border-[#344b39] dark:bg-[#101812]"></div>
                    <div><label for="quick_tanggal" class="text-sm font-bold text-slate-700 dark:text-slate-200">Tanggal</label><input id="quick_tanggal" name="tanggal" type="date" max="{{ now()->toDateString() }}" value="{{ now()->toDateString() }}" required class="mt-1 block w-full rounded-xl border-[#dce5dc] bg-[#f8faf7] py-3 focus:border-[#438b55] focus:ring-[#438b55] dark:border-[#344b39] dark:bg-[#101812]"></div>
                    <button type="submit" class="sa-primary-button w-full">Simpan setoran</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
