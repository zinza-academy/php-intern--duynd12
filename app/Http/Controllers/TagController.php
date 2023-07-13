<?php

namespace App\Http\Controllers;

use App\Constants\Pagination;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::paginate(Pagination::LIMIT_RECORD);

        return view('tags.tag', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.addTag');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $data = $request->all();
        try {
            Tag::create($data);
            Notify::success("Thêm thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
            return back()->withInput($data);
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = Tag::findOrFail($id);

        return view('tags.editTag', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            Tag::findOrFail($id)->update($data);
            Notify::success("Sửa thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());

            return back()->withInput($data);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            Tag::findOrFail($id)->delete();
            Notify::success("Xóa thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }

        return back();
    }

    // delete many tag 

    public function deleteTags(Request $request)
    {

        $tagIds = $request->input('ids');
        Tag::whereIn('id', $tagIds)->delete();

        return response()->json(['message' => 'Tags deleted successfully']);
    }
}
