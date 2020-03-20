<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{

    protected $fillable = [
        'url_id', "response_code", "response_status"
    ];

    public function projectUrl() {
        
        return $this->belongsTo(ProjectUrl::class);

    }
}
