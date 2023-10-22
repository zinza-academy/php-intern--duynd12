<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        Auth::setDefaultDriver('api');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $content = $request->input('content');
        $postId = $request->input('post_id');

        $commentRecord = [
            'user_id' => JWTAuth::user()->id,
            'content' => $content,
            'post_id' => $postId,
        ];
        Comment::create($commentRecord);
        // $comment = $this->commentService->getDataAttrComment($record->id);

        return response()->json([
            'status' => 201,
            'message' => "Thêm thành công"
        ]);
    }

    //like or remove like
    public function changeLikeComment(int $id)
    {
        $user = User::findOrFail(JWTAuth::user()->id);
        $user->likes()->toggle($id);

        return response()->json([
            'status' => 204
        ]);
    }

    // change status resolve
    public function changeStatusResolve(int $commentId)
    {
        $this->commentService->handleChangeStatus($commentId);

        return response()->json(['status' => 204]);
    }
}
