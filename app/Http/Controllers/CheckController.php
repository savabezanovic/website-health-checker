<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckRequest;
use App\Services\CheckService;

class CheckController extends Controller
{



    protected $projectUrlService;

    public function __construct(CheckService $checkService)

    {

        $this->middleware('auth');
        $this->checkService = $checkService;
    }

}
