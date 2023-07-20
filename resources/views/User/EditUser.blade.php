@extends('home')

@push('css')
@endpush

@section('content')
    <x-header-title-component title="Edit User" :route="route('user.index')"></x-header-title-component>
    <form action="{{ route('user.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20">
            <div class="flex items-end flex-row h-20 gap-2">
                @if (session('data')['role'] == App\Constants\RoleConstants::ADMINISTRATOR)
                    <div class="flex flex-col items-start gap-2 h-20 w-80">
                        <label for="">Email</label>
                        <input value={{ old('email') ? old('email') : $data['email'] }} id="name"
                            class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                            name="email" placeholder="email" />
                        <span id="msg_name" style="color:red;display:none">Không được dể trống</span>
                    </div>
                @endif
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Name</label>
                    <input value={{ old('name') ? old('name') : $data['profile']['name'] }} id="name"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="name" placeholder="Name" />
                    @error('name')
                        {{-- <span class=" text-rose-600">{{$message}}</span> --}}
                    @enderror
                    <span id="msg_name" style="color:red;display:none">Không được dể trống</span>

                </div>
                @if (session('data')['role'] !== \App\Constants\RoleConstants::COMPANY_ACCOUNT)
                    <div class="flex flex-col items-start gap-2 h-20 w-80">
                        <label for="companies">Assign Company</label>
                        <select id='companies'
                            class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                            name="company_id">
                            @foreach ($companies as $companies)
                                <option {{ $data->company_id === $companies->id ? 'selected' : '' }}
                                    value="{{ $companies->id }}">{{ $companies['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
                <div class="flex flex-col items-start gap-2 h-20 w-80">
                    <label for="">Dob</label>
                    <input value="{{ old('dob') ? old('dob') : $data['profile']['dob'] }}" type="date"
                        class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                        name="dob" placeholder="Dob" />
                </div>
                @if (session('data')['role'] !== \App\Constants\RoleConstants::COMPANY_ACCOUNT)
                    <div class="flex flex-col items-start gap-2 h-20 w-80">
                        <label for="role">Role</label>
                        <select id='role'
                            class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500"
                            name="role" placeholder="Dob">
                            @foreach (App\Constants\RoleConstants::ARRAY_ROLE as $key => $role)
                                <option {{ $data->role === $key ? 'selected' : '' }} value="{{ $key }}">
                                    {{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @error('dob')
                    {{-- <span class=" text-rose-600">{{$message}}</span> --}}
                @enderror
            </div>
            <button type="submit" class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
                Edit
            </button>
        </div>
    </form>
@endsection


@push('js')
@endpush
