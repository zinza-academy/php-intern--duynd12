<?php

namespace App\Services;

use App\Constants\StatusConstants;
use App\Models\Post;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostService
{
    // insert data 

    public function insertData($data)
    {
        $data['user_id'] = Auth::id();
        try {
            DB::beginTransaction();
            $post = Post::create($data);
            $post->tags()->attach($data['tags']);
            Cache::forget(StatusConstants::KEY_CACHE_TOPIC);
            DB::commit();
            Notify::success('Thêm post thành công');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
            Notify::error($e->getMessage());
            return back()->withInput($data);
        }
    }

    // update data

    public function updateData($data, int $id)
    {
        try {
            DB::beginTransaction();
            $post = Post::findOrFail($id);
            $post->update($data);
            $post->tags()->sync($data['tags']);

            DB::commit();
            Notify::success('Sửa post thành công');
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
            return back()->withInput($data);
        }
    }
}
