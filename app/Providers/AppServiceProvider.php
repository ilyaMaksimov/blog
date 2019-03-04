<?php

namespace App\Providers;

use App\Entities\Category;
use App\Entities\Comment;
use App\Entities\Post;
use App\Entities\Subscribe;
use App\Entities\Tag;
use App\Entities\User;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Repositories\SubscribeRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
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
        view()->composer('frontend.layout._sidebar', function ($view) {
            $postRepository = new PostRepository($this->app['em'], $this->app['em']->getClassMetaData(Post::class));
            $categoryRepository = new CategoryRepository($this->app['em'], $this->app['em']->getClassMetaData(Category::class));

            $view->with('categories', $categoryRepository->findAll());
            $view->with('featuredPosts', $postRepository->findBy(['is_featured' => 1]));
            $view->with('recentPosts', $postRepository->recentPosts());
        });

        view()->composer('admin.layout._sidebar', function ($view) {
            $commentRepository = new CommentRepository($this->app['em'], $this->app['em']->getClassMetaData(Post::class));
            $view->with('newCommentsCount', count($commentRepository->findByStatus(Comment::STATUS_WAITING_VERIFICATION)));
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

        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
            );
        });

        $this->app->bind(CommentRepository::class, function ($app) {
            return new CommentRepository(
                $app['em'],
                $app['em']->getClassMetaData(Comment::class)
            );
        });

        $this->app->bind(SubscribeRepository::class, function ($app) {
            return new SubscribeRepository(
                $app['em'],
                $app['em']->getClassMetaData(Subscribe::class)
            );
        });
    }
}
