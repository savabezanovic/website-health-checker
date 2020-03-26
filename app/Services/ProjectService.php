<?php

namespace App\Services;


use App\Repositories\ProjectRepository;
use App\Mail\ProjectDownNotification;
use App\Mail\ProjectUpNotification;
use App\Project;
use App\User;

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


	public function update($slug, $attributes)
	{
		return $this->project->update($slug, $attributes);
	}

	public function delete($slug)
	{
		return $this->project->delete($slug);
	}

	public function projectDown($id)
	{
		$user = User::find($id);
		$user->notifyDown();
	}

	public function projectUp($id)
	{
		$user = User::find($id);
		$user->notifyUp();
		
	}

}
