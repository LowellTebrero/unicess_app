<div class="bg-white 2xl:w-[27rem] xl:w-[13rem]">

    {{--  Proposal Summary  --}}
    <div class="flex flex-col p-5 mt-12 ">
        <h1 class="text-gray-700 xl:text-sm 2xl:text-[1.1rem] tracking-wider font-medium">Proposal Monitoring
        </h1>
        <div class="justify-between flex mt-3 flex-col  space-y-5">

            <button
                class="border border-gray-400 min-h-[8vh] bg-gradient-to-r from-green-200 to-green-500  w-full rounded-xl p-5  flex space-x-5 items-center relative overflow-hidden  duration-100"
                type="button" x-data="{}"
                x-on:click="window.livewire.emitTo('finished-proposal', 'show')">

                    <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="50"
                        width="50">
                        <path d="m20 32.4-7.85-7.85 2.4-2.4L20 27.6l13.45-13.45 2.4 2.4Z" />
                    </svg>
                    <h1 class="text-sm font-semibold text-white tracking-wider xl:text-xs 2xl:text-sm">
                        FINISHED PROPOSAL</h1>
                    <h1 class="text-3xl font-bold text-white">
                    {{ $finishedProposal }}</h1>
            </button>

            <button
                class="border border-gray-400 min-h-[8vh] bg-gradient-to-r from-sky-400 to-blue-500 w-full  rounded-xl p-5 flex space-x-5 items-center relative overflow-hidden  duration-100"
                type="button" x-data="{}"
                x-on:click="window.livewire.emitTo('ongoing-proposal', 'show')">


                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 24 24">
                    <path
                        d="M15.25 5q-.525 0-.888-.363T14 3.75q0-.525.363-.888t.887-.362q.525 0 .888.363t.362.887q0 .525-.363.888T15.25 5Zm0 16.5q-.525 0-.888-.363T14 20.25q0-.525.363-.888T15.25 19q.525 0 .888.363t.362.887q0 .525-.363.888t-.887.362Zm4-13q-.525 0-.888-.363T18 7.25q0-.525.363-.888T19.25 6q.525 0 .888.363t.362.887q0 .525-.363.888t-.887.362Zm0 9.5q-.525 0-.888-.363T18 16.75q0-.525.363-.888t.887-.362q.525 0 .888.363t.362.887q0 .525-.363.888T19.25 18Zm1.5-4.75q-.525 0-.888-.363T19.5 12q0-.525.363-.888t.887-.362q.525 0 .888.363T22 12q0 .525-.363.888t-.887.362ZM2 12q0-3.925 2.613-6.75t6.412-3.2q.4-.05.688.238T12 3q0 .4-.263.7t-.662.35q-3.025.35-5.05 2.6T4 12q0 3.125 2.025 5.363t5.05 2.587q.4.05.663.35T12 21q0 .425-.288.713t-.687.237Q7.2 21.575 4.6 18.75T2 12Zm10 2q-.825 0-1.413-.588T10 12q0-.125.013-.263t.062-.262L8.7 10.1q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l1.375 1.375q.1-.025.525-.075q.825 0 1.413.588T14 12q0 .825-.588 1.413T12 14Z" />
                </svg>

                <h1 class="text-sm font-semibold text-white  tracking-wider xl:text-xs 2xl:text-sm"> ONGOING
                    PROPOSAL</h1>
                <h1 class=" text-3xl font-bold  rounded-3xl text-white">{{ $ongoingProposal }}</h1>
            </button>

            <button
                class="border border-gray-400 min-h-[8vh] bg-gradient-to-l from-orange-600 via-orange-400 to-yellow-300   w-full rounded-2xl p-5 space-x-5   items-center relative overflow-hidden flex "
                type="button" x-data="{}"
                x-on:click="window.livewire.emitTo('pending-proposal', 'show')">



                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24">
                    <path
                        d="M4 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h8.41A7 7 0 0 0 16 23a7 7 0 0 0 7-7a7 7 0 0 0-5-6.7V8l-6-6H4m0 2h7v5h5a7 7 0 0 0-7 7a7 7 0 0 0 1.26 4H4V4m12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m-1 1v5l3.61 2.16l.75-1.22l-2.86-1.69V12H15Z" />
                </svg>
                <h1 class="text-sm font-semibold text-white tracking-wider xl:text-xs 2xl:text-sm">PENDING
                    PROPOSAL
                </h1>
                <h1 class="text-3xl text-white font-bold ">{{ $projectProposal }}</h1>

            </button>
        </div>
    </div>
</div>
