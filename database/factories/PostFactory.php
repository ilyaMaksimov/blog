<?php

use Faker\Generator as Faker;
use App\Models\Post\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $name = $faker->name,
        'slug' => str_slug($name),
        'description' => $faker->text(50),
        'content' => $faker->text(),

        'image' => $faker->imageUrl(),
        'category_id' => 1,
        'status' => $faker->boolean,
        'views' => $faker->randomNumber(),
        'is_featured' => $faker->boolean,
        'date' => $faker->date(),
    ];
});
