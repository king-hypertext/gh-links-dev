<?php

use App\Http\Controllers\CandidateApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateProfileController;

Route::middleware(['candidate'])->group(function () {
    Route::prefix('candidate')->group(function () {
        Route::get('/applied-jobs', [CandidateProfileController::class, 'applied_jobs'])->name('candidate.application.index');
        Route::get('/profile/setup', [CandidateProfileController::class, 'create'])->name('candidate.profile.create');
        Route::post('/profile/setup', [CandidateProfileController::class, 'store'])->name('candidate.profile.store');
        Route::get('profile/saved-jobs', [CandidateProfileController::class, 'save_jobs'])->name('candidate.saved-jobs');
        Route::any('/logout', [CandidateController::class, 'logout'])->name('candidate.logout');
        Route::singleton('/profile', CandidateProfileController::class);
        Route::post('/save_job', [CandidateProfileController::class, 'save_job'])->name('candidate.save_job');
        Route::post('/unsave_job', [CandidateProfileController::class, 'unsave_job'])->name('candidate.unsave_job');
    });
    // });
});
Route::get('/candidate/{username}', [CandidateController::class, 'showByUsername'])->name('candidate.profile-info');
Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
