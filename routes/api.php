<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionApiController;

Route::post('/submit', [SubmissionApiController::class, 'store'])->name('api.submission.store');
