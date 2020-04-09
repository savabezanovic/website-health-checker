<?php

namespace App\Services;


use App\Repositories\ProjectRepository;

class ProjectService
{
	public function __construct(ProjectRepository $project)
	{
		$this->project = $project;
	}

	public function findProjectById($id) {
		return $this->project->findProjectById($id);
	}

	public function showProjects()
	{
		return $this->project->showProjects();
	}

	public function showProject($slug)
	{
		return $this->project->showProject($slug);
	}

	public function showNotifications($slug)
	{
		return $this->project->showNotifications($slug);
	}

	public function notificationSetting($notificationSettingId)
	{
		return $this->project->notificationSetting($notificationSettingId);
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

}
