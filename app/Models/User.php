<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'name',
        'email',
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_activity_date' => 'date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getNameAttribute(): string
    {
        return (string) $this->attributes['nama'];
    }

    public function setNameAttribute(string $value): void
    {
        $this->attributes['nama'] = $value;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function tabungan(): HasMany
    {
        return $this->hasMany(Tabungan::class);
    }

    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class);
    }

    public function menabung(): HasMany
    {
        return $this->hasMany(Menabung::class);
    }

    public function latestDeposit(): HasOne
    {
        return $this->hasOne(Menabung::class)->latestOfMany('created_at');
    }

    public function hasActiveSavingStreak(): bool
    {
        return $this->latestDeposit?->created_at?->greaterThanOrEqualTo(now()->subHours(24)) ?? false;
    }

    public function sharedTabungan(): BelongsToMany
    {
        return $this->belongsToMany(Tabungan::class, 'tabungan_kontributor')
            ->withPivot(['role', 'joined_at']);
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class)->withPivot('earned_at');
    }

    public function canContributeTo(Tabungan $tabungan): bool
    {
        return $tabungan->user_id === $this->id
            || $this->sharedTabungan()->whereKey($tabungan->id)->wherePivot('role', 'kontributor')->exists();
    }

    public function levelProgress(): int
    {
        return (int) ($this->xp % 100);
    }
}
