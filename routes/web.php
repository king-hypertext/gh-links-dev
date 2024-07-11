<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/',[HomeController::class, 'home'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/user', [HomeController::class, 'home'])->name('auth.home');
});
// Route::get('/user/:id', function)
Route::get('/search', [HomeController::class, 'search'])->name('search');
include 'jobs.php';
include 'employer.php';
include 'candidate.php';
include 'auth.php';
