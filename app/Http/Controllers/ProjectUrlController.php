<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectUrlRequest;
use App\Services\ProjectUrlService;

class ProjectUrlController extends Controller
{



    protected $projectUrlService;

    public function __construct(ProjectUrlService $projectUrlService)

    {

        $this->middleware('auth');
        $this->projectUrlService = $projectUrlService;
    }

    public function store(ProjectUrlRequest $request, $slug)
    {

        $projectUrlData = $request->all();

        $this->projectUrlService->store($projectUrlData, $slug);

        return redirect('/project/edit/' . $slug);
    }

    // public function delete($id)
    // {

    //     $projectUrl = $this->projectUrlService->find($id);

    //     $projectSlug = $projectUrl->project->slug;

    //     $this->projectUrlService->delete($projectUrl->id);

    //     return redirect("/project/edit/" . $projectSlug);

    // }

    public function delete($id) {
        
        $this->projectUrlService->delete($id);

        return redirect()->back();
    }
}
