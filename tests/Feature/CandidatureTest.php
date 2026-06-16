<?php

namespace Tests\Feature;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_utilisateur_connecte_peut_soumettre_un_cv(): void
    {
        $user = User::factory()->create();
        $offre = Offre::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post("/offres/{$offre->id}/candidatures", [
            'nom' => 'Jean Dupont',
            'texte_cv' => str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 20),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Analyse en cours...');
        $this->assertDatabaseHas('candidatures', ['nom' => 'Jean Dupont']);
        $this->assertDatabaseHas('analyses', ['statut' => 'en_attente']);
    }

    public function test_un_utilisateur_non_connecte_ne_peut_pas_soumettre_un_cv(): void
    {
        $offre = Offre::factory()->create();

        $response = $this->post("/offres/{$offre->id}/candidatures", [
            'nom' => 'Jean Dupont',
            'texte_cv' => str_repeat('Lorem ipsum ', 20),
        ]);

        $response->assertRedirect('/login');
    }

    public function test_un_utilisateur_non_proprietaire_ne_peut_pas_soumettre_un_cv(): void
    {
        $proprietaire = User::factory()->create();
        $autre = User::factory()->create();
        $offre = Offre::factory()->create(['user_id' => $proprietaire->id]);

        $response = $this->actingAs($autre)->post("/offres/{$offre->id}/candidatures", [
            'nom' => 'Jean Dupont',
            'texte_cv' => str_repeat('Lorem ipsum ', 20),
        ]);

        $response->assertStatus(403);
    }

    public function test_la_validation_echoue_sans_nom(): void
    {
        $user = User::factory()->create();
        $offre = Offre::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post("/offres/{$offre->id}/candidatures", [
            'texte_cv' => str_repeat('Lorem ipsum ', 20),
        ]);

        $response->assertSessionHasErrors('nom');
    }

    public function test_la_validation_echoue_avec_texte_cv_trop_court(): void
    {
        $user = User::factory()->create();
        $offre = Offre::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post("/offres/{$offre->id}/candidatures", [
            'nom' => 'Jean Dupont',
            'texte_cv' => 'Texte trop court',
        ]);

        $response->assertSessionHasErrors('texte_cv');
    }

    public function test_le_formulaire_de_soumission_saffiche(): void
    {
        $user = User::factory()->create();
        $offre = Offre::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/offres/{$offre->id}/candidatures/create");

        $response->assertStatus(200);
        $response->assertSee('Soumettre un CV');
        $response->assertSee('Nom du candidat');
        $response->assertSee('Texte du CV');
    }
}
