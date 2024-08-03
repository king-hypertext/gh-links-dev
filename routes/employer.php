<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\EmployersAccountController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::middleware(['employer'])->group(function () {
    Route::resource('/employers', EmployersController::class);
    Route::prefix('employer')->group(function () {
        Route::post('upload-images', [EmployerProfileController::class, 'storeImages'])->name('employer.profile.upload-images');
        Route::get('/dashboard', [EmployersController::class, 'dashboard'])->name('employer.dashboard');
        Route::get('/profile', [EmployerProfileController::class, 'show'])->name('employer.company-profile');
        Route::post('/profile', [EmployerProfileController::class, 'store'])->name('employer.company-profile.save');
        Route::singleton('my-account', EmployersAccountController::class);
        Route::put('/update-password', [EmployersAccountController::class, 'update_password'])->name('employer.reset_password');
        Route::resource('/my-jobs', PostJobController::class)->name('index', 'job.index');
        Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
        Route::get('/job-applications/{job_id}', [JobApplicationController::class, 'show'])->name('job-applications.show');
        Route::get('/my-candidates', [EmployerProfileController::class, 'candidates'])->name('employer.candidates');
        Route::post('/save-candidate', [EmployerProfileController::class, 'save_candidate'])->name('employer.save_candidate');
        Route::post('/unsave-candidate', [EmployerProfileController::class, 'unsave_candidate'])->name('employer.unsave_candidate');
        Route::put('/approve-application/{id}', [JobApplicationController::class, 'approve_application'])->name('approve_application');
        Route::any('/logout', [EmployersController::class, 'logout'])->name('employer.logout');
    });
});

// Route::get('/employer/verify-email', function () {
//     return view('employer.dashboard', ['emailNotVerified' => true, 'page_title' => 'VERIFY EMAIL']);
// })->middleware('employer')->name('verification.notice');

// Route::get('/verification/send', [EmployersController::class, 'email'])->name('verification.send')->middleware(['employer', 'throttle:6,1'])->name('verification.send');;
// Route::get('/employer/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect()->route('employer.dashboard')->with('success', 'Email verified successfully');
// })->middleware(['employer', 'signed'])->name('verification.verify');
Route::get('companies/{id}', [EmployersController::class, 'company_details'])->name('company.show');
Route::get('company/{company_name}', [EmployersController::class, 'showByCompanyName'])->name('company.profile-info');
Route::get('/companies', [EmployersController::class, 'company'])->name('company.index');
