<?php

namespace App\Http\Controllers;

use App\Services\ProjectUrlService;
use App\Services\ProjectService;
use App\Repositories\ProjectUrlRepository;
use App\Services\CheckService;
use App\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{



    public function __construct(
        ProjectUrlRepository $projectUrl,
        CheckService $checkService,
        UserService $userService,
        ProjectUrlService $projectUrlService,
        ProjectService $projectService
    ) {
        $this->projectUrl = $projectUrl;
        $this->checkService = $checkService;
        $this->userService = $userService;
        $this->projectUrlService = $projectUrlService;
        $this->projectService = $projectService;
    }



    public function test()
    {
        $projects = $this->projectService->showProjects();

        foreach ($projects as $project) {

            $projectUp = $project->up;

            $newProjectUp = [];

            foreach ($project->projectUrls as $url) {

                $newCheck = $this->checkService->new();

                if (Carbon::now()->diffInSeconds($url->checked_at) > $url->frequency->seconds) {
                    
                    $timeBefore = Carbon::now();

                    try {

                        $response = Http::get($url->url);

                        $newCheck->response_status = $response->status();
                    } catch (Exception $e) {

                        $newCheck->response_status = 0;
                    }

                    $timeAfter = Carbon::now();

                    $newCheck->url_id = $url->id;

                    $newCheck->response_time = $timeAfter->diffInMilliseconds($timeBefore);

                    $url->checked_at = Carbon::now();

                    $results  = [
                        "testedCheck" => $newCheck,
                        "testedUrl" => $url
                    ];

                    $testedCheck = $results["testedCheck"];

                    $testedUrl = $results["testedUrl"];

                    $this->projectUrl->saveTestedUrl($testedUrl);

                    $this->projectUrl->saveTestedCheck($testedCheck);

                    if (!in_array($testedCheck->response_status, range(200, 299))) {

                        $newProjectUp[] += 0; 
                        
                    } else if (in_array($testedCheck->response_status, range(200, 299))) {
                       
                        $newProjectUp[] += 1;

                    }
                }
            }

            var_dump($projectUp);
            echo "<br>";
            var_dump($newProjectUp);

            if ($projectUp == 0 && in_array(0, $newProjectUp) == false) {

                echo "Project UP";

                $this->userService->notifyTeamProjectUp($testedUrl->project->user_id, $testedUrl->project->id);

                $this->projectUrl->saveUrlUp($testedUrl);

            } else if ($projectUp == 1 && in_array(0, $newProjectUp) == true) {

                echo "Project DOWN";

                $this->userService->notifyTeamProjectDown($testedUrl->project->user_id, $testedUrl->project->id);

                $this->projectUrl->saveUrlDown($testedUrl);
            }
        }
    }
}
