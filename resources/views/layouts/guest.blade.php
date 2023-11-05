<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="w-full flex flex-col  lg:flex-row xl:flex-row 2xl:flex-row  ">
        {{-- lg:min-h-screen flex flex-col lg:flex-row md:flex-col w-full items-center bg-blue-100  --}}
        <div class="flex-1  flex lg:min-h-screen xl:min-h-screen relative overflow-hidden">
            {{-- flex  justify-center  lg:min-h-screen md:overflow-hidden lg:overflow-hidden   --}}
            <div class="flex flex-row lg:flex-col lg:px-16 lg:py-20 w-full  lg:min-h-screen ">

                <div class="  lg:absolute z-50 flex flex-col lg:flex-col pt-5 px-5 ">

                    <div class="flex space-x-2 items-center lg:items-start  lg:flex-col  ml-5">
                        <a class=" drop-shadow-lg" href={{ route('lnu') }}><img class="w-24 xl:w-32 lg:w-24"
                                src="{{ asset('img/logo.png') }}" alt=""></a>
                        <h1 class="text-white lg:text-4xl my-5 drop-shadow-lg">Leyte Normal University</h1>
                    </div>

                    <div class="lg:flex-col p-5">
                        <h1
                            class="text-yellow-400 text-2xl md:text-3xl lg:text-2xl xl:text-4xl tracking-widest font-bold drop-shadow-lg">
                            UNIVERSITY COMMUNITY EXTENSION SERVICES SYSTEM (UniCESS)</h1>
                        <h1 class="text-white text-lg mt-5 drop-shadow-lg">WELCOME NORMALISTA!</h1>
                    </div>
                </div>
            </div>
            <div
                class="md:h-[10vh] lg:min-h-screen bg-gradient-to-tl from-blue-900/100 via-blue-800/90  to-blue-900/30 w-full min-h-screen absolute z-20 bg-blend-screen">
            </div>
            <img class="md:h-[10vh] lg:min-h-screen backdrop-opacity-5 blur-sm absolute top-0 left-0 right-0 w-full min-h-screen object-cover"
                src="{{ asset('img/bg-2.jpg') }}" alt="">
        </div>


        <div
            class=" xl:min-h-screen lg:basis-14 h-18 w-full md:h-[5vh] lg:w-1/4 lg:min-h-screen bg-blue-600 pt-5 lg:pt-0">
        </div>

        <section class="flex-1 flex  justify-center items-center bg-gray-100 ">


            <div class="flex-col flex bg-white shadow rounded-xl xl:w-2/3 2xl:w-1/2">


                <div class="flex space-x-2 p-3">
                    @include('layouts.user-navigation')
                </div>
                <hr>

                <div class="p-5 w-full">

                    {{ $slot }}
                </div>
            </div>
        </section>
    </div>
</body>

</html>
