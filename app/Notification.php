<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Project;

class Notification extends Model
{

    protected $fillable = [
        "notification_type", "notification_setting", "notifiable_type", "notifiable_id", "data", "read_at", "created_at", "updated_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
}
