<?php

namespace App\Services;

use App\Models\Topic;

class CommentService
{
    // get all comment belongto topic
    public function getComments($topics)
    {
        foreach ($topics as $topic) {
            $totalComments = $topic->posts->sum(function ($post) {
                return $post->comments->count();
            });
            $topic->setAttribute('totalComment', $totalComments);
            $topic->setAttribute('latestPost', $topic->posts->first());
        }
    }
}
