
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

    </style>

<form action="{{ route('evaluate.create', $id) }}" method="GET" class="flex flex-col">
    <div class="flex">
         <input class="outline-none border-0 p-0 border-transparent focus:border-transparent focus:ring-0" type="text" name="yearGetter"  value="{{ $currentYear }} - {{ $previousYear }}" hidden>
    </div>

    <div class="mt-12 flex items-center justify-center min-h-[40vh] ">

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
                <div class="flex space-y-3 items-center justify-center flex-col text-green-500 text-lg font-medium">
                    <img src="{{ asset('img/submit-successfully.png') }}" width="90" class="submitted-image">
                    <h1 class="text-xl submitted-text">Evaluation form submitted </h1>
                    <p class="text-gray-500 tracking-wider text-sm submitted-description">Please wait for the admin to verify your evaluation form. </p>
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
                    <div class="flex space-y-3 items-center justify-center flex-col text-green-500 text-lg font-medium">
                        <img src="{{ asset('img/submit-successfully.png') }}" width="90" class="submitted-image">
                        <h1 class="text-xl submitted-text">Evaluation form submitted </h1>
                        <p class="text-gray-500 tracking-wider text-sm submitted-description">Please wait for the admin to verify your evaluation form. </p>
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
                    <h1>Status: Pending </h1>
                @endif
            @endforeach


            @foreach ($evaluation_status as $Estatus)
                @if ($currentYear != date('Y') && $currentYear == $Estatus->year && ($stats->status == "checked" || $stats->status == "close") && $Estatus->status == 'evaluated')
                    {{--  {{ $Estatus }}  --}}
                    <div class="flex flex-col space-y-2">
                    <h1 class="font-medium sm:text-lg text-sm text-center tracking-wider">Download Evaluation Form {{ $currentYear  }}</h1>
                    <a href="{{ route('evaluate-pdf',$Estatus->id ) }}" class="text-white text-center py-2 px-3 rounded-lg text-sm bg-green-400 hover:bg-green-500">Click here to download </a>
                    </div>
                    @endif
            @endforeach
        @endforeach
    </div>
</form>
