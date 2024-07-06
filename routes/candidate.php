<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateProfileController;

Route::middleware(['candidate'])->group(function () {
    Route::prefix('candidate')->group(function () {
        // Route::resource('/candidates', CandidateController::class);
        Route::singleton('/profile', CandidateProfileController::class);
        Route::any('/logout', [CandidateController::class, 'logout'])->name('candidate.logout');
    });
});
