<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProjectService;
use App\Services\ProjectUrlService;

class CheckUrl extends Command
{

    protected $signature = 'command:checkUrl';

    protected $description = 'Check Url and save status ';

    protected $projectService;

    protected $userService;

    public function __construct(ProjectService $projectService, ProjectUrlService $projectUrlService)

    {

        parent::__construct();

        $this->projectService = $projectService;
        $this->projectUrlService = $projectUrlService;
    }

    public function handle()

    {

        $urls = $this->projectUrlService->all();

        foreach ($urls as $url) {

            $this->projectUrlService->testUrl($url);
        }
    }
}
