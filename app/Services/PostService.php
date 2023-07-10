<?php

namespace App\Services;

use App\Models\Post;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\DB;

class PostService
{
    // insert data 

    public function insertData($data)
    {
        try {
            DB::beginTransaction();
            $post = Post::create($data);
            $post->tags()->attach($data['tags']);
            DB::commit();
            Notify::success('Thêm post thành công');
        } catch (Exception $e) {
            DB::rollBack();
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
