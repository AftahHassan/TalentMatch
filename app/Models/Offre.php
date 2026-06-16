<?php

namespace App\Models;

use Database\Factories\OffreFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offre extends Model
{
    /** @use HasFactory<OffreFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'competences_requises',
        'niveau_experience',
    ];

    protected function casts(): array
    {
        return [
            'competences_requises' => 'array',
            'niveau_experience' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
