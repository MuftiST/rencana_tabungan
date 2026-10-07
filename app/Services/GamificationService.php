<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\Menabung;
use App\Models\User;
use Carbon\Carbon;

class GamificationService
{
    public function recordDeposit(User $user, Menabung $deposit): void
    {
        $today = Carbon::parse($deposit->tanggal)->startOfDay();
        $last = $user->last_activity_date?->startOfDay();
        if (!$last || $last->diffInDays($today) > 1) {
            $user->current_streak = 1;
        } elseif ($last->diffInDays($today) === 1) {
            $user->current_streak++;
        }
        $user->last_activity_date = $today;
        $this->addXp($user, 10);
        $user->save();
        $this->awardEligibleBadges($user);
    }

    public function addXp(User $user, int $amount): void
    {
        $user->xp = (int) $user->xp + $amount;
        $user->level = max(1, (int) floor($user->xp / 100) + 1);
    }

    public function awardEligibleBadges(User $user): void
    {
        $definitions = [
            ['slug' => 'first-deposit', 'name' => 'Langkah Pertama', 'icon' => '🌱', 'description' => 'Melakukan setoran pertama', 'xp_reward' => 25, 'earned' => $user->tabungan()->whereHas('menabung')->exists()],
            ['slug' => 'goal-achiever', 'name' => 'Goal Achiever', 'icon' => '🏆', 'description' => 'Mencapai satu target tabungan', 'xp_reward' => 50, 'earned' => $user->tabungan()->where('status', 'tercapai')->exists()],
            ['slug' => 'week-streak', 'name' => 'Konsisten 7 Hari', 'icon' => '🔥', 'description' => 'Menabung konsisten selama 7 hari', 'xp_reward' => 75, 'earned' => $user->current_streak >= 7],
            ['slug' => 'team-player', 'name' => 'Team Player', 'icon' => '🤝', 'description' => 'Berkolaborasi dalam tabungan bersama', 'xp_reward' => 30, 'earned' => $user->sharedTabungan()->exists()],
        ];
        foreach ($definitions as $definition) {
            if (!$definition['earned']) continue;
            $badge = Badge::firstOrCreate(['slug' => $definition['slug']], collect($definition)->except('earned')->all());
            if (!$user->badges()->whereKey($badge->id)->exists()) {
                $user->badges()->attach($badge->id, ['earned_at' => now()]);
                $this->addXp($user, (int) $badge->xp_reward);
            }
        }
        $user->save();
    }
}
