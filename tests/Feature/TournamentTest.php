<?php

namespace Tests\Feature;

use App\Models\Lomba;
use App\Models\Pendaftaran;
use App\Models\Pertandingan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TournamentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test role middleware blocks non-admins (peserta) from accessing panitia dashboard.
     */
    public function test_peserta_cannot_access_panitia_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);

        $response = $this->actingAs($user)->get('/panitia/dashboard');

        $response->assertStatus(403);
    }

    /**
     * Test panitia can access panitia dashboard.
     */
    public function test_panitia_can_access_panitia_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'panitia']);

        $response = $this->actingAs($user)->get('/panitia/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Panel Panitia');
    }

    /**
     * Test panitia can approve registration.
     */
    public function test_panitia_can_approve_registration(): void
    {
        $admin = User::factory()->create(['role' => 'panitia']);
        $user = User::factory()->create(['role' => 'peserta']);
        $lomba = Lomba::factory()->create();
        
        $pendaftaran = Pendaftaran::create([
            'user_id' => $user->id,
            'lomba_id' => $lomba->id,
            'status' => 'menunggu',
        ]);

        $response = $this->actingAs($admin)->post("/panitia/pendaftaran/{$pendaftaran->id}/verifikasi", [
            'status' => 'terverifikasi',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pendaftarans', [
            'id' => $pendaftaran->id,
            'status' => 'terverifikasi',
        ]);
    }

    /**
     * Test panitia cannot approve registration if quota full.
     */
    public function test_panitia_cannot_approve_registration_if_quota_full(): void
    {
        $admin = User::factory()->create(['role' => 'panitia']);
        $lomba = Lomba::factory()->create(['batas_kuota_maksimal' => 1]);
        
        $user1 = User::factory()->create(['role' => 'peserta']);
        $user2 = User::factory()->create(['role' => 'peserta']);

        Pendaftaran::create(['user_id' => $user1->id, 'lomba_id' => $lomba->id, 'status' => 'terverifikasi']);
        $pendaftaran2 = Pendaftaran::create(['user_id' => $user2->id, 'lomba_id' => $lomba->id, 'status' => 'menunggu']);

        $response = $this->actingAs($admin)->post("/panitia/pendaftaran/{$pendaftaran2->id}/verifikasi", [
            'status' => 'terverifikasi',
        ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('pendaftarans', [
            'id' => $pendaftaran2->id,
            'status' => 'menunggu',
        ]);
    }

    /**
     * Test generating bracket with even participants.
     */
    public function test_generate_bracket_with_even_participants(): void
    {
        $admin = User::factory()->create(['role' => 'panitia']);
        $lomba = Lomba::factory()->create();
        
        $users = User::factory(4)->create(['role' => 'peserta']);
        foreach ($users as $user) {
            Pendaftaran::create(['user_id' => $user->id, 'lomba_id' => $lomba->id, 'status' => 'terverifikasi']);
        }

        $response = $this->actingAs($admin)->post("/panitia/lomba/{$lomba->id}/generate-bagan");

        $response->assertRedirect();
        $this->assertEquals(2, Pertandingan::where('lomba_id', $lomba->id)->count());
        $this->assertEquals(0, Pertandingan::where('lomba_id', $lomba->id)->whereNull('peserta_2_id')->count());
    }

    /**
     * Test generating bracket with odd participants (bye test).
     */
    public function test_generate_bracket_with_odd_participants(): void
    {
        $admin = User::factory()->create(['role' => 'panitia']);
        $lomba = Lomba::factory()->create();
        
        $users = User::factory(5)->create(['role' => 'peserta']);
        foreach ($users as $user) {
            Pendaftaran::create(['user_id' => $user->id, 'lomba_id' => $lomba->id, 'status' => 'terverifikasi']);
        }

        $response = $this->actingAs($admin)->post("/panitia/lomba/{$lomba->id}/generate-bagan");

        $response->assertRedirect();
        // 5 participants -> 2 normal matches + 1 bye match = 3 matches total
        $this->assertEquals(3, Pertandingan::where('lomba_id', $lomba->id)->count());
        
        // Check for the bye match
        $byeMatch = Pertandingan::where('lomba_id', $lomba->id)->whereNull('peserta_2_id')->first();
        $this->assertNotNull($byeMatch);
        $this->assertEquals($byeMatch->peserta_1_id, $byeMatch->pemenang_id);
        $this->assertEquals('selesai', $byeMatch->status);
    }
}
