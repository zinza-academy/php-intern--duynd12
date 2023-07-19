<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\CommentUser;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Services\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentService;

    //create function construct
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $content = $request->input('content');
        $postId = $request->input('post_id');
        $commentRecord = [
            'user_id' => Auth::id(),
            'content' => $content,
            'post_id' => $postId,
        ];
        $record = Comment::create($commentRecord);
        $comment = $this->commentService->getDataAttrComment($record->id);
        $html = view('components.comment-tpl', ['comment' => $comment, 'postId' => $postId])->render();

        return response()->json(['status' => 'ok', 'content' => $html]);
    }

    // change status resolve
    public function changeStatusResolve(int $postId, int $commentId)
    {
        $post = Post::with(['comments'])->where('id', $postId)
            ->first();
        $comments = $post->comments->pluck('resolve', 'id')->toArray();
        $this->commentService->handleChangeStatus($comments, $commentId);

        return response()->json(['status' => 'ok']);
    }

    //like or remove like
    public function changeLikeComment(int $id)
    {
        $user = User::findOrFail(Auth::id());
        $user->likes()->toggle($id);
        $comment = $this->commentService->getDataAttrComment($id);
        $totalHeart = count($comment->likes);
        $html = view('components.like-tpl', ['comment' => $comment])->render();

        return response()->json(['success' => true, 'comment_id' => $id, 'content' => $html, 'totalHeart' => $totalHeart]);
    }
}
