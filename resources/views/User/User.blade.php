@extends('home')

@push('css')
@endpush

@section('content')
    <div class="">
        <x-title-component name="user"></x-title-component>
        <div class="w-full" style="height: 801px">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="pb-4 bg-white dark:bg-gray-900">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <button type="submit" id="delete-users-btn" class="mr-2 rounded text-white"
                                style="background-color:#3CA3DD;height:40px;width:130px;margin-top:15px">
                                Delete Users
                            </button>
                        </div>
                    </div>
                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <img style="height: 16px;width:16px ;margin-right:10px"
                                        src="{{ URL::asset('images/user.png') }}" alt="">
                                    <span class="font-normal">Name</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <img style="height: 16px;width:16px ;margin-right:10px"
                                    src="{{ URL::asset('images/lock.png') }}" alt="">
                                <span class="font-normal">DOB</span>
                            </th>
                            <th scope="col" class="px-6 py-3 flex">
                                <img style="height: 16px;width:16px ;margin-right:10px"
                                    src="{{ URL::asset('images/time.png') }}" alt="">
                                <span class="font-normal">Status</span>

                                <form action="{{ route('user.index') }}" method="GET">
                                    @if ($param == \App\Constants\StatusConstants::DESC)
                                        <input name="status" value="{{ \App\Constants\StatusConstants::ASC }}" hidden />
                                        <button type="submit">
                                            <img type="submit" style="height: 16px;width:16px;margin-left:10px"
                                                src="{{ URL::asset('images/down.png') }}" alt="">
                                        </button>
                                    @else
                                        <input name="status" value="{{ \App\Constants\StatusConstants::DESC }}" hidden />
                                        <button type="submit">
                                            <img type="submit" style="height: 16px;width:16px;margin-left:10px"
                                                src="{{ URL::asset('images/up-arrow.png') }}" alt="">
                                        </button>
                                    @endif
                                </form>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <img style="height: 16px;width:16px ;margin-right:10px"
                                        src="{{ URL::asset('images/lock.png') }}" alt="">
                                    <span class="font-normal">Role</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data1)
                            <x-view-component :data1="$data1"></x-view-component>
                        @endforeach
                    </tbody>
                </table>
                @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    {{ $data->links() }}
                @endif
            </div>

        </div>
    @endsection


    @section('js')
        <script>
            var listStatus = document.querySelectorAll('.status')
            for (let i = 0; i < listStatus.length; i++) {
                let status = listStatus[i];
                console.log(status.innerHTML.trim());
                if (status.innerHTML.trim() !== 'Active') {
                    status.style.backgroundColor = 'red';
                }
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let selectedUserIds = [];
            $('#delete-users-btn').on('click', function() {
                var recordIds = [];
                $('input[name="user_ids[]"]:checked').each(function() {
                    recordIds.push($(this).val());
                });
                if (recordIds.length > 0) {
                    $.ajax({
                        url: '{{ route('user.deleteUsers') }}',
                        type: 'DELETE',
                        data: {
                            ids: recordIds,

                        },
                        success: function(response) {
                            alert("Users deleted successfully");
                        },
                        error: function(xhr) {
                            alert("Xóa thất bại");
                        }
                    });
                }
            });
        </script>
    @endsection
