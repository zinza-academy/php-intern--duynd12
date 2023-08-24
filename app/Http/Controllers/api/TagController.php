<?php

namespace App\Http\Controllers\api;

use App\Constants\Pagination;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::with(['posts'])->paginate(Pagination::LIMIT_RECORD);

        return response()->json([
            'tags' => $tags,
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $data = $request->validated();
        try {
            Tag::create($data);

            return response()->json([
                'message' => "Thêm thành công",
                "status" => 201
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Thêm thất bại",
            ]);
        }
    }

    //function get tagName
    public function getTagName()
    {
        $tagNames = Tag::pluck('name', 'id');

        return response()->json([
            'data' => $tagNames,
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $tag = Tag::findOrFail($id);

        return response()->json([
            'data' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            Tag::findOrFail($id)->update($data);

            return response()->json([
                'message' => "Sửa thành công",
                'status' => 204
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Sửa thất bại"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            Tag::findOrFail($id)->delete();

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

    // delete many tag
    public function deleteTags(Request $request)
    {
        try {
            $tagIds = $request->input('listTags');
            Tag::whereIn('id', $tagIds)->delete();

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
