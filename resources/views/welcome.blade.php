<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/output.css">
    {{-- vite --}}
    {{-- <link rel="stylesheet" href="/css/app.css"> --}}
    {{-- @vite('resources/css/app.css') --}}
    <!-- Styles -->
</head>

<body>
    <div class="flex min-h-full h-screen flex-col items-center justify-center bg-[#F5F5F5]">
        <div class="rounded-2xl w-2/5 border border-slate-200 h-4/5 bg-white">
            <div class="px-6 py-4">
                <h1 class="font-medium text-sm">Login</h1>
            </div>
            <hr>
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img src="{{ URL::asset('/images/image 6.png') }}" class="mx-auto mt-2 h-24 w-24 rounded-lg w-auto"
                    alt="">
            </div>
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <div class="mt-2">
                            <input id="email" name="email" type="text" autocomplete="text"
                                class="decoration-[#323941] pl-4 w-96 h-9 grow-0 border-2 border-slate-200 order-none
                    focus:border-sky-300  focus:outline-none order-none rounded
                    "
                                placeholder="Email">
                            @error('email')
                                <span class=" text-rose-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <div>
                                <input id="password" name="password" type="password" autocomplete="text"
                                    class=" decoration-[#323941] pl-4 w-96 h-9 grow-0 border-2 border-slate-200 order-none
                        focus:outline-none focus:border-sky-300 focus:ring-1 placeholder-opacity-80
                        rounded font-normal placeholder-color not-italic text-sm"
                                    placeholder="Password">
                                @error('password')
                                    <span class=" text-rose-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @if (Session::has('message'))
                        <span class="text-center ml-30 text-rose-600">{{ Session::get('message') }}</span>
                    @endif
                    <div class="mb-2">
                        <a href="" class="float-right mb-4 font-normal text-xs">Forgot password ?</a>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-96 h-10 decoration-white font-medium text-sm
                    flex w-full justify-center rounded-md bg-sky-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Login
                        </button>
                    </div>
                </form>
                <div class="grid grid-cols-3 items-center mt-8">
                    <hr class="border border-[#000000]">
                    <p class="text-center">OR</p>
                    <hr class="border border-[#000000]">
                </div>
                <div>
                    <div>
                        <button type=""
                            class="w-96 h-10 border-2 mt-10 rounded font-normal text-sm flex items-center justify-center bg-[#f7f8fa]">
                            <img src="{{ URL::asset('/images/search.png') }}" class="w-5 h-5 mr-5"alt="">
                            <span>Login with google</span>
                        </button>
                    </div>
                </div>
                <div>
                    <div>
                        <button type=""
                            class="w-96 h-10 border-2 mt-4 rounded flex items-center justify-center bg-[#f7f8fa]">
                            <img src="{{ URL::asset('/images/facebook.png') }}" class="w-5 h-5 mr-5"alt="">
                            <span class="font-normal text-sm">Login with FaceBook</span>
                        </button>
                    </div>
                </div>
                <div>
                    <div>
                        <button type=""
                            class="w-96 h-10 border-2 mt-4 rounded flex items-center justify-center bg-[#f7f8fa]">
                            <img src="{{ URL::asset('/images/apple.png') }}" class="w-5 h-5 mr-5"alt="">
                            <span class="font-normal text-sm">Login with App</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
