<?php

use Faker\Generator as Faker;
use App\Entities\Category;


$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->name,
        'slug' => str_slug($title),
    ];
});