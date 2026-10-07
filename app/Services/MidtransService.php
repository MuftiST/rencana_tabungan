<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class MidtransService
{
    public function createSnapTransaction(string $orderId, int $amount, string $title, string $name, string $email): array
    {
        $serverKey = (string) config('services.midtrans.server_key');
        if ($serverKey === '') {
            throw new RuntimeException('MIDTRANS_SERVER_KEY belum dikonfigurasi.');
        }

        $response = Http::withBasicAuth($serverKey, '')
            ->acceptJson()
            ->post($this->baseUrl().'/snap/v1/transactions', [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $amount,
                ],
                'item_details' => [[
                    'id' => $orderId,
                    'price' => $amount,
                    'quantity' => 1,
                    'name' => 'Setoran '.$title,
                ]],
                'customer_details' => [
                    'first_name' => $name,
                    'email' => $email,
                ],
                'enabled_payments' => ['qris'],
            ]);

        if ($response->failed()) {
            throw new RuntimeException('Midtrans gagal membuat transaksi: '.$response->body());
        }

        return $response->json();
    }

    public function isValidSignature(string $orderId, string $statusCode, string $grossAmount, string $signature): bool
    {
        return hash_equals(
            hash('sha512', $orderId.$statusCode.$grossAmount.(string) config('services.midtrans.server_key')),
            $signature
        );
    }

    private function baseUrl(): string
    {
        return config('services.midtrans.is_production')
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';
    }
}
