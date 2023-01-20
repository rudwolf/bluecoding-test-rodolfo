<?php

namespace App\Jobs;

use App\Services\CrawlService;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCrawlUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // url to be crawled
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url = 'https://www.lipsum.com')
    {
        if (empty($url)) {
            $url = 'https://www.lipsum.com'; // force lipsum when empty url
        }
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //# initiate crawler
        CrawlService::crawl($this->url);
    }
}
