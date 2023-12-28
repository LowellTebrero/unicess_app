<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UniCESS</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/preloader.css'])


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">


    <style>
        [x-cloak] {
            display: none
        }
    </style>

</head>

<body class="font-sans antialiased w-[100%]">


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

    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "176826635513427");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v18.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>


    {{--  <x-messages/>  --}}
    <script src="{{ asset('js/preloader.js') }}"></script>
    {{--  <script src="{{ asset('js/chatPlugin.js') }}"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

    @stack('scripts')
    @livewireScripts


</body>

</html>
