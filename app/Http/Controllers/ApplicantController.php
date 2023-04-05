<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantSearchRequest;
use App\Http\Traits\ApiResponseBuilder;
use App\Services\ApplicantService;
use App\Http\Requests\ApplicantDocsRequest;
use App\Http\Requests\SaveJobsRequest;
use Illuminate\Http\Request;
class ApplicantController extends Controller
{
    use ApiResponseBuilder;

    protected $applicantService;

    public function __construct(ApplicantService $applicantService)
    {
        $this->applicantService = $applicantService;
    }

    /**
     * Applicant Searching Controller function.
     * param  \Illuminate\Http\ApplicantSearchRequest  $request
     * return \Illuminate\Http\Response
     */
    public function searchApplicants(ApplicantSearchRequest $request)
    {
        $data = $request->all();
        $data = $this->applicantService->findApplicants($data);

        return $this->success('Applicants List',['count'=>count($data),'Applicants'=>$data]);
    }

    /**
     * Applicant Update Docs Controller function.
     * param  \Illuminate\Http\ApplicantDocsRequest  $request
     * return \Illuminate\Http\Response
     */
    public function uploadApplicantDocs(ApplicantDocsRequest $request)
    {
        $user = $this->applicantService->uploadApplicantDocs($request);

        return $this->success('Updated Successfully', $user, 201);
    }

    /**
     * Applicant Update Skills Controller function.
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function updateApplicantSkills(Request $request)
    {
        $user = $this->applicantService->updateApplicantSkills($request);

        return $this->success('Updated Successfully', $user, 201);
    }

    /**
     * Applicant Update Description Controller function.
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function updateApplicantDescription(Request $request)
    {
        $user = $this->applicantService->updateApplicantDescription($request);

        return $this->success('Updated Successfully', $user, 201);
    }

    /**
     * Applicant Save Favourite Job Controller function.
     * param  \Illuminate\Http\SaveJobsRequest  $request
     * return \Illuminate\Http\Response
     */
    public function saveApplicantFavourite(SaveJobsRequest $request)
    {
        $user = $this->applicantService->saveApplicantFavourite($request);

        return $this->success('Job Added in Favourite Successfully', $user, 201);
    }

    /**
     * Applicant Favourite List Controller function.
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function applicantSavedJobslist(Request $request)
    {
        $data = $this->applicantService->applicantSavedJobslist($request);

        return $this->success('Jobs List',['count'=>count($data),'Jobs'=>$data]);
    }

    /**
     * Applicant Applied Jobs List Controller function.
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
    */
    public function applicantAppliedJobslist(Request $request)
    {
        $data = $this->applicantService->applicantAppliedJobslist($request);

        return $this->success('Jobs List',['count'=>count($data),'Jobs'=>$data]);
    }
}
