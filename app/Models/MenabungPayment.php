<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenabungPayment extends Model
{
    protected $fillable = ['user_id', 'tabungan_id', 'order_id', 'nominal', 'tanggal', 'status', 'paid_at'];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal' => 'date',
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function tabungan(): BelongsTo { return $this->belongsTo(Tabungan::class); }
}
