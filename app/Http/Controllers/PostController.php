<?php

namespace App\Http\Controllers;

use App\Constants\StatusConstants;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Services\PostService;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{

    public $postService;

    //create function construct

    public function  __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::with(['tags', 'users.profiles'])->get();
        return view('posts.post', ['data' => $data]);
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
        //
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
            $post->tags()->detach();
            Cache::forget(StatusConstants::KEY_CACHE_TOPIC);

            Notify::success("Xóa thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }
        return back();
    }
}
