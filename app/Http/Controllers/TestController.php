<?php

namespace App\Http\Controllers;

use App\Services\ProjectUrlService;

class TestController extends Controller
{



    protected $projectUrlService;

    public function __construct(ProjectUrlService $projectUrlService)

    {

        $this->middleware('auth');
        $this->projectUrlService = $projectUrlService;
        
    }

    public function test()
    {
        return view("test");
    }

}
