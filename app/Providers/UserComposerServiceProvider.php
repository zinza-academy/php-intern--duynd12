<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class UserComposerServiceProvider extends ServiceProvider
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
        view()->composer(['components.comment-tpl', 'posts.postDetail'], function ($view) {
            $user = User::with(['profiles', 'companies'])
                ->findOrFail(Auth::id());
            $view->with(['user' => $user]);
        });
    }
}
