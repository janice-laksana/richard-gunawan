<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->userName,
        // 'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // 'remember_token' => Str::random(10),
        'user_desc' => $faker->text,
        'user_role' => 2,
        'user_gender' => $faker->numberBetween(0,1),
        'user_age' => $faker->numberBetween(20,40),
        'user_picture' => 'nophoto.jpeg',
        'user_is_active' => 1,
        'user_phone' => $faker->e164PhoneNumber,
        'user_rating' => $faker->randomFloat(2,1,5),
        'user_balance' => $faker->numberBetween(100000,10000000),
    ];
});
