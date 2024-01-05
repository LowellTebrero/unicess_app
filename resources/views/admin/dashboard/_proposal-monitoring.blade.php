<div class="2xl:w-[25rem] xl:w-[14rem] w-full ">

    {{--  Proposal Summary  --}}
    <div class="flex flex-col p-5 mt-6 rounded-lg mr-6 bg-white">
        <h1 class="text-gray-700 xl:text-sm 2xl:text-[1.1rem] tracking-wider font-medium">Project Monitoring</h1>
        <div class="justify-between flex mt-2 2xl:mt-3 xl:flex-col xl:space-y-2 xl:space-x-0 flex-col sm:flex-row sm:space-y-0 space-y-2 sm:space-x-4">

            <button
                class="border border-gray-400 min-h-[8vh] bg-gradient-to-r from-green-200 to-green-500  w-full rounded-lg p-5  flex space-x-5 items-center relative overflow-hidden  duration-100"
                type="button" x-data="{}"
                x-on:click="window.livewire.emitTo('finished-proposal', 'show')">

                    <svg class="fill-white lg:block  xl:hidden 2xl:block" xmlns="http://www.w3.org/2000/svg" height="50"
                        width="50">
                        <path d="m20 32.4-7.85-7.85 2.4-2.4L20 27.6l13.45-13.45 2.4 2.4Z" />
                    </svg>
                    <h1 class="text-sm font-semibold text-white tracking-wider xl:text-xs 2xl:text-sm"> FINISHED </h1>
                    <h1 class="text-xl 2xl:text-3xl font-bold text-white">
                    {{ $finishedProposal }}</h1>
            </button>

            <button
                class="border border-gray-400 min-h-[8vh] bg-gradient-to-r from-sky-400 to-blue-500 w-full  rounded-lg p-5 flex space-x-5 items-center relative overflow-hidden  duration-100"
                type="button" x-data="{}"
                x-on:click="window.livewire.emitTo('ongoing-proposal', 'show')">


                <svg class="fill-white lg:block  xl:hidden 2xl:block" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 24 24">
                    <path
                        d="M15.25 5q-.525 0-.888-.363T14 3.75q0-.525.363-.888t.887-.362q.525 0 .888.363t.362.887q0 .525-.363.888T15.25 5Zm0 16.5q-.525 0-.888-.363T14 20.25q0-.525.363-.888T15.25 19q.525 0 .888.363t.362.887q0 .525-.363.888t-.887.362Zm4-13q-.525 0-.888-.363T18 7.25q0-.525.363-.888T19.25 6q.525 0 .888.363t.362.887q0 .525-.363.888t-.887.362Zm0 9.5q-.525 0-.888-.363T18 16.75q0-.525.363-.888t.887-.362q.525 0 .888.363t.362.887q0 .525-.363.888T19.25 18Zm1.5-4.75q-.525 0-.888-.363T19.5 12q0-.525.363-.888t.887-.362q.525 0 .888.363T22 12q0 .525-.363.888t-.887.362ZM2 12q0-3.925 2.613-6.75t6.412-3.2q.4-.05.688.238T12 3q0 .4-.263.7t-.662.35q-3.025.35-5.05 2.6T4 12q0 3.125 2.025 5.363t5.05 2.587q.4.05.663.35T12 21q0 .425-.288.713t-.687.237Q7.2 21.575 4.6 18.75T2 12Zm10 2q-.825 0-1.413-.588T10 12q0-.125.013-.263t.062-.262L8.7 10.1q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l1.375 1.375q.1-.025.525-.075q.825 0 1.413.588T14 12q0 .825-.588 1.413T12 14Z" />
                </svg>

                <h1 class="text-sm font-semibold text-white  tracking-wider xl:text-xs 2xl:text-sm">ONGOING</h1>
                <h1 class=" text-xl 2xl:text-3xl font-bold  rounded-3xl text-white">{{ $ongoingProposal }}</h1>
            </button>

            <button
                class="border border-gray-400 min-h-[8vh] bg-gradient-to-l from-orange-600 via-orange-400 to-yellow-300   w-full rounded-lg p-5 space-x-5   items-center relative overflow-hidden flex "
                type="button" x-data="{}"
                x-on:click="window.livewire.emitTo('pending-proposal', 'show')">



                <svg class="fill-white lg:block  xl:hidden 2xl:block" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24">
                    <path
                        d="M4 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h8.41A7 7 0 0 0 16 23a7 7 0 0 0 7-7a7 7 0 0 0-5-6.7V8l-6-6H4m0 2h7v5h5a7 7 0 0 0-7 7a7 7 0 0 0 1.26 4H4V4m12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m-1 1v5l3.61 2.16l.75-1.22l-2.86-1.69V12H15Z" />
                </svg>
                <h1 class="text-sm font-semibold text-white tracking-wider xl:text-xs 2xl:text-sm">PENDING</h1>
                <h1 class="text-xl 2xl:text-3xl text-white font-bold ">{{ $projectProposal }}</h1>

            </button>
        </div>
    </div>

    <div class="flex flex-col p-5 mt-3 2xl:mt-8 rounded-lg mr-6 bg-white text-gray-800">
        <h1 class="tracking-wide 2xl:text-lg font-medium text-gray-600 text-sm">Narrative Report</h1>
        <a href={{ route('admin.dashboard.narrative-index') }} class="mt-2 bg-white w-full text-gray-600 rounded-lg  hover:bg-slate-100 transition-all flex justify-between items-center p-4 sm:p-0 sm:px-4 md:px-6 px-8 xl:px-3 xl:py-4 2xl:py-5 shadow relative hover:border hover:border-teal-300">
            <div>
                <div class="flex space-x-2">
                    <span class="flex items-center space-x-1  xl:text-5xl text-4xl font-medium">
                        <span class="text-[1.7rem] text-gray-600 font-medium 2xl:text-[3rem]">{{ $narrativeCount }}</span>
                        <span class="text-xs">Out of</span>
                        <span class="block text-gray-600  text-lg ">{{ $totalAccount }}</span>
                    </span>
                </div>
                <h1 class="xl:text-[.6rem] 2xl:text-xs text-xs mt-2">Submitted Narrative Report </h1>
            </div>
            <svg class="xl:w-[1.8rem] 2xl:w-[2rem] lg:w-[3rem] sm:w-[2rem] sm:absolute sm:top-2 sm:right-5 lg:relative xl:absolute xl:top-2 xl:right-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512"><path d="M124 80v322c0 7.7-6.3 14-14 14s-14-6.3-14-14V112H80c-17.7 0-32 14.3-32 32v288c0 17.7 14.3 32 32 32h353.1c17 0 30.9-13.8 30.9-30.9V80c0-17.7-14.3-32-32-32l-278 2c-17.7 0-30 12.3-30 30zm66 32h84c7.7 0 14 6.3 14 14s-6.3 14-14 14h-84c-7.7 0-14-6.3-14-14s6.3-14 14-14zm0 160h148c7.7 0 14 6.3 14 14s-6.3 14-14 14H190c-7.7 0-14-6.3-14-14s6.3-14 14-14zm196 108H190c-7.7 0-14-6.3-14-14s6.3-14 14-14h196c7.7 0 14 6.3 14 14s-6.3 14-14 14zm0-160H190c-7.7 0-14-6.3-14-14s6.3-14 14-14h196c7.7 0 14 6.3 14 14s-6.3 14-14 14z" fill="currentColor"/></svg>
        </a>

        <h1 class="xl:mt-5 2xl:mt-10 tracking-wide 2xl:text-lg font-medium text-gray-600 text-sm">Terminal  Report</h1>
        <a href={{ route('admin.dashboard.terminal-index') }} class="mt-2 bg-white w-full text-gray-600 rounded-lg  hover:bg-slate-100 transition-all flex justify-between items-center p-4 sm:p-0 sm:px-4 md:px-6 px-8 xl:px-3 xl:py-4 2xl:py-5 shadow relative hover:border hover:border-teal-300">
            <div>
                <div class="flex space-x-2">
                    <span class="flex items-center space-x-1  xl:text-5xl text-4xl font-medium">
                        <span class="text-[1.7rem] text-gray-600 font-medium 2xl:text-[3rem]">{{ $terminalCount }}</span>
                        <span class="text-xs">Out of</span>
                        <span class="block text-gray-600  text-lg ">{{ $totalAccount }}</span>
                    </span>
                </div>
                <h1 class="xl:text-[.6rem] 2xl:text-xs text-xs mt-2">Submitted Terminal  Report </h1>
            </div>

            <svg class="xl:w-[1.8rem] 2xl:w-[2rem] lg:w-[3rem] sm:w-[2rem] sm:absolute sm:top-2 sm:right-5 lg:relative xl:absolute xl:top-2 xl:right-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512"><path d="M124 80v322c0 7.7-6.3 14-14 14s-14-6.3-14-14V112H80c-17.7 0-32 14.3-32 32v288c0 17.7 14.3 32 32 32h353.1c17 0 30.9-13.8 30.9-30.9V80c0-17.7-14.3-32-32-32l-278 2c-17.7 0-30 12.3-30 30zm66 32h84c7.7 0 14 6.3 14 14s-6.3 14-14 14h-84c-7.7 0-14-6.3-14-14s6.3-14 14-14zm0 160h148c7.7 0 14 6.3 14 14s-6.3 14-14 14H190c-7.7 0-14-6.3-14-14s6.3-14 14-14zm196 108H190c-7.7 0-14-6.3-14-14s6.3-14 14-14h196c7.7 0 14 6.3 14 14s-6.3 14-14 14zm0-160H190c-7.7 0-14-6.3-14-14s6.3-14 14-14h196c7.7 0 14 6.3 14 14s-6.3 14-14 14z" fill="currentColor"/></svg>
        </a>
    </div>
</div>



