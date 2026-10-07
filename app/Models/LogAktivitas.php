<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $fillable = ['user_id', 'tabungan_id', 'aktivitas', 'deskripsi'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tabungan(): BelongsTo
    {
        return $this->belongsTo(Tabungan::class);
    }
}
