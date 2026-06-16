<?php

namespace App\Ai\Tools;

use App\Models\Offre;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class GetJobRequirements implements Tool
{
    public function description(): Stringable|string
    {
        return 'Get the job requirements, description, and details for a given job offer ID.';
    }

    public function handle(Request $request): Stringable|string
    {
        $offre = Offre::findOrFail($request['offre_id']);

        return json_encode($offre->toArray(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'offre_id' => $schema->integer()->description('The ID of the job offer')->required(),
        ];
    }
}
