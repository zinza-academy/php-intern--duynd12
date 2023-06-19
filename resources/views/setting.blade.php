@extends('home')

@section('content')
<form action="{{route('setting.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
            <h1 class="font-semibold mb-5">Account info</h1>
            <div class="flex items-end">
                <img src="{{URL::asset('/images/image 6.png')}}" alt="" id="avatar">
                <input type="file" name="avatar">
                {{-- <img src="{{URL::asset('/images/image8.png')}}" class="bg-cover h-7 w-7" alt="">           --}}
            </div>
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 650px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Name</label>
                <input value="{{$data[0]->profiles['name']}}"  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="name" placeholder="Name"/>
            </div>  
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Email</label>
                <input readonly value="{{$data[0]['email']}}" class="border-2 bg-gray-200 rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="email" placeholder="Email"/>
            </div>  
        </div>
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 980px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Old Password</label>
                <input  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="oldPassword" placeholder="Old Password"/>
            </div>  
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Password</label>
                <input class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="password" placeholder="Password"/>
            </div>  
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Confirm Password</label>
                <input  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="confirmPassword" placeholder="Confirm Password"/>
            </div>  
        </div>
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 980px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Dob</label>
                <input value="{{$data[0]->profiles['dob']}}" type="date"  class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="dob" placeholder="Dob"/>
            </div>
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