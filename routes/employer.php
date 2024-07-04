<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployersController;

Route::middleware(['employer'])->group(function () {
    Route::resource('/employers', EmployersController::class);
    Route::prefix('employer')->group(function () {
        Route::get('/dashboard', [EmployersController::class, 'dashboard'])->name('employer.dashboard');
        Route::any('/logout', [EmployersController::class, 'logout'])->name('employer.logout');
    });
});
