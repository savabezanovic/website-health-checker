<?php

namespace App\Repositories;

use App\ProjectUrl;
use App\Project;

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

  public function store($projectUrlData, $slug)
  {

    $projectUrl = new ProjectUrl();

    $projectUrl->url = $projectUrlData["url"];

    $projectUrl->frequency_id = $projectUrlData["frequency"];

    $project = Project::where("slug", "=", $slug)->first();

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
