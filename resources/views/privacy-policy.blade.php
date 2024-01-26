<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Privacy-Policy | UniCESS</title>

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


    <main class="h-[70%]">
        <header class=" bg-yellow-500">
            <div class="w-[95%] m-auto p-5">
                <h1 class="text-xl text-white">Privacy Policy for UNICESS - University Community Extension Services System</h1>
                <h1 class="text-xs text-white"><i>Last Updated: January 2024</i></h1>
            </div>
        </header>

       <div class="space-y-4 mt-4 p-5 w-[95%] m-auto">
            <div>
                <h1 class="text-lg">Introduction</h1>
                <p class="ml-4 text-sm">
                    Welcome to UNICESS, the University Community Extension Services System. This Privacy Policy is designed
                    to inform you about the types of personal information we collect, how we use it, and the choices you
                    have regarding your information. By using UNICESS, you agree to the terms outlined in this Privacy
                    Policy.
                </p>
            </div>
            <div>
                <h1>Information We Collect</h1>
                <div class="ml-4 text-sm">
                    <p>
                        a. User-Provided Information
                        We may collect personal information you provide when creating an account on UNICESS. This includes, but
                        is not limited to:
                    </p>
                    <ul class="ml-4">
                        <li>• Full name</li>
                        <li>• Email address</li>
                        <li>• User credentials</li>
                    </ul>
                </div>
                <div class="ml-4 text-sm">
                    <p>
                        b. Automatically Collected Information
                        We may collect information about your use of UNICESS, including:
                    </p>
                    <ul class="ml-4">
                        <li>• IP address</li>
                        <li>• Browser type</li>
                        <li>• Device information</li>
                        <li>• Usage patterns</li>
                    </ul>
                </div>


            </div>
            <div>
                <h1>How We Use Your Information</h1>
                <div class="ml-4 text-sm">
                    <p>
                        We use the collected information for the following purposes:
                    </p>
                    <ul class="ml-4">
                        <li>• To provide and maintain UNICESS services</li>
                        <li>• To authenticate user accounts</li>
                        <li>• To communicate with users</li>
                        <li>• To improve and optimize UNICESS</li>
                        <li>• To comply with legal obligations</li>
                    </ul>
                </div>

            </div>
            <div>
                <h1>Sharing Your Information</h1>
                <p class="ml-4 text-sm">
                    We do not sell, trade, or otherwise transfer your personal information to third parties. However, we may
                    share information with service providers assisting us in operating UNICESS, subject to confidentiality
                    agreements.
                </p>
            </div>
            <div>
                <h1>User Access and Control</h1>
                <p class="text-sm ml-4 ">
                    You have the right to access, correct, or delete your personal information. You can manage your account
                    settings within UNICESS or contact us for assistance.
                </p>
            </div>
            <div>
                <h1>Security</h1>
                <p class="text-sm ml-4">
                    We implement reasonable security measures to protect your information. However, no method of
                    transmission over the internet or electronic storage is entirely secure. Use UNICESS at your own risk.
                </p>
            </div>
            <div>
                <h1>External Links</h1>
                <p class="text-sm ml-4">
                    UNICESS may contain links to external websites. We are not responsible for the privacy practices or
                    content of these sites. Please review the privacy policies of external websites.
                </p>
            </div>
            <div>
                <h1>Updates to Privacy Policy</h1>
                <p class="text-sm ml-4 ">
                    We may update this Privacy Policy from time to time. We will notify users of any significant changes through UNICESS or via email.
                </p>
            </div>
            <div>
                <h1>Contact Us</h1>
                <p class="text-sm ml-4">
                    If you have any questions or concerns about this Privacy Policy, please contact us at UniCESS@gmail.com.
                </p>
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
