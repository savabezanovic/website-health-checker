<?php

namespace App\Repositories;

class HttpRequestRepository
{

  protected $httpRequest;

  public function __construct(HttpRequestRepository $httpRequest)
  {
    $this->httpRequest = $httpRequest;
  }
}
