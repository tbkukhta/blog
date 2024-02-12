<?php

namespace App\Providers;

use App\Models\Advert;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layouts.sidebar', function ($view) {
            $advert1 = Advert::getAdvert(Advert::ADVERT_SIDEBAR_1);
            $advert2 = Advert::getAdvert(Advert::ADVERT_SIDEBAR_2);
            $view->with(compact('advert1', 'advert2'));
        });

        view()->composer('layouts.footer', function ($view) {
            $posts = Post::setPopularPosts(true);
            $categories = Category::setPopularCategories(true);
            $tags = Tag::setPopularTags(true);
            $view->with(compact('posts', 'categories', 'tags'));
        });

        Paginator::useBootstrap();
    }
}
