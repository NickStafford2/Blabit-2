<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Chat::class, function (Faker $faker) {
    return [
        'user_id' => $faker->word,
        'title' => $faker->realText(60),
        'description' => $faker->paragraph,
        'is_live' => $faker->boolean,
        'num_viewers' => $faker->randomDigit,
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
