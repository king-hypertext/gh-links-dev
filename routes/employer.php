<?php

use App\Http\Controllers\EmployerProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\JobsController;

Route::middleware(['employer'])->group(function () {
    Route::resource('/employers', EmployersController::class);
    Route::prefix('employer')->group(function () {
        Route::get('/dashboard', [EmployersController::class, 'dashboard'])->name('employer.dashboard');
        Route::singleton('/your-profile', EmployerProfileController::class);
        Route::resource('/post-job', JobsController::class);
        Route::any('/logout', [EmployersController::class, 'logout'])->name('employer.logout');
    });
});
