<?php

namespace App\Services;

use App\Dto\SubmissionDto;
use App\Jobs\StoreSubmissionJob;

class SubmissionService
{
    public function create(SubmissionDto $submissionDto): void
    {
        StoreSubmissionJob::dispatch($submissionDto);
    }
}
