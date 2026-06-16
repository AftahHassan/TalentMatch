<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = [
        'analyse_id',
        'titre',
    ];

    public function analyse(): BelongsTo
    {
        return $this->belongsTo(Analyse::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
