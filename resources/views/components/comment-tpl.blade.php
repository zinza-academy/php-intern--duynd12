<div class="w-full gap-3 bg-[#F1F1F1] p-2 flex h-[270px] mb-3">
    <div class="flex flex-col justify-center items-center w-[180px] border-2 bg-[#fff]">
        <img src="{{ asset('images/image 6.png') }}" class="w-20 h-20 rounded-full" alt="">
        <span class="font-bold">{{ $user->profile->name }}</span>
        <span>{{ $user->companie->name ?? '' }}</span>
    </div>
    <div class="flex-1 relative grid grid-flow-row bg-[#fff] p-2">
        <div class="flex items-center">
            <span class="text-[#c2c2c2] text-xs font-bold">{{ $comment->created_at }}</span>
            <div class="flex absolute right-4 items-center justify-center" id="heart.{{ $comment->id }}">
                <span class="mr-2 totalLike">{{ count($comment->likes) }}</span>
                <div class="float-right listIconHeart"
                    data-url="{{ route('comment.like_action', ['comment_id' => $comment->id]) }}">
                    @if (in_array(auth()->id(), $comment['user_id_liked'] ?? []))
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_19_5629)">
                                <path class="path"
                                    d="M8.10612 14.34L7.13945 13.46C3.70612 10.3467 1.43945 8.29333 1.43945 5.77333C1.43945 3.71999 3.05279 2.10666 5.10612 2.10666C6.26612 2.10666 7.37945 2.64666 8.10612 3.49999C8.83279 2.64666 9.94612 2.10666 11.1061 2.10666C13.1595 2.10666 14.7728 3.71999 14.7728 5.77333C14.7728 8.29333 12.5061 10.3467 9.07279 13.4667L8.10612 14.34Z"
                                    fill="#EC007F" />
                            </g>
                            <defs>
                                <clipPath id="clip0_19_5629">
                                    <rect x="0.106445" y="0.32" width="16" height="16" rx="5"
                                        fill="white" />
                                </clipPath>
                            </defs>
                            {{ $comment->id }}
                        </svg>
                    @else
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_19_5629)">
                                <path class="path"
                                    d="M11.1061 2.32C9.94612 2.32 8.83279 2.86 8.10612 3.71333C7.37945 2.86 6.26612 2.32 5.10612 2.32C3.05279 2.32 1.43945 3.93333 1.43945 5.98667C1.43945 8.50667 3.70612 10.56 7.13945 13.68L8.10612 14.5533L9.07279 13.6733C12.5061 10.56 14.7728 8.50667 14.7728 5.98667C14.7728 3.93333 13.1595 2.32 11.1061 2.32ZM8.17279 12.6867L8.10612 12.7533L8.03945 12.6867C4.86612 9.81333 2.77279 7.91333 2.77279 5.98667C2.77279 4.65333 3.77279 3.65333 5.10612 3.65333C6.13279 3.65333 7.13279 4.31333 7.48612 5.22667H8.73279C9.07945 4.31333 10.0795 3.65333 11.1061 3.65333C12.4395 3.65333 13.4395 4.65333 13.4395 5.98667C13.4395 7.91333 11.3461 9.81333 8.17279 12.6867Z"
                                    fill="#AFAFAF" />
                            </g>
                            <defs>
                                <clipPath id="clip0_19_5629">
                                    <rect x="0.106445" y="0.32" width="16" height="16" rx="5"
                                        fill="white" />
                                </clipPath>
                            </defs>
                            {{ $comment->id }}
                        </svg>
                    @endif
                </div>
                <div class="iconResolve"
                    data-url="{{ route('comment.changeStatusResolve', ['post_id' => $postId, 'comment_id' => $comment->id]) }}">
                    @if ($comment->isResolve())
                        <img src="{{ asset('images/resolved.png') }}" alt="123">
                    @else
                        <img src="{{ asset('images/resolve.png') }}" alt="123">
                    @endif
                </div>
            </div>
        </div>
        <div class="content text-sm">
            {{ $comment->content }}
        </div>
    </div>
</div>
