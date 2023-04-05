<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendUserNotification;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Job;
use App\Models\SaveJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class JobExpiredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:job_expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Job Expired';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $jobs = Job::where('created_at', '>=', Carbon::now()->subDay(10))->get()->pluck('id')->toArray();
        $savedJob = SaveJob::whereIn('job_id',$jobs)->with('user')->get();

        foreach($savedJob as $user){
            if($user->user){
                Mail::to($user->user->email)->send(new SendUserNotification('Job Expired', "Job Expired"));
            }
        }

        echo"OK";
    }
}
