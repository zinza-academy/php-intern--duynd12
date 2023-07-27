<tbody class="rounded posts">
    @foreach ($topics->posts as $key => $post)
        <tr class="bg-white border-2 border-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-600 h-20 post">
            <td class="w-full p-4">
                <span class="text-lg font-bold text-black ">{{ $post->title }}</span>
                <span class="text-sm text-black overflow-hidden text-ellipsis whitespace-nowrap truncate line-clamp-1">
                    {!! $post->description !!}...</span>
            </td>
            @if (auth()->user()->role == \App\Constants\RoleConstants::ADMINISTRATOR)
                <td class="pinIcon" data-url="{{ route('post.changeStatusPin', $post->id) }}">
                    @if ($post->pin)
                        <img src="{{ asset('images/pin.png') }}" class="h-6 w-6" alt="">
                    @else
                        <img src="{{ asset('images/push-pin.png') }}" class="h-6 w-6" alt="">
                    @endif
                </td>
            @else
                <td>
                    @if ($post->isPin())
                        <img src="{{ asset('images/pin.png') }}" class="h-6 w-6" alt="">
                    @endif
                </td>
            @endif
            <td class="w-4 p-4">
                <span class="font-normal">Comments</span>
                <span class="font-bold text-black">{{ count($post->comments) }}</span>
            </td>
            <td class="px-6 py-4 flex mr-10">
                <img src="https://vapa.vn/wp-content/uploads/2022/12/anh-3d-thien-nhien.jpeg"
                    class="h-12 w-12 rounded-full"
                    alt=""data-tooltip-target="tooltip-no-arrow.{{ $key }}">
                <div class="ml-2">
                    <h6 class="font-bold text-black">{{ $post->title }}</h6>
                    <span class="font-normal" style='color:#C2C2C2'>{{ $post->created_at }}</span>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
