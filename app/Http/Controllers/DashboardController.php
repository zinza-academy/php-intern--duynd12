<?php

namespace App\Http\Controllers;

use App\Constants\StatusConstants;
use App\Models\Topic;
use App\Models\User;
use App\Services\CommentService;
use App\Services\TopicService;
use App\Services\UserService;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    private $topicService;
    private $userService;
    private $commentService;

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
        $topics = Cache::remember(StatusConstants::KEY_CACHE_TOPIC, StatusConstants::TIME_CACHE_MINUTE, function () {
            return $this->topicService->getAllTopics();
        });
        $users = User::with('profile')->get();
        $users = $users->pluck('profile.name', 'profile.user_id');
        $this->commentService->setAttributeTopic($topics);

        return view(
            'dashboard',
            compact('topics', 'users')
        );
    }
}
