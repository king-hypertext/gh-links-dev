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
        Route::get('/profile/settings', [CandidateProfileController::class, 'settings'])->name('candidate.profile.settings');
        Route::get('profile/saved-jobs', [CandidateProfileController::class, 'save_jobs'])->name('candidate.saved-jobs');
        Route::any('/logout', [CandidateController::class, 'logout'])->name('candidate.logout');
        Route::singleton('/profile', CandidateProfileController::class);
        Route::post('/save_job', [CandidateProfileController::class, 'save_job'])->name('candidate.save_job');
        Route::post('/unsave_job', [CandidateProfileController::class, 'unsave_job'])->name('candidate.unsave_job');
        Route::post('/apply_job', [CandidateProfileController::class, 'apply_job'])->name('candidate.apply_job');
        Route::post('/upload-image', [CandidateProfileController::class, 'upload_image'])->name('candidate.upload-image');
        Route::put('/update-info', [CandidateProfileController::class, 'update'])->name('candidate.update-info');
    });
    // });
});
Route::get('/candidate/{username}', [CandidateController::class, 'showByUsername'])->name('candidate.profile-info');
Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::get('/candidate/{id}', [CandidateController::class, 'show'])->name('candidate.show');
