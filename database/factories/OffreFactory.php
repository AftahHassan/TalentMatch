<?php

namespace Database\Factories;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffreFactory extends Factory
{
    protected $model = Offre::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'titre' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'competences_requises' => fake()->randomElements(['PHP', 'Laravel', 'MySQL', 'Vue.js', 'Docker', 'AWS', 'Git', 'Redis'], rand(2, 4)),
            'niveau_experience' => fake()->numberBetween(1, 10),
        ];
    }
}
