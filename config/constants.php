<?php

return [
    'job_links_format_1' => [
        'https://aexp.eightfold.ai/careers/feed?domain=aexp.com&target=indeed&start=0&limit=100&utm_source=BlackNorth',
        'https://careers.deloitte.ca/feed/383300',
        'https://jobs.scotiabank.com/feed/214117',
        'https://jobs.opg.com/feed/351460',

        // 'https://jobfeed.testing.equest.com/1.0/boards/3b16elabsskgs84t10hnpeh25t/jobs', too diff format, will add a speerate command for it or functions
        // 'https://client.hrservicesinc.com/downloads/rss/portals/2072.xml', Failed to connect to client.hrservicesinc.com port 443:
        // 'https://careers.adidas-group.com/jobs/feed.xml', NOT WORKING TOO MUCH DATA NOT PAGINATED
    ],
    'job_links_format_2' => [
        'https://aexp.eightfold.ai/careers/feed?domain=aexp.com&target=linkedin&start=0&limit=100&utm_source=BlackNorth',
    ],
];

//description present in all links --- job_links_format_2
/** FIRST LINK
  "title" => " Manager Compliance (m/f/d), Frankfurt am Main "
  "url" => " https://aexp.eightfold.ai/careers/job/14728283?domain=aexp.com&utm_source=BlackNorth "
  "city" => " Frankfurt "
  "state" => " HE,DE "
  "country" => " DE "
  "date" => " Wed, 07 Dec 2022 16:10:17 GMT "
  "company" => " Amex "
  "sourcename" => " Amex "
  "category" => " A756497 - International Market "
  "reqid" => " 22032839 "
  "hide-on-indeed" => " false "
  "job_level" => " Manager "
  "referencenumber" => " 22032839-en-1 "
 */

/** SECOND LINK
 "title" => "Manager, M&A Transaction Services, Montreal- Future opportunity"
 "date" => "Fri, 02 12 2022 00:00:00 GMT"
 "referencenumber" => "122525-en_US"
 "url" => "https://careers.deloitte.ca/job/Montreal%2C-Quebec%2C-Canada-Manager%2C-M&A-Transaction-Services%2C-Montreal-Future-opportunity-QC/966011500/?feedId=383300&utm_source=CABlackNorth&utm_campaign=Deloitte_BlackNorth"
 "company" => "Deloitte"
 "location" => "Montreal, Quebec, Canada"
 "category" => []
 "department" => "Financial Advisory"
 "jobtype" => "Permanent"
 "degree" => []
 "education" => []
 "shift" => []
 "experience" => []
 */

/** THIRD LINK
"date" => "Tue, 17 01 2023 00:00:00 GMT"
"title" => "Customer Experience Lead - Gatineau, QC (26.25 hours)"
"url" => "https://jobs.scotiabank.com/job/Gatineau-Customer-Experience-Lead-Gatineau%2C-QC-%2826_25-hours%29-QC-J8P1E3/566838917/?feedId=214117&utm_source=LinkedInJobPostings&utm_campaign=ScotiaBank_Linkedin"
"company" => "Scotiabank"
"city" => "Gatineau"
"state" => "QC"
"postalcode" => "J8P1E3"
"country" => "CA"
"location" => "Gatineau, QC, CA, J8P1E3"
"JobFunction" => "First-Line Supervisors, Customer Service"
"Type" => "PERMANENT"
"Experience_Level" => "0"
"Industries" => []
"CompanyID" => []
"ContractID" => []
"JobID" => "171423-en_US"
"JobPosterEmailAddress" => "09168479"
"posteddate" => []
"jobtype" => []
 */

/** FOURTH LINK
  "title" => "Executive Administrative Assistant"
  "date" => "Fri, 17 02 2023 00:00:00 GMT"
  "referencenumber" => "41670-en_GB"
  "url" => "https://jobs.opg.com/job/Pickering-Executive-Administrative-Assistant-ON-L1W-3J2/567925717/?feedId=351460&utm_source=CABlackNorth&utm_campaign=ONPower_BlackNorth"
  "company" => "Ontario Power Generation"
  "location" => "Pickering, ON, CA, L1W 3J2"
  "category" => "Supply Chain"
  "department" => "Chief Administrative Office"
  "jobtype" => "Regular Full Time"
  "degree" => []
  "education" => []
  "shift" => []
  "experience" => []
*/

/** description is present in all linkgs --- job_links_format_2
 [
    "company" => array:1 [
        "name" => "Amex"
    ]
    "position" => array:11 [
        "title" => "Engineer II"
        "description" => "some long text"
        "isRemote" => "No"
        "city" => "Bengaluru"
        "country" => "India"
        "location" => "Bengaluru, Karnataka, India"
        "workplaceTypes" => "Hybrid"
        "job-functions" => array:1 [
        "job-function" => array:1 [
            "code" => "othr"
        ]
        ]
        "industries" => array:1 [
        "industry" => array:1 [
            "code" => "othr"
        ]
        ]
        "job-type" => array:1 [
        "code" => "F"
        ]
        "experience-level" => array:1 [
        "code" => "ENTRY_LEVEL"
        ]
    ]
    "how-to-apply" => array:1 [
        "application-url" => "https://aexp.eightfold.ai/careers/job/15285961?domain=aexp.com&utm_source=BlackNorth"
    ]
    "reqid" => "23002948"
    "hide-on-linkedin" => "false"
    "job_level" => "Individual Contributor"
    "job_type" => "contractor"
    "work_location_option" => "Hybrid"
  ]
 */
