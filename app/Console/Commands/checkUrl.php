<?php

namespace App\Console\Commands;

use App\Check;
use App\ProjectUrl;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Exception;


class CheckUrl extends Command
{

    protected $signature = 'command:checkUrl';

    protected $description = 'Check Url and save status ';

    public function __construct()

    {

        parent::__construct();
    }

    public function handle()

    {
        $urls = ProjectUrl::all();

        foreach ($urls as $url) {

            if (Carbon::now()->diffInSeconds($url->checked_at) > $url->frequency->seconds) {

                $check = new Check();

                $timeBefore = Carbon::now();

                try {

                    $response = Http::get($url->url);

                    $check->response_status = $response->status();

                } catch (Exception $e) {

                    $check->response_status = 0;
                    
                }

                $timeAfter = Carbon::now();

                $check->url_id = $url->id;

                $check->response_time = $timeAfter->diffInMilliseconds($timeBefore);

                $url->checked_at = Carbon::now();

                $url->save();

                $check->save();
            }
        }
    }
}
