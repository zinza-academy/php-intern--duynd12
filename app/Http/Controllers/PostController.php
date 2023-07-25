<?php

namespace App\Http\Controllers;

use App\Constants\Pagination;
use App\Constants\StatusConstants;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Services\CommentService;
use App\Services\PaginatorService;
use App\Services\PostService;
use App\Services\TopicService;
use Illuminate\Http\Request;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    private $topicService;
    private $postService;
    private $commentService;
    private $paginatorService;

    //create function construct
    public function  __construct(PostService $postService, CommentService $commentService, TopicService $topicService, PaginatorService $paginatorService)
    {
        $this->postService = $postService;
        $this->commentService = $commentService;
        $this->topicService = $topicService;
        $this->paginatorService = $paginatorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $column = 'status';
        $data = Post::with(['tags', 'user.profile', 'comments'])
            ->withTrashed();
        $data = $this->paginatorService->sortData($request, $column, $data);
        $data = $data->paginate(Pagination::LIMIT_RECORD);
        $param = $this->paginatorService->getParam($request, $column);

        return view('posts.post', ['data' => $data, 'param' => $param]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $topics = Topic::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('posts.addPost', [
            'topics' => $topics,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $this->postService->insertData($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $post = Post::with(['comments.likes', 'tags', 'user.company'])
            ->findOrFail($id);
        $comments = $post->comments()->with(['user.profile', 'user.company'])
            ->paginate(Pagination::LIMIT_RECORD);
        foreach ($comments as $key => $comment) {
            $this->commentService->setAttrComment($comment);
        }

        return view('posts.post_detail', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = Post::with('tags')->findOrFail($id);
        $topics = Topic::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('posts.editPost', ['data' => $data, 'topics' => $topics, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, int $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->validated();
        $this->postService->updateData($data, $id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            $post->update([
                'status' =>  StatusConstants::DELETE_BY_ADMIN_OR_COMPANY_ACCOUNT
            ]);
            $post->tags()->detach();
            Cache::forget(StatusConstants::KEY_CACHE_TOPIC);

            Notify::success("Xóa thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }

        return back();
    }

    // change status pin
    public function changeStatusPin(int $postId)
    {
        Cache::forget(StatusConstants::KEY_CACHE_TOPIC);
        $post = Post::findOrFail($postId);
        $post->update([
            'pin' => !$post->pin
        ]);
        $topics = $this->topicService->getRelationshipWithTopics()
            ->where('id', $post->topic_id)
            ->first();
        $html = view('components.pin-tpl', ['topics' => $topics])->render();

        return response()->json([
            'success' => 'ok',
            'content' => $html
        ]);
    }
}
