<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendUserNotification;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class JobSuggestionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:job_suggestions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Job Suggestions';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $jobs = Job::where('created_at', '>=', Carbon::now()->subHour())->get();
        //dd($jobs);
        //$users = [];
        foreach($jobs as $job){
           $users = Applicant::with('user')
            ->where('job_title', 'like', '%' .$job->title . '%')
            ->orWhere('skills', 'like', '%' .$job->title . '%')
            ->orWhere('job_type', 'like', '%' .$job->job_type . '%')
            ->orWhere('location', 'like', '%' .$job->location . '%')->limit(5)->get();

            foreach($users as $user){
                if($user->user){
                    Mail::to($user->user->email)->send(new SendUserNotification('Job Suggestions', "tetststsestees"));
                }
                //sleep(1);
            }
        }

        echo "OK";
    }
}
