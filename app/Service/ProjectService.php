<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectService
{
	public function __construct(ProjectRepository $project)
	{
		$this->project = $project ;
	}

	public function index()
	{
		return $this->project->all();
	}

        public function store($projectData)
	{
         
        return $this->project->store($projectData);
	}

	public function edit($slug)
	{
     return $this->project->find($slug);
	}

	public function update(Request $request, $slug)
	{
	  $attributes = $request->all();
	  
      return $this->project->update($slug, $attributes);
	}

	public function delete($slug)
	{
      return $this->project->delete($slug);
	}
}