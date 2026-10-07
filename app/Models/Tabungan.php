<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tabungan extends Model
{
    protected $table = 'tabungan';
    protected $fillable = ['user_id', 'foto', 'judul', 'target_nominal', 'target_tanggal', 'status'];
    protected $casts = ['target_nominal' => 'decimal:2', 'target_tanggal' => 'date'];
    protected $appends = ['nominal_terkumpul', 'persentase_progress'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function menabung(): HasMany { return $this->hasMany(Menabung::class); }
    public function collaborators(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tabungan_kontributor')
            ->withPivot(['role', 'joined_at']);
    }
    public function canManage(User $user): bool { return $this->user_id === $user->id; }
    public function canContribute(User $user): bool
    {
        return $this->user_id === $user->id
            || $this->collaborators()->whereKey($user->id)->wherePivot('role', 'kontributor')->exists();
    }

    protected function nominalTerkumpul(): Attribute
    {
        return Attribute::get(fn () => (float) ($this->menabung_sum_nominal ?? $this->menabung()->sum('nominal')));
    }

    protected function persentaseProgress(): Attribute
    {
        return Attribute::get(fn () => $this->target_nominal > 0
            ? min(100, round(($this->nominal_terkumpul / (float) $this->target_nominal) * 100, 2))
            : 0);
    }
}
