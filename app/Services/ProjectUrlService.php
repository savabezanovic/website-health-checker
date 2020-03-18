<?php

namespace App\Services;

use App\Repositories\ProjectUrlRepository;
use Illuminate\Http\Request;

class ProjectUrlService
{
	public function __construct(ProjectUrlRepository $projectUrl)
	{
		$this->projectUrl = $projectUrl;
	}

	public function find($id)
	{
		return $this->projectUrl->find($id);
	}

	public function store($projectUrlData, $slug)
	{
		return $this->projectUrl->store($projectUrlData, $slug);
	}

	public function delete($id)
	{
		return $this->projectUrl->delete($id);
	}
}
