<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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

$factory->define(\App\CmsApplication::class, function (Faker $faker) {
    return [
        'name' => 'Instance ' . $faker->word,
        'url' => $faker->url,
        'app_key' => Str::random(12),
        'user_id' => 1
    ];
});
