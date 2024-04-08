<section class="grid grid-cols-3 gap-4 h-[15vh]">
     <!-- Current href is admin.evaluation.index -->
    <a href={{ route('admin.dashboard.evaluation-chart') }} class="bg-white w-full text-gray-600 rounded-lg xl:rounded-xl  hover:bg-slate-100 transition-all flex justify-between items-center p-4 sm:p-0 px-4 md:px-6 xl:px-10 shadow relative hover:border hover:border-teal-300">
        <div>
            <div class="flex space-x-2">
                <span class="flex items-center space-x-1  xl:text-5xl text-4xl font-medium">
                    <span class="text-4xl text-gray-600 font-medium 2xl:text-6xl">{{ $evaluation }}</span>
                    <span class="text-[.6rem] sm:text-xs">Out of</span>
                    <span class="text-[.7rem] sm:text-xs text-gray-600  md:text-lg ">{{ $totalAccount }}</span>
                </span>
            </div>
            <h1 class="xl:text-[.7rem] 2xl:text-sm text-[.6rem]">Submitted Evaluation Form </h1>
            {{--  Request for proposal member  --}}
        </div>
        <svg class="hidden sm:block xl:w-[2rem] 2xl:w-[5rem] lg:w-[2rem] w-[1.5rem] sm:absolute sm:top-2 sm:right-5 xl:absolute xl:top-2 xl:right-7 2xl:sticky top-2" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 16 16"><path fill="#374151" d="M9 1v3.5A1.5 1.5 0 0 0 10.5 6H14v7.5a1.5 1.5 0 0 1-1.5 1.5H8.19c.202-.346.27-.769.16-1.179C9.952 13.634 11 12.088 11 10.5a5.5 5.5 0 0 0-7-5.293V2.5A1.5 1.5 0 0 1 5.5 1H9ZM6.862 14.79A4.5 4.5 0 1 1 10 10.5c0 1.301-.89 2.34-1.98 2.34c-.302 0-.56-.07-.776-.2a1.372 1.372 0 0 1-.406-.379a1.82 1.82 0 0 1-.586.423c-.225.1-.477.156-.752.156a1.818 1.818 0 0 1-1.5-.772c-.31-.422-.48-.977-.48-1.568c0-.59.17-1.146.48-1.568c.344-.47.859-.772 1.5-.772a1.815 1.815 0 0 1 .97.273a.513.513 0 0 1 .085-.112a.54.54 0 0 1 .92.305l.005.074v1.8c0 .895.202 1.26.54 1.26c.453 0 .9-.521.9-1.26a3.404 3.404 0 0 0-.634-1.983a3.434 3.434 0 0 0-1.794-1.29A3.42 3.42 0 0 0 4 7.425a3.42 3.42 0 0 0 2.335 6.392l.2-.057l.14-.048a.54.54 0 0 1 .44.984l-.068.03l-.185.063ZM4.6 10.5c0 .717.38 1.26.9 1.26s.9-.543.9-1.26s-.38-1.26-.9-1.26s-.9.543-.9 1.26ZM10 1.25V4.5a.5.5 0 0 0 .5.5h3.25L10 1.25Zm-2.169 9.567l.002-.002Z"/></svg>
    </a>

    <div class="hover:border hover:border-teal-300 bg-white w-full text-gray-600 rounded-lg xl:rounded-xl  hover:bg-slate-100 transition-all flex justify-between items-center p-4 sm:p-0 px-4 md:px-6  xl:px-10 shadow relative"
        type="button" x-data="{}" x-on:click="window.livewire.emitTo('pending-user', 'show')">

            <div class="relative">
                <div class="flex space-x-2">
                    <span class="block 2xl:text-6xl text-4xl font-medium">{{ $pendingAccount }}</span>

                <div class="flex flex-col">
                    @if ($getCountUsers > 0)
                    <span class="text-[.6rem] text-green-500 sm:text-xs 2xl:text-sm">{{ $getCountUsers }} % </span>
                    <span class="text-[.6rem] sm:text-xs text-green-500">of today</span>
                    @elseif ($getCountUsers <= 0)
                    <span class="text-[.6rem] text-red-400 sm:text-xs 2xl:text-sm">{{ $getCountUsers }} % </span>
                    <span class="text-[.6rem] sm:text-xs text-red-400">of today</span>
                    @endif
                </div>
                </div>
                <h1 class="xl:text-[.7rem] 2xl:text-sm text-[.6rem]">Pending account</h1>
            </div>


        <svg class="hidden sm:block xl:w-[2rem] 2xl:w-[5rem] lg:w-[2rem] w-[1.5rem] sm:absolute sm:top-2 sm:right-5 xl:absolute xl:top-2 xl:right-7 2xl:sticky top-2" xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M10.63 14.1a6.998 6.998 0 0 1 9.27-3.47a6.998 6.998 0 0 1 3.47 9.27A6.98 6.98 0 0 1 17 24c-2.7 0-5.17-1.56-6.33-4H1v-2c.06-1.14.84-2.07 2.34-2.82S6.72 14.04 9 14c.57 0 1.11.05 1.63.1M9 4c1.12.03 2.06.42 2.81 1.17S12.93 6.86 12.93 8c0 1.14-.37 2.08-1.12 2.83c-.75.75-1.69 1.12-2.81 1.12s-2.06-.37-2.81-1.12C5.44 10.08 5.07 9.14 5.07 8c0-1.14.37-2.08 1.12-2.83C6.94 4.42 7.88 4.03 9 4m8 18a5 5 0 0 0 5-5a5 5 0 0 0-5-5a5 5 0 0 0-5 5a5 5 0 0 0 5 5m-1-8h1.5v2.82l2.44 1.41l-.75 1.3L16 17.69V14Z" />
        </svg>
    </div>

    <a href="{{ route('admin.extension-monitoring.index') }}"
        class="bg-white w-full text-gray-600 rounded-lg xl:rounded-xl  hover:bg-slate-100 transition-all flex justify-between items-center  p-4 sm:p-0 px-4 md:px-6 xl:px-10 shadow relative hover:border hover:border-teal-300">

        <div class="relative">
            <div class="flex space-x-2">
                <span class="block 2xl:text-6xl text-4xl  font-medium">{{ $totalProposal }}</span>

            <div class="flex flex-col ">
                @if ($getCountProposals > 0)
                <span class="text-[.6rem] sm:text-xs text-green-500  2xl:text-sm">{{ $getCountProposals }} % </span>
                <span class="text-[.6rem] sm:text-xs text-green-500">of today</span>
                @elseif ($getCountProposals <= 0)
                <span class=" text-[.6rem] sm:text-xs text-red-400 2xl:text-sm">{{ $getCountProposals }} % </span>
                <span class="text-[.6rem] sm:text-xs text-red-400">of today</span>
                @endif
            </div>
            </div>
            <h1 class="xl:text-[.6rem] 2xl:text-sm text-[.6rem]">Total of Extension Program/Project </h1>
        </div>
        <svg class="hidden sm:block xl:w-[2rem] 2xl:w-[5rem] lg:w-[2rem] w-[1.5rem] sm:absolute sm:top-2 sm:right-5 xl:absolute xl:top-2 xl:right-7 2xl:sticky top-2" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 512 512"><path fill="#374151" d="M428 224H288a48 48 0 0 1-48-48V36a4 4 0 0 0-4-4h-92a64 64 0 0 0-64 64v320a64 64 0 0 0 64 64h224a64 64 0 0 0 64-64V228a4 4 0 0 0-4-4Zm-92 160H176a16 16 0 0 1 0-32h160a16 16 0 0 1 0 32Zm0-80H176a16 16 0 0 1 0-32h160a16 16 0 0 1 0 32Z"/><path fill="#374151" d="M419.22 188.59L275.41 44.78a2 2 0 0 0-3.41 1.41V176a16 16 0 0 0 16 16h129.81a2 2 0 0 0 1.41-3.41Z"/></svg>
    </a>
</section>
