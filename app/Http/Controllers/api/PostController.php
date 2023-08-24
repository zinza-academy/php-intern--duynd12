<?php

namespace App\Http\Controllers\api;

use App\Constants\Pagination;
use App\Constants\StatusConstants;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\PostRequest as ApiPostRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Services\api\PostService as ApiPostService;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\TopicService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;


class PostController extends Controller
{
    private $topicService;
    private $commentService;
    private $postService;
    private $postApiService;

    public function __construct(
        TopicService $topicService,
        CommentService $commentService,
        PostService $postService,
        ApiPostService $postApiService
    ) {
        Auth::setDefaultDriver('api');
        $this->topicService = $topicService;
        $this->commentService = $commentService;
        $this->postService = $postService;
        $this->postApiService = $postApiService;
    }

    // get limit post
    public function limitRecordPost()
    {
        $limitRecordPost = Post::with(['user.profile'])
            ->orderBy('created_at', 'desc')
            ->take(StatusConstants::LIMIT_RECORD)
            ->get();

        return response()->json([
            'limitRecordPost' => $limitRecordPost,
            'status' => 200
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['tags', 'user.profile', 'comments'])
            ->withTrashed()
            ->paginate(Pagination::LIMIT_RECORD);

        return response()->json([
            'posts' => $posts,
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApiPostRequest $request)
    {
        $user_id = JWTAuth::user()->id;
        $posts = $request->validated();
        $posts['user_id'] = $user_id;

        try {
            $this->postApiService->createPost($posts);

            return response()->json([
                'message' => "Thêm thành công",
                'status' => 201
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApiPostRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            $this->postApiService->updatePost($data, $id);

            return response()->json([
                'message' => "Sửa thành công",
                'status' => 200
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->postApiService->deletePost($id);

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

    //get post by id
    public function getPostById(int $id)
    {
        $post = Post::with(['tags'])->findOrFail($id);

        return response()->json([
            'data' => $post
        ]);
    }

    // change status pin
    public function changeStatusPin(int $postId)
    {
        Cache::forget(StatusConstants::KEY_CACHE_TOPIC);
        $post = Post::findOrFail($postId);
        $post->update([
            'pin' => !$post->pin
        ]);

        return response()->json([
            'status' => 204
        ]);
    }

    //show post detail
    public function show(int $id)
    {
        $post = Post::with(['comments.likes', 'tags', 'user.company'])
            ->findOrFail($id);
        $comments = $post->comments;
        foreach ($comments as $key => $comment) {
            $this->commentService->setAttrComment($comment);
        }

        return response()->json([
            'data' => $post,
            'stats' => 200
        ]);
    }

    //search post
    public function searchPost(Request $request)
    {
        $keyword = $request->input('search');
        $posts = Post::with(['tags', 'user.profile', 'comments'])
            ->where('title', 'like', '%' . $keyword . '%')
            ->withTrashed()
            ->paginate(Pagination::LIMIT_RECORD);

        return response()->json([
            'data' => $posts
        ]);
    }
}
