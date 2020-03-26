<?php

namespace App\Repositories;

use App\ProjectUrl;
use App\Project;
use Carbon\Carbon;

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
    
    return $projectUrl->update(['frequency_id' => $attributes["frequency"], "url" =>$attributes["url"]]);
  
  }

  public function delete($id)

  {

    return $this->projectUrl->find($id)->delete();
  }
}
