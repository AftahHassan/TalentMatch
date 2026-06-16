<?php

namespace App\Jobs;

use App\Models\Analyse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AnalyzeCandidateJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Analyse $analyse,
    ) {}

    public function handle(): void
    {
        //
    }
}
