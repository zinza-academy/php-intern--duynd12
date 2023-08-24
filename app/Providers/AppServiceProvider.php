<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Observers\PostObserver;
use App\Observers\TagObserver;
use App\Observers\TopicObserver;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // URL::forceScheme('https');
        Paginator::useTailwind();
        Topic::observe(TopicObserver::class);
        Tag::observe(TagObserver::class);
        Post::observe(PostObserver::class);
    }
}
