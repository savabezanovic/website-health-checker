<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use App\Services\NotificationTypeService;
use App\Services\NotificationSettingService;


class ProjectController extends Controller
{

  protected $projectService;
  protected $notificationTypeService;
  protected $notificationSettingService;


  public function __construct(ProjectService $projectService, 
  NotificationTypeService $notificationTypeService, 
  NotificationSettingService $notificationSettingService)

  {

    $this->projectService = $projectService;
    $this->notificationTypeService = $notificationTypeService;
    $this->notificationSettingService = $notificationSettingService;
  }

  public function showProjects()

  {

    $projects = $this->projectService->showProjects();

    return view('projects.show-projects')->with("projects", $projects);
  }

  public function showProject($slug)
  {

    $project = $this->projectService->showProject($slug);

    return view("projects.show-project")->with("project", $project);
  }

  public function create()
  {

    return view('projects.create-project');
  }

  public function store(ProjectRequest $request)
  {

    $projectData = $request->all();

    $project = $this->projectService->store($projectData);

    $notificationTypes = $this->notificationTypeService->getAllNotificationTypes();

    $this->notificationSettingService->create($project->id, $notificationTypes);

    return redirect('/projects');
  }

  public function edit($slug)
  {

    $project = $this->projectService->edit($slug);

    return view('projects.edit-project')->with("project", $project);
  }

  public function update(ProjectRequest $request, $slug)
  {

    $attributes = $request->except('_method', '_token');

    $this->projectService->update($slug, $attributes);

    return redirect("/projects");
  }

  public function delete($slug)
  {
    $this->projectService->delete($slug);

    return redirect("/projects");
  }

  public function showNotifications($slug)
  {

    $data = $this->projectService->showNotifications($slug);

    return view("projects.show-notifications")
      ->with("notifications", $data["notifications"])
      ->with("slug", $data["slug"])
      ->with("project", $data["project"]);
  }

  public function notificationSetting($notificationSettingId)
  {
    $this->projectService->notificationSetting($notificationSettingId);
    return back();
  }
}
