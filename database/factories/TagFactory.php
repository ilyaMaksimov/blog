<?php

use Faker\Generator as Faker;
use App\Models\Tag\Tag;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->name,
        'slug' => str_slug($title),
    ];
});
