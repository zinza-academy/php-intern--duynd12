@extends('home')

@push('css')
@endpush

@section('content')
    <div class="">
        <x-title-component name="companies"></x-title-component>
        <div class="w-full" style="height: 801px">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <img style="height: 16px;width:16px ;margin-right:10px"
                                        src="{{ URL::asset('images/user.png') }}" alt="">
                                    <span class="font-normal">Name</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <img style="height: 16px;width:16px ;margin-right:10px"
                                        src="{{ URL::asset('images/lock.png') }}" alt="">
                                    <span class="font-normal">Copany Name</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 flex">
                                <img style="height: 16px;width:16px ;margin-right:10px"
                                    src="{{ URL::asset('images/time.png') }}" alt="">
                                <span class="font-normal">Status</span>
                                <x-sort-component name="status" :param="$param"></x-sort-component>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <img style="height: 16px;width:16px ;margin-right:10px"
                                        src="{{ URL::asset('images/lock.png') }}" alt="">
                                    <span class="font-normal">Number of users</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $company)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-28">
                                <th class="w-4 p-4">
                                    @if (count($company->users) > 0)
                                        <div class="flex">
                                            <img class="h-10 w-10"
                                                src="{{ URL::asset($company['users'][0]['profiles']['avatar']) }}"
                                                alt="Error">
                                            <div class="pl-4">
                                                <h1 class="font-medium text-sm decoration-gray-700">
                                                    {{ $company['users'][0]['profiles']['name'] }}
                                                </h1>
                                                <p class="font-thin text-base" style="color:#718096">
                                                    {{ $company['users'][0]['email'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                    </td>
                                <td class="w-4 p-4">
                                    {{ $company->name }}
                                </td>
                                <td class="w-4 p-4">
                                    <span class="status w-20 text-white text-center h-6">
                                        {{ $company->status === 0 ? 'Active' : 'In Active' }}
                                    </span>
                                </td>
                                <td class="w-4 p-4">
                                    {{ count($company->users) }}
                                </td>
                                <td class="px-6 py-4" style="height:10px;width:80px">
                                    <img src="{{ URL::asset('images/threedots.png') }}" style="width:20px"
                                        id="dropdownDefaultButton" data-dropdown-toggle="dropdown.{{ $company->id }}">
                                </td>
                                <x-popup-component name="companies" :id="$company['id']"></x-popup-component>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $data->links() }}
            @endif
        </div>
    @endsection
    @section('js')
        <script>
            var listStatus = document.querySelectorAll('.status')
            for (let i = 0; i < listStatus.length; i++) {
                let status = listStatus[i];
                status.style.display = 'block';

                if (status.innerHTML.trim() !== 'Active') {
                    status.style.backgroundColor = 'red';

                } else {
                    status.style.backgroundColor = '#42C867';
                }
            }
        </script>
    @endsection
