<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{--  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">  --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">


        <!-- Scripts -->
        <script src="//unpkg.com/alpinejs" defer></script>
        @vite(['resources/css/app.css'])
        {{--  'resources/css/preloader.css'  --}}

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <link href="../css/froala_style.min.css" rel="stylesheet" type="text/css" />
        <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />

        <style>
            [x-cloak] { display: none }
        </style>

    </head>

    <body class="font-sans antialiased">


    {{--  Nav Section  --}}
    @include('layouts.navigation')


             {{--  Pre Loader  --}}
    <div class="loader">
        <div class="loader-inner">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>


            {{--  Hero Section  --}}
            <section id="hero-section">
            @include('lnu-partials.lnu-hero-section')
            </section>

            {{--  Values Section  --}}

            @include('lnu-partials.lnu-values-section')


            {{--  Lastest Section  --}}
            <section id="events-section">
            @include('lnu-partials.lnu-latest-section')
            </section>

            {{--  LNU About  --}}
            <section id="about-section">
            @include('lnu-partials.lnu-about')
            </section>



            {{--  LNU Buttons  --}}
            <section id="button-section">
            @include('lnu-partials.lnu-buttons')
            </section>


            {{--  University Articles  --}}
            <section id="article-section">
            @include('lnu-partials.lnu-article-section')
            </section>

            {{--  University Program and Services  --}}
            <section id="program-and-services-section">
            @include('lnu-partials.lnu-program-services-section')
            </section>

            {{--  University Mission and Vision  --}}
            @include('lnu-partials.lnu-mission_vision-section')

            {{--  University Footer  --}}
            @include('lnu-partials.lnu-blank')

            {{--  University Footer  --}}
            <section id="contact-section">
            @include('lnu-partials.lnu-footer')
            </section>


    <x-messages/>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></>
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    @livewireScripts


    </body>
    </html
