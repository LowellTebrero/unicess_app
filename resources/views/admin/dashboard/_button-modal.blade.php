<section class="flex min-h-[15vh] rounded-xl w-full flex-col space-y-4  lg:flex-row  xl:flex-row lg:space-x-6 lg:space-y-0 xl:space-x-5 2xl:space-x-8 mt-2 text-white sm:flex-row sm:space-x-4 md:flex-row md:space-x-4 md:space-y-0 sm:space-y-0 sm:w-full">

    <div class="bg-white w-full text-gray-700 rounded-xl  hover:bg-slate-100 transition-all flex justify-between items-center p-4 sm:p-0 sm:px-4 md:px-6 px-8 xl:px-10 shadow relative hover:border hover:border-teal-300">
        <div>
            <div class=" flex items-end">
                <span class="block  xl:text-5xl 2xl:text-6xl text-4xl font-medium">{{ $evaluation }}</span>

                <div class="flex items-center space-x-2">
                    <span class="text-sm">Out of</span>
                    <span class="block  text-2xl font-medium mb-1">{{ $totalAccount }}</span>
                </div>
            </div>
            <h1 class="xl:text-[.7rem] 2xl:text-sm text-xs">Submitted Evaluaton form </h1>
        </div>
        <svg class="xl:w-[2rem] 2xl:w-[5rem] lg:w-[3rem] sm:w-[2rem] sm:absolute sm:top-2 sm:right-5 lg:relative xl:absolute xl:top-2 xl:right-7 2xl:sticky" xmlns="http://www.w3.org/2000/svg" width="55" height="55"
            viewBox="0 0 256 256">
            <path fill="currentColor"
                d="M64.12 147.8a4 4 0 0 1-4 4.2H16a8 8 0 0 1-7.8-6.17a8.35 8.35 0 0 1 1.62-6.93A67.79 67.79 0 0 1 37 117.51a40 40 0 1 1 66.46-35.8a3.94 3.94 0 0 1-2.27 4.18A64.08 64.08 0 0 0 64 144c0 1.28 0 2.54.12 3.8Zm182-8.91A67.76 67.76 0 0 0 219 117.51a40 40 0 1 0-66.46-35.8a3.94 3.94 0 0 0 2.27 4.18A64.08 64.08 0 0 1 192 144c0 1.28 0 2.54-.12 3.8a4 4 0 0 0 4 4.2H240a8 8 0 0 0 7.8-6.17a8.33 8.33 0 0 0-1.63-6.94Zm-89 43.18a48 48 0 1 0-58.37 0A72.13 72.13 0 0 0 65.07 212A8 8 0 0 0 72 224h112a8 8 0 0 0 6.93-12a72.15 72.15 0 0 0-33.74-29.93Z" />
        </svg>
    </div>

    <div class="hover:border hover:border-teal-300 bg-white w-full text-gray-700 rounded-xl  hover:bg-slate-100 transition-all flex justify-between items-center p-4 sm:p-0 sm:px-4 md:px-6 px-8 xl:px-10 shadow relative"
        type="button" x-data="{}" x-on:click="window.livewire.emitTo('pending-user', 'show')">

            <div class="relative">
                <div class="flex space-x-2">
                    <span class="block xl:text-5xl 2xl:text-6xl text-4xl font-medium">{{ $pendingAccount }}</span>

                <div class=" flex flex-col ">
                    @if ($getCountUsers > 0)
                    <span class="text-green-500">{{ $getCountUsers }} % </span>
                    <span class="text-xs text-green-500">of today</span>
                    @elseif ($getCountUsers <= 0)
                    <span class="text-red-500">{{ $getCountUsers }} % </span>
                    <span class="text-xs text-red-500">of today</span>
                    @endif
                </div>
                </div>
                <h1 class="xl:text-[.7rem] 2xl:text-sm text-xs">Pending account</h1>
            </div>


        <svg class="xl:w-[2rem] 2xl:w-[5rem] lg:w-[3rem] sm:w-[2rem] sm:absolute sm:top-2 sm:right-5 lg:relative xl:absolute xl:top-2 xl:right-7 2xl:sticky" xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M10.63 14.1a6.998 6.998 0 0 1 9.27-3.47a6.998 6.998 0 0 1 3.47 9.27A6.98 6.98 0 0 1 17 24c-2.7 0-5.17-1.56-6.33-4H1v-2c.06-1.14.84-2.07 2.34-2.82S6.72 14.04 9 14c.57 0 1.11.05 1.63.1M9 4c1.12.03 2.06.42 2.81 1.17S12.93 6.86 12.93 8c0 1.14-.37 2.08-1.12 2.83c-.75.75-1.69 1.12-2.81 1.12s-2.06-.37-2.81-1.12C5.44 10.08 5.07 9.14 5.07 8c0-1.14.37-2.08 1.12-2.83C6.94 4.42 7.88 4.03 9 4m8 18a5 5 0 0 0 5-5a5 5 0 0 0-5-5a5 5 0 0 0-5 5a5 5 0 0 0 5 5m-1-8h1.5v2.82l2.44 1.41l-.75 1.3L16 17.69V14Z" />
        </svg>
    </div>

    <a href="{{ route('admin.dashboard.chart-index') }}"
        class="bg-white w-full text-gray-700 rounded-xl  hover:bg-slate-100 transition-all flex justify-between items-center p-4 sm:p-0 sm:px-4 md:px-6 px-8 xl:px-10 shadow relative hover:border hover:border-teal-300">

        <div class="relative">
            <div class="flex space-x-2">
                <span class="block xl:text-5xl 2xl:text-6xl text-4xl  font-medium">{{ $totalProposal }}</span>

            <div class="flex flex-col ">
                @if ($getCountProposals > 0)
                <span class="text-green-500">{{ $getCountProposals }} % </span>
                <span class="text-xs text-green-500">of today</span>
                @elseif ($getCountProposals <= 0)
                <span class="text-red-500">{{ $getCountProposals }} % </span>
                <span class="text-xs text-red-500">of today</span>
                @endif
            </div>
            </div>
            <h1 class="xl:text-[.7rem] 2xl:text-sm text-xs">Total of proposals</h1>
        </div>

        <svg class="xl:w-[2rem] 2xl:w-[5rem] lg:w-[3rem] sm:w-[2rem] sm:absolute sm:top-2 sm:right-5 lg:relative xl:absolute xl:top-2 xl:right-7 2xl:sticky" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M4 4v18h16v2H4c-1.1 0-2-.9-2-2V4h2m11 3h5.5L15 1.5V7M8 0h8l6 6v12c0 1.11-.89 2-2 2H8a2 2 0 0 1-2-2V2c0-1.11.89-2 2-2m9 16v-2H8v2h9m3-4v-2H8v2h12Z" />
        </svg>
    </a>
</section>
