<?php

namespace App\Services;

use App\Repositories\CheckRepository;
use Illuminate\Http\Request;

class CheckService
{
	public function __construct(CheckRepository $check)
	{
		$this->check = $check;
	}

	public function find($id)
	{
		return $this->check->find($id);
	}

	public function new()
	{
		return $this->check->new();
	}

}
