<?php

namespace Tests\Feature;

use App\Models\Analyse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalyseTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_page_danalyse_complete_affiche_tous_les_champs(): void
    {
        $user = User::factory()->create();
        $analyse = Analyse::factory()->termine()->create();

        $analyse->offre->update(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/analyses/{$analyse->id}");

        $response->assertStatus(200);
        $response->assertSee($analyse->candidature->nom);
        $response->assertSee($analyse->offre->titre);
        $response->assertSee((string) $analyse->score);
        $response->assertSee('Points forts');
        $response->assertSee('Lacunes');
        $response->assertSee('Compétences manquantes');
        $response->assertSee('Compétences');
        $response->assertSee('Langues');
        $response->assertSee('Justification');
        $response->assertSee('Discuter avec l\'assistant');
    }

    public function test_un_utilisateur_non_proprietaire_ne_peut_pas_voir_une_analyse(): void
    {
        $proprietaire = User::factory()->create();
        $autre = User::factory()->create();
        $analyse = Analyse::factory()->termine()->create();
        $analyse->offre->update(['user_id' => $proprietaire->id]);

        $response = $this->actingAs($autre)->get("/analyses/{$analyse->id}");

        $response->assertStatus(403);
    }

    public function test_la_page_affiche_analyse_en_cours_pour_statut_en_attente(): void
    {
        $user = User::factory()->create();
        $analyse = Analyse::factory()->create();
        $analyse->offre->update(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get("/analyses/{$analyse->id}");

        $response->assertStatus(200);
        $response->assertSee('Analyse en cours');
        $response->assertDontSee('Points forts');
    }

    public function test_le_score_affiche_la_bonne_couleur_selon_le_niveau(): void
    {
        $user = User::factory()->create();

        $analyseVert = Analyse::factory()->termine()->create(['score' => 85]);
        $analyseVert->offre->update(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get("/analyses/{$analyseVert->id}");
        $response->assertSee('bg-green-50');

        $analyseOrange = Analyse::factory()->termine()->create(['score' => 55]);
        $analyseOrange->offre->update(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get("/analyses/{$analyseOrange->id}");
        $response->assertSee('bg-amber-50');

        $analyseRouge = Analyse::factory()->termine()->create(['score' => 25]);
        $analyseRouge->offre->update(['user_id' => $user->id]);
        $response = $this->actingAs($user)->get("/analyses/{$analyseRouge->id}");
        $response->assertSee('bg-red-50');
    }
}
