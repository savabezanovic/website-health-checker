<?php

namespace App\Repositories;

use App\Project;
use App\NotificationSetting;

class ProjectRepository
{

  protected $project;

  public function __construct(Project $project)
  {
    $this->project = $project;
  }

  public function findProjectById($id) {
    return $project = $this->project->find($id); 
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

  public function showNotifications($slug)
  {
    $project = $this->project->where("slug", "=", $slug)->first();

    $notifications = NotificationSetting::where("project_id", "=", $project->id)
    ->where("user_id", "=", auth()->user()->id)
    ->get();

    $data = [
      "project" => $project,
      "notifications" => $notifications,
      "slug" => $slug
    ];

    return $data;
  }

  public function notificationSetting($notificationSettingId)
  {
    $notificationSetting = NotificationSetting::find($notificationSettingId);
    if($notificationSetting->setting === 0) {
      $notificationSetting->setting = 1;
    } else {
      $notificationSetting->setting = 0;
    }
    $notificationSetting->save();
  }

  public function find($slug)
  {

    return $this->project->where('slug', '=', $slug)->first();
  }

  public function update($slug, $attributes)
  {

    $project = $this->project->where('slug', '=', $slug)->first();
  
    return $project->update($attributes);
  }

  public function delete($slug)

  {

    return $this->project->where('slug', '=', $slug)->first()->delete();
  }
}
