
<main class="border border-gray-300 rounded-xl h-[70vh] sm:h-[59vh] 2xl:h-[55vh] w-full text-gray-600 relative flex flex-col-reverse sm:flex-row sm:space-x-4 p-4">

    <div class="rounded-lg w-full flex flex-col space-y-4 ">

        <div class="rounded-lg h-full relative bg-gray-300">
            @include('user.evaluate.index_filter._filter_userform2_index')
        </div>

        <div class="flex items-start justify-between 2xl:justify-evenly  px-0 sm:px-2 py-2">

            <div class="flex space-x-2 items-center">
                <div>
                    <svg class="hidden lg:block" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#29a2ff" d="M5.615 21q-.69 0-1.152-.462Q4 20.075 4 19.385V6.615q0-.69.463-1.152Q4.925 5 5.615 5h1.77V2.77h1.077V5h7.153V2.77h1V5h1.77q.69 0 1.152.463q.463.462.463 1.152v12.77q0 .69-.462 1.152q-.463.463-1.153.463zm0-1h12.77q.23 0 .423-.192q.192-.193.192-.423v-8.77H5v8.77q0 .23.192.423q.193.192.423.192M5 9.615h14v-3q0-.23-.192-.423Q18.615 6 18.385 6H5.615q-.23 0-.423.192Q5 6.385 5 6.615zm0 0V6zm7 4.539q-.31 0-.54-.23q-.23-.23-.23-.54q0-.309.23-.539q.23-.23.54-.23q.31 0 .54.23q.23.23.23.54q0 .31-.23.539q-.23.23-.54.23m-4 0q-.31 0-.54-.23q-.23-.23-.23-.54q0-.309.23-.539q.23-.23.54-.23q.31 0 .54.23q.23.23.23.54q0 .31-.23.539q-.23.23-.54.23m8 0q-.31 0-.54-.23q-.23-.23-.23-.54q0-.309.23-.539q.23-.23.54-.23q.31 0 .54.23q.23.23.23.54q0 .31-.23.539q-.23.23-.54.23M12 18q-.31 0-.54-.23q-.23-.23-.23-.54q0-.309.23-.539q.23-.23.54-.23q.31 0 .54.23q.23.23.23.54q0 .31-.23.54Q12.31 18 12 18m-4 0q-.31 0-.54-.23q-.23-.23-.23-.54q0-.309.23-.539q.23-.23.54-.23q.31 0 .54.23q.23.23.23.54q0 .31-.23.54Q8.31 18 8 18m8 0q-.31 0-.54-.23q-.23-.23-.23-.54q0-.309.23-.539q.23-.23.54-.23q.31 0 .54.23q.23.23.23.54q0 .31-.23.54Q16.31 18 16 18"/></svg>
                </div>
                <div>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">Created:</h1>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">{{ \Carbon\Carbon::parse($Evaluation->created_at)->format('M d, y g:i:s A') }}</h1>
                </div>
            </div>

            <div class="flex space-x-2 items-center">
                <div>
                    <svg class="hidden lg:block" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#29a2ff" d="M196 112a4 4 0 0 1-4 4h-40a4 4 0 0 1 0-8h40a4 4 0 0 1 4 4m-4 28h-40a4 4 0 0 0 0 8h40a4 4 0 0 0 0-8m36-84v144a12 12 0 0 1-12 12H40a12 12 0 0 1-12-12V56a12 12 0 0 1 12-12h176a12 12 0 0 1 12 12m-8 0a4 4 0 0 0-4-4H40a4 4 0 0 0-4 4v144a4 4 0 0 0 4 4h176a4 4 0 0 0 4-4Zm-88.13 111a4 4 0 1 1-7.74 2C121.06 157 109 148 96 148s-25 9-28.13 21a4 4 0 0 1-3.87 3a3.87 3.87 0 0 1-1-.13a4 4 0 0 1-2.87-4.87a36.28 36.28 0 0 1 20.43-23.66a28 28 0 1 1 30.88 0A36.2 36.2 0 0 1 131.87 167M96 140a20 20 0 1 0-20-20a20 20 0 0 0 20 20"/></svg>
                </div>
                <div>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">ID:</h1>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">{{ $Evaluation->uuid }}</h1>
                </div>
            </div>
            <div class="flex space-x-2 items-center">
                <div>
                    <svg class="hidden lg:block" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256"><path fill="#29a2ff" d="M237.3 97.9a13.78 13.78 0 0 0-12.08-9.6l-59.46-5.14a2 2 0 0 1-1.65-1.22l-23.23-55.36a14 14 0 0 0-25.76 0L91.89 81.94a2 2 0 0 1-1.65 1.22L30.78 88.3a13.78 13.78 0 0 0-12.08 9.6a14 14 0 0 0 4.11 15l45.11 39.35a2.06 2.06 0 0 1 .64 2L55 212.76a14 14 0 0 0 5.45 14.56a13.74 13.74 0 0 0 15.4.62l51.11-31a1.9 1.9 0 0 1 2 0l51.11 31A14 14 0 0 0 201 212.76l-13.52-58.53a2.06 2.06 0 0 1 .64-2l45.11-39.35a14 14 0 0 0 4.07-14.98m-12 5.92l-45.11 39.35a14 14 0 0 0-4.44 13.76l13.52 58.53a2 2 0 0 1-.79 2.13a1.81 1.81 0 0 1-2.14.09l-51.11-31a13.92 13.92 0 0 0-14.46 0l-51.11 31a1.81 1.81 0 0 1-2.14-.09a2 2 0 0 1-.79-2.13l13.52-58.53a14 14 0 0 0-4.44-13.76L30.7 103.82a2 2 0 0 1-.59-2.19a1.86 1.86 0 0 1 1.7-1.38l59.47-5.14A14 14 0 0 0 103 86.58l23.23-55.36a2 2 0 0 1 3.62 0L153 86.58a14 14 0 0 0 11.68 8.53l59.47 5.14a1.86 1.86 0 0 1 1.7 1.38a2 2 0 0 1-.55 2.19"/></svg>
                </div>
                <div>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">Points:</h1>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">{{ $Evaluation->total_points }}</h1>
                </div>
            </div>
            <div class="flex space-x-2 items-center">
                <div>
                    <svg class="hidden lg:block" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512"><path fill="#29a2ff" d="M255 471L91.7 387V41h328.6v346zm-147.3-93.74L255 453l149.3-75.76V57H107.7zm146.56-33.1l-94.66-48.69v50l94.54 48.62l98.27-49.89v-49.9z"/></svg>
                </div>
                <div>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">Status:</h1>
                    <h1 class="text-[.7rem] lg:text-xs text-sky-400">{{ $Evaluation->status }}</h1>
                </div>
            </div>
        </div>

    </div>


    <div class="w-full sm:w-2/5 flex flex-col space-y-2 sm:space-y-4">

        <div class="bg-gradient-to-t from-blue-400 to-blue-600 rounded-lg h-full relative">

            <div class="flex sm:flex-col  md:flex-row justify-between text-white p-4">
                <h1 class="tracking-wide 2xl:text-sm text-xs">CES FACULTY <br> PERFORMANCE <br> EVALUATION FORM {{ $Evaluation->created_at->format('Y')}}</h1>
                <img class="w-[3rem] h-[3rem] object-fill" src="{{ asset('img/logo.png') }}" alt="">
            </div>
            @if ($Evaluation->users->gender == 'male')
            <img class="hidden sm:block w-[10rem] 2xl:w-[17rem] absolute bottom-0 left-2 lg:left-7" src="{{ asset('img/evaluation-man.svg') }}" alt="">
            @elseif($Evaluation->users->gender == 'female')
            <img class="hidden sm:block w-[10rem] 2xl:w-[18rem] absolute bottom-0 left-2 lg:left-7" src="{{ asset('img/evaluation-woman1.svg') }}" alt="">
            @else
            <img class="hidden sm:block w-[5rem] sm:w-[10rem] 2xl:w-[17rem] absolute bottom-0 right-0" src="{{ asset('img/evaluation-woman1.svg') }}" alt="">
            <img class="hidden sm:block w-[6rem] 2xl:w-[10rem] absolute bottom-0 left-3" src="{{ asset('img/evaluation-man.svg') }}" alt="">

            @endif



        </div>

        <div class="flex items-start justify-start pb-2 sm:pb-0">
            @if ($Evaluation->status == 'pending')
            <h1 class="px-2 py-2 text-center text-gray-700 2xl:text-sm text-xs w-full">Wait for the admin to validate</h1>
            @else
            <a href={{ route('evaluate-pdf',$Evaluation->id ) }} class="bg-blue-400 hover:bg-blue-500 px-2 py-2 text-center rounded-lg sm:rounded-xl text-white 2xl:text-sm text-xs w-full">Click here to download PDF</a>
            @endif
        </div>
    </div>

</main>
