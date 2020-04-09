<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\NotificationSetting;

class NotificationType extends Model
{

    protected $fillable = [
        "type"
    ];

    public function notificationSetting()
    {
        return $this->hasMany(NotificationSetting::class);
    }
    
}
