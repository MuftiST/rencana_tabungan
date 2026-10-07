<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tabungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('foto')->nullable();
            $table->string('judul', 150);
            $table->decimal('target_nominal', 15, 2);
            $table->date('target_tanggal');
            $table->enum('status', ['belum_tercapai', 'tercapai'])->default('belum_tercapai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tabungan');
    }
};
