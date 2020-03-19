<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{

    protected $fillable = [
        'url', 'project_id'
    ];

    public function project() {
        
        return $this->belongsTo(ProjectUrl::class);

    }
}
