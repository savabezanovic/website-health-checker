<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Project;
use App\NotificationType;

class NotificationSetting extends Model
{

    protected $fillable = [
        "setting", "user_id", "project_id", "notification_type_id"
    ];

    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->blongsTo(Project::class);
    }
    
}
