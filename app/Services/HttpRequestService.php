<?php

namespace App\Services;

use App\Repositories\HttpRequestRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

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

    public function testUrl($newCheck, $url)
    {
        $timeBefore = Carbon::now();

        try {

            $response = Http::get($url->url);

            $newCheck->response_status = $response->status();
        } catch (Exception $e) {

            $newCheck->response_status = 0;
        }

        $timeAfter = Carbon::now();

        $newCheck->url_id = $url->id;

        $newCheck->response_time = $timeAfter->diffInMilliseconds($timeBefore);

        $url->checked_at = Carbon::now();

        $results  = [
            "testedCheck" => $newCheck,
            "testedUrl" => $url
        ];

        return $results;
    }
}
