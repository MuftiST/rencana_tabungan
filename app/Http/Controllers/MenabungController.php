<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenabungRequest;
use App\Models\Menabung;
use App\Models\LogAktivitas;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\GamificationService;
use App\Models\MenabungPayment;
use App\Services\MidtransService;
use Illuminate\Support\Str;

class MenabungController extends Controller
{
    public function create(): View
    {
        $tabungan = auth()->user()->tabungan()->where('status', 'belum_tercapai')->get()
            ->concat(auth()->user()->sharedTabungan()->where('status', 'belum_tercapai')->get())->unique('id')->sortBy('judul');
        return view('menabung.create', compact('tabungan'));
    }

    public function store(StoreMenabungRequest $request, MidtransService $midtrans): RedirectResponse
    {
        $data = $request->validated();
        $tabungan = \App\Models\Tabungan::withSum('menabung', 'nominal')->findOrFail($data['tabungan_id']);
        abort_unless($tabungan->canContribute(auth()->user()), 403);
        abort_unless(
            $tabungan->status === 'belum_tercapai'
            && (float) $tabungan->menabung_sum_nominal < (float) $tabungan->target_nominal,
            422,
            'Tabungan yang sudah mencapai target tidak dapat menerima setoran.'
        );
        if ($data['payment_method'] === 'qris') {
            $payment = MenabungPayment::create([
                'user_id' => auth()->id(),
                'tabungan_id' => $tabungan->id,
                'order_id' => 'TAB-'.now()->format('YmdHis').'-'.Str::upper(Str::random(8)),
                'nominal' => $data['nominal'],
                'tanggal' => $data['tanggal'],
            ]);
            $transaction = $midtrans->createSnapTransaction(
                $payment->order_id,
                (int) $payment->nominal,
                $tabungan->judul,
                auth()->user()->nama,
                auth()->user()->email
            );

            return redirect()->away($transaction['redirect_url']);
        }

        $data['user_id'] = auth()->id();
        $menabung = Menabung::create($data);
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'tabungan_id' => $tabungan->id,
            'aktivitas' => 'setoran',
            'deskripsi' => 'Menambahkan setoran Rp '.number_format((float) $menabung->nominal, 0, ',', '.'),
        ]);
        app(GamificationService::class)->recordDeposit(auth()->user(), $menabung);
        return redirect()->route('home')->with('success', 'Setoran berhasil ditambahkan.');
    }
}
