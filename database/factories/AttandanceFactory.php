<?php

$factory->define(App\Attandance::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "user_id" => factory('App\User')->create(),
        "attendance" => collect(["1","2",])->random(),
        "entry" => $faker->date("H:i:s", $max = 'now'),
        "exit" => $faker->date("H:i:s", $max = 'now'),
    ];
});
