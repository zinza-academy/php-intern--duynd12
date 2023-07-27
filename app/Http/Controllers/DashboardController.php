<?php

namespace App\Http\Controllers;

use App\Constants\StatusConstants;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use App\Services\CommentService;
use App\Services\TopicService;
use App\Services\UserService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
            return $this->topicService->getRelationshipWithTopics()->get();
        });
        $users = User::with('profile')->get();
        $users = $users->pluck('profile.name', 'profile.user_id');
        $this->commentService->setAttributeTopic($topics);
        $topUsers = Comment::with('user.profile')
            ->where('resolve', true)
            ->groupBy('user_id')
            ->select('user_id', DB::raw('COUNT(resolve) as resolve_count'))
            ->get();

        return view(
            'dashboard',
            compact('topics', 'users', 'topUsers')
        );
    }
}
