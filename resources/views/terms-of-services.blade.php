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


    <style>
        [x-cloak] {
            display: none
        }
    </style>

</head>

<body class="font-sans antialiased w-[100%] h-[100%]">


    {{--  Nav Section  --}}
    @include('layouts.privacy-terms-navbar')


    {{--  Pre Loader  --}}
    <div class="loader">
        <div class="loader-inner">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>


    <main class="min-h-[70%]">
        <header class=" bg-yellow-500">
            <div class="w-[95%] m-auto p-5">
                <h1 class="text-xl text-white">Terms of Service for UNICESS - University Community Extension Services System</h1>
                <h1 class="text-xs text-white"><i>Last Updated: January 2024</i></h1>
            </div>
        </header>
            <div class="p-5 space-y-4 w-[95%] m-auto">
            <div>
                <h1>Acceptance of Terms</h1>
                <p class="ml-4 text-sm">
                    By accessing or using the UNICESS platform, you agree to comply with and be bound by these Terms of
                    Service. If you do not agree with any part of these terms, you may not use UNICESS.
                </p>
            </div>
            <div>
                <h1>User Accounts</h1>
                <p class="ml-4 text-sm">
                    To access certain features of UNICESS, you may need to create a user account. You are responsible for
                    maintaining the confidentiality of your account credentials and for all activities that occur under your
                    account. Notify us immediately of any unauthorized use of your account.

                </p>
            </div>
            <div>
                <h1>User Responsibilities</h1>
                <p class="ml-4 text-sm">
                    When using UNICESS, you agree to:
                <ul class="ml-4 text-sm">
                    <li>• Provide accurate and complete information</li>
                    <li>• Comply with applicable laws and regulations</li>
                    <li>• Respect the rights and privacy of others</li>
                    <li>• Refrain from engaging in any harmful activities, including hacking, data breaches, or unauthorized
                        access</li>
                </ul>
                </p>
            </div>
            <div>
                <h1>Content</h1>
                <p class="ml-4 text-sm">
                    You retain ownership of any content you submit to UNICESS. By submitting content, you grant us a
                    non-exclusive, worldwide, royalty-free license to use, reproduce, modify, adapt, and publish the content
                    solely for the purpose of providing UNICESS services.
                </p>
            </div>
            <div>
                <h1>Intellectual Property</h1>
                <p class="ml-4 text-sm">
                    UNICESS and its content, features, and functionality are owned by or licensed to us and are protected by
                    copyright, trademark, and other intellectual property laws.
                </p>
            </div>
            <div>
                <h1>Termination</h1>
                <p class="ml-4 text-sm">
                    We reserve the right to terminate or suspend your account and access to UNICESS, with or without cause,
                    at our discretion and without notice.
                </p>
            </div>
            <div>
                <h1>Limitation of Liability</h1>
                <p class="ml-4 text-sm">
                    In no event shall UNICESS or its affiliates be liable for any indirect, incidental, special,
                    consequential, or punitive damages arising out of or in connection with your use of UNICESS.
                </p>
            </div>
            <div>
                <h1>Modifications to Terms</h1>
                <p class="ml-4 text-sm">
                    We reserve the right to modify or update these Terms of Service at any time. Continued use of UNICESS after changes are made constitutes acceptance of the revised terms.
                </p>
            </div>
            <div>
                <h1>Governing Law</h1>
                <p class="ml-4 text-sm">
                    These Terms of Service are governed by and construed in accordance with the laws of the Republic of Philippines. Any disputes arising under or in connection with these terms shall be subject to the exclusive jurisdiction of the courts located in Tacloban City, Philippines.
                </p>
            </div>
            <div>
                <h1> Contact Us</h1>
                <p class="ml-4 text-sm">
                    If you have any questions or concerns about these Terms of Service, please contact us at UniCESS@gmail.com.
            </div>
        </div>
    </main>

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
