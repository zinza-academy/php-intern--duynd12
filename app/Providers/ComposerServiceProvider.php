<?php

namespace App\Providers;

use App\Constants\StatusConstants;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        view()->composer('topicDetail', function ($view) {
            $limitRecordPost = Post::with(['user.profile'])
                ->orderBy('created_at', 'desc')
                ->take(StatusConstants::LIMIT_RECORD)
                ->get();

            $view->with(['limitRecordPost' => $limitRecordPost]);
        });
    }
}
