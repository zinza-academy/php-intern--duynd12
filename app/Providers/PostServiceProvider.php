<?php

namespace App\Providers;

use App\Constants\StatusConstants;
use App\Models\Post;
use App\ViewComposers\PostComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['topics.topic_detail', 'dashboard'], PostComposer::class);
    }
}
