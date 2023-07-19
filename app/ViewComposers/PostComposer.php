<?php

namespace App\ViewComposers;

use App\Constants\StatusConstants;
use App\Models\Post;
use Illuminate\View\View;

class PostComposer
{

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $limitRecordPost = Post::with(['user.profile'])
            ->orderBy('created_at', 'desc')
            ->take(StatusConstants::LIMIT_RECORD)
            ->get();
        $view->with(['limitRecordPost' => $limitRecordPost]);
    }
}
