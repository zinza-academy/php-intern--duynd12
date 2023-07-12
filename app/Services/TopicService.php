<?php

namespace App\Services;

use App\Constants\StatusConstants;
use App\Models\Topic;

class TopicService extends DatabaseService
{
    // create function construct
    public function __construct(Topic $model)
    {
        parent::__construct($model);
    }

    // get all topic with relation comment , posts , return data sort created_at
    public function getAllTopics()
    {
        $topics = Topic::with(['posts' => function ($query) {
            $query->with('comments')
                ->orderBy('posts.pin', 'desc')
                ->orderBy('posts.created_at', 'desc')
                ->take(\App\Constants\StatusConstants::LIMIT_RECORD);
        }])
            ->get();

        return $topics;
    }
}
