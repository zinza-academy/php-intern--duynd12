<?php

namespace App\Http\Controllers\api;

use App\Constants\Pagination;
use App\Constants\StatusConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use App\Services\CommentService;
use App\Services\TopicService;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\Cache;

class TopicController extends Controller
{
    private $commentService;
    private $topicService;

    public function __construct(CommentService $commentService, TopicService $topicService)
    {
        $this->commentService = $commentService;
        $this->topicService = $topicService;
    }

    //function get all topic
    public function getAllTopics()
    {
        $topics = Cache::remember(StatusConstants::KEY_CACHE_TOPIC, StatusConstants::TIME_CACHE_MINUTE, function () {
            return $this->topicService->getRelationshipWithTopics()->get();
        });
        $this->commentService->setAttributeTopic($topics);

        return response()->json([
            'topics' => $topics,
            'status' => 200
        ]);
    }

    //public function index
    public function index()
    {
        $topics = Topic::with(['posts.comments'])
            ->paginate(Pagination::LIMIT_RECORD);

        return response()->json([
            'topics' => $topics,
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request)
    {
        $data = $request->all();
        try {
            Topic::create($data);

            return response()->json([
                'message' => "Thêm thành công",
                'status' => 201
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    //function get topicName
    public function getTopicName()
    {
        $topicNames = Topic::pluck('name', 'id');

        return response()->json([
            'data' => $topicNames,
            'status' => 200
        ]);
    }

    // get topic by id
    public function getTopicById(int $id)
    {
        $topic = Topic::findOrFail($id);

        return response()->json([
            'data' => $topic
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            Topic::findOrFail($id)->update($data);

            return response()->json([
                'message' => "Sửa thành công",
                'status' => 204
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Sửa thất bại"
            ]);
        }

        return back();
    }

    // delete topic
    public function destroy(int $id)
    {
        try {
            Topic::findOrFail($id)->delete($id);

            return response()->json([
                'message' => "Xóa thành công",
                'status' => 200
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $posts = $this->topicService->getSortedPosts($id);

        return response()->json([
            'data' => $posts,
            'status' => 200
        ]);
    }

    // delete many topic
    public function deleteTopics(Request $request)
    {
        try {
            $topicIds = $request->get('listTopics');
            Topic::whereIn('id', $topicIds)->delete();

            return response()->json([
                'message' => 'Xóa thành công',
                'status' => 200
            ]);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
