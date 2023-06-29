@extends('home')

@section('content')
    <x-title-component name="topics"></x-title-component>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="pb-4 bg-white dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="inset-y-0 left-0 flex items-center pl-3">
                    <button type="submit" id="delete-topics-btn" class="mr-2 rounded text-white"
                        style="background-color:#3CA3DD;height:40px;width:130px;margin-top:15px">
                        Delete Topics
                    </button>
                </div>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            <img style="height: 16px;width:16px ;margin-right:10px"
                                src="{{ URL::asset('images/user.png') }}" alt="">
                            <span class="font-normal">Name</span>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            <img style="height: 16px;width:16px ;margin-right:10px"
                                src="{{ URL::asset('images/lock.png') }}" alt="">
                            <span class="font-normal">Number of Posts</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $topic)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-28">
                        <td class="w-4 p-4">
                            <div class="flex items-center list-input">
                                <input name="topic_ids[]" value="{{ $topic->id }}" id="{{ $topic->id }}"
                                    type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="{{ $topic->id }}" class="sr-only">checkbox</label>
                                {{ $topic->name }}
                            </div>
                        </td>

                        <td class="w-4 p-4">
                            100
                        </td>
                        <td class="px-6 py-4" style="height:10px;width:80px">
                            <img src="{{ URL::asset('images/threedots.png') }}" class="float-right" style="width:20px"
                                id="dropdownDefaultButton" data-dropdown-toggle="dropdown.{{ $topic->id }}">
                        </td>
                        <x-popup-component name="topics" :id="$topic['id']"></x-popup-component>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection

    @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $data->links() }}
    @endif

    @section('js')
        <script type="text/javascript">
            var deleteTopicsUrl = '{{ route('topic.deleteTopics') }}';
        </script>
    @endsection
