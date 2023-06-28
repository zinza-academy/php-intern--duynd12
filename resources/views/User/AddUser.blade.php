@extends('home')

@push('css')
@endpush

@section('content')
    <h1>Page AddUser</h1>

    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
            <div class="flex items-end flex-row h-20 gap-2 w-full">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Email</label>
                    <input value="{{ old('email') }}"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="email" placeholder="Email" />
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Name</label>
                    <input value="{{ old('name') }}" id="name"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="name" placeholder="Name" />
                    @error('name')
                        {{-- <span class=" text-rose-600">{{$message}}</span> --}}
                    @enderror
                    <span id="msg_name" style="color:red;display:none">Không được dể trống</span>

                </div>
            </div>
            <div class="flex items-end flex-row h-20 gap-2 w-full">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="role">Role</label>
                    <select id='role'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="role_id" placeholder="Dob">
                        @foreach (App\Constants\RoleContants::ARRAY_ROLE as $key => $role)
                            <option value="{{ $key }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="companies">Assign Company</label>
                    <select id='companies'
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="company_id">
                        @foreach ($companies as $company)
                            <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Password</label>
                    <input value="{{ old('password') }}"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="password" id="password" placeholder="Password" />
                    <span id="msg_password" style="color:red;display:none">Mật khẩu không khớp nhau</span>
                </div>
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Dob</label>
                    <input value="{{ old('dob') }}" type="date"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="dob" placeholder="Dob" />
                </div>
                @error('dob')
                    {{-- <span class=" text-rose-600">{{$message}}</span> --}}
                @enderror
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
