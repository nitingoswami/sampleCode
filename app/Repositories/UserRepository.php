<?php

namespace App\Repositories;

use App\Models\Applicant;
use App\Models\User;
use App\Models\ApplicantExperience;
use App\Models\ApplicantEducation;
use Illuminate\Support\Facades\Storage;
class UserRepository
{
    public function save($data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        return $user;
    }

    public function saveApplicant($data, $userId)
    {
        $applicant = new Applicant();
        $applicant->user_id = $userId;
        $applicant->location = $data['location'];
        $applicant->country = $data['country'];
        $applicant->education = $data['education'];
        $applicant->experience = $data['experience'];
        $applicant->save();

        return $applicant;
    }

    /*
     * Repository function for Update User.
     * Parma $data Array
     * return User Object
    */
    public function update($data)
    {
        $user = auth()->user();
        $user->name = $data['name'];
        $user->email = $data['email'];

        if(!empty($data['password'])){
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return $user;
    }

    /*
     * Repository function for Update Applicant Profile.
     * Parma $data Array , $userId User id
     * return User Object
    */
    public function updateApplicant($data, $userId)
    {
        $applicant = Applicant::where('user_id',$userId)->first();

        if(!empty($data['language'])){
            $data['language'] = implode(",",$data['language']);
        }
        if(!empty($data['skills'])){
            $data['skills'] = implode(",",$data['skills']);
        }

        if(!empty($data['avatar'])){
            $file = $data['avatar'];
            $folder = 'avatar/'.$userId;
            Storage::disk('local')->put('public/'.$folder,  $file);
            $data['avatar'] = $folder.'/'.$file->hashName();
        }

        $applicant->update($data);

        return $applicant;
    }

    /*
     * Repository function for Applicant Add Experience.
     * Parma $data Array , $auth  Auth User
     * return User Object
    */
    public function addExperience($data,$auth)
    {
        $data['user_id'] = $auth->id;
        $data['applicant_id'] = $auth->applicant->id;
        $id = isset($data['id']) ? $data['id'] :NULL;

        $applicant = ApplicantExperience::updateOrCreate(['id' => $id],$data);

        return $applicant;
    }

    /*
     * Repository function for Applicant Add Education.
     * Parma $data Array , $auth  Auth User
     * return User Object
    */
    public function addEducation($data,$auth)
    {
        $data['user_id'] = $auth->id;
        $data['applicant_id'] = $auth->applicant->id;
        $id = isset($data['id']) ? $data['id'] :NULL;
        $applicant = ApplicantEducation::updateOrCreate(['id' => $id],$data);

        return $applicant;
    }

        /*
     * Repository function for Applicant Delete.
     * Parma $auth  Auth User
     * return User Object
    */
    public function deleteAccount($auth)
    {
        return $auth->delete();
    }

}
