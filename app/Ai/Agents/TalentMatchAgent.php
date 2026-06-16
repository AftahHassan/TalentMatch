<?php

namespace App\Ai\Agents;

use App\Ai\Tools\CompareCandidates;
use App\Ai\Tools\GetCandidateAnalysis;
use App\Ai\Tools\GetJobRequirements;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class TalentMatchAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    public function instructions(): Stringable|string
    {
        return 'Tu es TalentMatch, assistant RH expert. Tu dois toujours utiliser un tool pour récupérer les données réelles avant de répondre. Ne jamais inventer un score, une compétence ou une recommandation. Si tu n\'as pas l\'ID, demande-le à l\'utilisateur. Réponds en français.';
    }

    /** @return Message[] */
    public function messages(): iterable
    {
        return [];
    }

    /** @return Tool[] */
    public function tools(): iterable
    {
        return [
            new GetCandidateAnalysis,
            new GetJobRequirements,
            new CompareCandidates,
        ];
    }
}
