<?php

namespace Tests\Unit\Entity;

use App\Entity\Image;
use App\Models\Post\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImageTest extends TestCase
{
    /**
     * @test
     */
    public function returns_the_image_path()
    {
        $post = factory(Post::class)->make([
            'image' => $image = 'test.jpg'
        ]);

        $this->assertEquals(Image::SAVE_DIRECTORY.$image, Image::getPath($post->image));
    }

    /**
     * @test
     */
    /*private function returns_the_default_image_path()
    {

        $post = factory(Post::class)->make([
            'image' => null
        ]);

        $this->assertEquals(Image::DEFAULT_IMAGE, Image::getPath($post->image));
    }*/

    /**
     * @test1
     */
   /* private function returns_generated_name()
    {
        $this->assertEquals(15, strlen(Image::generateName('.png')));
    }*/
}
