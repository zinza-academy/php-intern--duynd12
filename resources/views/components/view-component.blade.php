<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <td class="w-4 p-4">
        <div class="flex items-center list-input">
            <input name="user_ids[]" value="{{ $user->id }}" id="{{ $user->id }}" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="{{ $user->id }}" class="sr-only">checkbox</label>
        </div>
    </td>
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        <div class="flex">
            <img class="h-10 w-10 rounded rounded-full"
                src="{{ $user['profile']['avatar'] === null ? URL::asset('images/image 6.png') : URL::asset('images/image 6.png') }}"
                alt="1234">
            <div class="pl-4">
                <h1 class="font-medium text-sm decoration-gray-700">
                    {{ $user['profile']['name'] === null ? 'default' : $user['profile']['name'] }}</h1>
                <p class="font-thin text-base" style="color:#718096">{{ $user['email'] }}</p>
            </div>
        </div>
    </th>
    <td class="px-6 py-4">
        {{ date('d/m/Y', strtotime($user['profile']['dob'])) }}
    </td>
    <td class="px-6 py-4">
        <span class="rounded block status" style="background-color:#42C867;width:80px;text-align:center;color:#ffff">
            {{ \App\Constants\StatusConstants::COMPANY_ACTIVE[$user['status']] }}
        </span>

    </td>
    <td class="px-6 py-4">
        {{ $user->role }}
    </td>
    <td class="px-6 py-4" style="height:10px;width:80px">
        <img src="{{ URL::asset('images/threedots.png') }}" id="dropdownDefaultButton"
            data-dropdown-toggle="dropdown.{{ $user->id }}">
    </td>
    <x-popup-component name="user" :id="$user['id']"></x-popup-component>
    </div>
    </div>
</tr>
