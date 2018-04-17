<?php

$factory->define(App\Salery::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "base_salery" => $faker->name,
        "month" => $faker->name,
        "due" => $faker->name,
        "bonus" => $faker->name,
    ];
});
