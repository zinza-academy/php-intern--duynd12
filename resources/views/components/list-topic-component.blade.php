    <table class="mt-7 w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            style="background-color:#5C7099">
            <tr class='w-2 rounded-md'>
                <th scope="col" class="px-6 py-3 w-full">
                    <div class="flex items-center">
                        <span class="text-white font-medium text-lg">{{ $topic->name }}</span>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3 w-full">
                    <a href="#" class="text-white font-medium text-sm">Read More</a>
                </th>
            </tr>

        </thead>
        <tbody class="rounded">
            @foreach ($topic->posts as $key => $post)
                @if ($key >= 5)
                    break;
                @else
                    <tr class="bg-white border-2 border-indigo-400 hover:bg-gray-50 dark:hover:bg-gray-600 h-20">
                        <td class="w-1/2 p-4">
                            <span class="text-lg font-bold text-black ">{{ $post->title }}</span>
                            <span
                                class="text-sm block text-black block w-24 overflow-hidden text-ellipsis whitespace-nowrap">
                                {!! $post->description !!}</span>
                        </td>
                        <td class="w-4 p-4">
                            <span class="font-normal">Comments</span>
                            <span class="font-bold text-black">{{ count($post->comments) }}</span>
                        </td>
                        <td class="px-6 py-4 flex mr-10">
                            <img src="https://vapa.vn/wp-content/uploads/2022/12/anh-3d-thien-nhien.jpeg"
                                class="h-12 w-12 rounded-full" alt="">
                            <div class="ml-2">
                                <h6 class="font-bold text-black">{{ $post->title }}</h6>
                                <span class="font-normal" style='color:#C2C2C2'>{{ $post->created_at }}</span>
                            </div>

                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
