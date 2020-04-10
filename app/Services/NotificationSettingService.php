<?php

namespace App\Services;


use App\Repositories\NotificationSettingRepository;

class NotificationSettingService
{
	public function __construct(NotificationSettingRepository $notificationSetting)
	{
		$this->notificationSetting = $notificationSetting;
	}

    public function create($project_id, $notificationTypes)
    {
        return $this->notificationSetting->create($project_id, $notificationTypes);
    }

}
