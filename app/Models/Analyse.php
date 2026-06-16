<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Analyse extends Model
{
    protected $fillable = [
        'offre_id',
        'candidature_id',
        'competences',
        'annees_experience',
        'niveau_etude',
        'langues',
        'score',
        'points_forts',
        'lacunes',
        'competences_manquantes',
        'recommandation',
        'statut',
        'justification',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'competences' => 'array',
            'langues' => 'array',
            'points_forts' => 'array',
            'lacunes' => 'array',
            'competences_manquantes' => 'array',
            'payload' => 'array',
            'recommandation' => \App\Enums\Recommandation::class,
        ];
    }

    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }
}
