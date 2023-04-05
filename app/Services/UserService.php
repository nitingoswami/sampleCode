<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserProfileResource;
use App\Repositories\UserRepository;
use Exception;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function saveEmployer($data)
    {
        $user = $this->userRepo->save($data);
        if ($user) {
            $user->assignRole('employer');
        }

        return new UserResource($user);
    }

    public function saveApplicant($data)
    {
        $user = $this->userRepo->save($data);
        if ($user) {
            $this->userRepo->saveApplicant($data, $user->id);
            $user->assignRole('applicant');
        }

        return new UserResource($user);
    }

    public function loginUser($data)
    {
        if (! auth()->attempt($data)) {
            return false;
        }

        return new UserResource(auth()->user());
    }

    /*
     * Service function for get Applicant Profile.
     *
     * param
     * return User Object
    */
    public function getAuthenticatedUser()
    {
        return new UserProfileResource(auth()->user());
    }

    /*
     * Service function for Update Applicant Profile.
     *
     * param
     * return User Object
    */
    public function updateApplicantProfile($request)
    {
        $user = $this->userRepo->update($request->only("name","email","password"));
        if ($user) {
            $this->userRepo->updateApplicant($request->except("name","email","password"), $user->id);
        }

        return new UserProfileResource($user);
    }

    public function updateApplicantPersonalInfo($request)
    {
        $user = $this->userRepo->update($request->only("name","email","password"));
        if ($user) {
            $this->userRepo->updateApplicant($request->except("name","email","password"), $user->id);
        }

        return new UserProfileResource($user);
    }

    /*
     * Service function for Applicant Add Experience.
     *
     * param
     * return User Object
    */
    public function addExperience($data)
    {
        $auth = new UserProfileResource(auth()->user());

        return $this->userRepo->addExperience($data,$auth);
    }

    /*
     * Service function for Applicant Add Education.
     *
     * param
     * return User Object
    */
    public function addEducation($data)
    {
        $auth = new UserProfileResource(auth()->user());

        return $this->userRepo->addEducation($data,$auth);
    }

    public function logoutUser()
    {
        try {
            /** @var \App\Models\User */
            $user = auth()->user();
            $user->token()->revoke();

            return true;
        } catch (Exception $error) {
            return false;
        }
    }

    /*
     * Service function for Applicant delete Account.
     *
     * param
     * return User Object
    */
    public function deleteAccount()
    {
        try {
            $user = auth()->user();
            $this->userRepo->deleteAccount($user);
            return true;
        } catch (Exception $error) {
            return false;
        }
    }
}
