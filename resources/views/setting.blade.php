@extends('home')

@section('content')
{{-- <ul>
    @foreach ($breadcrumbs as $key => $value)
        <a href="" style="color:blue">
                {{$value}}
        </a>
        @if (count($breadcrumbs) - 1 !== $key)
                >    
        @endif
    @endforeach
</ul> --}}
<x-breadcrumbs-component :array="$breadcrumbs"></x-breadcrumbs-component>
<form action="{{route('setting.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
            <h1 class="font-semibold mb-5">Account info</h1>
            <div class="flex items-end">
                @if($data[0]->profiles['avatar']!==null)
                    <img src="{{URL::asset('storage/images/avatar/').'/'.$data[0]->profiles['avatar']}}" alt="" id="avatar" class="w-24 h-24 rounded-full bg-center">
                @else
                    <img src="{{URL::asset('images/image 6.png')}}" alt="" id="avatar" class="w-24 h-24 rounded-full bg-center">
                @endif
                <input type="file" name="avatar" id="ip_avatar">
                {{-- <img src="{{URL::asset('/images/image8.png')}}" class="bg-cover h-7 w-7" alt="">           --}}
            </div>
            <span id ="error" style="color:red;display:none">File image không phù hợp</span>
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 650px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Name</label>
                <input value="{{$data[0]->profiles['name']}}" id="name" class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="name" placeholder="Name"/>
                @error('name')
                    <span class=" text-rose-600">{{$message}}</span>
                @enderror
            <span id ="msg_name" style="color:red;display:none">Không được dể  trống</span>

            </div> 
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Email</label>
                <input readonly value="{{$data[0]['email']}}" class="border-2 bg-gray-200 rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="email" placeholder="Email"/>
            </div>  
        </div>
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 980px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Old Password</label>
                <input  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="oldPassword" id="oldPassword" placeholder="Old Password"/>
            </div>  
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Password</label>
                <input class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="password" id="password" placeholder="Password"/>
                <span id ="msg_password" style="color:red;display:none">Mật khẩu không khớp nhau</span>
                
            </div>  
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Confirm Password</label>
                <input  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="confirmPassword" id="confirmPassword"placeholder="Confirm Password"/>
                @error('confirmPassword')
                    <span class=" text-rose-600">{{$message}}</span>
                @enderror
                <span id ="msg_confpass" style="color:red;display:none">Mật khẩu không khớp nhau</span>

            </div>  
        </div>
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 980px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Dob</label>
                <input value="{{$data[0]->profiles['dob']}}" type="date"  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="dob" placeholder="Dob"/>
            </div>
            @error('dob')
                <span class=" text-rose-600">{{$message}}</span>
            @enderror
        </div>
        <button class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
            Save
        </button>
    </div>
    
</form>

@endsection


@section('script')
<script type="text/javascript">
    console.log("121233");
</script>
@endsection