<?php

namespace App\Services;

use App\Constants\Pagination;
use App\Constants\StatusConstants;
use App\Models\Topic;
use BadMethodCallException;
use Exception;

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

    //oder by theo pin , created_at with search
    public function sortDescDataWithSearch($data, $relation, $keyword = null)
    {
        $query =  $data->{$relation}()
            ->orderBy('pin', 'desc')
            ->orderBy('created_at', 'desc')
            ->where('title', 'like', '%' . $keyword . '%');

        return $query;
    }

    // get sortData posts
    public function getSortedPosts($id, $keyword = null)
    {
        $topics = Topic::with(['posts.comments'])
            ->where('id', $id)
            ->first();
        if ($topics == null) {
            abort(404, 'Not found');
        } else {
            $posts = $this->sortDescDataWithSearch($topics, 'posts', $keyword)
                ->paginate(Pagination::LIMIT_RECORD);
        }

        return $posts;
    }
}
