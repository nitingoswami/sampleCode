<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\addExperienceRequest;
use App\Http\Requests\addEducationRequest;
use App\Http\Traits\ApiResponseBuilder;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Notifications\UserNotification;
use App\Mail\SendUserNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
    use ApiResponseBuilder;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function registerEmployer(RegisterRequest $request)
    {
        $data = $request->only('name', 'email', 'password');
        $user = $this->userService->saveEmployer($data);

        return $this->success('User Added Successfully', $user, 201);
    }

    public function registerApplicant(RegisterApplicantRequest $request)
    {
        $data = $request->only('name', 'email', 'password', 'location', 'country', 'education', 'experience');
        $user = $this->userService->saveApplicant($data);

        return $this->success('User Added Successfully', $user, 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->only('email', 'password');
        $userData = $this->userService->loginUser($data);
        if (! $userData) {
            return $this->failure('Invalid Email or Password');
        }

        return $this->success('Logged In Successfully', $userData);
    }

    public function profile()
    {
        $user = $this->userService->getAuthenticatedUser();

        return $this->success('User Profile', $user);
    }

    /**
     * Update Applicant Profile Controller function .
     * param  \Illuminate\Http\UpdateApplicantRequest  $request
     * return \Illuminate\Http\Response
    */
    public function updateApplicantProfile(UpdateApplicantRequest $request)
    {
        $user = $this->userService->updateApplicantProfile($request);

        return $this->success('Updated Successfully', $user, 201);
    }

    /**
     * Update Applicant Personal Info Controller function .
     * param  \Illuminate\Http\UpdateApplicantRequest  $request
     * return \Illuminate\Http\Response
    */
    public function updateApplicantPersonalInfo(UpdateApplicantRequest $request)
    {
        $user = $this->userService->updateApplicantPersonalInfo($request);

        return $this->success('Updated Successfully', $user, 201);
    }

    /**
     * Add Applicant Experience Controller function .
     * param  \Illuminate\Http\addExperienceRequest  $request
     * return \Illuminate\Http\Response
    */
    public function addExperience(addExperienceRequest $request)
    {
        $data = $request->all();
        $user = $this->userService->addExperience($data);

        return $this->success('Applicant Experience', $user);
    }

    /**
     * Add Applicant Education Controller function .
     * param  \Illuminate\Http\addEducationRequest  $request
     * return \Illuminate\Http\Response
    */
    public function addEducation(addEducationRequest $request)
    {
        $data = $request->all();
        $user = $this->userService->addEducation($data);

        return $this->success('Applicant Education', $user);
    }

    public function logout()
    {
        $isLogout = $this->userService->logoutUser();
        if ($isLogout) {
            return $this->success('User Logged Out');
        }

        return $this->failure('Failed to Logout User');
    }

     /**
     * delete Applicant Account Controller function .
     * param  \Illuminate\Http\addEducationRequest  $request
     * return \Illuminate\Http\Response
    */
    public function deleteAccount()
    {
        $isLogout = $this->userService->deleteAccount();
        if ($isLogout) {
            return $this->success('Delete Successfully');
        }

        return $this->failure('Failed! Something wrongs');
    }

    /**
     * Send Notification to User Controller function .
     * param  \Illuminate\Http\addEducationRequest  $request
     * return \Illuminate\Http\Response
    */
    public function sendNotification(Request $request)
    {
        $user = User::Find(1);
        $data =[];
        switch($request->type) {
            case('applied_job'):
                $user->notify(new UserNotification($user,'notifications.applied_job'));
                break;

            case('changed_password'):
                $user->notify(new UserNotification($user,'notifications.changed_password'));
                break;

            case('message_received'):
                $user->notify(new UserNotification($user,'notifications.changed_password'));
                Mail::to($user->user->email)->send(new SendUserNotification('Job Expired', "Job Expired"));
                break;

            case('new_message'):
                Mail::to($user->user->email)->send(new SendUserNotification('new message', "new message received"));
                break;
            default:
                break;
        }


        return $this->success('Notification Send Successfully');
    }
}
