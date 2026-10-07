<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenabungRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }

    protected function prepareForValidation(): void
    {
        if ($this->filled('tabungan_id')) {
            $tabungan = \App\Models\Tabungan::withSum('menabung', 'nominal')->find($this->integer('tabungan_id'));

            if ($tabungan && (!$tabungan->canContribute(auth()->user())
                || (float) $tabungan->menabung_sum_nominal >= (float) $tabungan->target_nominal)) {
                $this->merge(['tabungan_id' => null]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'tabungan_id' => ['required', 'integer', 'exists:tabungan,id'],
            'nominal' => ['required', 'numeric', 'decimal:0,2', 'gt:0', 'max:9999999999999.99'],
            'tanggal' => ['required', 'date', 'before_or_equal:today'],
            'payment_method' => ['required', 'in:manual,qris'],
        ];
    }

    public function messages(): array
    {
        return [
            'tabungan_id.required' => 'Tabungan ini sudah mencapai 100% dan tidak dapat menerima setoran lagi.',
        ];
    }
}
