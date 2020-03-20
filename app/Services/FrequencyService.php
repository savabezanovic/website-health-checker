<?php

namespace App\Services;

use App\Repositories\FrequencyRepository;
use Illuminate\Http\Request;

class FrequencyService
{
	public function __construct(FrequencyRepository $frequency)
	{
		$this->frequency = $frequency;
	}

	public function find($id)
	{
		return $this->frequency->find($id);
	}
	public function all()
	{
		return $this->frequency->all();
	}
}
