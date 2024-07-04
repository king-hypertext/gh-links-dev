<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;

Route::prefix('/app')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])
        ->middleware('throttle:5,1')
        ->name('login.authenticate');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
});
