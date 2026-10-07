<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('tabungan_kontributor')) {
            return;
        }

        Schema::create('tabungan_kontributor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tabungan_id')->constrained('tabungan')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('role', ['pemilik', 'kontributor'])->default('kontributor');
            $table->timestamp('joined_at')->useCurrent();
            $table->unique(['tabungan_id', 'user_id']);
        });
    }

    public function down(): void
    {
        // Preserve collaborator records if this migration was a no-op on an existing database.
    }
};
