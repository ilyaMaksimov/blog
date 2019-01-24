<?php

namespace Tests\Feature\Admin;

use App\Models\Category\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ViewCategoryTest extends TestCase
{
    use DatabaseTransactions;

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
        $category = factory(Category::class)->create();

        $this->put('/admin/category/' . $category->id, [
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
        $category = factory(Category::class)->create();

        $response = $this->put('/admin/category/' . $category->id);
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function delete_category()
    {
        $category = factory(Category::class)->create();

        $response = $this->get('/admin/category');
        $response
            ->assertStatus(200)
            ->assertSee($category->title);

        $this->delete('/admin/category/' . $category->id);

        $responseDelete = $this->get('/admin/category/');
        $responseDelete
            ->assertStatus(200)
            ->assertDontSee($category->title);
    }
}