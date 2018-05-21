<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->lastName,
        'director' => $faker->lastName,
        'imageUrl' => $faker->url,
        'duration' => $faker->numberBetween($min = 0, $max = 200),
        'releaseDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'genre' => $faker->lastName
    ];
});


		