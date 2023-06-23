<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <td class="w-4 p-4">
        <div class="flex items-center list-input">
            <input name="user_ids[]" value="{{$data1->id}}" id="{{$data1->id}}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="{{$data1->id}}" class="sr-only">checkbox</label>
                </div>
        </td>
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex">
                <img class="h-10 w-10" src="{{URL::asset('images/Avatar.png')}}" alt="1234">
                <div class="pl-4">
                    <h1 class="font-medium text-sm decoration-gray-700">{{$data1['profiles']['name'] === null ? 'default' : $data1['profiles']['name']}}</h1>
                    <p class="font-thin text-base" style="color:#718096">{{$data1['email']}}</p>
                </div>
             </div>
        </th>
        <td class="px-6 py-4">
            {{date('d/m/Y', strtotime($data1['profiles']['dob']))}}
        </td>
        <td class="px-6 py-4">
            @if($data1['deleted_at'] === null && $data1['status'] == \App\Constants\StatusConstants::ACTIVE)
                <span class="rounded block" style="background-color:#42C867;width:80px;text-align:center;color:#ffff">
                    ACTIVE
                </span>
            @else
                <span class="rounded block" style="background-color:red;width:100px;text-align:center;color:#ffff">
                    NO ACTIVE
                </span>
            @endif
        </td>
            <td class="px-6 py-4">
                {{$data1['roles'][0]['name_role']}}
            </td>
            <td class="px-6 py-4" style="height:10px;width:80px">
                <img src="{{URL::asset('images/threedots.png')}}" id="dropdownDefaultButton" data-dropdown-toggle="dropdown.{{$data1->id}}" >
            </td>
            <div id="dropdown.{{$data1->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{route('user.edit',$data1->id)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                    </li>
                    <li>
                        <a type="button" data-modal-target="staticModal" data-modal-toggle="staticModal.{{$data1->id}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                    </li>
                </ul>
            </div>
                <div id="staticModal.{{$data1->id}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Delete Company
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                </button>
                            </div>
                            <div class="p-6 space-y-6">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    Are you sure? You can't undo this action afterwards.
                                </p>
                            </div>
                        <div class="flex items-center  p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <form action="{{route('user.delete',$data1->id)}}" method="POST">
                                @csrf
                                @method('DELETE')  
                                <button data-modal-hide="staticModal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    I accept click     
                                </button>
                            </form>
                    <button data-modal-hide="staticModal" type="button" class="text-black bg-gray-300 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                </div>
            </div>
        </div>
     </div>
</tr>