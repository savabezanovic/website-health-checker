<?php

namespace App\Repositories;

use App\Project;

class ProjectRepository
{

  protected $project;

  public function __construct(Project $project)
  {
    $this->project = $project;
  }
  public function store($projectData)
  {

    $project = new Project();
    $project->name = $projectData["name"];
    $project->user_id = auth()->user()->id;

    $project->save();
  }

  public function showProjects()
  {
    return $this->project->all();
  }

  public function showProject($slug)
  {
    return $this->project->where('slug', '=', $slug)->first();
  }

  public function find($slug)
  {

    return $this->project->where('slug', '=', $slug)->first();
  }

  public function update($slug, $attributes)
  {

    $project = $this->project->where('slug', '=', $slug)->first();
    
    //$project->slug = null;
    //$project->save();
    
    return $project->update($attributes);

    //return $this->project->where('slug', '=', $slug)->update($attributes);
  }

  public function delete($slug)

  {

    return $this->project->where('slug', '=', $slug)->first()->delete();
  }
}
