<?php

namespace App\Observers;

use Illuminate\Support\Str;

use App\Models\Topic;

class TopicObserver
{
    /**
     * Handle the post "saving" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function saving(Topic $topic)
    {
        $topic->slug = Str::slug($topic->name, '-');
    }

    /**
     * Handle the  "updating" event.
     *
     *
     */
    public function updating(Topic $topic)
    {
        $topic->slug = Str::slug($topic->name, '-');
    }
}
