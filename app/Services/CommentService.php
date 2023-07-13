<?php

namespace App\Services;

use App\Models\Topic;

class CommentService
{
    // setAttribute totalComment , latestPost belongto topic
    public function setAttributeTopic($topics)
    {
        foreach ($topics as $topic) {
            $totalComment = $topic->posts->sum(function ($post) {
                return $post->comments->count();
            });
            $latestPost = $topic->posts->sortByDesc('created_at')->first();
            $topic->setAttribute('totalComment', $totalComment);
            $topic->setAttribute('latestPost', $latestPost);
        }
    }
}
