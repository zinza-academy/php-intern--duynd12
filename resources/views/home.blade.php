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
        <link href="{{asset('css/app.css')}}">
        {{-- vite --}}
        @vite('resources/css/app.css')
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Styles -->
    </head>
    {!! Notify::render() !!}
    <body>
        <x-header-component>

        </x-header-component>
        <div class="container">
            @yield('content')
        </div>
        <div>
            footer    
        </div>
        @yield('js')
    </body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

</html>