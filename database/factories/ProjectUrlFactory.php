<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProjectUrl;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ProjectUrl::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'project_id' => $faker->numberBetween($min = 1, $max = 10),
        "frequency_id" => 1 ,
        "checked_at" => '2020-02-25 08:37:17'
    ];
});
