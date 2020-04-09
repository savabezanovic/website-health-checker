<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Project extends Model
{

    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name', "user_id", "up"
    ];

    public function creator() {

        return $this->belongsTo(User::class, "user_id");

    }

    public function projectUrls() {

        return $this->hasMany(ProjectUrl::class);

    }

    public function notificationSettings() {
        return $this->hasMany(NotificationSetting::class);
    }

}
