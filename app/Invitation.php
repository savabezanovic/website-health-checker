<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Project;

class Invitation extends Model
{

    protected $fillable = [
        
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
