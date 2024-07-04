<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('pages.home');
});
Route::middleware('auth')->group(function () {
    Route::get('/user', [HomeController::class, 'home'])->name('home');
});
include 'jobs.php';
include 'auth.php';
include 'employer.php';
