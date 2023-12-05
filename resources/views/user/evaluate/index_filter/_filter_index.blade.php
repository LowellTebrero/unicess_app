
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

<form action="{{ route('evaluate.create', $id) }}" method="GET" class="flex flex-col">
    <div class="flex">
         <input class="outline-none border-0 p-0 border-transparent focus:border-transparent focus:ring-0" type="text" name="yearGetter"  value="{{ $currentYear }} - {{ $previousYear }}" hidden>
    </div>

    <div class="mt-12 flex items-center justify-center min-h-[40vh]">

        @foreach ($status as $stats )

            @if ($currentYear == date('Y') && $stats->status == "close" &&  $latestYear == $currentYear && $evaluation->isEmpty())
                <div class="flex space-y-2 items-center justify-center flex-col ">
                    <img src="{{ asset('img/attention.png') }}" width="90" class="closed-image w-[5rem] sm:w-[7rem]">
                    <h1 class="sm:text-3xl font-semibold tracking-wider closed-title text-sm">Whoops..</h1>
                    <h1 class="mt-2 tracking-wide closed-description text-sm sm:text-lg text-center">The evaluation form has been closed by the admin. </h1>
                </div>
            @endif


            @foreach ($evaluation as $eval)
                @if ($currentYear == date('Y') && $stats->status == "close" && $latestYear < $previousYear &&  $eval->status == 'evaluated' )
                    <div class="flex space-y-2 items-center justify-center flex-col">
                        {{--  <img src="{{ asset('img/attention.png') }}" width="90" class="closed-image">  --}}
                        <h1 class="text-lg font-medium tracking-wider closed-title">Your evaluation form has been verified.</h1>
                        <a href="{{ route('evaluate-pdf',$latestYearAndId->id ) }}" class="text-white py-2 px-3 rounded-lg text-sm bg-green-400 hover:bg-green-500">Click here to download </a>
                    </div>

                @endif
            @endforeach

            @foreach ($evaluation as $eval)
                @if ($currentYear == date('Y') && $stats->status == "close" && $latestYear < $previousYear &&  $eval->status == 'pending' )
                <div id="div1" class="animated-div-container animated-div flex space-y-3 items-center justify-center flex-col text-green-500 text-lg font-medium">
                    <img src="{{ asset('img/submit-successfully.png') }}" width="90" class="submitted-image">
                    <h1 class="text-xl submitted-text">Evaluation form submitted </h1>
                    <p class="text-gray-500 tracking-wider text-sm submitted-description">Please wait for the admin to verify your evaluation form. </p>
                </div>

                <div id="div2" class="hidden-div-container hidden-div flex flex-col text-green-500">
                    <div class="flex space-x-2 text-green-500 text-lg font-medium items-center">
                        <img src="{{ asset('img/submit-successfully.png') }}" width="50" class="submitted-image w-[2rem] h-[3vh]">
                        <div>
                            <h1 class="text-lg submitted-text">Evaluation form submitted </h1>
                            <p class="text-gray-500 tracking-wider submitted-description text-xs">Please wait for the admin to verify your evaluation form. </p>
                        </div>
                    </div>
                    @include('user.evaluate.index_filter._filter_userform_index')
                </div>
                @endif
            @endforeach


            {{--  Stock Open for evaluation  --}}
            {{--  @foreach ($evaluation as $eval)  --}}

            @if ($currentYear == date('Y') && $stats->status == "checked" && $latestYear == $currentYear && $latesEvaluationtYear != $latestYear && $evaluation->isEmpty())
                <div class="flex flex-col items-center space-y-2">
                    <h1 class="sm:text-lg text-center open-text">The evaluation form is now open. </h1>
                    <button type="submit" class="bg-blue-500 text-white px-4 hover:bg-blue-600 rounded-xl py-2 open-button text-sm sm:text-md">Click here to submit</button>
                </div>
            @endif
            {{--  @endforeach  --}}

            {{--  Stock and Searching for pending  --}}
            @foreach ($evaluation_status as $Estatus)
                @if ($currentYear == date('Y')  && $stats->status == "checked" && $Estatus->status == 'pending' && $Estatus->year == date('Y'))
                    <div id="div1" class="animated-div-container animated-div flex space-y-3 items-center justify-center flex-col text-green-500 text-lg font-medium">
                        <img src="{{ asset('img/submit-successfully.png') }}" width="90" class="submitted-image">
                        <h1 class="text-xl submitted-text">Evaluation form submitted </h1>
                        <p class="text-gray-500 tracking-wider text-sm submitted-description">Please wait for the admin to verify your evaluation form. </p>
                    </div>

                    <div id="div2" class="hidden-div-container hidden-div flex flex-col text-green-500">
                        <div class="flex space-x-2 text-green-500 text-lg font-medium items-center">
                            <img src="{{ asset('img/submit-successfully.png') }}" width="50" class="submitted-image w-[2rem] h-[3vh]">
                            <div>
                                <h1 class="text-lg submitted-text">Evaluation form submitted </h1>
                                <p class="text-gray-500 tracking-wider submitted-description text-xs">Please wait for the admin to verify your evaluation form. </p>
                            </div>
                        </div>
                        @include('user.evaluate.index_filter._filter_userform_index')
                    </div>
                @endif
            @endforeach

            {{--  Stock and searching for Evaluated  --}}
            @foreach ($result as $res)
            @foreach ($evaluation as $eval)
                @if ($currentYear == date('Y')  && $stats->status == "checked" && $res->status == 'evaluated' &&  $latestYear == $currentYear && $res->max_year == $currentYear )
                    <div class="flex flex-col items-center justify-center space-y-2 text-green-500">
                        <img src="{{ asset('img/confetti.png') }}" width="75" class="head-primary-main">
                        <h1 class="text-2xl font-medium tracking-wide head-primary-sub">Congratulations </h1>
                        <p class="text-gray-700 tracking-wider">Your evaluation form has been verified.</p>
                        <a href="{{ route('evaluate-pdf',$latestYearAndId->id ) }}" class="text-white py-2 px-3 rounded-lg text-sm bg-green-400 hover:bg-green-500">Click here to download </a>
                    </div>
                @endif
            @endforeach
            @endforeach

            {{--  For Old Years  --}}
            @foreach ($evaluation_status as $Estatus)
                @if ($currentYear != date('Y') && $currentYear == $Estatus->year && ($stats->status == "checked" || $stats->status == "close") && $Estatus->status == 'pending')

                <div class="flex flex-col space-y-2">
                    <div class="flex space-x-2 text-red-400 text-lg font-medium items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#f87171" d="M17.385 21q-1.672 0-2.836-1.164Q13.385 18.67 13.385 17t1.164-2.836Q15.713 13 17.385 13q1.67 0 2.835 1.164T21.385 17q0 1.671-1.165 2.836T17.385 21Zm.384-4.165V14.5q0-.154-.115-.27q-.116-.115-.27-.115q-.153 0-.269.116q-.115.115-.115.269v2.333q0 .153.056.296q.056.144.186.275l1.525 1.525q.112.111.264.121q.152.01.282-.121q.131-.13.131-.273q0-.143-.13-.273l-1.545-1.548ZM5.615 20q-.666 0-1.14-.475Q4 19.051 4 18.385V5.615q0-.666.475-1.14Q4.949 4 5.615 4h4.637q.14-.587.623-.986T12 2.615q.654 0 1.134.4q.48.398.62.985h4.63q.667 0 1.141.475q.475.474.475 1.14v6.02q-.258-.133-.488-.233T19 11.223V5.615q0-.23-.192-.423Q18.615 5 18.385 5H16v1.423q0 .343-.23.576q-.23.232-.57.232H8.8q-.34 0-.57-.232Q8 6.766 8 6.423V5H5.615q-.23 0-.423.192Q5 5.385 5 5.615v12.77q0 .269.173.442t.442.173h6.127q.08.28.189.521q.11.24.28.479H5.616Zm6.388-14.77q.345 0 .575-.232q.23-.234.23-.578q0-.345-.233-.575q-.234-.23-.578-.23q-.345 0-.575.234q-.23.233-.23.577q0 .345.234.575q.233.23.577.23Z"/></svg>
                            <div>
                                <h1 class="text-lg submitted-text">Evaluation form has been pending </h1>
                                <p class="text-gray-500 tracking-wider submitted-description text-xs">Please contact the admin to verify your evaluation form.  </p>
                            </div>
                        </div>
                        <div class="flex items-end flex-col">
                            <h1 class="font-medium text-sm text-center tracking-wider">CES Evaluation Form {{ $currentYear  }}</h1>
                        </div>
                    </div>
                    @include('user.evaluate.index_filter._filter_userform_index')
                </div>

                @endif
            @endforeach

            @foreach ($evaluation_status as $Estatus)
                @if ($currentYear != date('Y') && $currentYear == $Estatus->year && ($stats->status == "checked" || $stats->status == "close") && $Estatus->status == 'evaluated')
                    <div class="flex flex-col space-y-2">
                        <div class="flex space-x-2 text-green-500 text-lg font-medium items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('img/submit-successfully.png') }}" width="50" class="submitted-image w-[2rem] h-[3vh]">
                                <div>
                                    <h1 class="text-lg submitted-text">Evaluation validated </h1>
                                    <p class="text-gray-500 tracking-wider submitted-description text-xs">Your evaluation form has been verified. </p>
                                </div>
                            </div>
                            <div class="flex items-end flex-col">
                                <h1 class="font-medium text-sm text-center tracking-wider">Download Evaluation Form {{ $currentYear  }}</h1>
                                <a href={{ route('evaluate-pdf',$Estatus->id ) }} class="text-white text-right py-1 px-3 rounded-md text-sm bg-green-400 hover:bg-green-500">Click here to download</a>
                            </div>
                        </div>
                        @include('user.evaluate.index_filter._filter_userform_index')
                    </div>
                    @endif
            @endforeach
        @endforeach
    </div>
</form>


 {{--  <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the div elements
        var div1 = document.getElementById('div1');
        var div2 = document.getElementById('div2');

        // Show div1 initially
        if (div1) {
            div1.classList.add('animated-div');

            // Set a timeout to hide div1 and show div2 after 5 seconds
            setTimeout(function () {
                if (div1) {
                    div1.classList.remove('animated-div');
                    div1.style.display = 'none'; // Hide div1
                    if (div2) {
                        div2.classList.remove('hidden-div');
                    }
                }
            }, 5000);
        }
    });

 </script>  --}}
