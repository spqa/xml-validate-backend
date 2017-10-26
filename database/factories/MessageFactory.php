<?php

use Faker\Generator as Faker;

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

$factory->define(\App\Message::class, function (Faker $faker) {
    static $password;

    return [
        'ja' => $faker->name,
        'vi' => $faker->sentence,
        'en' => $faker->name,
        'final' => str_random(10),
        'code_file_id' => 1,
        'resource_file_id' => 1,
        'message_key' => $faker->sentence
    ];
});
