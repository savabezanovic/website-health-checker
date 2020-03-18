<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUrl extends Model
{

    protected $fillable = [
        'url', 'project_id'
    ];

    public function project() {
        
        return $this->belongsTo(Project::class);

    }
}
