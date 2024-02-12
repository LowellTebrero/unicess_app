
<main class="h-[50vh] p-5 w-full flex items-center justify-center flex-col">

    <div class="space-y-3">
        <!-- FIRST SEMESTER -->
        @if ($dateNow >= $firstSemesterStart )
        <div class="text-center flex flex-col space-y-2">
            <h1>1st Semester SY {{ $currentYear}} - {{ $previousYear  }}</h1>

            <!-- No created Evaluation -->
            @if ($dateNow <= $firstSemesterEnd && $status->status == 'checked' &&  is_null($firstSemesterEvaluations))
            <h1 class="text-center text-sm">The evaluation form is now open. </h1>
            <a href={{ route('evaluate.create', $id) }} class="blue-500 text-white rounded-lg bg-blue-600 hover:bg-blue-700 py-1 px-5">Click here to create</a>

            <!-- Didnt created Evaluation -->
            @elseif ($dateNow <= $firstSemesterEnd && $status->status == 'close' &&  is_null($firstSemesterEvaluations))

            <h1 class="sm:text-xl font-semibold tracking-wider closed-title text-sm">Whoops..</h1>
            <h1 class="mt-2 tracking-wide closed-description text-sm sm:text-lg text-center">The evaluation form has been closed by the admin. </h1>

            @elseif ($dateNow <= $firstSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($firstSemesterEvaluations))

                <h1>
                    @if ($firstSemesterEvaluations->status == 'pending')
                        Please wait for the admin to verify your evaluation
                    @else
                        Your Evaluation has been verified
                    @endif
                </h1>
                <a href={{ route('evaluate.created', $firstSemesterEvaluations->id) }} class="blue-500 text-white rounded-lg bg-blue-600 hover:bg-blue-700 py-1 px-5">
                {{ $firstSemesterEvaluations->status == 'pending' ? 'Pending' : 'Evaluated' }}
                </a>

            @elseif ($dateNow >= $firstSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($firstSemesterEvaluations))

            <h1>
                @if ($firstSemesterEvaluations->status == 'pending')
                    Please wait for the admin to verify your evaluation
                @else
                    Your Evaluation has been verified
                @endif
            </h1>
            <a href={{ route('evaluate.created', $firstSemesterEvaluations->id) }} class="blue-500 text-white rounded-lg bg-blue-600 hover:bg-blue-700 py-1 px-5">
            {{ $firstSemesterEvaluations->status == 'pending' ? 'Pending' : 'Evaluated' }}
            </a>
            @else
                <h1>Evaluation has been ended</h1>
            @endif

        </div>
        @endif

        <!-- SECOND SEMESTER -->
        @if ($dateNow >= $secondSemesterStart )
        <div class="text-center flex flex-col space-y-2">
            <h1>2st Semester SY {{ $currentYear }} - {{ $previousYear }}</h1>

            @if ( $dateNow <= $firstSemesterEnd && $status->status == 'checked' &&  is_null($secondSemesterEvaluations))
            <h1 class="text-center text-sm">The evaluation form is now open. </h1>
            <a href={{ route('evaluate.create', $id) }} class="blue-500 text-white rounded-lg bg-blue-600 hover:bg-blue-700 py-1 px-5">Click here to create</a>

             <!-- Didnt created Evaluation -->
            @elseif ($dateNow <= $secondSemesterEnd && $status->status == 'close' &&  is_null($secondSemesterEvaluations))
            <h1 class="sm:text-xl font-semibold tracking-wider closed-title text-sm">Whoops..</h1>
            <h1 class="mt-2 tracking-wide closed-description text-sm sm:text-lg text-center">The evaluation form has been closed by the admin. </h1>

            @elseif ($dateNow <= $secondSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($secondSemesterEvaluations))

            <h1>
                @if ($secondSemesterEvaluations->status == 'pending')
                    Please wait for the admin to verify your evaluation
                @else
                    Your Evaluation has been verified
                @endif
            </h1>
            <a href={{ route('evaluate.created', $secondSemesterEvaluations->id) }} class="blue-500 text-white rounded-lg bg-blue-600 hover:bg-blue-700 py-1 px-5">
            {{ $secondSemesterEvaluations->status == 'pending' ? 'Pending' : 'Evaluated' }}
            </a>

            @elseif ($dateNow >= $secondSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($secondSemesterEvaluations))

            <h1>
                @if ($secondSemesterEvaluations->status == 'pending')
                    Please wait for the admin to verify your evaluation
                @else
                    Your Evaluation has been verified
                @endif
            </h1>
            <a href={{ route('evaluate.created', $secondSemesterEvaluations->id) }} class="blue-500 text-white rounded-lg bg-blue-600 hover:bg-blue-700 py-1 px-5">
            {{ $secondSemesterEvaluations->status == 'pending' ? 'Pending' : 'Evaluated' }}
            </a>


            @else
            <h1>Evaluation has been ended</h1>
            @endif

        </div>
        @endif
    </div>

</main>
