<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FrequencyRequest;
use App\Services\FrequencyService;

class FrequencyController extends Controller
{



    protected $frequencyService;

    public function __construct(FrequencyService $frequencyService)

    {

        $this->middleware('auth');
        $this->frequencyService = $frequencyService;
    }

}
