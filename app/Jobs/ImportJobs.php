<?php

namespace App\Jobs;

use App\Services\JobService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImportJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    protected $url;

    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filePath, $url)
    {
        $this->filePath = $filePath;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(JobService $jobService)
    {
        try {
            if (! empty($this->filePath)) {
                $file = Storage::get($this->filePath);
                $jobService->saveJobsFormatOne($file);
                Storage::delete($this->filePath);
            }
            if (! empty($this->url)) {
                $timeout = 2400;
                $fileByUrl = Http::timeout($timeout)->connectTimeout($timeout)->get($this->url)->body();
                $jobService->saveJobsFormatOne($fileByUrl);
            }
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }
}
