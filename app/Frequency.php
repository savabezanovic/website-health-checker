<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{

    protected $fillable = [
        "name", "seconds"
    ];

    
    public function projectUrls() {
        return $this->hasMany(ProjectUrl::class);
    }
}
