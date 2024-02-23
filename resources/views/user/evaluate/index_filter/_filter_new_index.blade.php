
<main class="h-[70vh] p-5 w-full flex items-center justify-center flex-col ">

    <div class="space-y-3">
        <!-- FIRST SEMESTER -->
        @if ($dateNow >= $firstSemesterStart )
            <div class="flex flex-col space-y-2">
            <h1 class="text-sm sm:text-base text-center">1st Semester SY {{ $currentYear}} - {{ $previousYear  }}</h1>

                <!-- No created Evaluation -->
                @if ($dateNow <= $firstSemesterEnd && $status->status == 'checked' &&  is_null($firstSemesterEvaluations))
                    <h1 class="text-center text-sm">The evaluation form is now open. </h1>
                    <a href={{ route('evaluate.create', $id) }} class="blue-500 text-white text-center rounded-xl bg-blue-600 hover:bg-blue-700 py-1 px-5">Click here to create</a>

                    <!-- Didnt created Evaluation -->
                @elseif ($dateNow <= $firstSemesterEnd && $status->status == 'close' &&  is_null($firstSemesterEvaluations))

                    <h1 class="sm:text-xl font-semibold tracking-wider closed-title text-sm text-center">Whoops..</h1>
                    <h1 class="mt-2 tracking-wide closed-description text-sm sm:text-lg text-center">The evaluation has been closed by the admin. </h1>

                @elseif ($dateNow <= $firstSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($firstSemesterEvaluations))
                    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg 2xl:py-6 2xl:px-8 px-3 sm:px-5 py-4 border-2 border-blue-200 w-full text-white relative">
                        <div class="flex justify-between items-center relative">
                            <div class="space-y-1 2xl:space-y-3">
                                <svg class="w-[1.5rem] sm:w-[2rem]" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" d="m12 14.052l1.656 1.015q.217.137.441-.022q.224-.158.168-.426l-.442-1.886l1.465-1.258q.216-.192.125-.437q-.09-.246-.363-.27l-1.917-.176l-.76-1.767q-.103-.242-.372-.242q-.268 0-.374.242l-.76 1.767l-1.917.175q-.273.025-.363.27q-.09.246.125.438l1.465 1.258l-.442 1.886q-.056.268.168.426q.224.159.441.022zM9.066 19h-2.45q-.667 0-1.141-.475Q5 18.051 5 17.385v-2.451l-1.79-1.803q-.237-.243-.348-.534q-.112-.292-.112-.593q0-.302.112-.597q.111-.295.348-.538L5 9.066v-2.45q0-.667.475-1.141Q5.949 5 6.615 5h2.451l1.803-1.79q.243-.237.534-.348q.292-.112.593-.112q.302 0 .597.112q.295.111.538.348L14.934 5h2.45q.667 0 1.141.475q.475.474.475 1.14v2.451l1.79 1.803q.237.243.348.534q.112.292.112.593q0 .302-.112.597q-.111.295-.348.538L19 14.934v2.45q0 .667-.475 1.141q-.474.475-1.14.475h-2.451l-1.803 1.79q-.243.237-.534.348q-.292.112-.593.112q-.302 0-.597-.112q-.295-.111-.538-.348z"/></svg>
                                <div>
                                    <h1 class="text-xs sm:text-sm 2xl:text-[1.1rem] tracking-wide font-medium"> 1st Semester Evaluation  </h1>
                                    <hr>
                                    <h1 class="text-[.7rem] sm:text-xs 2xl:text-sm tracking-wider">Created: {{ \Carbon\Carbon::parse($firstSemesterEvaluations->created_at)->format('M d, y g:i:s A') }}</h1>
                                </div>
                                <div>
                                    <h1 class="text-[.7rem] sm:text-xs">ID : {{ $firstSemesterEvaluations->uuid }}</h1>
                                    <h1 class="text-[.7rem] sm:text-xs tracking-wider">Status : {{ $firstSemesterEvaluations->status }}</h1>
                                </div>
                                <div>
                                    <a href={{ route('evaluate.created', $firstSemesterEvaluations->id) }} class="border text-[.7rem] sm:text-xs 2xl:text-sm rounded-lg py-1 px-2 hover:bg-white hover:text-blue-500">
                                    Show detail
                                    </a>
                                </div>

                            </div>

                            <div>
                                <div class="py-7 px-5 sm:px-10  text-center">
                                    <h1 class="text-3xl sm:text-5xl 2xl:text-7xl text-white font-medium">{{ $firstSemesterEvaluations->total_points }}</h1>
                                    <h1 class="text-xs sm:text-sm tracking-wider text-white"><span class="hidden sm:block mr-1">Total</span>points</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($dateNow >= $firstSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($firstSemesterEvaluations))

                    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg 2xl:py-6 2xl:px-8 px-5 py-4 border-2 border-blue-200 w-full text-white relative">
                        <div class="flex justify-between items-center relative">
                            <div class="space-y-1 2xl:space-y-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" d="m12 14.052l1.656 1.015q.217.137.441-.022q.224-.158.168-.426l-.442-1.886l1.465-1.258q.216-.192.125-.437q-.09-.246-.363-.27l-1.917-.176l-.76-1.767q-.103-.242-.372-.242q-.268 0-.374.242l-.76 1.767l-1.917.175q-.273.025-.363.27q-.09.246.125.438l1.465 1.258l-.442 1.886q-.056.268.168.426q.224.159.441.022zM9.066 19h-2.45q-.667 0-1.141-.475Q5 18.051 5 17.385v-2.451l-1.79-1.803q-.237-.243-.348-.534q-.112-.292-.112-.593q0-.302.112-.597q.111-.295.348-.538L5 9.066v-2.45q0-.667.475-1.141Q5.949 5 6.615 5h2.451l1.803-1.79q.243-.237.534-.348q.292-.112.593-.112q.302 0 .597.112q.295.111.538.348L14.934 5h2.45q.667 0 1.141.475q.475.474.475 1.14v2.451l1.79 1.803q.237.243.348.534q.112.292.112.593q0 .302-.112.597q-.111.295-.348.538L19 14.934v2.45q0 .667-.475 1.141q-.474.475-1.14.475h-2.451l-1.803 1.79q-.243.237-.534.348q-.292.112-.593.112q-.302 0-.597-.112q-.295-.111-.538-.348z"/></svg>
                                <div>
                                    <h1 class="text-xs sm:text-sm 2xl:text-[1.1rem] tracking-wider font-medium"> 1st Sem {{$currentYear}}-{{ $previousYear }} Evaluation  </h1>
                                    <hr>
                                    <h1 class="text-[.7rem] sm:text-xs 2xl:text-sm tracking-wider">Created: {{ \Carbon\Carbon::parse($firstSemesterEvaluations->created_at)->format('M d, y g:i:s A') }}</h1>
                                </div>
                                <div>
                                    <h1 class="text-[.7rem] sm:text-xs">ID : {{ $firstSemesterEvaluations->uuid }}</h1>
                                    <h1 class="text-[.7rem] sm:text-xs tracking-wider">Status : {{ $firstSemesterEvaluations->status }}</h1>
                                </div>
                                <div>
                                    <a href={{ route('evaluate.created', $firstSemesterEvaluations->id) }} class="border text-xs 2xl:text-sm rounded-lg py-1 px-2 hover:bg-white hover:text-blue-500">
                                    Show detail
                                    </a>
                                </div>

                            </div>

                            <div>
                                <div class="py-7 px-5 sm:px-10  text-center">
                                    <h1 class="text-3xl sm:text-5xl 2xl:text-7xl text-white font-medium">{{ $firstSemesterEvaluations->total_points }}</h1>
                                    <h1 class="text-xs sm:text-sm tracking-wider text-white"><span class="hidden sm:block mr-1">Total</span>points</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h1>Evaluation has been ended</h1>
                @endif

            </div>
        @endif


        <!-- SECOND SEMESTER -->
        @if ($dateNow >= $secondSemesterStart )
            <div class=" flex flex-col space-y-2">
            <h1 class="text-center">2nd Semester SY {{ $currentYear }} - {{ $previousYear }}</h1>

                @if ( $dateNow <= $firstSemesterEnd && $status->status == 'checked' &&  is_null($secondSemesterEvaluations))
                    <h1 class="text-center text-sm">The evaluation form is now open. </h1>
                    <a href={{ route('evaluate.create', $id) }} class="blue-500 text-white rounded-lg bg-blue-600 hover:bg-blue-700 py-1 px-5">Click here to create</a>

                    <!-- Didnt created Evaluation -->
                @elseif ($dateNow <= $secondSemesterEnd && $status->status == 'close' &&  is_null($secondSemesterEvaluations))
                    <h1 class="sm:text-xl font-semibold tracking-wider closed-title text-sm">Whoops..</h1>
                    <h1 class="mt-2 tracking-wide closed-description text-sm sm:text-lg text-center">The evaluation form has been closed by the admin. </h1>

                @elseif ($dateNow <= $secondSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($secondSemesterEvaluations))

                    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg 2xl:py-6 2xl:px-8 px-5 py-4 border-2 border-blue-200 w-full text-white relative">
                        <div class="flex justify-between items-center relative">
                            <div class="space-y-1 2xl:space-y-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" d="m12 14.052l1.656 1.015q.217.137.441-.022q.224-.158.168-.426l-.442-1.886l1.465-1.258q.216-.192.125-.437q-.09-.246-.363-.27l-1.917-.176l-.76-1.767q-.103-.242-.372-.242q-.268 0-.374.242l-.76 1.767l-1.917.175q-.273.025-.363.27q-.09.246.125.438l1.465 1.258l-.442 1.886q-.056.268.168.426q.224.159.441.022zM9.066 19h-2.45q-.667 0-1.141-.475Q5 18.051 5 17.385v-2.451l-1.79-1.803q-.237-.243-.348-.534q-.112-.292-.112-.593q0-.302.112-.597q.111-.295.348-.538L5 9.066v-2.45q0-.667.475-1.141Q5.949 5 6.615 5h2.451l1.803-1.79q.243-.237.534-.348q.292-.112.593-.112q.302 0 .597.112q.295.111.538.348L14.934 5h2.45q.667 0 1.141.475q.475.474.475 1.14v2.451l1.79 1.803q.237.243.348.534q.112.292.112.593q0 .302-.112.597q-.111.295-.348.538L19 14.934v2.45q0 .667-.475 1.141q-.474.475-1.14.475h-2.451l-1.803 1.79q-.243.237-.534.348q-.292.112-.593.112q-.302 0-.597-.112q-.295-.111-.538-.348z"/></svg>
                                <div>
                                    <h1 class="text-xs sm:text-sm 2xl:text-[1.1rem] tracking-wider font-medium"> 1st Sem {{$currentYear}}-{{ $previousYear }} Evaluation  </h1>
                                    <hr>
                                    <h1 class="text-[.7rem] sm:text-xs 2xl:text-sm tracking-wider">Created: {{ \Carbon\Carbon::parse($secondSemesterEvaluations->created_at)->format('M d, y g:i:s A') }}</h1>
                                </div>
                                <div>
                                    <h1 class="text-[.7rem] sm:text-xs">ID : {{ $secondSemesterEvaluations->uuid }}</h1>
                                    <h1 class="text-[.7rem] sm:text-xs tracking-wider">Status : {{ $secondSemesterEvaluations->status }}</h1>
                                </div>
                                <div>
                                    <a href={{ route('evaluate.created', $secondSemesterEvaluations->id) }} class="border text-xs 2xl:text-sm rounded-lg py-1 px-2 hover:bg-white hover:text-blue-500">
                                    Show detail
                                    </a>
                                </div>

                            </div>

                            <div>
                                <div class="py-7 px-5 sm:px-10   text-center">
                                    <h1 class="text-3xl sm:text-5xl 2xl:text-7xl text-white font-medium">{{ $secondSemesterEvaluations->total_points }}</h1>
                                    <h1 class="text-xs sm:text-sm tracking-wider text-white"><span class="hidden sm:block mr-1">Total</span>points</h1>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif ($dateNow >= $secondSemesterEnd && ($status->status == 'checked' || $status->status == 'close') &&  !is_null($secondSemesterEvaluations))


                    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg 2xl:py-6 2xl:px-8 px-5 py-4 border-2 border-blue-200 w-full text-white relative">
                        <div class="flex justify-between items-center relative">
                            <div class="space-y-1 2xl:space-y-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" d="m12 14.052l1.656 1.015q.217.137.441-.022q.224-.158.168-.426l-.442-1.886l1.465-1.258q.216-.192.125-.437q-.09-.246-.363-.27l-1.917-.176l-.76-1.767q-.103-.242-.372-.242q-.268 0-.374.242l-.76 1.767l-1.917.175q-.273.025-.363.27q-.09.246.125.438l1.465 1.258l-.442 1.886q-.056.268.168.426q.224.159.441.022zM9.066 19h-2.45q-.667 0-1.141-.475Q5 18.051 5 17.385v-2.451l-1.79-1.803q-.237-.243-.348-.534q-.112-.292-.112-.593q0-.302.112-.597q.111-.295.348-.538L5 9.066v-2.45q0-.667.475-1.141Q5.949 5 6.615 5h2.451l1.803-1.79q.243-.237.534-.348q.292-.112.593-.112q.302 0 .597.112q.295.111.538.348L14.934 5h2.45q.667 0 1.141.475q.475.474.475 1.14v2.451l1.79 1.803q.237.243.348.534q.112.292.112.593q0 .302-.112.597q-.111.295-.348.538L19 14.934v2.45q0 .667-.475 1.141q-.474.475-1.14.475h-2.451l-1.803 1.79q-.243.237-.534.348q-.292.112-.593.112q-.302 0-.597-.112q-.295-.111-.538-.348z"/></svg>
                                <div>
                                    <h1 class="text-xs sm:text-sm 2xl:text-[1.1rem] tracking-wider font-medium"> 1st Sem {{$currentYear}}-{{ $previousYear }} Evaluation  </h1>
                                    <hr>
                                    <h1 class="text-[.7rem] sm:text-xs 2xl:text-sm tracking-wider">Created: {{ \Carbon\Carbon::parse($secondSemesterEvaluations->created_at)->format('M d, y g:i:s A') }}</h1>
                                </div>
                                <div>
                                    <h1 class="text-[.7rem] sm:text-xs">ID : {{ $secondSemesterEvaluations->uuid }}</h1>
                                    <h1 class="text-[.7rem] sm:text-xs tracking-wider">Status : {{ $secondSemesterEvaluations->status }}</h1>
                                </div>
                                <div>
                                    <a href={{ route('evaluate.created', $secondSemesterEvaluations->id) }} class="border text-xs 2xl:text-sm rounded-lg py-1 px-2 hover:bg-white hover:text-blue-500">
                                    Show detail
                                    </a>
                                </div>

                            </div>

                            <div>
                                <div class="py-7 px-5 sm:px-10   text-center">
                                    <h1 class="text-3xl sm:text-5xl 2xl:text-7xl text-white font-medium">{{ $secondSemesterEvaluations->total_points }}</h1>
                                    <h1 class="text-xs sm:text-sm tracking-wider text-white"><span class="hidden sm:block mr-1">Total</span>points</h1>
                                </div>
                            </div>
                        </div>
                    </div>


                @else
                    <h1>Evaluation has been ended</h1>
                @endif

            </div>
        @endif
    </div>

</main>
