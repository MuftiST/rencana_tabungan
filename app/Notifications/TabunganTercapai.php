<?php

namespace App\Notifications;

use App\Models\Tabungan;
use Illuminate\Notifications\Notification;

class TabunganTercapai extends Notification
{
    public function __construct(private Tabungan $tabungan) {}
    public function via(object $notifiable): array { return ['database']; }
    public function toDatabase(object $notifiable): array
    {
        return ['title' => 'Tabungan tercapai!', 'message' => "Selamat, target {$this->tabungan->judul} sudah tercapai.", 'tabungan_id' => $this->tabungan->id, 'url' => route('tabungan.show', $this->tabungan)];
    }
}
