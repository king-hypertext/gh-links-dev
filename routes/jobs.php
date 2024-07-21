<?php

use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

Route::get('/jobs', [JobsController::class, 'index'])->name('jobs.index');
Route::get('/job/{id}', [JobsController::class, 'show'])->name('jobs.show');
Route::get('company/{company}', [JobsController::class, 'company_details'])->name('company.show');
Route::get('/companies', [JobsController::class, 'company'])->name('company.index');
Route::get('/autocompleteJobList', [JobsController::class, 'autocompleteJobList'])->name('job.autocompleteJobList');
