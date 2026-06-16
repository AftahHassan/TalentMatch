<?php

namespace Tests\Feature;

use App\Models\Analyse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConversationTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_utilisateur_connecte_peut_creer_une_conversation(): void
    {
        $user = User::factory()->create();
        $analyse = Analyse::factory()->termine()->create();
        $analyse->offre->update(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post("/analyses/{$analyse->id}/conversations", [
            'titre' => 'Discussion sur le candidat',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('conversations', [
            'analyse_id' => $analyse->id,
            'titre' => 'Discussion sur le candidat',
        ]);
    }

    public function test_un_utilisateur_non_connecte_ne_peut_pas_creer_une_conversation(): void
    {
        $analyse = Analyse::factory()->termine()->create();

        $response = $this->post("/analyses/{$analyse->id}/conversations");

        $response->assertRedirect('/login');
    }

    public function test_un_utilisateur_non_proprietaire_ne_peut_pas_creer_une_conversation(): void
    {
        $proprietaire = User::factory()->create();
        $autre = User::factory()->create();
        $analyse = Analyse::factory()->termine()->create();
        $analyse->offre->update(['user_id' => $proprietaire->id]);

        $response = $this->actingAs($autre)->post("/analyses/{$analyse->id}/conversations");

        $response->assertStatus(403);
    }

    public function test_un_utilisateur_connecte_peut_voir_sa_conversation(): void
    {
        $user = User::factory()->create();
        $analyse = Analyse::factory()->termine()->create();
        $analyse->offre->update(['user_id' => $user->id]);

        $conversation = $analyse->conversations()->create(['titre' => 'Test']);

        $response = $this->actingAs($user)->get("/conversations/{$conversation->id}");

        $response->assertStatus(200);
        $response->assertSee('Test');
    }
}
