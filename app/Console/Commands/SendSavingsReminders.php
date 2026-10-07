<?php

namespace App\Console\Commands;

use App\Models\Tabungan;
use App\Notifications\ReminderMenabung;
use App\Notifications\TargetMendekati;
use Illuminate\Console\Command;

class SendSavingsReminders extends Command
{
    protected $signature = 'app:cek-reminder-tabungan';
    protected $description = 'Send database reminders for upcoming savings goals';

    public function handle(): int
    {
        $count = 0;
        Tabungan::with(['user', 'menabung'])->where('status', 'belum_tercapai')->each(function (Tabungan $tabungan) use (&$count) {
            $lastSaving = $tabungan->menabung()->latest('created_at')->first();
            $lastSavingAt = $lastSaving?->created_at ?? $tabungan->created_at;

            if ($lastSavingAt && $lastSavingAt->lte(now()->subHours(24))) {
                $tabungan->user->notify(new ReminderMenabung($tabungan, 'streak'));
                $count++;
            }

            if ($tabungan->target_tanggal->isFuture() && (!$lastSaving || $lastSavingAt->diffInDays(now()) >= 7)) {
                $tabungan->user->notify(new ReminderMenabung($tabungan));
                $count++;
            }
            if ($tabungan->target_tanggal->isSameDay(now()->addDays(7))) {
                $tabungan->user->notify(new TargetMendekati($tabungan));
                $count++;
            }
        });
        $this->info("{$count} reminder(s) sent.");
        return self::SUCCESS;
    }
}
