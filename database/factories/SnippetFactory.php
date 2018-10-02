<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
use \App\Snippet;
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

$factory->define(App\Snippet::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'code' => $faker->text,
        'expiration' => Carbon::now()->addDays(rand(1, 20)),
        'uuid' => uniqid(),
        'access' => array_random(Snippet::accessStates())
    ];
});
