<?php

namespace App\Repositories;

use App\NotificationSetting;

class NotificationSettingRepository
{

    protected $project;

    public function __construct(NotificationSetting $notificationSetting)
    {
        $this->notificationSetting = $notificationSetting;
    }

    public function create($project_id, $notificationTypes)
    {
        foreach ($notificationTypes as $type) {
            $notificationSetting = new NotificationSetting();
            $notificationSetting->project_id = $project_id;
            $notificationSetting->user_id = auth()->user()->id;
            $notificationSetting->setting = 0;
            $notificationSetting->notification_type_id = $type->id;
            $notificationSetting->save();
        }
    }
}
