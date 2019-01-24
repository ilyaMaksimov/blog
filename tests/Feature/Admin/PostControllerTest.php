<?php

namespace Tests\Feature\Admin;

use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function create_post()
    {
        $category = factory(Category::class)->create();

        $post = factory(Post::class)->create([
            'category_id' => $category->id
        ]);

        $response = $this->get('/admin/post');
        $response
            ->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($category->title);
    }

    /**
     * @todo подправить tags \image \is_featured \ views
     * @test
     */
    public function store_post()
    {
        $category = factory(Category::class)->create();
        $tags = factory(Tag::class, 2)->create();

        $array = [
            'title' => $title = 'title test',
            'content' => $content = 'content test',
            'description' => $description = 'description test',
            'category_id' => $category->id,
            'status' => 0,
            'views' => 0,
            'is_featured' => 1,

            'date' => $date = '1991-02-09',
            'image' => $image = 'rtyv23dsfsdg',
            //'tags' => [2,3,4]
        ];

        $response =$this->post('/admin/post', $array);
        $this->assertDatabaseHas('posts', $array);
       // $this->assertEquals($tags, $post->selectedTagsId());

       // $response->assertSee()

    }


    /**
     * @todo подправить tags \image \is_featured \ views
     * @test
     */
    public function delete_post()
    {
        $post = factory(Post::class)->create([]);

        $response = $this->get('/admin/post');
        $response
            ->assertStatus(200)
            ->assertSee($post->title);


        $this->delete('/admin/post/' . $post->id);

        $response = $this->get('/admin/post');
        $response
            ->assertStatus(200)
            ->assertDontSee($post->title);

    }

    /**
     * @todo подправить tags \image \is_featured \ views
     * @test
     */
    public function update_post()
    {
        /** @var Post $post */
        $post = factory(Post::class)->create($arrayCreate = [
            'title' => 'title test',
            'content' => 'content test',
            'description' => 'description test',
            'category_id' => factory(Category::class)->create()->id,
            'status' => 0,
            'views' => 0,
            'is_featured' => 1,

            'date' => '1991-02-09',
            'image' =>  'rtyv23dsfsdg',
        ]);

        $tags = factory(Tag::class, 2)->create();

        $arrayUpdate = [
            'title' =>  'title test update',
            'content' =>  'content test update',
            'description' =>  'description test update',
            'category_id' => factory(Category::class)->create()->id,
            'status' => 1,
            'views' => 0,
            'is_featured' => 0,
            'date' => '1991-02-11',
            'image' =>'rtyv23dsfsdg',
        ];

        $this->put('/admin/post/'.$post->id, $arrayUpdate+['tags' => $tags = $tags->pluck('id')->all()]);



        $this->assertDatabaseHas('posts', $arrayUpdate );
        $this->assertEquals($tags, $post->selectedTagsId());
    }


}
