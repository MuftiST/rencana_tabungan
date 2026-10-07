<?php

namespace App\Http\Controllers;

use App\Exports\TabunganExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function excel()
    {
        return Excel::download(new TabunganExport(auth()->id()), 'laporan-tabungan.xlsx');
    }

    public function pdf(): Response
    {
        $tabungan = auth()->user()->tabungan()->withSum('menabung', 'nominal')->get();
        return Pdf::loadView('exports.tabungan-pdf', compact('tabungan'))
            ->setPaper('a4', 'portrait')->download('laporan-tabungan.pdf');
    }
}
