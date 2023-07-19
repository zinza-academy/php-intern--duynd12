<?php

namespace App\Services;

use App\Models\Comment;
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

    //handle logic change status resolve
    public function handleChangeStatus($comments, $commentId)
    {
        $checkResolve = in_array(true, $comments);
        $key = array_search(true, $comments);
        if (!$comments[$commentId]) {
            Comment::findOrFail($commentId)->update([
                'resolve' => true
            ]);
        }
        if ($checkResolve) {
            Comment::findOrFail($commentId)->update([
                'resolve' => true
            ]);
            Comment::findOrFail($key)->update([
                'resolve' => false
            ]);
        }
    }

    //getDataAttribute for comment
    public function getDataAttrComment($commentId)
    {
        $comment = Comment::with(['likes'])->findOrFail($commentId);
        $this->setAttrComment($comment);
        return $comment;
    }

    //setAttribute for comment
    public function setAttrComment($comment)
    {
        if (count($comment['likes']) > 0) {
            foreach ($comment['likes'] as $like) {
                $array[] = $like->user_id;
            }
            $comment->setAttribute('user_id_liked', $array);
        }
    }
}
