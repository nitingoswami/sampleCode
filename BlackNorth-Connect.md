
Search Jobs
    - URL: http://blacknorth-connect.test/api/search/jobs
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
    - Body: { "title": "Architecture","location":"India","industries":"IT","job_type":"type","posted_date":"1" }

Recommended Job Search
    - URL: http://blacknorth-connect.test/api/search/recommended-job
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
    - Body: { "title": "Architecture" }

Search Applicants
    - URL: http://blacknorth-connect.test/api/search/applicants
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
    - Body: { "title": "user name","skills":"skills","education":"education","country":"country","address":"address","experience":"experience"}

Job Apply
    - URL: http://blacknorth-connect.test/api/job-apply
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body: { "job_id": "1","employer_id": "1"}

Get Notifications
    - URL: http://blacknorth-connect.test/api/get-jobs-notifications
    - Method: GET
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:

Send Notifications
    - URL: http://blacknorth-connect.test/api/send-notification
    - Method: GET
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
    - Body:

Update Applicants Profile
    - URL: http://blacknorth-connect.test/api/update-applicant-profile
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{name:"",email:"",language:[],skills:[] ...}

Add Applicants Experience
    - URL: http://blacknorth-connect.test/api/add-applicant-experience
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"title": "", "company_name" :"","start_date":""}

Update Applicants Experience
    - URL: http://blacknorth-connect.test/api/add-applicant-experience
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"title": "", "company_name" :"","start_date":"","id":""}

Add Applicants Education
    - URL: http://blacknorth-connect.test/api/add-applicant-education
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"school": "", "start_date" :""}

Update Applicants Education
    - URL: http://blacknorth-connect.test/api/add-applicant-education
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"school": "", "start_date" :"", "id":1}

Update Applicants Avatar/Resume
    - URL: http://blacknorth-connect.test/api/upload-user-docs
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"file": "", "type" :"resume or avatar"}

Update Applicants Skills
    - URL: http://blacknorth-connect.test/api/update-user-skills
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"skills": [],}

Update Applicants About
    - URL: http://blacknorth-connect.test/api/update-user-description
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"About": "",}

Applicant Save Job
    - URL: http://blacknorth-connect.test/api/applicant-save-job
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{"job_id": ""}

Applicant Save Job Listing
    - URL: http://blacknorth-connect.test/api/applicant-saved-jobslist
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{}

Applicant Applied Job Listing
    - URL: http://blacknorth-connect.test/api/applicant-applied-jobslist
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{}

Send New Message Notifications
    - URL: http://blacknorth-connect.test/api/send-notification
    - Method: GET
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
    - Body:{"type"=>"new_message"}

Cron Job For Saved Job Expired
    - Command: php artisan command:job_expired
    - Schedule : evvery day

Cron Job For Saved Job Expired
    - Command: php artisan command:job_suggestions
    - Schedule : evvery hour

Update Applicants Personal Info
    - URL: http://blacknorth-connect.test/api/update-applicant-personal-info
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{name:"",email:"",avatar: <image>,language:[],skills:[] ...}

Delete user account
    - URL: http://blacknorth-connect.test/api/delete-account
    - Method: POST
    - Headers:
        - Accept: application/json
        - Content-Type: application/json
        - 'Authorization: Bearer <toekn>
    - Body:{}
