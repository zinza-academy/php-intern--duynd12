@extends('home')

@section('content')
    <h1>Day la page dashboard</h1>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            style="background-color:#5C7099">
            <tr class='w-2'>
                <th scope="col" class="px-6 py-3 w-full">
                    <div class="flex items-center">
                        <span class="text-white font-medium text-lg">All Topic</span>
                    </div>
                </th>
            </tr>

        </thead>
        <tbody class="rounded">
            @foreach ($data as $topic)
                <tr
                    class="bg-white border-2 border-indigo-400 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-20">
                    <td class="w-1/2 p-4">
                        <span class="text-lg font-bold text-black ">{{ $topic->name }}</span>
                    </td>
                    <td class="w-4 p-4">
                        <span class="font-normal">Posts</span>
                        <span class="font-bold text-black">{{ count($topic->posts) }}</span>
                    </td>
                    <td class="w-4 p-4">
                        <span class="font-normal">Comments</span>
                        <span class="font-bold text-black">{{ $comments[$topic->id] }}</span>
                    </td>
                    <td class="px-6 py-4 flex mr-10">
                        <img src="https://vapa.vn/wp-content/uploads/2022/12/anh-3d-thien-nhien.jpeg"
                            class="h-12 w-12 rounded-full" alt="">
                        <div class="ml-2">
                            <h6 class="font-bold text-black">{{ $topic->posts[count($topic->posts) - 1]->title }}</h6>
                            <span class="font-normal"
                                style='color:#C2C2C2'>{{ $topic->posts[count($topic->posts) - 1]->created_at }}</span>
                        </div>

                    </td>
                </tr>
            @endforeach
            @foreach ($data as $topic)
                <x-list-topic-component :topic="$topic"></x-list-topic-component>
            @endforeach
            <div class="mt-4">
                @foreach ($data as $topic)
                    <span>{{ $topic->name }}</span>
                @endforeach
            </div>
        </tbody>
    </table>
@endsection
