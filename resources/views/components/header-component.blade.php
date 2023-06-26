<div class="flex justify-between align-center border-2 bg-gradient-to-r from-purple-500 to-pink-500">
    <div>
        <nav class="flex justify-center space-x-4">
            <a href="{{route('dashboard')}}" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Dashboard</a>
            <a href="{{route('user.index')}}" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">User</a>
            <a href="{{route('companies.index')}}" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Company</a>
            <a href="/reports" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Topic</a>
            <a href="/reports" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Tag</a>
            <a href="/reports" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Post</a>
        </nav>
    </div>
    <div class="p-2 flex justify-center items-center">
        <input class="border-2 rounded-md py-1 mr-5
            pl-3 focus:outline-none
            bg-white 
            focus:border-sky-500 focus:ring-sky-500" name="email" 
            
            placeholder="Search ....."/>
            <img type="button" id="dropdownDefaultButton" data-dropdown-toggle="dropdown" src="{{URL::asset('/images/image 6.png')}}" class="w-8 h-8 mr-2" alt="">
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                  <li>
                    <a href="{{route('setting.store')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Setting</a>
                  </li>
                  <li>
                    <a href="{{route('logout.logout')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logout</a>
                  </li>
                </ul>
            </div>
    </div>
</div>