<?php

namespace App\Jobs;

use App\Dto\SubmissionDto;
use App\Events\SubmissionSavedEvent;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class StoreSubmissionJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly SubmissionDto $submissionDto) {}

    public function handle(): void
    {
        $submission = Submission::create($this->submissionDto->toArray());

        event(new SubmissionSavedEvent($submission));
    }

    public function failed(?\Throwable $exception): void
    {
        $submissionData = $this->submissionDto->toObject();
        Log::error("Submission with name {$submissionData->name} was not created. Error: {$exception->getMessage()}");

        // send notification about error to Sentry/Bugsnag or to Slack...
    }
}
