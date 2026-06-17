<?php

namespace App\Jobs;

use App\Models\Analyse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use function Laravel\Ai\agent;

class AnalyzeCandidateJob implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct(
        public Analyse $analyse,
    ) {}

    public function handle(): void
    {
        $this->analyse->load(['candidature', 'offre']);

        $candidature = $this->analyse->candidature;
        $offre = $this->analyse->offre;

        $prompt = "Tu es un expert RH. Analyse ce CV par rapport à cette offre d'emploi.\n\n"
            ."OFFRE: {$offre->titre}\n"
            ."Description: {$offre->description}\n"
            .'Compétences requises: '.implode(', ', $offre->competences_requises)."\n"
            ."Expérience minimum: {$offre->niveau_experience} ans\n\n"
            ."CV DU CANDIDAT ({$candidature->nom}):\n"
            ."{$candidature->texte_cv}\n\n"
            .'Retourne une analyse structurée avec un score de matching de 0 à 100.';

        try {
            $response = agent(
                instructions: 'Tu es un expert RH spécialisé dans l\'analyse de CV.',
                schema: fn ($schema) => [
                    'competences' => $schema->array()
                        ->items($schema->string())
                        ->required(),
                    'annees_experience' => $schema->integer()
                        ->min(0)
                        ->required(),
                    'niveau_etude' => $schema->string()
                        ->required(),
                    'langues' => $schema->array()
                        ->items($schema->string())
                        ->required(),
                    'score' => $schema->integer()
                        ->min(0)
                        ->max(100)
                        ->required(),
                    'points_forts' => $schema->array()
                        ->items($schema->string())
                        ->required(),
                    'lacunes' => $schema->array()
                        ->items($schema->string())
                        ->required(),
                    'competences_manquantes' => $schema->array()
                        ->items($schema->string())
                        ->required(),
                    'recommandation' => $schema->string()
                        ->enum(['convoquer', 'attente', 'rejeter'])
                        ->required(),
                    'justification' => $schema->string()
                        ->required(),
                ],
            )->prompt($prompt);

            $this->analyse->update([
                'competences' => $response['competences'],
                'annees_experience' => $response['annees_experience'],
                'niveau_etude' => $response['niveau_etude'],
                'langues' => $response['langues'],
                'score' => $response['score'],
                'points_forts' => $response['points_forts'],
                'lacunes' => $response['lacunes'],
                'competences_manquantes' => $response['competences_manquantes'],
                'recommandation' => $response['recommandation'],
                'justification' => $response['justification'],
                'statut' => 'termine',
                'payload' => method_exists($response, 'toArray') ? $response->toArray() : (array) $response,
            ]);
        } catch (\Throwable $e) {
            $this->analyse->update([
                'statut' => 'echec',
                'justification' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
