<?php

namespace App\Repositories;

class HttpRequestRepository
{

  protected $check;

  public function __construct(HttpRequestRepository $httpRequest)
  {
    $this->httpRequest = $httpRequest;
  }

  public function requestSuccessful($check)
  {

    $check = $this->checkService->read($check->id);

    if (in_array($check->response_code, range(200, 299))) {
      return true;
    } else {
      return false;
    }
  }
}
