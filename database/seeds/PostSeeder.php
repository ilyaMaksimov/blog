<?php

use Illuminate\Database\Seeder;

use App\Entities\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        entity(Category::class, 5)->create()->each(function (Category $category) {
            $tag = entity(\App\Entities\Tag::class, 1)->create();
            entity(\App\Entities\Post::class, 1)->create([
                'category' => $category,
                'tags' => [$tag]
            ]);
        });
    }
}
