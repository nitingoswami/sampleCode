<?php

namespace App\Console\Commands;

use App\Services\JobService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AddEmployersData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:employers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(JobService $jobService)
    {
        $timeout = 2400;
        set_time_limit($timeout);
        $jobLinks = config('constants.job_links');
        foreach ($jobLinks as $link) {
            try {
                dump('*********START*****'.$link.'**********');
                $fileByUrl = Http::timeout($timeout)->connectTimeout($timeout)
                ->get($link)
                ->body();
                $jobService->saveEmployers($fileByUrl);
                dump('*********END*****'.$link.'**********');
            } catch (Exception $err) {
                dump($err->getMessage());
                dump('*********ERROR-END*****'.$link.'**********');

                continue;
            }
        }

        return Command::SUCCESS;
    }
}
