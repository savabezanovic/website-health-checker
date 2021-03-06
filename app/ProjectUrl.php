<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUrl extends Model
{

    protected $fillable = [
        'url', 'project_id', "frequency_id", "checked_at"
    ];

    public function project() {
        
        return $this->belongsTo(Project::class);

    }
    public function check() {

        return $this->hasMany(Check::class);

    }

    public function frequency(){
        return $this->belongsTo(Frequency::class);
    }
}
