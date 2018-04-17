<?php

$factory->define(App\ProjectManagement::class, function (Faker\Generator $faker) {
    return [
        "project_name" => $faker->name,
        "description" => $faker->name,
        "deadline" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "comment" => $faker->name,
        "project_status" => collect(["1","2","3",])->random(),
        "user_id" => factory('App\User')->create(),
    ];
});
