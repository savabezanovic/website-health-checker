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

    return $this->project;

  }
  
  public function all()
  {
    return $this->project->all();
  }

  public function find($slug)
  {
   return $this->project->find($slug);
  }
  
  public function update($slug, array $attributes)
  {
  return $this->project->find($slug)->update($attributes);
  }
 
  public function delete($slug)
  {
   return $this->project->find($slug)->delete();
  }
}