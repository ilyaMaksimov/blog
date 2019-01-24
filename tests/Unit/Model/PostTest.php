<?php

namespace Tests\Unit\Model;

use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function returns_the_id_tags_of_the_post()
    {
        /** @var Tag $tags */
        $tags = factory(Tag::class,3)->create();
        /** @var Post $post */
        $post = factory(Post::class)->create();

        $post->tags()->saveMany($tags);

        $this->assertEquals($tags->pluck('id')->all(), $post->selectedTagsId());
    }

    /**
     * @test
     */
    public function returns_the_title_tags_of_the_post()
    {
        /** @var Tag $tags */
        $tag1 = factory(Tag::class)->create();
        $tag2 = factory(Tag::class)->create();
        /** @var Post $post */
        $post = factory(Post::class)->create();

        $post->tags()->save($tag1);
        $post->tags()->save($tag2);

        $this->assertEquals("$tag1->title, $tag2->title", $post->getTagsTitles());
    }

    /**
     * @test
     */
    public function returns_the_no_tags_of_the_post()
    {
        /** @var Post $post */
        $post = factory(Post::class)->create();

        $this->assertEquals('нет тегов', $post->getTagsTitles());
    }


}
