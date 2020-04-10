<?php

namespace App\Repositories;

use App\User;
use App\NotificationSetting;
use App\NotificationType;
use App\Notifications\ProjectDownNotification;
use App\Notifications\ProjectUpNotification;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function notificationTypes()
    {

        $notificationTypes = NotificationType::all();

        $userNotifications = NotificationSetting::where("user_id", "=", auth()->user()->id);

        return $notificationTypes;
    }

    public function notifyCreatorProjectDown($user_id, $project_id)
    {

        $user = User::find($user_id);
        $notificationType = NotificationType::where("type", "=", "Project Down");
        $notificationSetting = NotificationSetting::where("user_id", "=", $user_id)
        ->where("project_id", "=", $project_id)->where("notification_type", "=", $notificationType->id)
        ->first();

        if($notificationSetting->setting === true) {
            $user->notify(new ProjectDownNotification());
        }
        
    }

    public function notifyCreatorProjectUp($user_id, $project_id)
    {
        $user = User::find($user_id);
        $notificationType = NotificationType::where("type", "=", "Project Up");
        $notificationSetting = NotificationSetting::where("user_id", "=", $user_id)
        ->where("project_id", "=", $project_id)->where("notification_type", "=", $notificationType->id)
        ->first();

        if($notificationSetting->setting === true) {
            $user->notify(new ProjectUpNotification());
        }
        
    }

    public function notificationON($id)
    {
        $notificationSettings = NotificationSetting::where("notification_type_id", "=", $id)
        ->where("user_id", "=", auth()->user()->id)
        ->get();

        foreach($notificationSettings as $notificationSetting)
        {
            $notificationSetting->setting = 0;
            $notificationSetting->save();
        }

    }

    public function notificationOFF($id)
    {
        $notificationSettings = NotificationSetting::where("notification_type_id", "=", $id)
        ->where("user_id", "=", auth()->user()->id)
        ->get();

        foreach($notificationSettings as $notificationSetting)
        {
            $notificationSetting->setting = 1;
            $notificationSetting->save();
        }

    }

}
