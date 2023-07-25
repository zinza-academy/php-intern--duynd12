@extends('home')

@section('content')
    <div class="flex">
        <div class="w-[1300px]">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    style="background-color:#5C7099">
                    <tr class='w-2'>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                <span class="text-white font-medium text-lg">All Topic</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="rounded">
                    @foreach ($topics as $topic)
                        <tr
                            class="bg-white border-2 border-indigo-400 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-20">
                            <td class="w-full p-4">
                                <span class="text-lg font-bold text-black ">{{ $topic->name }}</span>
                            </td>
                            <td class="w-4 p-4">
                                <span class="font-normal">Posts</span>
                                <span class="font-bold text-black">{{ count($topic->posts) }}</span>
                            </td>
                            <td class="w-4 p-4">
                                <span class="font-normal">Comments</span>
                                <span class="font-bold text-black">{{ $topic->totalComment }}</span>
                            </td>
                            @if ($topic->latestPost)
                                <td class="px-6 py-4 flex mr-10">
                                    <img src="https://vapa.vn/wp-content/uploads/2022/12/anh-3d-thien-nhien.jpeg"
                                        class="h-12 w-12 rounded-full" alt=""
                                        data-tooltip-target="tooltip-no-arrow.{{ $topic->latestPost->user_id }}">
                                    <span
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
                                        id="tooltip-no-arrow.{{ $topic->latestPost->user_id }}"
                                        role="tooltip">{{ $users[$topic->latestPost->user_id] }}</span>
                                    <div class="ml-2">
                                        <h6 class="font-bold text-black">{{ $topic->latestPost->title }}</h6>
                                        <span class="font-normal"
                                            style='color:#C2C2C2'>{{ $topic->latestPost->created_at }}</span>
                                    </div>

                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @foreach ($topics as $topic)
                @if (count($topic->posts) > 0)
                    <x-list-topic-component :topic="$topic" :users="$users"></x-list-topic-component>
                @endif
            @endforeach
            <div class="mt-4 w-full h-12 pl-2 flex items-center" style="background-color: #e5e6ec">
                @foreach ($topics as $topic)
                    <span class="mr-2">{{ $topic->name }}</span>
                @endforeach
            </div>
        </div>
        <div class="pl-2 ml-2 border-l-gray-300 border-l-2 w-[200px]">
            <div>
                <h1 class="p-2">Latest Post</h1>
                <hr>
                @foreach ($limitRecordPost as $post)
                    <div class="mt-2" style="flex:1">
                        <span class="font-bold text-black text-lg block">{{ $post->title }}</span>
                        <span class="text-black text-sm font-normal truncate line-clamp-1">{!! $post->description !!}...</span>
                        <span style="color:#c2c2c2" class="text-sm block my-2">{{ $post->created_at }}</span>
                        <img src="{{ $post->user->profile->avatar !== null ? URL::asset($post->user->profile->avatar) : asset('images/image 6.png') }}"
                            alt="" class="h-10 w-10 rounded-full mt-2">
                    </div>
                @endforeach
            </div>
            <div class="mt-2">
                <h1 class="font-bold">TOP USERS</h1>
                @foreach ($topUsers as $topUser)
                    <div class="user flex">
                        <img src="{{ $topUser->user->profile->avatar !== null ? $topUser->user->profile->avatar : asset('images/image 6.png') }}"
                            alt="" class="h-10 w-10 rounded-full mt-2">
                        <div class="info ml-4">
                            <span class="name block font-normal">{{ $topUser->user->profile->name ?? '' }}</span>
                            <span class="totalPoint font-bold">{{ $topUser->resolve_count }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).on('click', '.pinIcon', function() {
            var url = $(this).data('url');
            let element = $(this);
            $.ajax({
                url: url,
                type: 'POST',
                success: function(data) {
                    element.parents('.posts').replaceWith(data.content);
                },
                error: function(xhr) {}
            })
        })
    </script>
@endsection
