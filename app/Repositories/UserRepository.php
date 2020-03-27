<?php

namespace App\Repositories;

use App\User;
use App\Notifications\ProjectDownNotification;
use App\Notifications\ProjectUpNotification;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function notifications($slug)
    {
        $user = User::where("slug", "=", $slug)->first();
    }

    public function notifyCreatorProjectDown($id)
    {

        $user = User::find($id);
        $user->notify(new ProjectDownNotification());
    }

    public function notifyCreatorProjectUp($id)
    {
        $user = User::find($id);
        $user->notify(new ProjectUpNotification());
    }
}
