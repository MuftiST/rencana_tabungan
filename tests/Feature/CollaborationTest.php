<?php

namespace Tests\Feature;

use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CollaborationTest extends TestCase
{
    use RefreshDatabase;

    public function test_collaborators_use_the_updated_pivot_schema(): void
    {
        $this->assertTrue(Schema::hasColumns('tabungan_kontributor', [
            'tabungan_id',
            'user_id',
            'role',
            'joined_at',
        ]));

        $owner = User::factory()->create();
        $contributor = User::factory()->create();
        $tabungan = Tabungan::create([
            'user_id' => $owner->id,
            'judul' => 'Dana darurat',
            'target_nominal' => 5000000,
            'target_tanggal' => now()->addMonth()->toDateString(),
        ]);

        $tabungan->collaborators()->attach($contributor->id, [
            'role' => 'kontributor',
            'joined_at' => now(),
        ]);

        $this->assertTrue($tabungan->fresh()->canContribute($contributor));
        $this->assertTrue($contributor->sharedTabungan()->whereKey($tabungan->id)->exists());

        $this->actingAs($owner)
            ->get(route('tabungan.show', $tabungan))
            ->assertOk()
            ->assertSee('Kontributor');
    }
}
