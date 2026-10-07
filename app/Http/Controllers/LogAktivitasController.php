<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LogAktivitasController extends Controller
{
    public function index(): View
    {
        $aktivitas = auth()->user()->logAktivitas()
            ->with(['tabungan', 'user'])
            ->latest()
            ->paginate(15);
        return view('log-aktivitas.index', compact('aktivitas'));
    }
}