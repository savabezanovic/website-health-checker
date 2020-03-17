<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;

class ProjectController extends Controller
{ 

	protected $projectservice;

	public function __construct(ProjectService $projectservice)
	{
		  $this->projectservice = $projectservice;
  }
  
    public function index(){
       
    $projects = $this->projectservice->index();
     
    return view('home', compact('projects'));
    }

    public function show($slug)
    {
      return view("read", compact("projects"));
    }

    public function create() {

      return view('create-project');

    }

    public function store(ProjectRequest $request) {

      $projectData = $request->all();

      $this->projectservice->store($projectData);

      return redirect('/');

    }

    public function edit($slug)
    {
       
       $project = $this->projectservice->edit($slug);

       return view('edit', compact('project'));

    }

    public function update(ProjectService $request, $slug)
    {

      $this->projectservice->update($request, $slug);

     return redirect()->back()->with('status', 'Project has been updated succesfully');
    }

    public function delete($slug)
    {
     $this->projectservice->delete($slug);

     return back()->with(['status'=>'Deleted successfully']);
    }
}