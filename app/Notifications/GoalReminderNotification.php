<?php

namespace App\Notifications;

use App\Models\Tabungan;
use Illuminate\Notifications\Notification;

class GoalReminderNotification extends Notification
{
    public function __construct(public Tabungan $tabungan, public string $reason = 'deadline') {}

    public function via(object $notifiable): array { return ['database']; }

    public function toDatabase(object $notifiable): array
    {
        $title = match ($this->reason) {
            'deadline' => 'Target tabungan segera berakhir',
            'streak' => 'Jangan biarkan streak berhenti',
            default => 'Waktunya menabung',
        };
        $message = match ($this->reason) {
            'deadline' => "Target {$this->tabungan->judul} berakhir pada {$this->tabungan->target_tanggal->format('d/m/Y')}.",
            'streak' => "Sudah lebih dari 24 jam sejak setoran terakhir. Yuk, setor lagi untuk menjaga streak {$this->tabungan->judul}.",
            default => "Jangan lupa menambah setoran untuk {$this->tabungan->judul}.",
        };

        return [
            'title' => $title,
            'message' => $message,
            'tabungan_id' => $this->tabungan->id,
            'url' => route('tabungan.show', $this->tabungan),
        ];
    }
}
