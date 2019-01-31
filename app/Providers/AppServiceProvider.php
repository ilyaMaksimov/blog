<?php

namespace App\Providers;

use App\Entities\Category;
use App\Entities\Post;
use App\Entities\Tag;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, function ($app) {
            return new CategoryRepository(
                $app['em'],
                $app['em']->getClassMetaData(Category::class)
            );
        });

        $this->app->bind(TagRepository::class, function ($app) {
            return new TagRepository(
                $app['em'],
                $app['em']->getClassMetaData(Tag::class)
            );
        });

        $this->app->bind(PostRepository::class, function ($app) {
            return new PostRepository(
                $app['em'],
                $app['em']->getClassMetaData(Post::class)
            );
        });
    }
}
