<?php

namespace Tests\Feature;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OffreTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_utilisateur_connecte_peut_creer_une_offre(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/offres', [
            'titre' => 'Développeur Laravel',
            'description' => 'Nous recherchons un développeur Laravel expérimenté.',
            'competences_requises' => 'PHP, Laravel, MySQL',
            'niveau_experience' => 3,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('offres', [
            'titre' => 'Développeur Laravel',
            'user_id' => $user->id,
        ]);
    }

    public function test_un_utilisateur_non_connecte_ne_peut_pas_creer_une_offre(): void
    {
        $response = $this->post('/offres', [
            'titre' => 'Développeur Laravel',
            'description' => 'Description.',
            'competences_requises' => 'PHP, Laravel',
            'niveau_experience' => 3,
        ]);

        $response->assertRedirect('/login');
    }

    public function test_la_validation_echoue_sans_titre(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/offres', [
            'description' => 'Description.',
            'competences_requises' => 'PHP',
            'niveau_experience' => 3,
        ]);

        $response->assertSessionHasErrors('titre');
    }

    public function test_la_validation_echoue_avec_niveau_negatif(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/offres', [
            'titre' => 'Développeur',
            'description' => 'Description.',
            'competences_requises' => 'PHP',
            'niveau_experience' => -1,
        ]);

        $response->assertSessionHasErrors('niveau_experience');
    }

    public function test_un_utilisateur_connecte_voit_ses_offres(): void
    {
        $user = User::factory()->create();
        $autreUser = User::factory()->create();

        $offre = Offre::factory()->create([
            'user_id' => $user->id,
            'titre' => 'Mon offre',
        ]);

        Offre::factory()->create([
            'user_id' => $autreUser->id,
            'titre' => 'Offre autre user',
        ]);

        $response = $this->actingAs($user)->get('/offres');

        $response->assertStatus(200);
        $response->assertSee('Mon offre');
        $response->assertDontSee('Offre autre user');
    }

    public function test_message_aucune_offre(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/offres');

        $response->assertStatus(200);
        $response->assertSee('Aucune offre pour le moment');
    }

    public function test_un_utilisateur_non_proprietaire_ne_peut_pas_voir_une_offre(): void
    {
        $user = User::factory()->create();
        $autreUser = User::factory()->create();

        $offre = Offre::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($autreUser)->get("/offres/{$offre->id}");

        $response->assertStatus(403);
    }
}
