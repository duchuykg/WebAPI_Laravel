<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Role;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

        'password' => Hash::make($faker->password),

        'type' => $faker->randomElement([0, 1]),

        'created_at' => new DateTime(), 

        'updated_at' => new DateTime(),

        
    ];
});
