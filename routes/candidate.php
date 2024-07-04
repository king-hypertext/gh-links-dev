<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

Route::middleware(['candidate'])->group(function () {
    Route::prefix('candidate')->group(function () {
        Route::resource('/candidates', CandidateController::class);
        Route::get('/dashboard', [CandidateController::class, 'dashboard'])->name('candidate.dashboard');
        Route::any('/logout', [CandidateController::class, 'logout'])->name('candidate.logout');
    });
});
