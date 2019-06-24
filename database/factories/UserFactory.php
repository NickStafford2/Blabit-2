<?php
use Carbon\Carbon;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'id' => $faker->word,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'description' => $faker->paragraph,
        'remember_token' => str_random(10),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});
