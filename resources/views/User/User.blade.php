@extends('home')

@push('css')

@endpush

@section('content')
<div class="">
    <div class="flex aligns-center w-full h-20 justify-between py-3 px-3" style="">
        <h1 class="text-base font-bold" style="color:#0000000;line-height:80px">User Management</h1>
        <button class="mr-2 rounded" style="background-color:#3CA3DD;height:40px;width:85px;margin-top:15px">
            <a href="{{route('user.create')}}" class="text-sm" style="color:white">New User</a>
        </button>
    </div>
    <div class="w-full" style="height: 801px">
        <table class="table-auto w-full">
            <thead class="bg-gray-500 border-2 border-gray-200 h-10" style="background-color: #F5F5F5">
              <tr>
                <th >
                    <div class="flex items-center">
                        <img style="height: 16px;width:16px ;margin-right:10px" src="{{URL::asset('images/user.png')}}" alt="">
                        <span class="font-normal">Name</span>
                    </div>
                </th>
                <th>
                    <div class="flex items-center">
                        <img style="height: 16px;width:16px ;margin-right:10px" src="{{URL::asset('images/lock.png')}}" alt="">
                        <span class="font-normal">DOB</span>
                    </div>
                </th>
                <th>
                    <div class="flex items-center">
                        <img style="height: 16px;width:16px ;margin-right:10px" src="{{URL::asset('images/time.png')}}" alt="">
                        <span class="font-normal">Status</span>
                        <img style="height: 16px;width:16px;margin-left:10px" src="{{URL::asset('images/up-arrow.png')}}" alt="">
                    </div>
                </th>
                <th>
                    <div class="flex items-center">
                        <img style="height: 16px;width:16px ;margin-right:10px" src="{{URL::asset('images/lock.png')}}" alt="">
                        <span class="font-normal">Role</span>
                    </div>
                </th>
              </tr>
            </thead>
            <tbody>
            @foreach($data as $user)
              <tr class="h-10 border-2" style="">
                <td class="h-20">
                    <div class="flex">
                        <img class="h-10 w-10" src="{{URL::asset('images/Avatar.png')}}" alt="1234">
                        <div class="pl-4">
                            <h1 class="font-medium text-sm decoration-gray-700">{{$user['profiles']['name'] === null ? 'default' : $user['profiles']['name']}}</h1>
                            <p class="font-thin text-base" style="color:#718096">{{$user['email']}}</p>
                        </div>
                    </div>
                </td>
                {{-- date('d-m-Y', strtotime($user['profiles']['dob'])); --}}
                <td class="text-sx" style="color:#2D3748">{{date('d/m/Y', strtotime($user['profiles']['dob']))}}</td>
                <td>
                    <span class="rounded block" style="background-color:#42C867;width:80px;text-align:center;color:#ffff">
                        {{$user['deleted_at'] === null ? 'ACTIVE' : ''}}
                    </span>
                </td>
                <td>{{$user['roles'][0]['name_role']}}</td>
                <td class="h-10 w-10 pr-4">
                    <img src="{{URL::asset('images/threedots.png')}}" id="dropdownDefaultButton" data-dropdown-toggle="dropdown" >
                </td>
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                      <li>
                        <h1>{{$user['profiles']['name']}}</h1>
                        <a href="{{route('user.edit',$user->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                      </li>
                      <li>
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="w-full block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</button>
                      </li>
                    </ul>
                </div>
              </tr>
            @endforeach
            </tbody>
          </table>
          <!-- Dropdown menu -->
          {{-- //check if used paginate --}}
          @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $data->links()}}
          @endif
    </div>
</div>
@endsection


@push('js')

@endpush