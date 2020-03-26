<?php

namespace App\Console\Commands;

use App\Check;
use App\ProjectUrl;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Services\ProjectService;

class CheckUrl extends Command
{

    protected $signature = 'command:checkUrl';

    protected $description = 'Check Url and save status ';
    protected $projectService;

    public function __construct(ProjectService $projectService)

    {

        parent::__construct();
        $this->projectService = $projectService;
    }

    public function handle()

    {
        $urls = ProjectUrl::all();

        foreach ($urls as $url) {

            if (Carbon::now()->diffInSeconds($url->checked_at) > $url->frequency->seconds) {

                $check = new Check();

                $timeBefore = Carbon::now();

                try {

                    $response = Http::get($url->url);

                    $check->response_status = $response->status();

                } catch (Exception $e) {

                    $check->response_status = 0;
                    
                }

                $timeAfter = Carbon::now();

                $check->url_id = $url->id;

                $check->response_time = $timeAfter->diffInMilliseconds($timeBefore);

                $url->checked_at = Carbon::now();

                $url->save();

                $check->save();

                if (!in_array($check->response_status, range(200, 299)) && $url->project->up == 1) {

                    $url->project->up = 0;

                    $url->project->save();

                    $this->projectService->projectDown($url->project->user_id);

                }

                else if($url->project->up != 1 && in_array($check->response_status, range(200, 299))) {

                    // $url->project->creator->notify(new ProjectUpEmail());
                    $url->project->up = 1;
                    $url->project->save();

                    $this->projectService->projectUp($url->project->user_id);
                    
                }

            }
        }
    }
}
