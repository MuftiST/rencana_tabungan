<?php

namespace App\Http\Controllers;

use App\Models\Menabung;
use App\Models\MenabungPayment;
use App\Models\LogAktivitas;
use App\Services\GamificationService;
use App\Services\MidtransService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MidtransWebhookController extends Controller
{
    public function __invoke(Request $request, MidtransService $midtrans): JsonResponse
    {
        $data = $request->validate([
            'order_id' => ['required', 'string'],
            'status_code' => ['required', 'string'],
            'gross_amount' => ['required', 'string'],
            'signature_key' => ['required', 'string'],
            'transaction_status' => ['required', 'string'],
        ]);

        abort_unless($midtrans->isValidSignature(
            $data['order_id'],
            $data['status_code'],
            $data['gross_amount'],
            $data['signature_key']
        ), 403, 'Signature Midtrans tidak valid.');

        $payment = MenabungPayment::where('order_id', $data['order_id'])->firstOrFail();
        abort_unless(
            number_format((float) $payment->nominal, 2, '.', '') === number_format((float) $data['gross_amount'], 2, '.', ''),
            422,
            'Nominal pembayaran tidak sesuai.'
        );
        if (in_array($data['transaction_status'], ['settlement', 'capture'], true)) {
            DB::transaction(function () use ($payment): void {
                $payment = MenabungPayment::whereKey($payment->id)->lockForUpdate()->firstOrFail();
                if ($payment->status === 'paid') {
                    return;
                }
                $payment->update(['status' => 'paid', 'paid_at' => now()]);
                $deposit = Menabung::create([
                    'tabungan_id' => $payment->tabungan_id,
                    'user_id' => $payment->user_id,
                    'nominal' => $payment->nominal,
                    'tanggal' => $payment->tanggal,
                ]);
                LogAktivitas::create([
                    'user_id' => $payment->user_id,
                    'tabungan_id' => $payment->tabungan_id,
                    'aktivitas' => 'setoran',
                    'deskripsi' => 'Menambahkan setoran via QRIS Rp '.number_format((float) $deposit->nominal, 0, ',', '.'),
                ]);
                app(GamificationService::class)->recordDeposit($payment->user, $deposit);
            });
        } elseif (in_array($data['transaction_status'], ['deny', 'cancel', 'expire', 'failure'], true)) {
            $payment->update(['status' => $data['transaction_status']]);
        }

        return response()->json(['ok' => true]);
    }
}
