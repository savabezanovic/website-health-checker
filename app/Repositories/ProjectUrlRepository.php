<?php

namespace App\Repositories;

use App\ProjectUrl;
use App\Project;
use Carbon\Carbon;
use Exception;


use Illuminate\Support\Facades\Http;

class ProjectUrlRepository
{

  protected $projectUrl;

  public function __construct(ProjectUrl $projectUrl)
  {
    $this->projectUrl = $projectUrl;
  }

  public function find($id)
  {
    return $this->projectUrl->find($id);
  }

  public function showUrls($slug)
  {

    $project = Project::where("slug", "=", $slug)->first();

    $projectUrls = $this->projectUrl->where("project_id", "=", $project->id)->get();

    return $projectUrls;
  }

  public function all()
  {

    $urls = ProjectUrl::get();

    return $urls;
  }

  public function store($projectUrlData, $slug)
  {

    $projectUrl = new ProjectUrl();

    $projectUrl->url = $projectUrlData["url"];

    $projectUrl->frequency_id = $projectUrlData["frequency"];

    $project = Project::where("slug", "=", $slug)->first();

    $projectUrl->checked_at = Carbon::now();

    $projectUrl->project_id = $project->id;

    $projectUrl->save();
  }

  public function update($attributes, $id)
  {

    $projectUrl = $this->projectUrl->find($id);

    return $projectUrl->update(['frequency_id' => $attributes["frequency"], "url" => $attributes["url"]]);
  }

  public function delete($id)

  {

    return $this->projectUrl->find($id)->delete();
  }

  public function testUrl($url, $newCheck, $userService)
  {

    if (Carbon::now()->diffInSeconds($url->checked_at) > $url->frequency->seconds) {

      // $check = $this->checkService->new();

      $check = $newCheck;

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

        // $this->userService->notifyCreatorProjectUp($url->project->user_id);

        $userService->notifyCreatorProjectUp($url->project->user_id);

        // $url->project->creator->notify(new ProjectDownNotification());

      } else if ($url->project->up != 1 && in_array($check->response_status, range(200, 299))) {

        $url->project->up = 1;

        $url->project->save();

        // $url->project->creator->notify(new ProjectUpNotification());

        $userService->notifyCreatorProjectDown($url->project->user_id);
      }
    }
  }
}
