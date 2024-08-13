<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;

Route::prefix('/app')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login/forgot-password', [AuthController::class, 'forgot_password'])->middleware('guest')->name('reset-password');
    Route::post('login/forgot-password', [AuthController::class, 'sendPasswordResetLink'])->middleware('guest')->name('send-link');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::post('/create-account', [AuthController::class, 'create'])->name('auth.create');
    Route::get('/password/reset/{token}/account_type', [AuthController::class, 'reset_password'])->middleware('guest')->name('auth.verify_token');
    Route::post('/password/reset/{token}/account_type', [AuthController::class, 'verify_reset_token'])->middleware('guest')->name('auth.reset');
});
