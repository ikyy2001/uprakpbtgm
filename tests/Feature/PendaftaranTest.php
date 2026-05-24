<?php

namespace Tests\Feature;

use App\Models\Lomba;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PendaftaranTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test peserta bisa melihat dashboard dan form pendaftaran.
     */
    public function test_peserta_can_view_registration_form(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);

        $response = $this->actingAs($user)->get('/peserta/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Formulir Pendaftaran Lomba');
    }

    /**
     * Test peserta berhasil mendaftar lomba.
     */
    public function test_peserta_can_register_for_lomba(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);
        $lomba = Lomba::factory()->create(['nama_lomba' => 'Balap Karung', 'batas_kuota_maksimal' => 10]);

        $response = $this->actingAs($user)->post('/peserta/daftar', [
            'lomba_id' => $lomba->id,
        ]);

        $response->assertRedirect(route('peserta.dashboard'));
        $this->assertDatabaseHas('pendaftarans', [
            'user_id' => $user->id,
            'lomba_id' => $lomba->id,
            'status' => 'menunggu',
        ]);
    }

    /**
     * Test peserta tidak bisa mendaftar lomba yang sama dua kali.
     */
    public function test_peserta_cannot_register_twice_for_same_lomba(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);
        $lomba = Lomba::factory()->create(['nama_lomba' => 'Balap Karung']);
        
        // Pendaftaran pertama
        Pendaftaran::create([
            'user_id' => $user->id,
            'lomba_id' => $lomba->id,
            'status' => 'menunggu',
        ]);

        // Pendaftaran kedua (seharusnya ditolak)
        $response = $this->actingAs($user)->post('/peserta/daftar', [
            'lomba_id' => $lomba->id,
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals(1, Pendaftaran::where('user_id', $user->id)->count());
    }

    /**
     * Test peserta tidak boleh mendaftar lebih dari 2 lomba.
     */
    public function test_peserta_cannot_register_for_more_than_two_lombas(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);
        $lomba1 = Lomba::factory()->create();
        $lomba2 = Lomba::factory()->create();
        $lomba3 = Lomba::factory()->create();

        // Daftar 2 lomba pertama
        Pendaftaran::create(['user_id' => $user->id, 'lomba_id' => $lomba1->id, 'status' => 'menunggu']);
        Pendaftaran::create(['user_id' => $user->id, 'lomba_id' => $lomba2->id, 'status' => 'menunggu']);

        // Daftar lomba ke-3 (seharusnya ditolak)
        $response = $this->actingAs($user)->post('/peserta/daftar', [
            'lomba_id' => $lomba3->id,
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals(2, Pendaftaran::where('user_id', $user->id)->count());
    }

    /**
     * Test peserta tidak bisa mendaftar jika kuota sudah penuh.
     */
    public function test_peserta_cannot_register_if_quota_full(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);
        $lomba = Lomba::factory()->create(['batas_kuota_maksimal' => 2]);

        // Isi kuota penuh
        $otherUser1 = User::factory()->create(['role' => 'peserta']);
        $otherUser2 = User::factory()->create(['role' => 'peserta']);
        Pendaftaran::create(['user_id' => $otherUser1->id, 'lomba_id' => $lomba->id, 'status' => 'menunggu']);
        Pendaftaran::create(['user_id' => $otherUser2->id, 'lomba_id' => $lomba->id, 'status' => 'menunggu']);

        // User baru mencoba mendaftar (seharusnya ditolak)
        $response = $this->actingAs($user)->post('/peserta/daftar', [
            'lomba_id' => $lomba->id,
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals(2, Pendaftaran::where('lomba_id', $lomba->id)->count());
    }
}
