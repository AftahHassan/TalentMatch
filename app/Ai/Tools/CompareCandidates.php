<?php

namespace App\Ai\Tools;

use App\Models\Analyse;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class CompareCandidates implements Tool
{
    public function description(): Stringable|string
    {
        return 'Compare two candidate analyses by their IDs and return both analyses with offer and candidate details.';
    }

    public function handle(Request $request): Stringable|string
    {
        $analyse1 = Analyse::with(['offre', 'candidature'])->findOrFail($request['analyse_id_1']);
        $analyse2 = Analyse::with(['offre', 'candidature'])->findOrFail($request['analyse_id_2']);

        return json_encode([
            'candidate_1' => $analyse1->toArray(),
            'candidate_2' => $analyse2->toArray(),
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'analyse_id_1' => $schema->integer()->description('The ID of the first analysis')->required(),
            'analyse_id_2' => $schema->integer()->description('The ID of the second analysis')->required(),
        ];
    }
}
