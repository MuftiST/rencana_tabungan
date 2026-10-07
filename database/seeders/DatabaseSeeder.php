<?php

namespace Database\Seeders;

use App\Models\Menabung;
use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'demo@tabungan.test'],
            ['nama' => 'Pengguna Demo', 'password' => Hash::make('password')]
        );

        $berlibur = $user->tabungan()->updateOrCreate(
            ['judul' => 'Liburan Akhir Tahun'],
            ['target_nominal' => 5000000, 'target_tanggal' => now()->addMonths(4), 'status' => 'belum_tercapai']
        );
        $rumah = $user->tabungan()->updateOrCreate(
            ['judul' => 'Dana Rumah'],
            ['target_nominal' => 15000000, 'target_tanggal' => now()->addYear(), 'status' => 'belum_tercapai']
        );

        Menabung::updateOrCreate(['tabungan_id' => $berlibur->id, 'tanggal' => now()->subDays(10)->toDateString()], ['nominal' => 1500000]);
        Menabung::updateOrCreate(['tabungan_id' => $berlibur->id, 'tanggal' => now()->subDays(3)->toDateString()], ['nominal' => 750000]);
        Menabung::updateOrCreate(['tabungan_id' => $rumah->id, 'tanggal' => now()->subDays(5)->toDateString()], ['nominal' => 3000000]);
    }
}
