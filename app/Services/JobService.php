<?php

namespace App\Services;

use App\Jobs\ImportJobs;
use App\Repositories\JobRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class JobService
{
    protected $jobRepo;

    public function __construct(JobRepository $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    public function convertXmlIntoObjectArray($xmlString)
    {
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
        $vacanciesXml = json_encode($xml);
        $allJobsData = json_decode($vacanciesXml, true);

        return $this->getJobsList($allJobsData);
    }

    public function saveJobsFormatOne($file)
    {
        try {
            $jobs = $this->convertXmlIntoObjectArray($file);
            $jobsData = $this->makeJobModelObjectsFormatOne($jobs);
            $this->jobRepo->saveJobs($jobsData);
            $totalJobs = count($jobsData);

            return $totalJobs.' Jobs Added Successfully';
        } catch (Exception $error) {
            dump($error->getMessage());
        }
    }

    public function saveJobsFormatTwo($file)
    {
        try {
            $jobs = $this->convertXmlIntoObjectArray($file);
            $jobsData = $this->makeJobModelObjectsFormatTwo($jobs);
            $this->jobRepo->saveJobs($jobsData);
            $totalJobs = count($jobsData);

            return $totalJobs.' Jobs Added Successfully';
        } catch (Exception $error) {
            echo $error->getMessage();

            return $error->getMessage();
        }
    }

    public function saveEmployers($file)
    {
        try {
            $jobs = $this->convertXmlIntoObjectArray($file);
            $employer = [];
            if (count($jobs) > 0) {
                $employer = $jobs[0];
                $this->jobRepo->saveEmployer($this->checkEmpty($employer, ['employer', 'sourcename']));
                dump('Employer Added Successfully');
            } else {
                dump('No Employer to be added');
            }
        } catch (Exception $error) {
            dump($error->getMessage());
        }
    }

    public function saveFileAndDispatchImportFileJob($data)
    {
        if (empty($data['jobs_file']) && ! empty($data['jobs_url'])) {
            ImportJobs::dispatch(null, $data['jobs_url']);
        } elseif (! empty($data['jobs_file']) && empty($data['jobs_url'])) {
            $path = Storage::put('files', $data['jobs_file']);
            ImportJobs::dispatch($path, null);
        } elseif (! empty($data['jobs_file']) && ! empty($data['jobs_url'])) {
            $path = Storage::put('files', $data['jobs_file']);
            ImportJobs::dispatch($path, $data['jobs_url']);
        } else {
            return 'No data provided';
        }

        return 'Your request is being processed';
    }

    public function getJobsList($data)
    {
        if (isset($data['Job'])) {
            return $data['Job'];
        } elseif (isset($data['jobs']['job'])) {
            return $data['jobs']['job'];
        } elseif (isset($data['job'])) {
            return $data['job'];
        }

        return [];
    }

    public function makeJobModelObjectsFormatOne($data)
    {
        $jobsData = [];
        foreach ($data as $job) {
            $jobUniqueId = $this->checkEmpty($job, ['company', 'sourcename']).'_'.$this->checkEmpty($job, ['ID', 'referencenumber', 'JobID']);
            if (! $this->jobRepo->findJobByUniqueIndex($jobUniqueId)) {
                $myJob = [];
                $myJob['description'] = $this->checkEmpty($job, ['Job-Description', 'description']);
                $myJob['title'] = $this->checkEmpty($job, ['title', 'JobTitle']);
                $myJob['req_id'] = $this->checkEmpty($job, ['ReqId', 'reqid']);
                $myJob['filter_label'] = isset($job['filter5']['label']) && ! empty($job['filter5']['label']) ? $job['filter5']['label'] : null;
                $myJob['filter_value'] = isset($job['filter5']['value']) && ! empty($job['filter5']['value']) ? $job['filter5']['value'] : null;
                $myJob['ad_code'] = $this->checkEmpty($job, ['adcode']);
                $myJob['brand'] = $this->checkEmpty($job, ['brand']);
                $myJob['campaign_code'] = $this->checkEmpty($job, ['campaigncode']);
                $myJob['category'] = $this->checkEmpty($job, ['category']);
                $myJob['city'] = $this->checkEmpty($job, ['city']);
                $myJob['posted_date'] = $this->checkEmpty($job, ['posteddate', 'created', 'date']);
                $myJob['job_id'] = $this->checkEmpty($job, ['ID', 'referencenumber', 'JobID']);
                $myJob['url'] = $this->checkEmpty($job, ['url']);
                $myJob['state'] = $this->checkEmpty($job, ['state']);
                $myJob['postal_code'] = $this->checkEmpty($job, ['postalcode']);
                $myJob['country'] = $this->checkEmpty($job, ['country']);
                $myJob['job_type'] = $this->checkEmpty($job, ['jobtype', 'Type']);
                $myJob['location'] = $this->checkEmpty($job, ['location']);
                $myJob['multi_location'] = $this->checkEmpty($job, ['multilocation']);
                $myJob['business_unit'] = $this->checkEmpty($job, ['businessunit']);
                $myJob['department'] = $this->checkEmpty($job, ['department', 'dept']);
                $myJob['facility'] = $this->checkEmpty($job, ['facility']);
                $myJob['shift_type'] = $this->checkEmpty($job, ['shifttype', 'shift']);
                $myJob['compensation'] = $this->checkEmpty($job, ['compensation']);
                $myJob['recruiter_id'] = $this->checkEmpty($job, ['recruiterid']);
                $myJob['locale'] = $this->checkEmpty($job, ['locale']);
                $myJob['client_customer'] = $this->checkEmpty($job, ['clientcustomer']);
                $myJob['custom_field_1'] = $this->checkEmpty($job, ['customfield1']);
                $myJob['custom_field_2'] = $this->checkEmpty($job, ['customfield2']);
                $myJob['custom_field_3'] = $this->checkEmpty($job, ['customfield3']);
                $myJob['custom_field_4'] = $this->checkEmpty($job, ['customfield4']);
                $myJob['custom_field_5'] = $this->checkEmpty($job, ['customfield5']);
                $myJob['certification'] = $this->checkEmpty($job, ['certification']);
                $myJob['degree'] = $this->checkEmpty($job, ['degree']);
                $myJob['education'] = $this->checkEmpty($job, ['education']);
                $myJob['travel'] = $this->checkEmpty($job, ['travel']);
                $myJob['product_service'] = $this->checkEmpty($job, ['productservice']);
                $myJob['experience'] = $this->checkEmpty($job, ['experience', 'job_level', 'Experience_Level']);
                $myJob['job_poster_email_address'] = $this->checkEmpty($job, ['JobPosterEmailAddress']);
                $myJob['contract_id'] = $this->checkEmpty($job, ['ContractID']);
                $myJob['employer_id'] = $this->checkEmpty($job, ['EmployerID']);
                $myJob['industries'] = $this->checkEmpty($job, ['Industries']);
                $myJob['job_function'] = $this->checkEmpty($job, ['JobFunction']);
                $myJob['segments'] = $this->checkEmpty($job, ['segments']);
                $myJob['major_market'] = $this->checkEmpty($job, ['majormarket']);
                $myJob['secondary_market'] = $this->checkEmpty($job, ['secondarymarket']);
                $myJob['employer'] = $this->checkEmpty($job, ['company', 'sourcename']);
                $myJob['created_at'] = Carbon::now();
                $myJob['updated_at'] = Carbon::now();
                $myJob['job_unique_id'] = $jobUniqueId;
                array_push($jobsData, $myJob);
            }
        }

        return $jobsData;
    }

    public function makeJobModelObjectsFormatTwo($data)
    {
        $vacanciesData = [];
        foreach ($data as $job) {
            $company = isset($job['company']['name']) && ! empty($job['company']['name']) ? $job['company']['name'] : null;
            $reqId = $this->checkEmpty($job, ['ReqId', 'reqid']);
            $jobUniqueId = $company.'_'.$reqId;
            if (! $this->jobRepo->findJobByUniqueIndex($jobUniqueId)) {
                $myJob = [];
                $myJob['employer'] = $company;
                $myJob['description'] = isset($job['position']['description']) && ! empty($job['position']['description']) ? preg_replace('#<!\[CDATA\[(.+?)\]\]>#s', '$1', $job['position']['description']) : null;
                $myJob['title'] = isset($job['position']['title']) && ! empty($job['position']['title']) ? $job['position']['title'] : null;
                $myJob['is_remote'] = isset($job['position']['isRemote']) && ! empty($job['position']['isRemote']) ? $job['position']['isRemote'] : null;
                $myJob['city'] = isset($job['position']['city']) && ! empty($job['position']['city']) ? $job['position']['city'] : null;
                $myJob['country'] = isset($job['position']['country']) && ! empty($job['position']['country']) ? $job['position']['country'] : null;
                $myJob['location'] = isset($job['position']['location']) && ! empty($job['position']['location']) ? $job['position']['location'] : null;
                $myJob['workplace_types'] = isset($job['position']['workplaceTypes']) && ! empty($job['position']['workplaceTypes']) ? $job['position']['workplaceTypes'] : null;
                $myJob['job_function'] = isset($job['position']['job-functions']['job-function']['code']) && ! empty($job['position']['job-functions']['job-function']['code']) ? $job['position']['job-functions']['job-function']['code'] : null;
                $myJob['industries'] = isset($job['position']['industries']['industry']['code']) && ! empty($job['position']['industries']['industry']['code']) ? $job['position']['industries']['industry']['code'] : null;
                $myJob['experience'] = isset($job['experience-level']['code']) && ! empty($job['experience-level']['code']) ? $job['experience-level']['code'] : null;
                $myJob['req_id'] = $reqId;
                $myJob['job_type'] = $this->checkEmpty($job, ['job_type']);
                $myJob['job_level'] = $this->checkEmpty($job, ['job_level']);
                $myJob['experience'] = isset($job['position']['experience-level']['code']) && ! empty($job['position']['experience-level']['code']) ? $job['position']['experience-level']['code'] : null;
                $myJob['url'] = isset($job['how-to-apply']['application-url']) && ! empty($job['how-to-apply']['application-url']) ? $job['how-to-apply']['application-url'] : null;
                $myJob['created_at'] = Carbon::now();
                $myJob['updated_at'] = Carbon::now();
                $myJob['job_unique_id'] = $jobUniqueId;
                array_push($vacanciesData, $myJob);
            }
        }

        return $vacanciesData;
    }

    public function checkEmpty($array, $keys)
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $array) && ! empty($array[$key])) {
                return $array[$key];
            }
        }

        return null;
    }

    /*
     * Service function for Search jobs for applicants based on selected filters.
     *
     * param  Request array
     * return array
    */

    public function findYouJobs($data)
    {
        return $this->jobRepo->findYouJobs($data);
    }

    /*
     * Service function for Search jobs for applicants based on selected filters.
     *
     * param  Request array
     * return array
    */

    public function searchJobsWithTitle($data)
    {
        return $this->jobRepo->searchJobsWithTitle($data);
    }

    /*
     * Service function for Applicants Apply Jobs.
     *
     * param  Request array
     * return jobApply instance
    */

    public function jobApply($data)
    {
        return $this->jobRepo->jobApply($data);
    }

     /*
     * Service function for Get Job Notifications.
     *
     * return jobApply instance
    */
    public function jobsNotifications()
    {
        return $this->jobRepo->jobsNotifications();
    }
}
