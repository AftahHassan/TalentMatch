<?php

namespace App\Providers;

use App\Models\Analyse;
use App\Models\Candidature;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Offre;
use App\Policies\AnalysePolicy;
use App\Policies\CandidaturePolicy;
use App\Policies\ConversationPolicy;
use App\Policies\MessagePolicy;
use App\Policies\OffrePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Offre::class => OffrePolicy::class,
        Analyse::class => AnalysePolicy::class,
        Candidature::class => CandidaturePolicy::class,
        Conversation::class => ConversationPolicy::class,
        Message::class => MessagePolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
