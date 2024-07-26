<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,

        'slug' => $faker->slug, 

        'created_at' => new DateTime(), 

        'updated_at' => new DateTime()
    ];
});
