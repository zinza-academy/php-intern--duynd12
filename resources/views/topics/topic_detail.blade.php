@extends('home')

@section('content')
    @if (count($posts) > 0)
        <h1 class="title mb-2 font-bold text-lg">Topic {{ $posts[0]->topic_id }}</h1>
        <div class="flex">
            <div class="w-[1300px]">
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="p-4
                flex items-center bg-white border-2 border-indigo-400 border-x-indigo-400 hover:bg-gray-50
                dark:hover:bg-gray-600 h-20"
                            style='width:1300px'>
                            <div class="w-681 flex justify-between items-center">
                                <div>
                                    <span class="block text-lg font-semibold">{{ $post->title }}</span>
                                    <span class="text-sm">{!! $post->description !!}</span>
                                </div>
                                <div class="m-[30px]">
                                    @if ($post->isPin())
                                        <img src="{{ asset('images/pin.png') }}" class="h-6 w-6" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="flex">
                                <div class="mr-5 w-112">
                                    <span class="block font-bold" style='color:#c2c2c2'>Comments</span>
                                    <span class="black font-bold">{{ count($post->comments) }}</span>
                                </div>
                                <div class="flex justify-center items-center">
                                    <img src="https://bold.vn/wp-content/uploads/2019/05/bold-academy-5.jpg" alt=""
                                        class="h-10 w-10 rounded-full mr-3">
                                    <div>
                                        <span class="block font-bold">{{ $post->title }}</span>
                                        <span class="font-bold" style="color:#C2C2C2">{{ $post->created_at }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right ml-16">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600">Xem chi tiết</a>
                            </div>
                        </div>
                    @endforeach
                    @if ($posts instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $posts->links() }}
                    @endif
                @else
                    <h1 class="text-center">Không có dữ liệu nào phù hợp</h1>
                @endif
            </div>
            <div class="pl-2 ml-2 border-l-gray-300 border-l-2 w-full" style="flex:1">
                <h1 class="p-2">Latest Post</h1>
                <hr>
                @foreach ($limitRecordPost as $post)
                    <div class="mt-2" style="flex:1">
                        <span class="font-bold text-black text-lg block">{{ $post->title }}</span>
                        <span class="text-black text-sm font-normal">{!! $post->description !!}</span>
                        <span style="color:#c2c2c2" class="text-sm block my-2">{{ $post->created_at }}</span>
                        <img src="{{ $post->user->profile->avatar ? URL::asset($post->user->profile->avatar) : asset('images/image 6.png') }}"
                            alt="" class="h-10 w-10 rounded-full mt-2">
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h1>Topic chưa có dữ liệu</h1>
    @endif
@endsection


@section('js')
    <script type="text/javascript">
        var searchUrl = '{{ route('topics.show', count($posts) > 0 ? $posts[0]->topic_id : '') }}';
    </script>
@endsection
