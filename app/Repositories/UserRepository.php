<?php

namespace App\Repositories;

use App\User;
use App\Project;
use App\NotificationSetting;
use App\NotificationType;
use App\Notifications\ProjectDownNotification;
use App\Notifications\ProjectUpNotification;
use Illuminate\Database\Eloquent\Builder;

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

    public function notifyTeamProjectDown($user_id, $projectId)
    {

        $project = Project::find($projectId);

        $members = $project->members;

        $teamMembers = [];

        foreach($members as $member) {
            $teamMembers[] += $member;
        }

        $teamMembers[] += $project->creator;

        $notificationType = NotificationType::where("type", "=", "Project Down")->first();

        foreach ($teamMembers as $user) {
            $notificationSetting = NotificationSetting::where("user_id", "=", $user->id)
                ->where("project_id", "=", $projectId)->where("notification_type_id", "=", $notificationType->id)
                ->first();

            if ($notificationSetting->setting == true) {
                $user->notify(new ProjectDownNotification());
            }
        }
    }

    public function notifyTeamProjectUp($user_id, $projectId)
    {

        $project = Project::find($projectId);

        $members = $project->members;

        $teamMembers = [];

        foreach($members as $member) {
            $teamMembers[] += $member;
        }

        $teamMembers[] += $project->creator;

        $notificationType = NotificationType::where("type", "=", "Project Up")->first();
        
        foreach ($teamMembers as $user) {
            $notificationSetting = NotificationSetting::where("user_id", "=", $user->id)
                ->where("project_id", "=", $projectId)->where("notification_type_id", "=", $notificationType->id)
                ->first();

            echo $user->name . "<br>";
            if ($notificationSetting->setting == true) {
               
                $user->notify(new ProjectDownNotification());
                echo "Poslao je mail <br>";
            } else {
                
                echo "Nije poslao mail <br>";
            }
        }
    }

    public function notifyCreatorProjectDown($user_id, $project_id)
    {
        
        $user = User::find($user_id);
        $notificationType = NotificationType::where("type", "=", "Project Down")->first();
        $notificationSetting = NotificationSetting::where("user_id", "=", $user_id)
            ->where("project_id", "=", $project_id)->where("notification_type_id", "=", $notificationType->id)
            ->first();

        if ($notificationSetting->setting === true) {
            $user->notify(new ProjectDownNotification());
        }
    }

    public function notifyCreatorProjectUp($user_id, $project_id)
    {
        $user = User::find($user_id);
        $notificationType = NotificationType::where("type", "=", "Project Up")->first();
        $notificationSetting = NotificationSetting::where("user_id", "=", $user_id)
            ->where("project_id", "=", $project_id)->where("notification_type_id", "=", $notificationType->id)
            ->first();

        if ($notificationSetting->setting === true) {
            $user->notify(new ProjectUpNotification());
        }
    }

    public function notificationON($id)
    {
        $notificationSettings = NotificationSetting::where("notification_type_id", "=", $id)
            ->where("user_id", "=", auth()->user()->id)
            ->get();

        foreach ($notificationSettings as $notificationSetting) {
            $notificationSetting->setting = 0;
            $notificationSetting->save();
        }
    }

    public function notificationOFF($id)
    {
        $notificationSettings = NotificationSetting::where("notification_type_id", "=", $id)
            ->where("user_id", "=", auth()->user()->id)
            ->get();

        foreach ($notificationSettings as $notificationSetting) {
            $notificationSetting->setting = 1;
            $notificationSetting->save();
        }
    }

    public function addToTeam($projectId)
    {

        $user = User::find(auth()->user()->id);

        $user->member()->attach($projectId);
    }
}
