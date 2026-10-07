<x-app-layout>
    <x-slot name="header"><div class="flex flex-wrap items-center justify-between gap-3"><div><p class="sa-eyebrow">Perkembanganmu</p><h1 class="mt-1 font-display text-2xl font-extrabold text-[#183b2a] dark:text-white">Statistik Tabungan</h1></div><div class="flex w-full gap-2 sm:w-auto"><a href="{{ route('exports.pdf') }}" class="sa-secondary-button flex-1 !py-2 text-sm sm:flex-none">Unduh PDF</a><a href="{{ route('exports.excel') }}" class="sa-primary-button flex-1 !py-2 text-sm sm:flex-none">Unduh Excel</a></div></div></x-slot>
    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-4 sm:grid-cols-3"><div class="sa-card p-5"><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total terkumpul</p><p class="mt-2 break-words font-display text-xl font-extrabold text-[#34794a] dark:text-[#a9d2ad] sm:text-2xl">Rp {{ number_format($totalSaved, 0, ',', '.') }}</p></div><div class="sa-card p-5"><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total setoran</p><p class="mt-2 font-display text-2xl font-extrabold text-[#183b2a] dark:text-white">{{ $totalDeposits }}</p></div><div class="sa-card p-5"><p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Target tercapai</p><p class="mt-2 font-display text-2xl font-extrabold text-[#183b2a] dark:text-white">{{ $achieved }}<span class="text-base font-semibold text-slate-400"> / {{ $goals->count() }}</span></p></div></div>
        <div class="grid gap-5 lg:grid-cols-3"><div class="sa-card min-w-0 p-5 sm:p-6 lg:col-span-2"><h2 class="mb-4 font-display font-extrabold text-[#183b2a] dark:text-white">Setoran per bulan</h2><div class="relative h-64 sm:h-72"><canvas id="monthlyChart"></canvas></div></div><div class="sa-card min-w-0 p-5 sm:p-6"><h2 class="mb-4 font-display font-extrabold text-[#183b2a] dark:text-white">Status tabungan</h2><div class="relative mx-auto h-64 max-w-xs"><canvas id="statusChart"></canvas></div></div></div>
        <div class="sa-card min-w-0 p-5 sm:p-6"><h2 class="mb-4 font-display font-extrabold text-[#183b2a] dark:text-white">Progress rencana</h2><div class="relative h-64"><canvas id="progressChart"></canvas></div></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($monthlyLabels); const monthly = @json($monthlyValues);
        const chartText = document.documentElement.classList.contains('dark') ? '#F3F7F0' : '#334155';
        const chartGrid = document.documentElement.classList.contains('dark') ? '#304638' : '#E2E8F0';
        const chartScale = { ticks: { color: chartText }, grid: { color: chartGrid } };
        const monthlyChart = new Chart(document.getElementById('monthlyChart'), {type:'line', data:{labels, datasets:[{label:'Rupiah', data:monthly, borderColor:'#7ED957', backgroundColor:'rgba(126,217,87,.22)', fill:true, tension:.35}]}, options:{responsive:true, plugins:{legend:{labels:{color:chartText}}}, scales:{x:chartScale,y:chartScale}}});
        const goalLabels = @json($goals->pluck('judul')); const progress = @json($goals->pluck('persentase_progress'));
        const statusChart = new Chart(document.getElementById('statusChart'), {type:'doughnut', data:{labels:['Tercapai','Berjalan'], datasets:[{data:[{{ $achieved }},{{ $unfinished }}], backgroundColor:['#7ED957','#E8B94B']}]}, options:{responsive:true, plugins:{legend:{labels:{color:chartText}}}}});
        const topLabels = @json($topGoals->pluck('judul')); const topProgress = @json($topGoals->pluck('persentase_progress'));
        const progressChart = new Chart(document.getElementById('progressChart'), {type:'bar', data:{labels:topLabels, datasets:[{label:'Progress %', data:topProgress, backgroundColor:'#7ED957'}]}, options:{responsive:true, indexAxis:'y', plugins:{legend:{labels:{color:chartText}}}, scales:{x:{beginAtZero:true,max:100,...chartScale},y:chartScale}}});
        document.addEventListener('tabungan-theme-changed', () => {
            const text = document.documentElement.classList.contains('dark') ? '#F3F7F0' : '#334155';
            const grid = document.documentElement.classList.contains('dark') ? '#304638' : '#E2E8F0';
            [monthlyChart, statusChart, progressChart].forEach(chart => {
                if (chart.options.plugins?.legend?.labels) chart.options.plugins.legend.labels.color = text;
                Object.values(chart.options.scales || {}).forEach(scale => {
                    scale.ticks.color = text;
                    scale.grid.color = grid;
                });
                chart.update();
            });
        });
    </script>
</x-app-layout>
