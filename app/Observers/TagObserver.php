<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Tag;

class TagObserver
{
    /**
     * Handle the Tag "saving" event.
     */
    public function saving(Tag $tag): void
    {
        $tag->slug = Str::slug($tag->name, '-');
    }
}
