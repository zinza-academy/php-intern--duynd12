@extends('home')

@section('content')
    <x-header-title-component title="Edit Company" :route="route('companies.index')"></x-header-title-component>
    <form action="{{ route('companies.update', $data['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
            <div class="flex items-end flex-row h-20 gap-2 " style="width: 650px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Name</label>
                    <input value="{{ old('name') ? old('name') : $data['name'] }}" id="name"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="name" placeholder="Name" />
                    @error('name')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                    <span id="msg_name" style="color:red;display:none">Không được dể trống</span>

                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Avatar</label>
                    <input type="file" id="ip_avatar"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="logo" placeholder="logo" />
                </div>
                <img src="{{ URL::asset($data['logo']) }}" alt="" id="avatar"
                    class="w-24 h-24 bg-center rounded-full">
            </div>
            <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="address">Address</label>
                    <input value="{{ old('address') ? old('address') : $data['address'] }}"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="address" id="address" placeholder="Address" />
                    <span id="msg_password" style="color:red;display:none">Mật khẩu không khớp nhau</span>
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Max_users</label>
                    <input value="{{ old('max_users') ? old('max_users') : $data['max_users'] }}" type="text"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="max_users" placeholder="Max_users" />
                </div>
            </div>
            <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="Expired_at">Exprired at</label>
                    <input type="datetime-local"
                        value="{{ old('expired_time') ? old('expired_time') : $data['expired_time'] }}" id='Expired_at'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="expired_time" placeholder="Expired">

                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="Active">Active</label>
                    <select id='active'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="status" placeholder="">
                        @foreach (App\Constants\StatusConstants::COMPANY_ACTIVE as $key => $status)
                            <option {{ $data['status'] == $status ? 'selected' : '' }} value="{{ $key }}">
                                {{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
                Save
            </button>
        </div>

    </form>
@endsection

@section('js')
    <script src="{{ asset('js/image.js') }}"></script>
@endsection
