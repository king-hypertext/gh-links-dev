<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployersController;

Route::post('/app/employer/create-account', [EmployersController::class, 'register'])->name('employer.register');
Route::middleware(['auth', 'employer', 'throttle:5,1'])->group(function () {
    // Route::resource('/employers', EmployersController::class);
    Route::prefix('employer')->group(function () {
        Route::get('/dashboard', [EmployersController::class, 'dashboard'])->name('employer.dashboard');
    });
});
