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

$factory->define(App\Models\Size::class, function (Faker $faker) {
    $sizes = [
        "M",
        "S",
        "L",
        "49 inches",
        "41 inches",
        "40 inches",
        "29 inches",
        "X",
    ];
    $name = $sizes[rand(0, 7)];
    return [
        'code' => strtoupper(str_replace(" ", "", $name)),
        'value' => $name
    ];
});
