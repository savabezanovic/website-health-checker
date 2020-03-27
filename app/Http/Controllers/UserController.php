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

    public function notifications($slug)
    {
        $notifications = $this->userService->notifications();
        return view('user.notifications')->with("notifications", $notifications);
    }
}
