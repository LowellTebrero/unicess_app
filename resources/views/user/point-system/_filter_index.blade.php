

<div class="w-full p-5 h-[50vh] items-center justify-center flex flex-col space-y-4">

    @if ($dateNow >= $firstSemesterStart )

        @if (!is_null($firstSemesterEvaluations))
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg py-6 px-8 border-2 border-blue-200 w-[50rem] text-white relative">
                <div class="flex justify-between items-center relative">
                    <div class="space-y-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" d="m12 14.052l1.656 1.015q.217.137.441-.022q.224-.158.168-.426l-.442-1.886l1.465-1.258q.216-.192.125-.437q-.09-.246-.363-.27l-1.917-.176l-.76-1.767q-.103-.242-.372-.242q-.268 0-.374.242l-.76 1.767l-1.917.175q-.273.025-.363.27q-.09.246.125.438l1.465 1.258l-.442 1.886q-.056.268.168.426q.224.159.441.022zM9.066 19h-2.45q-.667 0-1.141-.475Q5 18.051 5 17.385v-2.451l-1.79-1.803q-.237-.243-.348-.534q-.112-.292-.112-.593q0-.302.112-.597q.111-.295.348-.538L5 9.066v-2.45q0-.667.475-1.141Q5.949 5 6.615 5h2.451l1.803-1.79q.243-.237.534-.348q.292-.112.593-.112q.302 0 .597.112q.295.111.538.348L14.934 5h2.45q.667 0 1.141.475q.475.474.475 1.14v2.451l1.79 1.803q.237.243.348.534q.112.292.112.593q0 .302-.112.597q-.111.295-.348.538L19 14.934v2.45q0 .667-.475 1.141q-.474.475-1.14.475h-2.451l-1.803 1.79q-.243.237-.534.348q-.292.112-.593.112q-.302 0-.597-.112q-.295-.111-.538-.348z"/></svg>                    
                        <h1 class="text-xs">UUID : {{ $firstSemesterEvaluations->uuid }}</h1>               
                        <h1 class="text-[1.1rem] tracking-wider font-medium"> 1st Sem {{$currentYear}}-{{ $previousYear }} Evaluation Points  </h1>
                        <hr>
                        <h1 class="text-sm tracking-wider">Created: {{ \Carbon\Carbon::parse($firstSemesterEvaluations->created_at)->format('M d, y g:i:s A') }}</h1>
                        <button class="border text-sm rounded-lg py-1 px-2 hover:bg-white hover:text-blue-500">Show detail</button>

                        
                    </div>

                    <div>
                        <div class="py-7 px-10  text-center ">
                            <h1 class="text-5xl text-white font-medium">{{ $firstSemesterEvaluations->total_points }}</h1>
                            <h1 class="text-sm tracking-wider text-white">points</h1>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg py-6 px-8 border-2 border-blue-200 w-[50rem] text-white relative">
                <h1>N/A</h1>
            </div>
        @endif
    @endif


    @if ($dateNow >= $secondSemesterStart )

        @if (!is_null($secondSemesterEvaluations))
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg py-6 px-8 border-2 border-blue-200 w-[50rem] text-white relative">
            <div class="flex justify-between items-center relative">
                <div class="space-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" d="m12 14.052l1.656 1.015q.217.137.441-.022q.224-.158.168-.426l-.442-1.886l1.465-1.258q.216-.192.125-.437q-.09-.246-.363-.27l-1.917-.176l-.76-1.767q-.103-.242-.372-.242q-.268 0-.374.242l-.76 1.767l-1.917.175q-.273.025-.363.27q-.09.246.125.438l1.465 1.258l-.442 1.886q-.056.268.168.426q.224.159.441.022zM9.066 19h-2.45q-.667 0-1.141-.475Q5 18.051 5 17.385v-2.451l-1.79-1.803q-.237-.243-.348-.534q-.112-.292-.112-.593q0-.302.112-.597q.111-.295.348-.538L5 9.066v-2.45q0-.667.475-1.141Q5.949 5 6.615 5h2.451l1.803-1.79q.243-.237.534-.348q.292-.112.593-.112q.302 0 .597.112q.295.111.538.348L14.934 5h2.45q.667 0 1.141.475q.475.474.475 1.14v2.451l1.79 1.803q.237.243.348.534q.112.292.112.593q0 .302-.112.597q-.111.295-.348.538L19 14.934v2.45q0 .667-.475 1.141q-.474.475-1.14.475h-2.451l-1.803 1.79q-.243.237-.534.348q-.292.112-.593.112q-.302 0-.597-.112q-.295-.111-.538-.348z"/></svg>          
                    <h1 class="text-xs">UUID : {{ $secondSemesterEvaluations->uuid }}</h1>           
                    <h1 class="text-[1.1rem] tracking-wider font-medium"> 2nd Sem {{$currentYear}}-{{ $previousYear }} Evaluation Points  </h1>
                    <hr>
                    <h1 class="text-sm tracking-wider">Created: {{ \Carbon\Carbon::parse($secondSemesterEvaluations->created_at)->format('M d, y g:i:s A') }}</h1>
                    <button class="border text-sm rounded-lg py-1 px-2 hover:bg-white hover:text-blue-500">Show detail</button>
                </div>

                <div>
                    <div class="py-7 px-10 text-center">
                        <h1 class="text-5xl text-white font-medium">{{ $secondSemesterEvaluations->total_points }}</h1>
                        <h1 class="text-sm tracking-wider text-white">points</h1>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg py-6 px-8 border-2 border-blue-200 w-[50rem] text-white relative">
                <h1>N/A</h1>
            </div>
        @endif
    @endif
</div>