<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('menabung', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('tabungan_id')->constrained('users')->nullOnDelete();
        });
        DB::table('menabung')
            ->join('tabungan', 'tabungan.id', '=', 'menabung.tabungan_id')
            ->whereNull('menabung.user_id')
            ->select('menabung.id', 'tabungan.user_id')
            ->orderBy('menabung.id')
            ->get()
            ->each(function (object $row): void {
                DB::table('menabung')->where('id', $row->id)->update(['user_id' => $row->user_id]);
            });
    }

    public function down(): void
    {
        Schema::table('menabung', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
