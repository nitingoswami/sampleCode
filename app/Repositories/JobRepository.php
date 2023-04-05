<?php

namespace App\Repositories;

use App\Models\Employer;
use App\Models\Job;
use App\Models\UserAppliedJob;
use Illuminate\Support\Facades\Auth;
class JobRepository
{
    public function saveJobs($data)
    {
        foreach($data as $insert)
         {
            Job::insert($insert);
         }
    }

    public function findJobByUniqueIndex($val)
    {
        return Job::where('job_unique_id', $val)->exists();
    }

    public function saveEmployer($name)
    {
        $employer = new Employer();
        $employer->name = $name;
        $employer->save();

        return $employer;
    }

    /*
    * Repository function for Search jobs for applicants based on selected filters.
    *
    *  param  Request array
    * return array
    */

    public function findYouJobs($filters)
    {
        $query = Job::query();

        if(!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%')
            ->orWhere('description', 'like', '%' . $filters['title'] . '%')
            ->orWhere('category', 'like', '%' . $filters['title'] . '%');
        }

        if(!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }

        if(!empty($filters['industries']) && $filters['industries'] != 'all') {
            $query->where('industries', $filters['industries']);
        }

        if(!empty($filters['job_type'])) {
            if(is_array($filters['job_type'])){
                $query->Where(function ($query) use($filters) {
                    foreach($filters['job_type'] as $jobtype){
                        $query->orwhere('job_type', 'like',  '%' . $jobtype .'%');
                    }
               });
            }else{
                $query->where('job_type', 'like', '%' . $filters['job_type'] . '%');
            }

        }

        if(!empty($filters['posted_date'])) {
            $query->where('created_at', '>', now()->subDays($filters['posted_date'])->endOfDay());

        }

        $result = $query->orderBy('id', 'desc')->paginate(50);

        return $result;
    }

    /*
    * Repository function for Search jobs with title for applicants based on selected filters.
    *
    *  param  Request array
    * return array
    */

    public function searchJobsWithTitle($filters)
    {
        $query = Job::query();

        if(!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%')
            ->orWhere('department', 'like', '%' . $filters['title'] . '%')
            ->orWhere('industries', 'like', '%' . $filters['title'] . '%');
            $result = $query->orderBy('id', 'desc')->paginate(50);
        }else{
            $result = $query->orderBy('id', 'desc')->paginate(50);
        }
        return $result;
    }

    /*
    * Repository function for Applicants Apply Jobs.
    *
    *  param  Request array
    * return jobApply instance
    */

    public function jobApply ($data)
    {
        $data['user_id'] = Auth::user()->id;

        $apply = UserAppliedJob::firstOrNew($data);

        $apply->applied ++;

        $apply->save();

        return $apply;
    }

    /*
     * Repository function for Send Notifications to Applicants.
     *
     * return jobApply instance
    */

    public function jobsNotifications ()
    {
        $noti = UserAppliedJob::where('user_id',Auth::user()->id)->paginate(50);

        return  $noti;
    }

}
