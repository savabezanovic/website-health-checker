<?php

namespace App\Repositories;

class HttpRequestRepository
{

  protected $check;

  public function __construct(HttpRequestRepository $httpRequest)
  {
    $this->httpRequest = $httpRequest;
  }
}
