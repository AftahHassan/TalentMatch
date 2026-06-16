<?php

namespace Database\Factories;

use App\Enums\Recommandation;
use App\Models\Analyse;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnalyseFactory extends Factory
{
    protected $model = Analyse::class;

    public function definition(): array
    {
        return [
            'offre_id' => Offre::factory(),
            'candidature_id' => Candidature::factory(),
            'statut' => 'en_attente',
        ];
    }

    public function termine(): static
    {
        return $this->state(fn (array $attributes) => [
            'statut' => 'termine',
            'competences' => ['PHP', 'Laravel', 'MySQL', 'JavaScript'],
            'annees_experience' => 5,
            'niveau_etude' => 'Master',
            'langues' => ['Français', 'Anglais'],
            'score' => 75,
            'points_forts' => ['Solide expérience Laravel', 'Bonne maîtrise de MySQL'],
            'lacunes' => ['Pas d\'expérience DevOps'],
            'competences_manquantes' => ['Docker'],
            'recommandation' => Recommandation::Convoquer,
            'justification' => 'Le candidat correspond bien au profil recherché. Son expérience Laravel est solide et sa maîtrise de MySQL est un atout.',
            'payload' => ['model' => 'gpt-4o', 'usage' => ['tokens' => 500]],
        ]);
    }

    public function echec(): static
    {
        return $this->state(fn (array $attributes) => [
            'statut' => 'echec',
        ]);
    }
}
