<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectUrlRequest;
use App\Services\ProjectUrlService;
use App\Services\FrequencyService;

class ProjectUrlController extends Controller
{



    protected $projectUrlService;

    public function __construct(ProjectUrlService $projectUrlService, FrequencyService $frequencyService)

    {

        $this->middleware('auth');
        $this->projectUrlService = $projectUrlService;
        $this->frequencyService = $frequencyService;
    }

    public function showUrls($slug)
    {
        $projectUrls = $this->projectUrlService->showUrls($slug);

        return view("urls.show-urls")->with("slug", $slug)->with("projectUrls", $projectUrls);
    }

    public function add($slug)
    {
        $frequencies = $this->frequencyService->all();

        return view("urls.add-url")->with("slug", $slug)->with("frequencies", $frequencies);

    }

    public function edit($slug, $id)
    {
        
        $projectUrl = $this->projectUrlService->find($id);
        
        $frequencies = $this->frequencyService->all();

        return view("urls.edit-url")->with("slug", $slug)->with("projectUrl", $projectUrl)->with("frequencies", $frequencies);
    }

    public function store(ProjectUrlRequest $request, $slug)
    {

        $projectUrlData = $request->all();

        $this->projectUrlService->store($projectUrlData, $slug);

        return redirect("/project/" . $slug . "/urls");
    }

    public function update(ProjectUrlRequest $request, $id)
    {
    
      $attributes = $request->except('_method', '_token');
      
      $this->projectUrlService->update($attributes, $id);
  
      return redirect()->back();
    }

    public function delete($id) {
        
        $this->projectUrlService->delete($id);

        return redirect()->back();
    }
}
