<div class="iconResolve" data-url="{{ route('comment.changeStatusResolve', ['comment_id' => $comment->id]) }}">
    @if ($comment->isResolve())
        <img src="{{ asset('images/resolved.png') }}" alt="123">
    @else
        <img src="{{ asset('images/resolve.png') }}" alt="123">
    @endif
</div>
<div class="content text-sm">
    {{ $comment->content }}
</div>
