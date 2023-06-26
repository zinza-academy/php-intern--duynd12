@extends('home')

@section('content')
<form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="pt-3 pr-0.5 pb-3 pl-6 flex flex-col items-start gap-5  left-0 top-20" style="width: 1444px;height:952px">
        <div class="flex items-end flex-row h-20 gap-2 " style="width: 650px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Name</label>
                <input value="{{old('name_company')}}" id="name" class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="name_company" placeholder="Name"/>
                @error('name_company')
                    <span class=" text-rose-600">{{$message}}</span>
                @enderror
            </div> 
            {{-- <div class="flex items-end">
                    <img src="" alt="" id="avatar" class="w-24 h-24 rounded-full bg-center">
                     <input type="file" name="avatar" id="ip_avatar">
            </div> --}}
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Avatar</label>
                <input type="file" id="ip_avatar" class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="logo" placeholder="logo"/>
                @error('logo')
                <span class=" text-rose-600">{{$message}}</span>
            @enderror
            </div>  
            <img src="" alt="" id="avatar" class="w-24 h-24 bg-center rounded-full">
        </div>
        <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="address">Address</label>
                <input value="{{old('address')}}" class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="address" id="address" placeholder="Address"/>
                @error('address')
                <span class=" text-rose-600">{{$message}}</span>
            @enderror
            </div>  
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="">Max_users</label>
                <input type="text"  value="{{old('max_users')}}" class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="max_users" placeholder="Max_users"/>
                @error('max_users')
                <span class=" text-rose-600">{{$message}}</span>
            @enderror
            </div>
        </div>
        <div class="flex items-end flex-row h-20 gap-2" style="width: 980px">
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="Expired_at">Exprired at</label>
                <input type="datetime-local" id ='Expired_at' class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="expired_time" placeholder="Expired">                    
                {{-- @error('expired_at')
                <span class=" text-rose-600">{{$message}}</span>
                @enderror --}}
            </div>
            <div class="flex flex-col items-start gap-2 h-20 w-80">
                <label for="Active">Active</label>
                <select  id ='active' class="border-2 bg-white rounded-md h-10 w-full py-1 pl-3 focus:outline-none focus:border-sky-500 focus:ring-sky-500" name="active" placeholder="">
                    @foreach(App\Constants\StatusConstants::COMPANY_ACTIVE as $status)
                        <option value="{{$status}}">{{$status}}</option>
                    @endforeach  
                </select>
            </div>
        </div>
        <button class="bg-sky-500 hover:bg-sky-700 h-10 w-80 text-cyan-50">
            ADD
        </button>
    </div>
    
</form>
@endsection

@section('js')
<script src="{{ asset('js/image.js') }}">

</script>

@endsection