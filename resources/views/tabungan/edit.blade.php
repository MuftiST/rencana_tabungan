<x-app-layout>
    <x-slot name="header"><p class="sa-eyebrow">Perbarui tujuan</p><h1 class="mt-1 font-display text-2xl font-extrabold text-[#183b2a] dark:text-white">Edit Rencana</h1><p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Sesuaikan targetmu kapan saja.</p></x-slot>
    <div class="py-8 sm:py-10"><div class="mx-auto max-w-xl px-5 sm:px-6"><div class="sa-card p-6 sm:p-8">
        <form method="POST" action="{{ route('tabungan.update', $tabungan) }}" enctype="multipart/form-data" class="space-y-5">@csrf @method('PUT')
            @include('tabungan._form')
            <div class="flex flex-col-reverse gap-3 border-t border-[#eef1ed] pt-5 sm:flex-row sm:justify-end dark:border-[#293b2e]"><a href="{{ route('home') }}" class="sa-secondary-button">Batal</a><button type="submit" class="sa-primary-button">Simpan Perubahan</button></div>
        </form>
    </div></div></div>
</x-app-layout>
