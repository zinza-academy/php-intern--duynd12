<?php

namespace App\Services;

class CommentService
{
    // get all comment belongto topic

    public function getComments($topics)
    {
        $comments = [];
        foreach ($topics as $topic) {

            $totalComments = $topic->posts->sum(function ($post) {
                return $post->comments->count();
            });
            $comments[$topic->id] = ['comments' => $totalComments];
        }
        return $comments;
    }
}
