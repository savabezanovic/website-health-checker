<?php

namespace App\Services;

use App\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendInvitation;

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

    public function sendInvitation($email, $project_id)
    {

        $link = "smece radi";

        $user = User::where("email", "=", $email)->first();

        $isMember = false;

        foreach ($user->member as $project)  {
           
            if ($project->id != $project_id) {
                
                $isMember = false;
              
            } else if($project->id == $project_id){

                return $isMember = true;
            }
        }

        if($isMember == false) {

            Notification::route('mail', $email)->notify(new SendInvitation($link));

            echo "Poslao sam";

        } else {

            echo "Nisam poslao";

        }
    }
}
