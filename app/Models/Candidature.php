<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'texte_cv',
    ];

    public function analyse(): HasOne
    {
        return $this->hasOne(Analyse::class);
    }
}
