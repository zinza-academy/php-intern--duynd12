@extends('home')

@section('content')
    <x-title-component name="posts"></x-title-component>
    <table class="border-2 w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                        <form action="{{ route('posts.index') }}" method="GET">
                            @if ($param == \App\Constants\StatusConstants::DESC)
                                <input name="status" value="{{ \App\Constants\StatusConstants::ASC }}" hidden />
                                <button type="submit">
                                    <img type="submit" class="h-4 w-4 h.-2.5" src="{{ URL::asset('images/down.png') }}"
                                        alt="">
                                </button>
                            @else
                                <input name="status" value="{{ \App\Constants\StatusConstants::DESC }}" hidden />
                                <button type="submit">
                                    <img type="submit" class="h-4 w-4 h.-2.5" src="{{ URL::asset('images/up-arrow.png') }}"
                                        alt="">
                                </button>
                            @endif
                        </form>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        <img class="h-4 w-4 mr-2.5" src="{{ URL::asset('images/lock.png') }}" alt="">
                        <span class="font-normal">TAGS</span>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $post)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-28">
                    <td class="w-4 p-4">
                        <span class="text-black">
                            {{ $post->title }}
                        </span>
                    </td>
                    <td class="w-4 p-4">
                        <span class="text-black">
                            {{ $post->user->profile->name }}
                        </span>
                    </td>
                    <td class="w-4 p-4">
                        <span class="status w-20 p-1 text-white rounded text-center block">
                            {{ \App\Constants\StatusConstants::STATUS_POST[$post->status] }}
                        </span>
                    </td>
                    @if (count($post->tags) > 0)
                        <td class="w-4 p-4">
                            <span class="w-20 p-1 rounded-lg text-center block bg-[#319795] text-white">
                                {{ $post->tags[0]->name }}
                            </span>
                        </td>
                    @else
                        <td></td>
                    @endif

                    @if ($post->deleted_at == null)
                        <td class="px-6 py-4 h-2.5 w-20">
                            <img src="{{ URL::asset('images/threedots.png') }}" class="float-right w-5"
                                id="dropdownDefaultButton" data-dropdown-toggle="dropdown.{{ $post->id }}">
                        </td>
                        <x-popup-component name="posts" :id="$post['id']"></x-popup-component>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script type="text/javascript">
        let listStatus = document.querySelectorAll('.status');
        listStatus.forEach((element, index) => {
            switch (element.innerText.trim()) {
                case 'Resolve':
                    element.style.backgroundColor = '#1BC268';
                    break;
                case 'Not Resolve':
                    element.style.backgroundColor = "#718096";
                    element.style.width = '100px';
                    break;
                case 'Delete by admin/company_account':
                    element.style.width = '300px';
                    element.style.backgroundColor = '#DD4040';
                    break;
            }
        });
    </script>
@endsection()
