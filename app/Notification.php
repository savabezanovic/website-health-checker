<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NotificationType;
use App\User;
use App\Project;

class Notification extends Model
{

    protected $fillable = [
        'notification_type_id', 'project_id', "user_id"
    ];

    public function notificationType() {
        
        return $this->hasOne(NotificationType::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function toArray($notifiable)
{
    return [
        'invoice_id' => $this->invoice->id,
        'amount' => $this->invoice->amount,
    ];
}
    
}
