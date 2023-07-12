<?php

namespace App\Http\Controllers;

use App\Constants\Pagination;
use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Topic::paginate(Pagination::LIMIT_RECORD);
        return view('topics.topic', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('topics.addTopic');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request)
    {
        $data = $request->all();
        try {
            Topic::create($data);
            Notify::success("Thêm thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
            return back()->withInput($data);
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = Topic::findOrFail($id);
        return view('topics.editTopic', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TopicRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            Topic::findOrFail($id)->update($data);
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
            Topic::findOrFail($id)->delete($id);
            Notify::success("Xóa thành công");
        } catch (Exception $e) {
            Notify::error($e->getMessage());
        }
        return back();
    }

    // delete many topic 

    public function deleteTopics(Request $request)
    {

        $topicIds = $request->input('ids');
        Topic::whereIn('id', $topicIds)->delete();

        return response()->json(['message' => 'Users deleted successfully']);
    }
}
