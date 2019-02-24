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
       view()->composer('frontend.layout._sidebar', function ($view){
           $postRepository = new PostRepository($this->app['em'], $this->app['em']->getClassMetaData(Post::class));
           $categoryRepository =  new CategoryRepository($this->app['em'], $this->app['em']->getClassMetaData(Category::class));

           $view->with('categories', $categoryRepository->findAll());
           $view->with('featuredPosts', $postRepository->findBy(['is_featured'=>1]));
           $view->with('recentPosts', $postRepository->recentPosts());
       });
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
