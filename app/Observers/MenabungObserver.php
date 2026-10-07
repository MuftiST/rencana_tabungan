<?php

namespace App\Observers;

use App\Models\Menabung;
use App\Notifications\TabunganTercapai;

class MenabungObserver
{
    public function saved(Menabung $menabung): void { $this->syncStatus($menabung); }
    public function deleted(Menabung $menabung): void { $this->syncStatus($menabung); }

    private function syncStatus(Menabung $menabung): void
    {
        $tabungan = $menabung->tabungan()->withSum('menabung', 'nominal')->first();
        if ($tabungan) {
            $wasAchieved = $tabungan->status === 'tercapai';
            $tabungan->updateQuietly([
                'status' => (float) $tabungan->menabung_sum_nominal >= (float) $tabungan->target_nominal
                    ? 'tercapai' : 'belum_tercapai',
            ]);
            if (!$wasAchieved && $tabungan->status === 'tercapai') {
                $tabungan->user->notify(new TabunganTercapai($tabungan));
            }
        }
    }
}
