<?php

namespace Tests\Feature\Admin;

use App\Entities\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ViewCategoryTest extends TestCase
{
    use DatabaseTransactions;
    //use DatabaseMigrations;

    /**
     * @test
     */
    public function store_category()
    {
        $this->post('/admin/category', [
            'title' => $title = 'test title',
        ]);

        $response = $this->get('/admin/category');
        $response
            ->assertStatus(200)
            ->assertSee($title);
    }

    /**
     * @test
     */
    public function when_saving_the_category_the_title_field_is_required()
    {
        $response = $this->post('/admin/category/');
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function update_category()
    {
        $category = entity(Category::class)->make();

        $this->put('/admin/category/' . $category->getId(), [
            'title' => $title = 'update title',
        ]);

        $response = $this->get('/admin/category');
        $response->assertSee($title);
    }

    /**
     * @test
     */
    public function when_updating_the_category_the_title_field_is_obligatory()
    {
        $category = entity(Category::class)->create();

        $response = $this->put('/admin/category/' . $category->getId());
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function delete_category()
    {
        $category = entity(Category::class)->create();

        $response = $this->get('/admin/category');
        $response
            ->assertStatus(200)
            ->assertSee($category->getTitle());

        $this->delete('/admin/category/' . $category->getId());

        $responseDelete = $this->get('/admin/category/');
        $responseDelete
            ->assertStatus(200)
            ->assertDontSee($category->getTitle());
    }
}