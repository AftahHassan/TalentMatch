<?php

namespace App\Ai\Tools;

use App\Models\Analyse;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class GetCandidateAnalysis implements Tool
{
    public function description(): Stringable|string
    {
        return 'Get the full candidate analysis data by analysis ID, including the job offer and candidate details.';
    }

    public function handle(Request $request): Stringable|string
    {
        $analyse = Analyse::with(['offre', 'candidature'])->findOrFail($request['analyse_id']);

        return json_encode($analyse->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'analyse_id' => $schema->integer()->description('The ID of the analysis')->required(),
        ];
    }
}
