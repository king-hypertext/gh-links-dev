<?php

use App\Http\Controllers\CandidateApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateProfileController;

Route::middleware(['candidate'])->group(function () {
    Route::prefix('candidate')->group(function () {
        Route::get('/applications', [CandidateApplicationController::class, 'index']);
        Route::get('/profile/setup', [CandidateProfileController::class, 'create'])->name('candidate.profile.create');
        Route::post('/profile/setup', [CandidateProfileController::class, 'store'])->name('candidate.profile.store');
        Route::get('profile/saved-jobs', [CandidateProfileController::class, 'index'])->name('candidate.saved-jobs');
        Route::any('/logout', [CandidateController::class, 'logout'])->name('candidate.logout');
        Route::singleton('/profile', CandidateProfileController::class);
    });
    // });
});
Route::get('/candidate/{username}', [CandidateController::class, 'showByUsername'])->name('candidate.profile-info');
Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
