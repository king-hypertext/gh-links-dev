<?php

use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\EmployersAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\JobsController;

Route::middleware(['employer'])->group(function () {
    Route::resource('/employers', EmployersController::class);
    Route::prefix('employer')->group(function () {
        Route::get('/dashboard', [EmployersController::class, 'dashboard'])->name('employer.dashboard');
        Route::get('/company-profile', [EmployerProfileController::class, 'show'])->name('employer.company-profile');
        Route::post('/company-profile', [EmployerProfileController::class, 'store'])->name('employer.company-profile.save');
        Route::singleton('my-account', EmployersAccountController::class);
        Route::resource('/post-job', JobsController::class);
        Route::any('/logout', [EmployersController::class, 'logout'])->name('employer.logout');
    });
});
