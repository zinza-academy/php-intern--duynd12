<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Handle the Tag "saving" event.
     */
    public function saving(Post $post): void
    {
        $post->slug = Str::slug($post->title, '-');
    }
}
