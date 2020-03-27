<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function notifications($slug)
    {
        $this->user->notifications($slug);
    }

    public function notifyCreatorProjectDown($id)
    {
        $this->user->notifyCreatorProjectDown($id);
    }

    public function notifyCreatorProjectUp($id)
    {
        $this->user->notifyCreatorProjectUp($id);
    }
}
