<?php

namespace App\Services;


use App\Repositories\InvitationRepository;

class InvitationService
{
	public function __construct(InvitationRepository $invitationRepository)
	{
		$this->invitationRepository = $invitationRepository;
	}

    public function create($project_id, $email)
    {
        return $this->invitationRepository->create($project_id, $email);
    }

}
