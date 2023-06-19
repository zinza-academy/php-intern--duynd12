<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- vite --}}
        @vite('resources/css/app.css')
        <!-- Styles -->
    </head>
    <body>
        
        <h1 class="text-center">Send Mail</h1>
        <div class="flex items-center justify-center">
            <div>
                <form action="{{route('mail.sendmail')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="block">
                        <span>Email Address</span>
                        <input class=" placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" 
                        type="text" name="email"/>
                    </div>
                    <div>
                        <span>Content</span>
                        <textarea class=" placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" 
                        type="text" name="content"></textarea>    
                    </div>
                    <button class="rounded-none bg-blue-500 mt-5" type="submit">Send mail</button>
                </form>
            </div>
        </div>
    </body>
</html>