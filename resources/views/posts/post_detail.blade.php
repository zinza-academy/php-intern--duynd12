@extends('home')

@section('content')
    <div>
        <div class="flex justify-between">
            <h1>{{ $post->title }}</h1>
            @if ($user->isAdmin() || $user->isCompanyAccount())
                <img type="button" data-modal-target="show-notify-delete" data-modal-toggle="show-notify-delete"
                    src="{{ asset('images/Trash.png') }}" alt="">
            @endif
        </div>
        <div class="w-full gap-3 bg-[#F1F1F1] flex p-2 h-[270px]">
            <div class="flex flex-col justify-center items-center w-52 border-2  bg-[#fff]">
                <img src="{{ asset('images/image 6.png') }}" class="w-20 h-20 rounded-full" alt="">
                <span class="font-bold">Member 01 (author)</span>
                <span>Compnay 01</span>
            </div>
            <div class="w-full bg-[#fff] p-2">
                <span class="text-[#c2c2c2] text-xs font-bold">{{ $post->created_at }}</span>
                <div class="tags">
                    @foreach ($post->tags as $tag)
                        <span class="mr-2">{{ $tag->name }}</span>
                    @endforeach
                </div>
                <div>
                    <p>{!! $post->description !!}</p>
                </div>
            </div>
        </div>
        <div id="comment-wrap">
            @foreach ($comments as $comment)
                <div class="w-full gap-3 bg-[#F1F1F1] p-2 flex h-[270px] mb-3">
                    <div class="flex flex-col justify-center items-center w-[180px] border-2 bg-[#fff]">
                        <img src="{{ asset('images/image 6.png') }}" class="w-20 h-20 rounded-full" alt="">
                        <span class="font-bold">{{ $comment->user->profiles->name }}</span>
                        <span>{{ $comment->user->companies->name ?? '' }}</span>
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
                                                    <rect x="0.106445" y="0.32" width="16" height="16"
                                                        rx="5" fill="white" />
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
                                                    <rect x="0.106445" y="0.32" width="16" height="16"
                                                        rx="5" fill="white" />
                                                </clipPath>
                                            </defs>
                                            {{ $comment->id }}
                                        </svg>
                                    @endif
                                </div>
                                <div class="iconResolve"
                                    data-url="{{ route('comment.changeStatusResolve', ['post_id' => $post->id, 'comment_id' => $comment->id]) }}">
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
            @endforeach
        </div>
    </div>
    @if ($comments instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $comments->links() }}
    @endif
    <div class="w-full gap-3 bg-[#F1F1F1] flex p-2 h-[270px]">
        <div class="w-52 flex flex-col justify-center items-center border-2 bg-[#fff]">
            <img src="{{ $user->profiles->avatar ?? asset('images/image 6.png') }}" class="w-20 h-20 rounded-full"
                alt="">
            <span class="font-bold">Me</span>
            {{-- <span>{{ $user->companies->name }}</span> --}}
        </div>
        <div class="w-full h-[270px]">
            <form action="" method="post" data-url="{{ route('comments.store') }}">
                <input type="hidden" id='post_id' value="{{ $post->id }}" />
                <textarea id='content' class="content w-full h-full" placeholder="Write something ...." name="content"></textarea>
                <button type="button"
                    class="btn-submit-content float-right h-10 w-[109px] bg-[#3ca3dd] text-white">Send</button>
            </form>
        </div>
    </div>
    <div id="show-notify-delete" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Delete {{ $post->name }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="staticModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Are you sure? You can't undo this action afterwards.
                    </p>
                </div>
                <div class="flex items-center  p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="staticModal" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            I accept click
                        </button>
                    </form>
                    <button data-modal-hide="staticModal" type="button"
                        class="text-black bg-gray-300 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                </div>
            </div>
        @endsection

        @section('js')
            <script>
                var routeSubmitContent = '{{ route('comments.store') }}';

                $(document).on('click', '.listIconHeart', function(event) {
                    let url = $(this).data('url');
                    let element = $(this);
                    $.ajax({
                        url: url,
                        type: 'POST',
                        success: function(data) {
                            element.siblings('span').text(data.totalHeart);
                            element.replaceWith(data.content);
                        },
                        error: function(xhr) {}
                    })
                })

                $(document).on('click', '.iconResolve', function(event) {
                    let url = $(this).data('url');
                    let element = $(this);
                    $.ajax({
                        url: url,
                        type: 'POST',
                        success: function(data) {
                            location.reload();
                        },
                        error: function(xhr) {}
                    })
                })
            </script>
        @endsection
