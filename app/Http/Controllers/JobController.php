<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Http\Requests\JobSearchRequest;
use App\Http\Requests\JobApplyRequest;
use App\Http\Traits\ApiResponseBuilder;
use App\Services\JobService;
use Illuminate\Http\Request;
class JobController extends Controller
{
    use ApiResponseBuilder;

    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function saveJobs(JobRequest $request)
    {
        $data = $request->only('jobs_file', 'jobs_url');
        $data = $this->jobService->saveFileAndDispatchImportFileJob($data);

        return $this->success($data);
    }

    /*
     * Search jobs for applicants based on selected filters.
     *
     * param  \Illuminate\Http\JobSearchRequest  $request
     * return \Illuminate\Http\Response
    */

    public function searchJobs(JobSearchRequest $request)
    {
        $data = $request->all();
        $data = $this->jobService->findYouJobs($data);

        return $this->success('Jobs List',['count'=>count($data),'jobs'=>$data]);
    }

    /*
     * Search jobs for applicants based on selected filters.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
    */
    public function searchJobsWithTitle(Request $request)
    {
        $data = $request->all();
        $jobs = $this->jobService->searchJobsWithTitle($data);

        return $this->success('Jobs List',['count'=>count($jobs),'jobs'=>$jobs]);
    }

    /*
     * Applicants Apply Jobs.
     *
     * param  \Illuminate\Http\JobApplyRequest  $request
     * return \Illuminate\Http\Response
    */

    public function jobApply (JobApplyRequest $request)
    {
        $data = $request->all();

        $data = $this->jobService->jobApply($data);

        return $this->success($data);
    }

    /*
     * User Job Notification list.
     *
     * param  \Illuminate\Http\JobApplyRequest  $request
     * return \Illuminate\Http\Response
    */
    public function jobsNotifications (Request $request)
    {
        $data = $this->jobService->jobsNotifications();

        return $this->success('Jobs Notifications',['count'=>count($data),'notifications'=>$data]);
    }
}
