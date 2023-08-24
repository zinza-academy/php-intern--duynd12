<?php

namespace App\Services;

use App\Constants\StatusConstants;
use App\Models\Comment;
use App\Models\Post;
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
    public function handleChangeStatus($commentId)
    {
        Comment::whereNotIn('id', [$commentId])
            ->where('resolve', true)
            ->update([
                'resolve' => false
            ]);
        $comment = Comment::findOrFail($commentId);
        $comment->update([
            'resolve' => !$comment->resolve
        ]);
        $post = Post::findOrFail($comment->post_id);
        if ($post->comments()->hasResolvedComment()->exists()) {
            $post->update([
                'status' => StatusConstants::RESOLVE
            ]);
        } else {
            $post->update([
                'status' => StatusConstants::NOT_RESOLVE
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
        $array = [];
        // if (count($comment['likes']) > 0) {
        foreach ($comment['likes'] as $like) {
            $array[] = $like->id;
        }
        $comment->setAttribute('user_id_liked', $array);
        // }
    }
}
