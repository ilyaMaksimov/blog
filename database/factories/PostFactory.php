<?php

use Faker\Generator as Faker;
use App\Entities\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $name = $faker->name,
        'slug' => str_slug($name),
        'description' => $faker->text(100),
        'content' => $faker->realText(200),
        'image' => null,
        'views' => $faker->randomNumber(),
        'is_featured' => $faker->boolean,
        'is_public' => 1,
        'date' => $faker->dateTime,
    ];
});
