<?php

use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
