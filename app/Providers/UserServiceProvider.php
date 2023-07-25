<?php

namespace App\Providers;

use App\Models\User;
use App\ViewComposers\UserComposer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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
        View::composer(['components.comment-tpl', 'posts.post_detail', 'components.header-component'], UserComposer::class);
    }
}
