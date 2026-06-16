<?php

namespace Tests\Feature;

use App\Models\Analyse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_envoi_sans_contenu_echoue(): void
    {
        $user = User::factory()->create();
        $analyse = Analyse::factory()->termine()->create();
        $analyse->offre->update(['user_id' => $user->id]);

        $conversation = $analyse->conversations()->create(['titre' => 'Test']);

        $response = $this->actingAs($user)->post("/conversations/{$conversation->id}/messages", [
            'contenu' => '',
        ]);

        $response->assertSessionHasErrors('contenu');
    }

    public function test_un_utilisateur_non_connecte_ne_peut_pas_envoyer_un_message(): void
    {
        $analyse = Analyse::factory()->termine()->create();
        $conversation = $analyse->conversations()->create(['titre' => 'Test']);

        $response = $this->post("/conversations/{$conversation->id}/messages", [
            'contenu' => 'Bonjour',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_un_utilisateur_non_proprietaire_ne_peut_pas_envoyer_un_message(): void
    {
        $proprietaire = User::factory()->create();
        $autre = User::factory()->create();
        $analyse = Analyse::factory()->termine()->create();
        $analyse->offre->update(['user_id' => $proprietaire->id]);

        $conversation = $analyse->conversations()->create(['titre' => 'Test']);

        $response = $this->actingAs($autre)->post("/conversations/{$conversation->id}/messages", [
            'contenu' => 'Bonjour',
        ]);

        $response->assertStatus(403);
    }
}
