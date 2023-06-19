<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="{{ asset('js/app.js') }}" defer></script> 
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- vite --}}
        @vite('resources/css/app.css')
        <!-- Styles -->
    </head>
    <body>
        <div class="flex justify-between align-center border-2 bg-gradient-to-r from-purple-500 to-pink-500">
            <div>
                <nav class="flex justify-center space-x-4">
                    <a href="/dashboard" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Dashboard</a>
                    <a href="/team" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">User</a>
                    <a href="/projects" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Company</a>
                    <a href="/reports" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Topic</a>
                    <a href="/reports" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Tag</a>
                    <a href="/reports" class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900">Post</a>
        
                  </nav>
            </div>
            <div class="p-2 flex">
                <input type="text" placeholder="Search..." class="pl-9 rounded-sm border-2">
                <img src="{{URL::asset('/images/image 6.png')}}" class="w-7 h-7" alt="">
                
            </div>
        </div>
        <div class="container">
            @yield('content')
        </div>
        <div>
            footer    
        </div>
        @yield('script')
    </body>
</html>