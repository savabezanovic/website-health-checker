<?php

namespace App\Services;

use App\Repositories\HttpRequestRepository;

class HttpRequestService
{
    public function __construct(HttpRequestRepository $httpRequest)
    {
        $this->httpRequest = $httpRequest;
    }

    public function find($id)
    {
        return $this->httpRequest->find($id);
    }

    public function requestSuccessful($httpRequest)
    {

        $httpRequest = $this->httpRequestService->find($httpRequest->id);

        if (in_array($httpRequest->response_code, range(200, 299))) {
            return true;
        } else {
            return false;
        }
    }
}
