<?php

namespace App\Repositories;

use App\Frequency;

class FrequencyRepository
{

  protected $check;

  public function __construct(Frequency $frequency)
  {
    $this->frequency = $frequency;
  }

  public function find($id)
  {
    return $this->frequency->find($id);
  }

}
