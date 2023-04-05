<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SaveJobController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('send-notification', [AuthController::class, 'sendNotification']);

Route::post('register/employer', [AuthController::class, 'registerEmployer']);
Route::post('register/applicant', [AuthController::class, 'registerApplicant']);

Route::post('login', [AuthController::class, 'login']);
Route::post('/save/jobs', [JobController::class, 'saveJobs']);
//Job searching route
Route::post('/search/jobs', [JobController::class, 'searchJobs']);

Route::post('/search/recommended-job', [JobController::class, 'searchJobsWithTitle']);
//applicants searching route
Route::post('/search/applicants', [ApplicantController::class, 'searchApplicants']);

Route::get('auth/{provider}', [SocialLoginController::class, 'linkedinRedirect']);
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'linkedinCallback']);

Route::group(['middleware' => ['auth:api']], function () {
    //applicants apply job
    Route::post('job-apply', [JobController::class, 'jobApply']);
    //employer get applied jobs
    Route::get('get-jobs-notifications', [JobController::class, 'jobsNotifications']);
    // get user profile
    Route::get('profile', [AuthController::class, 'profile']);
    // upload user docs
    Route::post('upload-user-docs', [ApplicantController::class, 'uploadApplicantDocs']);
    // update user skills
    Route::post('update-user-skills', [ApplicantController::class, 'updateApplicantSkills']);
    // update user description
    Route::post('update-user-description', [ApplicantController::class, 'updateApplicantDescription']);
    // update applicant profile
    Route::post('update-applicant-profile', [AuthController::class, 'updateApplicantProfile']);
    // update applicant Personal Info
    Route::post('update-applicant-personal-info', [AuthController::class, 'updateApplicantPersonalInfo']);
    // delete user account
    Route::post('delete-account', [AuthController::class, 'deleteAccount']);
    // add applicant experience
    Route::post('add-applicant-experience', [AuthController::class, 'addExperience']);
    // add applicant education
    Route::post('add-applicant-education', [AuthController::class, 'addEducation']);
    // user logout
    Route::post('logout', [AuthController::class, 'logout']);
    // applicant save jobs
    Route::post('applicant-save-job', [ApplicantController::class, 'saveApplicantFavourite']);
    // applicant saved jobs listing
    Route::post('applicant-saved-jobslist', [ApplicantController::class, 'applicantSavedJobslist']);
    // applicant applied jobs listing
    Route::post('applicant-applied-jobslist', [ApplicantController::class, 'applicantAppliedJobslist']);
});
