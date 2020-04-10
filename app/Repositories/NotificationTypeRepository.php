<?php

namespace App\Repositories;

use App\NotificationType;

class NotificationTypeRepository
{

    protected $project;

    public function __construct(NotificationType $notificationType)
    {
        $this->notificationType = $notificationType;
    }

    public function getAllNotificationTypes()
    {
        return $this->notificationType->all();
    }
}
