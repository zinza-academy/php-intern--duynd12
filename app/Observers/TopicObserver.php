<?php

namespace App\Observers;

use Illuminate\Support\Str;

use App\Models\Topic;

class TopicObserver
{
    /**
     * Handle the Topic "created" event.
     */
    public function created(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "updated" event.
     */
    public function updated(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "deleted" event.
     */
    public function deleted(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "restored" event.
     */
    public function restored(Topic $topic): void
    {
        //
    }

    /**
     * Handle the Topic "force deleted" event.
     */
    public function forceDeleted(Topic $topic): void
    {
        //
    }

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
