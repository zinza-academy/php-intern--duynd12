<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Services\CommentService;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
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
    public function store(Request $request)
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
        $record = [
            'user_id' => Auth::id(),
            'comment_id' =>  $id
        ];
        $likeRecord = Like::where('user_id', Auth::id())
            ->where('comment_id', $id);
        if (count($likeRecord->get()) > 0) {
            $likeRecord->delete();
            $comment = $this->commentService->getDataAttrComment($id);
        } else {
            Like::create($record);
            $comment = $this->commentService->getDataAttrComment($id);
        }
        $totalHeart = count($comment->likes);
        $html = view('components.like-tpl', ['comment' => $comment])->render();

        return response()->json(['success' => true, 'comment_id' => $id, 'content' => $html, 'totalHeart' => $totalHeart]);
    }
}
