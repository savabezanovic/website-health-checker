<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use App\ProjectUrl;
use App\Check;
use Carbon\Carbon;

class CheckUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckUrl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $urls = ProjectUrl::all();

        foreach ($urls as $url) {
            if (Carbon::now()->diffInSeconds($url->checked_at) > $url->frequency) {

                $check = new Check();

                $timeBefore = Carbon::now();
                $response = Http::get($url->url);
                $timeAfter = Carbon::now();

                $check->url_id = $url->id;
                $check->response_status = $response->status();
                $check->response_time = $timeAfter->diffInMiliseconds($timeBefore);
                $check->checked_at = 
                
                
                $url->checked_at = Carbon::now();
                
                $url->save();
                $check->save();
            }
        }
    }
}
