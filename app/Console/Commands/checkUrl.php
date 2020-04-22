<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProjectUrlService;

class CheckUrl extends Command
{

    protected $signature = 'command:checkUrl';

    protected $description = 'Check Url and save status ';

    protected $projectUrlService;

    public function __construct(ProjectUrlService $projectUrlService)

    {

        parent::__construct();
        $this->projectUrlService = $projectUrlService;
    }

    public function handle()

    {
        $this->projectUrlService->testUrl();
    }
}
