<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTabunganRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array
    {
        return [
            'foto' => ['nullable', 'image', 'max:2048'],
            'judul' => ['required', 'string', 'max:150'],
            'target_nominal' => ['required', 'numeric', 'decimal:0,2', 'gt:0', 'max:9999999999999.99'],
            'target_tanggal' => ['required', 'date', 'after_or_equal:today'],
        ];
    }
}
