@extends('home')

@section('content')
    <x-title-component name="posts"></x-title-component>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        <img class="h-4 w-4 mr-2.5" src="{{ URL::asset('images/user.png') }}" alt="">
                        <span class="font-normal">Title</span>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        <img class="h-4 w-4 mr-2.5" src="{{ URL::asset('images/lock.png') }}" alt="">
                        <span class="font-normal">Author(for admin)</span>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        <img class="h-4 w-4 mr-2.5" src="{{ URL::asset('images/lock.png') }}" alt="">
                        <span class="font-normal">STATUS</span>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        <img class="h-4 w-4 mr-2.5" src="{{ URL::asset('images/lock.png') }}" alt="">
                        <span class="font-normal">TAGS</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $post)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-28">
                    <td class="w-4 p-4">
                        {{ $post->title }}
                    </td>
                    <td class="w-4 p-4">
                        {{ $post->users->profiles->name }}
                    </td>
                    <td class="w-4 p-4">
                        {{ \App\Constants\StatusConstants::STATUS_POST[$post->status] }}
                    </td>
                    <td class="w-4 p-4">
                        {{ $post->tags[0]->name }}
                    </td>
                    <td class="px-6 py-4 h-2.5 w-20">
                        <img src="{{ URL::asset('images/threedots.png') }}" class="float-right w-5"
                            id="dropdownDefaultButton" data-dropdown-toggle="dropdown.{{ $post->id }}">
                    </td>
                    <x-popup-component name="posts" :id="$post['id']"></x-popup-component>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
