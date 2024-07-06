<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/user', [HomeController::class, 'home'])->name('auth.home');
});
include 'jobs.php';
include 'employer.php';
include 'candidate.php';
include 'auth.php';
