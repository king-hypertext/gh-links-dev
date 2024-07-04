<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

Route::resource('/candidates', CandidateController::class);
Route::prefix('candidate')->group(function () {
    Route::get('/dashboard', 'EmployeeController@dashboard')->name('candidate.dashboard');
});
