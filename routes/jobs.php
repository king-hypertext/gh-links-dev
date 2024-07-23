<?php

use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');
Route::get('/job/{id}', [JobsController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{company}', [JobsController::class, 'showByCompany'])->name('jobs.open-vacancy');
Route::get('/autocompleteJobList', [JobsController::class, 'autocompleteJobList'])->name('job.autocompleteJobList');

