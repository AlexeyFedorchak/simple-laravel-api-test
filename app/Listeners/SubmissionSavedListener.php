<?php

namespace App\Listeners;

use App\Events\SubmissionSavedEvent;
use Illuminate\Support\Facades\Log;

class SubmissionSavedListener
{
    /**
     * Handle the event
     *
     * @param SubmissionSavedEvent $event
     * @return void
     */
    public function handle(SubmissionSavedEvent $event): void
    {
        Log::info("Submission with name {$event->submission->name} and email {$event->submission->email} successfully created.");
    }
}
