<?php

namespace App\Repositories;

use App\Invitation;
use Illuminate\Support\Str;

class InvitationRepository
{

    protected $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function create($project_id, $email)
    {
            $invitation = new Invitation();
            $invitation->project_id = $project_id;
            $invitation->email = $email;
            $invitation->token = Str::random(5);
            $invitation->save();

            return $invitation->token;
    }
}
