<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function new()
    {
        return $this->user->new();
    }

    public function notificationTypes()
    {
        return $this->user->notificationTypes();
    }

    public function notifyCreatorProjectDown($user_id, $project_id)
    {
        return $this->user->notifyCreatorProjectDown($user_id, $project_id);
    }

    public function notifyCreatorProjectUp($user_id, $project_id)
    {
        return $this->user->notifyCreatorProjectUp($user_id, $project_id);
    }

    public function notificationON($id)
    {
        return $this->user->notificationON($id);
    }

    public function notificationOFF($id)
    {
        return $this->user->notificationOFF($id);
    }

}
