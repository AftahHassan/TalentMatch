<?php

namespace Database\Factories;

use App\Models\Candidature;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidatureFactory extends Factory
{
    protected $model = Candidature::class;

    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'texte_cv' => fake()->paragraphs(5, true),
        ];
    }
}
