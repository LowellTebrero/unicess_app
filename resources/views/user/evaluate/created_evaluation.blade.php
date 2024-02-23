    <style>
        @keyframes moveinLeft {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }80% {
                transform: translateX(5px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes moveinButton {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }80% {
                transform: translateY(5px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes moveinTop {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }80% {
                transform: translateY(5px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes moveinRight {
            0% {
                opacity: 0;
                transform: translateX(50px);
            }80% {
                transform: translateX(-10px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .head-primary-main {
            animation: moveinLeft 1s ease;
        }
        .head-primary-sub {
            animation: moveinRight 1s ease;
        }

        .closed-description {
            animation: moveinTop 1s ease;
        }
        .closed-title {
            animation: moveinRight 1s ease;
        }
        .closed-image {
            animation: moveinLeft 1s ease;
        }
        .open-text {
            animation: moveinButton 1s ease;
        }
        .open-button {
            animation: moveinTop 1s ease;
        }
        .submitted-text {
            animation: moveinRight 1s ease;
        }
        .submitted-description {
            animation: moveinTop 1s ease;
        }
        .submitted-image {
            animation: moveinLeft 1s ease;
        }

        /* Initial styles for div1 */
        #div1.animated-div {
            animation: fadeInAndOut 5s ease-in-out forwards;
        }

        /* Initial styles for div2 */
        #div2.hidden-div {
            display: none;
        }

        @keyframes fadeInAndOut {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 80%;
            }
            100% {
                opacity: 0;
                display: none;
            }
        }


    </style>

    <x-app-layout>
        @section('title', 'Show Evaluations | ' . config('app.name', 'UniCESS'))
            @if (Auth::user()->authorize == 'checked')
                @unlessrole('admin|New User')

                <section class="h-full rounded-xl text-slate-600 relative  bg-white">

                    <header class="flex justify-between p-5 py-4 flex-col sm:flex-row">
                        <h1 class="xl:text-2xl sm:text-lg text-[.9rem] font-semibold tracking-wider text-slate-700">Show Evaluation</h1>
                        <a class="hover:bg-gray-200 focus:bg-red-200 px-2 py-1 rounded absolute top-2 right-5" href={{ route('evaluate.index') }}>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>

                    </header>
                    <hr>
                    @if ($Evaluation == null)
                        <main class="flex flex-col items-center justify-center p-5 h-[85%] 2xl:h-[90%]">
                            <img class="w-[12rem]" src="{{ asset('img/not-found.svg') }}" alt="">
                            <h1 class="mt-2">Something went wrong..</h1>
                        </main>
                    @else
                        <main class="flex flex-col items-center justify-center p-5 h-[90%]  sm:h-[85%] 2xl:h-[90%] ">
                            @if ($Evaluation->status == 'pending')

                                <div id="div1" class="animated-div-container animated-div flex space-y-3 items-center justify-center flex-col text-green-500 text-lg font-medium">
                                    <img src="{{ asset('img/submit-successfully.png') }}" width="90" class="submitted-image">
                                    <h1 class="text-xl submitted-text">Evaluation form submitted </h1>
                                    <p class="text-gray-500 tracking-wider text-sm submitted-description text-center">Please wait for the admin to verify your evaluation form. </p>
                                </div>

                                <div id="div2" class="hidden-div-container hidden-div flex flex-col lg:w-[80%] ">
                                    <div class="flex space-x-2  text-lg font-medium items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <svg class="submitted-image" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#68bf7b" d="M12 23c6.075 0 11-4.925 11-11S18.075 1 12 1S1 5.925 1 12s4.925 11 11 11ZM7.5 10.586l3 3l6-6L17.914 9L10.5 16.414L6.086 12L7.5 10.586Z"/></svg>
                                            <div>
                                                <h1 class="text-xs sm:text-sm 2xl:text-lg submitted-text">Evaluation form submitted </h1>
                                                <p class="text-gray-500 submitted-description text-[.6rem] sm:text-xs">Please wait for the admin to verify your evaluation form.</p>
                                            </div>
                                        </div>

                                    </div>
                                    @include('user.evaluate.index_filter._filter_userform1_index')
                                </div>

                            @else

                                <div id="div1" class="animated-div-container animated-div flex flex-col items-center justify-center space-y-2 text-green-500">
                                    <img src="{{ asset('img/confetti.png') }}" width="75" class="head-primary-main">
                                    <h1 class="text-2xl font-medium tracking-wide head-primary-sub">Congratulations </h1>
                                    <p class="text-gray-700 tracking-wider">Your evaluation form has been verified.</p>
                                </div>

                                <div id="div2" class="hidden-div-container hidden-div flex flex-col  lg:w-[80%] ">
                                    <div class=" py-2 flex space-x-2  text-lg font-medium justify-between">
                                        <div class="flex items-center space-x-2">
                                            <img src="{{ asset('img/confetti.png') }}" width="35" class="head-primary-main">
                                            <div>
                                                <h1 class="text-sm 2xl:text-lg submitted-text ">Congratulations</h1>
                                                <p class="text-gray-500 tracking-wider submitted-description text-center text-xs">Your evaluation form has been verified. </p>
                                            </div>
                                        </div>
                                        <h1>&nbsp;</h1>
                                    </div>
                                    @include('user.evaluate.index_filter._filter_userform1_index')
                                </div>

                            @endif
                        </main>

                    @endif

                </section>

                @endunlessrole

        @elseif (Auth::user()->authorize == 'close')

            <div class="flex items-center justify-center h-[80vh]">
                <div class="mt-14">
                <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
                </div>
                <h1 class="text-2xl text-slate-700 font-bold">
                    <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                    Your account have been declined for some reason, <br> the admin is reviewing your account details
                    <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
                </h1>
            </div>

        @elseif (Auth::user()->authorize == 'pending')

            <div class="flex items-center justify-center h-[80vh]">
                <div class="mt-14">
                <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
                </div>
                <h1 class="text-2xl text-slate-700 font-bold">
                    <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                    You are not authorize yet, <br> Please fill-out your Profile Information
                    <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
                </h1>
            </div>
        @endif

        <script>

            function applyHideShowLogic() {
                var divContainers = document.querySelectorAll('.animated-div-container');

                // Show containers initially
                divContainers.forEach(function (container) {
                    container.classList.add('animated-div');

                    // Set a timeout to hide the container after 5 seconds
                    setTimeout(function () {
                        container.classList.remove('animated-div');
                        container.style.display = 'none'; // Hide the container
                        var hiddenDivContainer = container.nextElementSibling;
                        if (hiddenDivContainer) {
                            hiddenDivContainer.classList.remove('hidden-div');
                        }
                    }, 5000);
                });

            }

            applyHideShowLogic();


        </script>

    </x-app-layout>
