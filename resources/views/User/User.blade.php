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
                        <a type="button" data-modal-target="staticModal" data-modal-toggle="staticModal" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                      </li>
                    </ul>
                </div>
                  <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                      <div class="relative w-full max-w-2xl max-h-full">
                          <!-- Modal content -->
                          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                              <!-- Modal header -->
                              <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Delete Company
                                  </h3>
                                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                  </button>
                              </div>
                              <!-- Modal body -->
                              <div class="p-6 space-y-6">
                                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                     Are you sure? You can't undo this action afterwards
                                  </p>
                                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                      The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                                  </p>
                              </div>
                              <!-- Modal footer -->
                              <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                  <button data-modal-hide="staticModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                  <button data-modal-hide="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                              </div>
                          </div>
                      </div>
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