<?php

namespace App\ViewComposers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $user = User::with(['profiles', 'companies'])
            ->findOrFail(Auth::id());
        $view->with(['user' => $user]);
    }
}
