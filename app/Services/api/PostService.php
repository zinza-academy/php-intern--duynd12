<?php

namespace App\Services\api;

use App\Constants\Pagination;
use App\Constants\StatusConstants;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostService
{
    //delete Post
    public function updatePost($data, int $id)
    {
        DB::beginTransaction();

        $post = Post::findOrFail($id);
        $post->update($data);
        $post->tags()->sync($data['tags']);
        Cache::forget(StatusConstants::KEY_CACHE_TOPIC);

        DB::commit();
    }

    //create Post
    public function createPost($posts)
    {
        DB::beginTransaction();
        $post = Post::create($posts);
        $post->tags()->attach($posts['tags']);
        Cache::forget(StatusConstants::KEY_CACHE_TOPIC);
        DB::commit();
    }

    //delete Post
    public function deletePost(int $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $post->update([
            'status' =>  StatusConstants::DELETE_BY_ADMIN_OR_COMPANY_ACCOUNT
        ]);
        $post->tags()->detach();
        Cache::forget(StatusConstants::KEY_CACHE_TOPIC);
    }

    // getPost with or without search
    public function getPost($keyword = null)
    {
        $posts = Post::with(['tags', 'user.profile', 'comments']);
        if ($keyword) {
            $posts->where('title', 'like', '%' . $keyword . '%')
                ->withTrashed()
                ->paginate(Pagination::LIMIT_RECORD);
        } else {
            $posts->withTrashed()
                ->paginate(Pagination::LIMIT_RECORD);
        }

        return $posts;
    }
};
