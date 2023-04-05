<?php

namespace App\Repositories;

use App\Models\Employer;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Job;
use App\Models\SaveJob;
use App\Models\UserAppliedJob;
use Illuminate\Support\Facades\Storage;
class ApplicantRepository
{
    /**
     * Applicant searching Repository Function .
     * Parma (array)
    */
    public function findApplicants($filters)
    {
        $query = User::query()->with('applicant');

        if(!empty($filters['title'])) {
            $query->where('name', 'like', '%' . $filters['title'] . '%');
            $query->orWhereHas('applicant', function ($query) use($filters) {
                $query->where('title', 'like', '%' . $filters['title'] . '%')
                ->orWhere('about', 'like', '%' . $filters['title'] . '%');
            });
        }

        $query->WhereHas('applicant', function ($query) use($filters) {

            if(!empty($filters['skills'])) {
                $search = preg_replace('/\s*, \s*/', '|', $filters['skills']);
                $query->whereRaw("skills REGEXP '{$search}'");
            }

            if(!empty($filters['language'])) {
                $search = preg_replace('/\s*, \s*/', '|', $filters['language']);
                $query->whereRaw("language REGEXP '{$search}'");
            }

            if(!empty($filters['education'])) {
                $query->where('education', 'like', '%' . $filters['education'] . '%');
            }

            if(!empty($filters['country'])) {
                $query->where('country', 'like', '%' . $filters['country'] . '%');
            }

            if(!empty($filters['location'])) {
                $query->where('location', 'like', '%' . $filters['location'] . '%');
            }

            if(!empty($filters['experience'])) {
                $query->where('experience', 'like', '%' . $filters['experience'] . '%');
            }

            if(!empty($filters['salary'])) {
                $query->where('salary', 'like', '%' . $filters['salary'] . '%');
            }

            if(!empty($filters['job_type'])) {
                $query->where('job_type', 'like', '%' . $filters['job_type'] . '%');
            }

        });

        $result = $query->orderBy('id', 'desc')->paginate(50);

        return $result;
    }

    /**
     * Applicant Upload Docs Repository Function .
     * Parma Request $request
    */
    public function uploadApplicantDocs($request)
    {
        $user = auth()->user();
        $applicant = Applicant::where('user_id',$user->id)->first();
        if($request->hasFile('file')){
            $file = $request->file('file');
            $folder = 'avatar/'.$user->id;
            Storage::disk('local')->put('public/'.$folder,  $file);
            $name = $folder.'/'.$file->hashName();
            if($request->type == "resume"){
                $data['resume'] =$name;
            }else{
                $data['avatar'] = $name;
            }
            $applicant->update($data);
        }

        return $applicant;
    }

    /**
     * Applicant Update Skills Repository Function .
     * Parma Request $request
    */
    public function updateApplicantSkills($request)
    {
        $user = auth()->user();
        $applicant = Applicant::where('user_id',$user->id)->first();
        if(!empty($request->skills)){
            $data['skills'] = implode(",",$request->skills);
            $applicant->update($data);
        }

        return $applicant;
    }

    /**
     * Applicant  Update Description Repository Function .
     * Parma Request $request
    */
    public function updateApplicantDescription($request)
    {
        $user = auth()->user();
        $applicant = Applicant::where('user_id',$user->id)->first();
        if(isset($request->about)){
            $applicant->update(['about' => $request->about]);
        }

        return $applicant;
    }

    /**
     * Applicant Save Favourite Job Repository Function .
     * Parma Request $request
    */
    public function saveApplicantFavourite($request)
    {
        $user = auth()->user();

        $favorite = SaveJob::firstOrNew(['user_id' =>  $user->id,'job_id' => $request->job_id]);
        $favorite->user_id = $user->id;
        $favorite->job_id = $request->job_id;
        $favorite->save();

        return $favorite;
    }

    /**
     * Applicant Save Favourite Job Repository Function .
     * Parma
    */
    public function applicantSavedJobslist()
    {
        $user = auth()->user();
        $favorite = SaveJob::where('user_id', $user->id)->with('job')->get();
        return $favorite;
    }

    /**
     * Applicant Favourite Job List Repository Function .
     * Parma
    */
    public function applicantAppliedJobslist()
    {
        $user = auth()->user();
        $favorite = UserAppliedJob::where('user_id', $user->id)->with('job')->get();
        return $favorite;
    }

}
