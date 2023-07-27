@extends('home')

@push('css')
@endpush

@section('content')
    <x-header-title-component title="Create User" :route="route('user.index')"></x-header-title-component>
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
            <div class="flex items-end flex-row h-20 gap-2 w-full">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Email</label>
                    <input value="{{ old('email') }}"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="email" placeholder="Email" />
                    @error('email')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Name</label>
                    <input value="{{ old('name') }}" id="name"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="name" placeholder="Name" />
                    @error('name')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                    <span id="msg_name" style="color:red;display:none">Không được dể trống</span>

                </div>
            </div>
            <div class="flex items-end flex-row h-20 gap-2 w-full">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="role">Role</label>
                    <select id='role'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="role">

                        @if (session('data')['role'] === App\Constants\RoleConstants::COMPANY_ACCOUNT)
                            <option value="{{ App\Constants\RoleConstants::MEMBER }}">
                                {{ App\Constants\RoleConstants::ARRAY_ROLE[App\Constants\RoleConstants::MEMBER] }}</option>
                        @else
                            @foreach (App\Constants\RoleConstants::ARRAY_ROLE as $key => $role)
                                <option value="{{ $key }}">{{ $role }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="companies">Assign Company</label>
                    <select id='companies'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="company_id">
                        @foreach ($companies as $key => $company)
                            <option value="{{ $key }}">{{ $company }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-center flex-row h-20 gap-2 w-[980px]">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Password</label>
                    <input value="{{ old('password') }}" type="password"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="password" id="password" placeholder="Password" />
                    @error('password')
                        <span class=" text-rose-600">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <div class="flex relative flex-col justify-center items-start gap-2 w-80">
                        <div class="w-full">
                            <label for="">Dob</label>
                            <input value="{{ old('dob') }}" type="date"
                                class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                                name="dob" placeholder="date of birth" />
                        </div>
                    </div>
                    <div class="absolute">
                        @error('dob')
                            <span class=" text-rose-600">{{ $message }}</span>
                        @enderror
                    </div>
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
        </div>
    </form>
@endsection


@push('js')
@endpush
