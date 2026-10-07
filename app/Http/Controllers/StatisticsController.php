<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StatisticsController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();
        $goals = auth()->user()->tabungan()->withSum('menabung', 'nominal')->get();
        $deposits = DB::table('menabung')->join('tabungan', 'tabungan.id', '=', 'menabung.tabungan_id')
            ->where('tabungan.user_id', $userId)->select('tanggal', 'nominal')->orderBy('tanggal')->get();
        $monthly = DB::table('menabung')->join('tabungan', 'tabungan.id', '=', 'menabung.tabungan_id')
            ->where('tabungan.user_id', $userId)->where('tanggal', '>=', now()->subMonths(11)->startOfMonth())
            ->selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan, SUM(nominal) as total")
            ->groupBy('bulan')->orderBy('bulan')->get()->keyBy('bulan');
        return view('statistics.index', [
            'goals' => $goals,
            'monthlyLabels' => $monthly->keys()->values(),
            'monthlyValues' => $monthly->pluck('total')->values(),
            'totalSaved' => $deposits->sum('nominal'),
            'totalDeposits' => $deposits->count(),
            'achieved' => $goals->where('status', 'tercapai')->count(),
            'unfinished' => $goals->where('status', 'belum_tercapai')->count(),
            'topGoals' => $goals->sortByDesc('persentase_progress')->take(5),
        ]);
    }
}
