<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectService
{
	public function __construct(ProjectRepository $project)
	{
		$this->project = $project;
	}

	public function showProjects()
	{
		return $this->project->showProjects();
	}

	public function showProject($slug)
	{
		return $this->project->showProject($slug);
	}

	public function store($projectData)
	{

		return $this->project->store($projectData);
	}

	public function edit($slug)
	{
		return $this->project->find($slug);
	}


	public function update($request, $slug)
	{

		$attributes = $request->except('_method', '_token');

		return $this->project->update($slug, $attributes);
	}

	public function delete($slug)
	{
		return $this->project->delete($slug);
	}
}
