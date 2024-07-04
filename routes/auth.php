<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\EmployersController;

Route::prefix('/app')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/candidate', [AuthController::class, 'authenticate_candidate'])->name('login.candidate');
    Route::post('/login/employer', [AuthController::class, 'authenticate_employer'])->name('login.employer');
    Route::post('/candidate/create-account', [CandidateController::class, 'register'])->name('candidate.register');
    Route::post('/employer/create-account', [EmployersController::class, 'register'])->name('employer.register');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});
