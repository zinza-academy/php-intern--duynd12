@extends('home')

@section('content')
    <x-header-title-component title="Create Company" :route="route('companies.index')"></x-header-title-component>
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
            <div class="flex items-end flex-row h-20 gap-2 " style="width: 650px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Name</label>
                    <input value="{{ old('name') }}" id="name"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="name" placeholder="Name" />
                    @error('name')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Avatar</label>
                    <input type="file" id="ip_avatar"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="logo" placeholder="logo" />
                    @error('logo')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                </div>
                <img src="" alt="" id="avatar" class="w-24 h-24 bg-center rounded-full">
            </div>
            <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="address">Address</label>
                    <input value="{{ old('address') }}"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="address" id="address" placeholder="Address" />
                    @error('address')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Max_users</label>
                    <input type="text" value="{{ old('max_users') }}"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="max_users" placeholder="Max_users" />
                    @error('max_users')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="Expired_at">Exprired at</label>
                    <input type="datetime-local" id='Expired_at'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="expired_time" placeholder="Expired">
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="Active">Active</label>
                    <select id='status'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="status" placeholder="">
                        @foreach (App\Constants\StatusConstants::COMPANY_ACTIVE as $key => $status)
                            <option value="{{ $key }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
                ADD
            </button>
        </div>
        </div>

    </form>
@endsection

@section('js')
    <script src="{{ asset('js/image.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
