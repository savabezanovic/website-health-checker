<?php

namespace App\Services;

use App\Repositories\ProjectUrlRepository;
use App\Services\CheckService;
use App\Services\UserService;

class ProjectUrlService
{
	public function __construct(ProjectUrlRepository $projectUrl, CheckService $checkService, UserService $userService)
	{
		$this->projectUrl = $projectUrl;
		$this->checkService = $checkService;
		$this->userService = $userService;
	}

	public function find($id)
	{
		return $this->projectUrl->find($id);
	}

	public function all()
	{
		return $this->projectUrl->all();
	}

	public function showUrls($slug)
	{
		return $this->projectUrl->showUrls($slug);
	}

	public function store($projectUrlData, $slug)
	{
		return $this->projectUrl->store($projectUrlData, $slug);
	}

	public function update($attributes, $id)
	{
		return $this->projectUrl->update($attributes, $id);
	}

	public function delete($id)
	{
		return $this->projectUrl->delete($id);
	}

	public function testUrl($url)
	{
		$newCheck = $this->checkService->new();
		$userService = $this->userService;
		return $this->projectUrl->testUrl($url, $newCheck, $userService);
	}
}
