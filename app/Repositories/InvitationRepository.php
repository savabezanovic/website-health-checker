<?php

namespace App\Repositories;

use App\Invitation;

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
            $invitation->save();
    }
}
