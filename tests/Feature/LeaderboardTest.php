<?php

namespace Tests\Feature;

use App\Models\Lomba;
use App\Models\Pendaftaran;
use App\Models\Pertandingan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaderboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test panitia can set match winner and it marks match as selesai.
     */
    public function test_panitia_can_set_match_winner(): void
    {
        $admin = User::factory()->panitia()->create();
        $user1 = User::factory()->create(['kelas' => 'XII RPL 1']);
        $user2 = User::factory()->create(['kelas' => 'XII RPL 2']);
        $lomba = Lomba::factory()->create();

        $match = Pertandingan::create([
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user1->id,
            'peserta_2_id' => $user2->id,
            'babak' => 1,
            'status' => 'belum_mulai',
        ]);

        $response = $this->actingAs($admin)->post("/panitia/pertandingan/{$match->id}/set-winner", [
            'pemenang_id' => $user1->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pertandingans', [
            'id' => $match->id,
            'pemenang_id' => $user1->id,
            'status' => 'selesai',
        ]);
    }

    /**
     * Test panitia setting winner automatically advances winner to next round.
     */
    public function test_winner_automatically_advances_to_next_round_even_index(): void
    {
        $admin = User::factory()->panitia()->create();
        $user1 = User::factory()->create(['kelas' => 'XII RPL 1']);
        $user2 = User::factory()->create(['kelas' => 'XII RPL 2']);
        $lomba = Lomba::factory()->create();

        // Create 2 matches for Round 1 to test advancement indexing
        $match1 = Pertandingan::create([
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user1->id,
            'peserta_2_id' => $user2->id,
            'babak' => 1,
            'status' => 'belum_mulai',
        ]);

        $user3 = User::factory()->create(['kelas' => 'XII RPL 1']);
        $user4 = User::factory()->create(['kelas' => 'XII RPL 2']);
        $match2 = Pertandingan::create([
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user3->id,
            'peserta_2_id' => $user4->id,
            'babak' => 1,
            'status' => 'belum_mulai',
        ]);

        // Winner of Match 1 (index 0) should advance to peserta_1_id of Next Round Match 1
        $response = $this->actingAs($admin)->post("/panitia/pertandingan/{$match1->id}/set-winner", [
            'pemenang_id' => $user1->id,
        ]);

        $response->assertRedirect();

        // Verify a match in Babak 2 was created with peserta_1_id = $user1->id
        $this->assertDatabaseHas('pertandingans', [
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user1->id,
            'peserta_2_id' => null,
            'babak' => 2,
            'status' => 'belum_mulai',
        ]);

        // Winner of Match 2 (index 1) should advance to peserta_2_id of Next Round Match 1
        $response = $this->actingAs($admin)->post("/panitia/pertandingan/{$match2->id}/set-winner", [
            'pemenang_id' => $user3->id,
        ]);

        $response->assertRedirect();

        // Verify the Babak 2 match now has both participants set
        $this->assertDatabaseHas('pertandingans', [
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user1->id,
            'peserta_2_id' => $user3->id,
            'babak' => 2,
            'status' => 'belum_mulai',
        ]);
    }

    /**
     * Test panitia can disqualify a participant.
     */
    public function test_panitia_can_disqualify_participant(): void
    {
        $admin = User::factory()->panitia()->create();
        $user1 = User::factory()->create(['kelas' => 'XII RPL 1']);
        $user2 = User::factory()->create(['kelas' => 'XII RPL 2']);
        $lomba = Lomba::factory()->create();

        Pendaftaran::create([
            'user_id' => $user1->id,
            'lomba_id' => $lomba->id,
            'status' => 'terverifikasi',
        ]);

        Pendaftaran::create([
            'user_id' => $user2->id,
            'lomba_id' => $lomba->id,
            'status' => 'terverifikasi',
        ]);

        $match = Pertandingan::create([
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user1->id,
            'peserta_2_id' => $user2->id,
            'babak' => 1,
            'status' => 'belum_mulai',
        ]);

        // Disqualify $user1
        $response = $this->actingAs($admin)->post("/panitia/lomba/{$lomba->id}/diskualifikasi/{$user1->id}");

        $response->assertRedirect();

        // Verify user1's pendaftaran is marked as ditolak
        $this->assertDatabaseHas('pendaftarans', [
            'user_id' => $user1->id,
            'lomba_id' => $lomba->id,
            'status' => 'ditolak',
        ]);

        // Verify the match was completed with user2 as the winner
        $this->assertDatabaseHas('pertandingans', [
            'id' => $match->id,
            'pemenang_id' => $user2->id,
            'status' => 'selesai',
        ]);

        // Verify user2 advanced to Babak 2
        $this->assertDatabaseHas('pertandingans', [
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user2->id,
            'babak' => 2,
            'status' => 'belum_mulai',
        ]);
    }

    /**
     * Test leaderboard calculations.
     */
    public function test_leaderboard_calculates_points_correctly(): void
    {
        $user1 = User::factory()->create(['kelas' => 'XII RPL 1']);
        $user2 = User::factory()->create(['kelas' => 'XII RPL 2']);
        $lomba = Lomba::factory()->create();

        // 1. Check points for registrations (should be 10 pts each class)
        Pendaftaran::create(['user_id' => $user1->id, 'lomba_id' => $lomba->id, 'status' => 'terverifikasi']);
        Pendaftaran::create(['user_id' => $user2->id, 'lomba_id' => $lomba->id, 'status' => 'terverifikasi']);

        $response = $this->get('/leaderboard');
        $response->assertStatus(200);

        // Calculate and verify leaderboard returns correct data
        $leaderboardData = $response->viewData('leaderboard');
        $this->assertCount(2, $leaderboardData);

        $firstClass = $leaderboardData->first();
        $this->assertEquals(10, $firstClass['points']); // Both classes have 10 points

        // 2. Check points for winning Babak 1 (+50 pts)
        $match = Pertandingan::create([
            'lomba_id' => $lomba->id,
            'peserta_1_id' => $user1->id,
            'peserta_2_id' => $user2->id,
            'babak' => 1,
            'pemenang_id' => $user1->id,
            'status' => 'selesai',
        ]);

        $response = $this->get('/leaderboard');
        $leaderboardData = $response->viewData('leaderboard');
        
        // XII RPL 1: 10 (reg) + 50 (win babak 1) = 60 pts
        // XII RPL 2: 10 (reg) = 10 pts
        $this->assertEquals('XII RPL 1', $leaderboardData->first()['class_name']);
        $this->assertEquals(60, $leaderboardData->first()['points']);
        $this->assertEquals('XII RPL 2', $leaderboardData->last()['class_name']);
        $this->assertEquals(10, $leaderboardData->last()['points']);
    }
}
