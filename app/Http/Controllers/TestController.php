<?php

namespace App\Http\Controllers;

use App\Services\ProjectUrlService;

use App\Repositories\ProjectUrlRepository;
use App\Services\CheckService;
use App\Services\UserService;
use Carbon\Carbon;
// use App\Services\HttpRequestService;
use Exception;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{



    public function __construct(
        ProjectUrlRepository $projectUrl,
        CheckService $checkService,
        UserService $userService,
        ProjectUrlService $projectUrlService
    ) {
        $this->projectUrl = $projectUrl;
        $this->checkService = $checkService;
        $this->userService = $userService;
        $this->projectUrlService = $projectUrlService;
    }



    public function test()
    {

        $urls = $this->projectUrlService->all();

        foreach ($urls as $url) {

            $newCheck = $this->checkService->new();

            if (Carbon::now()->diffInSeconds($url->checked_at) > $url->frequency->seconds) {

                echo "Usao je u glavni if <br>";

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

                echo "SVE RADI DO OVDE <br>";

                $this->projectUrl->saveTestedUrl($testedUrl);

                $this->projectUrl->saveTestedCheck($testedCheck);

                if (!in_array($testedCheck->response_status, range(200, 299)) && $testedUrl->project->up == 1) {

                    $this->projectUrl->saveUrlDown($testedUrl);

                    $this->userService->notifyTeamProjectDown($testedUrl->project->user_id, $testedUrl->project->id);

                    echo "Radi if <br>";
                    
                } else if ($testedUrl->project->up != 1 && in_array($testedCheck->response_status, range(200, 299))) {

                    $this->projectUrl->saveUrlUp($testedUrl);

                    $this->userService->notifyTeamProjectUp($testedUrl->project->user_id, $testedUrl->project->id);

                    echo "Radi else if <br>";
                }
            } else {
                echo "Nije usao u if <br>";
            }
        }
    }
}
