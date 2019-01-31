<?php

use Faker\Generator as Faker;
use App\Entities\Tag;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->name,
        'slug' => str_slug($title),
    ];
});
