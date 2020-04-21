<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\InvitationService;

class UserController extends Controller
{

    public function __construct(UserService $userService, InvitationService $invitationService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->invitationService = $invitationService;
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

    public function sendInvitation(Request $request, $project_id)
    {
        
        $token = $this->invitationService->create($project_id, $request["email"]);
        $this->userService->sendInvitation($request["email"], $project_id, $token);
    }

    public function joinTeam($token) {
        
        $projectId = $this->invitationService->getProjectId($token);
        $this->userService->addToTeam($projectId);
        $this->invitationService->removeFromInvitations($token);
        return redirect("/projects");

    }

}
