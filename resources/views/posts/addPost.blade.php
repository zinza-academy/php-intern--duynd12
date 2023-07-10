@extends('home')


@section('content')
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20">
            <div class="flex items-end flex-row h-20 gap-2">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Title</label>
                    <input value="{{ old('title') }}" id="title"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="title" placeholder="Title" />
                    @error('title')
                        <span id="msg_name" class="text-red-600 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <label for="">Description</label>
                <div class=" bg-white rounded-b-lg dark:bg-gray-800 w-full mt-2">
                    <label for="editor" class="sr-only">Publish post</label>
                    <textarea rows="8"
                        class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                        placeholder="Write an article..." name="description" id="description"></textarea>
                </div>
            </div>

            <div class="flex flex-col items-start gap-2 h-20 w-80">
            </div>
            <div class="flex items-end flex-row h-20 gap-8">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Topic</label>
                    <select id='topic_id'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="topic_id" placeholder="Dob">
                        @foreach ($topics as $key => $topic)
                            <option value="{{ $key }}">{{ $topic }}</option>
                        @endforeach
                    </select>
                    @error('topic')
                        <span id="msg_name" class="text-red-600 block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-end flex-row h-20 gap-2">
                    <div class="flex flex-col items-start gap-2 h-20 w-80">
                        <label for="">Status</label>
                        <select id='status'
                            class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                            name="status" placeholder="Dob">
                            @foreach (\App\Constants\StatusConstants::STATUS_POST as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex items-end flex-row h-20 gap-2">
                <div class="flex flex-col items-start gap-2 h-20 w-80 rounded-md">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" multiple>
                        @foreach ($tags as $key => $tag)
                            <option value="{{ $key }}">{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
                ADD
            </button>
    </form>
    <label for="underline_select" class="sr-only">Underline select</label>
@endsection
@section('js')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
@endsection
