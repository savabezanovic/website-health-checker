<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use App\Services\FrequencyService;

class ProjectController extends Controller
{

  protected $projectService;
  protected $frequencyService;

  public function __construct(ProjectService $projectService, FrequencyService $frequencyService)

  {

    $this->projectService = $projectService;
    $this->frequencyService = $frequencyService;
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

    $this->projectService->store($projectData);

    return redirect('/projects');
  }

  public function edit($slug)
  {

    $frequencies = $this->frequencyService->all();

    $project = $this->projectService->edit($slug);

    return view('projects.edit-project')->with("project", $project)->with("frequencies", $frequencies);
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
}
