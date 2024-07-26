<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $categories = Category::inRandomOrder()->get();
    $users = User::inRandomOrder()->get();

    return [
        'title' => $faker->title(),

        'description' => $faker->name(),  
        'content' => $faker->name(),
        'image' => $faker->imageUrl(),
        'view_count' => $faker->imageUrl(),
        'new_post' => $faker->boolean(),
        'slug' => $faker->slug(), 
        'highlight_post' => $faker->boolean(),

        
        'category_id' => function () use ($categories) {
            return $categories->random()->id;
        },
        'user_id' => function () use ($users) {
            return $users->random()->id;
        },

        'created_at' => new DateTime(), 

        'updated_at' => new DateTime()

    ];
});
