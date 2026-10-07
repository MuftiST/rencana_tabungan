<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menabung extends Model
{
    protected $table = 'menabung';
    protected $fillable = ['tabungan_id', 'user_id', 'nominal', 'tanggal'];
    protected $casts = ['nominal' => 'decimal:2', 'tanggal' => 'date'];

    public function tabungan(): BelongsTo { return $this->belongsTo(Tabungan::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
