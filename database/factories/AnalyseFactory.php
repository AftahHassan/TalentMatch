<?php

namespace Database\Factories;

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
}
