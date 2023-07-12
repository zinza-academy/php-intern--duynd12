<?php

namespace App\Http\Controllers;

use App\Constants\StatusConstants;
use App\Models\User;
use App\Services\CommentService;
use App\Services\TopicService;
use App\Services\UserService;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    const TIME_CACHE_MINUTE = 30;

    public $topicService;
    public $userService;
    public $commentService;

    //create function construct 

    public function __construct(TopicService $topicService, UserService $userService, CommentService $commentService)
    {
        $this->userService = $userService;
        $this->topicService  = $topicService;
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        if (Cache::has(StatusConstants::KEY_CACHE_TOPIC)) {
            $topics = Cache::get(StatusConstants::KEY_CACHE_TOPIC);
        } else {
            $topics = $this->topicService->getAllTopics();
            Cache::put(StatusConstants::KEY_CACHE_TOPIC, $topics, now()->addMinutes(self::TIME_CACHE_MINUTE));
        }
        $users = User::with('profiles')->get();
        $users = $users->pluck('profiles.name', 'profiles.user_id');
        $comments = $this->commentService->getComments($topics);

        return view(
            'dashboard',
            [
                'data' => $topics,
                'comments' => $comments,
                'users' => $users
            ]
        );
    }
}
