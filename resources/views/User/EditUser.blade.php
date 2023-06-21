@extends('home')

@push('css')

@endpush

@section('content')
<h1>Page Edit </h1>
<form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 650px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Name</label>
                <input value={{$data['profiles']['name']}} id="name" class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="name" placeholder="Name"/>
                @error('name')
                    {{-- <span class=" text-rose-600">{{$message}}</span> --}}
                @enderror
            <span id ="msg_name" style="color:red;display:none">Không được dể  trống</span>

            </div> 
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Email</label>
                <input value={{$data['email']}} class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="email" placeholder="Email"/>
            </div>  
        </div>
        <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
            
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Dob</label>
                <input value={{$data['profiles']['dob']}} type="date"  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="dob" placeholder="Dob"/>
            </div>
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="role">Role</label>
                <select value={{$data['roles'][0]['name_role']}} id ='role' class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="role_id" placeholder="Dob">
                    @foreach($roles as $role)
                        <option value="{{$role['id']}}">{{$role['name_role']}}</option>
                    @endforeach  
                </select>
            </div>
            @error('dob')
                {{-- <span class=" text-rose-600">{{$message}}</span> --}}
            @enderror
        </div>
        <button class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
            Edit
        </button>
    </div>
</form>
@endsection


@push('js')

@endpush