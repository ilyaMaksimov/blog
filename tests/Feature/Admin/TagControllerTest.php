<?php

namespace Tests\Feature\Admin;

use App\Entities\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function store_tag()
    {
        $this->post('/admin/tag', [
            'title' => $nameTag = 'test tag'
        ]);


        $response = $this->get('/admin/tag');
        $response
            ->assertStatus(200)
            ->assertSee($nameTag);
    }

    /**
     * @test
     */
    public function when_saving_the_tag_the_title_field_is_required()
    {
        $response = $this->post('/admin/tag');

        $response
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function update_tag()
    {
        $tag = entity(Tag::class)->create();

        $this->put('/admin/tag/' . $tag->getId(), [
            'title' => $title = 'update tag'
        ]);

        $response = $this->get('/admin/tag');
        $response->assertSee($title);
    }

    /**
     * @test
     */
    public function when_update_the_tag_the_title_field_is_required()
    {
        $tag = entity(Tag::class)->create();

        $response = $this->put('/admin/tag/'.$tag->getId(), []);
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function delete_tag()
    {
        $tag = entity(Tag::class)->create();

        $response = $this->get('/admin/tag');
        $response
            ->assertStatus(200)
            ->assertSee($tag->getTitle());

        $this->delete('/admin/tag/'.$tag->getId());

        $responseDelete = $this->get('/admin/tag');
        $responseDelete
            ->assertStatus(200)
            ->assertDontSee($tag->getTitle());
    }
}
