<x-app-layout>
    <x-slot name="header">
        <p class="sa-eyebrow">Akun kamu</p>
        <h1 class="mt-1 font-display text-2xl font-extrabold text-[#183b2a] dark:text-white">Profil</h1>
    </x-slot>

    @php
        $profileGoals = $user->tabungan()->withSum('menabung', 'nominal')->get();
        $profileSaved = $profileGoals->sum('menabung_sum_nominal');
    @endphp

    <div class="py-12">
        <div class="mx-auto max-w-5xl space-y-5 px-4 sm:px-6 lg:px-8">
            <div class="sa-card p-5 sm:p-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3"><span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#edf5ed] font-display text-xl font-extrabold text-[#34794a] dark:bg-[#24372a] dark:text-[#a9d2ad]">{{ strtoupper(substr($user->nama, 0, 1)) }}</span><div><p class="font-display text-lg font-extrabold text-[#183b2a] dark:text-white">{{ $user->nama }}</p><p class="text-sm text-slate-500 dark:text-slate-400">{{ $user->email }}</p></div></div>
                        <p class="mt-5 text-sm font-semibold text-slate-600 dark:text-slate-300">Level {{ $user->level }} <span class="mx-1 text-slate-300">·</span> {{ number_format($user->xp) }} XP</p>
                        <div class="mt-2 h-2 w-full max-w-xs rounded-full bg-slate-100 dark:bg-[#29362c]"><div class="h-full rounded-full bg-[#438b55]" style="width:{{ $user->levelProgress() }}%"></div></div>
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">🔥 {{ $user->current_streak }} hari streak{{ $user->hasActiveSavingStreak() ? '' : ' · setor untuk mengaktifkan kembali' }}</p>
                    </div>
                    <div class="grid w-full grid-cols-2 gap-3 sm:w-auto">
                        <div class="rounded-2xl bg-[#f6f8f4] px-4 py-3 dark:bg-[#101812]"><p class="text-xs font-semibold text-slate-500 dark:text-slate-400">Jumlah rencana</p><p class="mt-1 font-display text-xl font-extrabold text-[#183b2a] dark:text-white">{{ $profileGoals->count() }}</p></div>
                        <div class="rounded-2xl bg-[#f6f8f4] px-4 py-3 dark:bg-[#101812]"><p class="text-xs font-semibold text-slate-500 dark:text-slate-400">Total terkumpul</p><p class="mt-1 font-display text-lg font-extrabold text-[#34794a] dark:text-[#a9d2ad]">Rp {{ number_format($profileSaved, 0, ',', '.') }}</p></div>
                    </div>
                    <div class="flex flex-wrap gap-2">@forelse($user->badges as $badge)<span title="{{ $badge->description }}" class="rounded-xl bg-amber-50 px-3 py-2 text-sm font-bold text-amber-700">{{ $badge->icon }} {{ $badge->name }}</span>@empty<span class="text-sm text-slate-500">Belum ada badge. Mulai menabung!</span>@endforelse</div>
                </div>
            </div>
            <div class="sa-card p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="sa-card p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="sa-card p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
