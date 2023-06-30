@extends('home')

@section('content')
    <h1>Edit Tag</h1>
    <form action="{{ route('tags.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20">
            <div class="flex items-end flex-row h-20 gap-2">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Name</label>
                    <input value="{{ old('name') ? old('name') : $data['name'] }}" id="name"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="name" placeholder="Name" />
                    @error('name')
                        <span id="msg_name" class="text-red-600 hidden">{{ $name }}</span>
                    @enderror
                    <span id="msg_name" class="text-red-600 hidden">Không được dể trống</span>
                </div>
            </div>
            <button class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
                Edit
            </button>
        </div>
    </form>
@endsection


@push('js')
@endpush
