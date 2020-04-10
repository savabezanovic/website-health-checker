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

    public function settings()
    {
        $notificationTypes = $this->userService->notificationTypes();
       
        return view('user.settings')->with("notificationTypes", $notificationTypes);
    }

    public function notificationON($typeId)
    {
        $this->userService->notificationON($typeId);

        return back();
    }

    public function notificationOFF($typeId)
    {
        $this->userService->notificationOFF($typeId);

        return back();
    }

}
