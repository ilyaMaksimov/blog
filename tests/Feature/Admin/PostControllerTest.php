<?php

namespace Tests\Feature\Admin;

use App\Entities\Category;
use App\Entities\Post;
//use App\Models\Post\Post;
//use App\Models\Post\Post;
//use App\Models\Tag\Tag;
use App\Entities\Tag;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function show_post()
    {
       // Storage::fake('avatars');


        $category = entity(Category::class)->create();

        $post = factory(Post::class)->create([
            'category_id' => $category->id,
            //'image' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response = $this->get('/admin/post');
        $response
            ->assertStatus(200)
            ->assertSee($post->title)
            ->assertSee($category->title);

        //Storage::disk('avatars')->assertExists('avatar.jpg');
    }

    /**
     * todo сохранение картнки с неправильным форматом
     * @test
     */
    public function returns_errors_create_post()
    {
        $response = $this->post('/admin/post', [
            'title'=> null,
            'description'=> null,
            'content'=> null,
            'date'=> null,
            'status'=> 'not boolean',
            'is_featured'=> 'not boolean',
        ]);

        $response->assertSessionHasErrors('title');
        $response->assertSessionHasErrors('description');
        $response->assertSessionHasErrors('content');
        $response->assertSessionHasErrors('date');
        $response->assertSessionHasErrors('status');
        $response->assertSessionHasErrors('is_featured');
    }

    /**
     * @todo подправить tags \image \is_featured \ views
     * @test123
     */
    public function store_post()
    {
        $category = entity(Category::class)->create();
        $tags = entity(Tag::class, 2)->create();

        $array = [
            'title' => $title = 'title test',
            'content' => $content = 'content test',
            'description' => $description = 'description test',
            'category_id' => $category->id,
            'status' => null,
            'views' => null,
            'is_featured' => '1',

            'date' => $date = '1991-02-09',
            'image' => null,
            //'tags' => [2,3,4]
        ];

        $response = $this->post('/admin/post', $array);
       // dd($response);
       // $this->assertDatabaseHas('posts', $array);

        $response = $this->get('/admin/post');
        $response
            ->assertStatus(200)
            ->assertSee($title)
            ->assertSee($category->title);
        // $this->assertEquals($tags, $post->selectedTagsId());

        // $response->assertSee()

    }



    /**
     * @todo подправить tags \image \is_featured \ views
     * @test1
     */
    public function update_post()
    {
        /** @var Post $post */
        $post = entity(Post::class)->create($arrayCreate = [
            'title' => 'title test',
            'content' => 'content test',
            'description' => 'description test',
            'category_id' => entity(Category::class)->create()->id,
            'status' => 0,
            'views' => 0,
            'is_featured' => 1,

            'date' => '1991-02-09',
            'image' => 'rtyv23dsfsdg',
        ]);

        $tags = entity(Tag::class, 2)->create();

        $arrayUpdate = [
            'title' => 'title test update',
            'content' => 'content test update',
            'description' => 'description test update',
            'category_id' => factory(Category::class)->create()->id,
            'status' => 1,
            'views' => 0,
            'is_featured' => 0,
            'date' => '1991-02-11',
            'image' => 'rtyv23dsfsdg',
        ];

        $this->put('/admin/post/' . $post->id, $arrayUpdate + ['tags' => $tags = $tags->pluck('id')->all()]);

        $this->assertDatabaseHas('posts', $arrayUpdate);
        $this->assertEquals($tags, $post->selectedTagsId());
    }


    /**
     * @test
     */
    public function delete_post()
    {
        $post = entity(Post::class)->create([]);

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
}
