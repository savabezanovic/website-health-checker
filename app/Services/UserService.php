<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ProjectService;

class UserService
{
    public function __construct(UserRepository $user, ProjectService $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    public function new()
    {
        $this->user->new();
    }

    public function settings($slug)
    {
        $this->user->settings($slug);
    }

    public function notifyCreatorProjectDown($user_id, $project_id)
    {
        $this->user->notifyCreatorProjectDown($user_id, $project_id);
    }

    public function notifyCreatorProjectUp($user_id, $project_id)
    {
        $this->user->notifyCreatorProjectUp($user_id, $project_id);
    }
}