<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    public function settings($slug)
    {
        $settings = $this->userService->settings($slug);
        return view('user.settings')->with("settings", $settings);
    }
}
