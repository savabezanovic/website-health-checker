<?php

namespace App\Services;

use App\Repositories\ProjectUrlRepository;
use App\Services\CheckService;
use App\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use App\Services\ProjectService;

class ProjectUrlService
{
	public function __construct(
		ProjectUrlRepository $projectUrl,
		ProjectService $projectService,
        CheckService $checkService,
        UserService $userService

	) {
		$this->projectUrl = $projectUrl;
		$this->checkService = $checkService;
		$this->userService = $userService;
		$this->projectService = $projectService;
	}

	public function find($id)
	{
		return $this->projectUrl->find($id);
	}

	public function all()
	{
		return $this->projectUrl->all();
	}

	public function showUrls($slug)
	{
		return $this->projectUrl->showUrls($slug);
	}

	public function store($projectUrlData, $slug)
	{
		return $this->projectUrl->store($projectUrlData, $slug);
	}

	public function update($attributes, $id)
	{
		return $this->projectUrl->update($attributes, $id);
	}

	public function delete($id)
	{
		return $this->projectUrl->delete($id);
	}

	public function testUrl()
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

			if ($projectUp == 0 && in_array(0, $newProjectUp) == false) {

				$this->projectUrl->saveUrlUp($testedUrl);

				$this->userService->notifyTeamProjectUp($testedUrl->project->user_id, $testedUrl->project->id);

			} else if ($projectUp == 1 && in_array(0, $newProjectUp) == true) {

				$this->projectUrl->saveUrlDown($testedUrl);

				$this->userService->notifyTeamProjectDown($testedUrl->project->user_id, $testedUrl->project->id);
				
			}
		}
	}
}
