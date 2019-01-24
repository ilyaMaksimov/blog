<?php

use Faker\Generator as Faker;
use App\Models\Category\Category;


$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->name,
        'slug' => str_slug($title),
    ];
});