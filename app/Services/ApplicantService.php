<?php

namespace App\Services;

use App\Repositories\ApplicantRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class ApplicantService
{
    protected $jobRepo;

    /**
     * Applicant Service.
    */
    public function __construct(ApplicantRepository $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    /**
     * Applicant Searching Service Function.
     * Parma Request array $data
     * return Array
    */
    public function findApplicants($data)
    {
        return $this->jobRepo->findApplicants($data);
    }

    /**
     * Applicant Upload Docs Service Function.
     * Parma Request $request
     * return Array
    */
    public function uploadApplicantDocs($request)
    {
        return $this->jobRepo->uploadApplicantDocs($request);
    }

    /**
     * Applicant Update Skills Service Function.
     * Parma Request $request
     * return Array
    */
    public function updateApplicantSkills($request)
    {
        return $this->jobRepo->updateApplicantSkills($request);
    }

    /**
     * Applicant Searching Service Function .
     * Parma Request $request
     * return Array
    */
    public function updateApplicantDescription($request)
    {
        return $this->jobRepo->updateApplicantDescription($request);
    }

    /**
     * Applicant Save Favourite Job Service Function.
     * Parma Request $request
     * return Array
    */
    public function saveApplicantFavourite($request)
    {
        return $this->jobRepo->saveApplicantFavourite($request);
    }

    /**
     * Applicant Favourite Jobs List Service Function.
     * Parma
     * return Array
    */
    public function applicantSavedJobslist()
    {
        return $this->jobRepo->applicantSavedJobslist();
    }

    /**
     * Applicant Applied Jobs List Service Function .
     * Parma
     * return Array
    */
    public function applicantAppliedJobslist()
    {
        return $this->jobRepo->applicantAppliedJobslist();
    }
}
