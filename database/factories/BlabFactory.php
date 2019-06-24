<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use App\Chat;

$factory->define(App\Blab::class, function (Faker $faker) {
    return [
        'user_id' 	=> $faker->word,
        'chat_id' 	=> $faker->numberBetween(0,count(Chat::all())-1),
        'message' 	=> $faker->realText(60),
        'created_at' => Carbon::now()->subMinutes(rand(1, 55))->format('Y-m-d H:i:s')

        //'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
    ];
});
