<x-app-layout>

    <section class="m-8  rounded-lg  relative mt-5 xl:min-h-[85vh] 2xl:min-h-[87vh]  bg-white text-gray-700">
        <header class="p-5 py-4 flex justify-between items-center">
            <h1 class="text-2xl tracking-wider font-semibold">Request Proposal</h1>
            <a href={{ route('allProposal.index') }} class="hover:bg-gray-200 px-1 rounded focus:bg-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <div class="p-5">
            <a href={{ route('allProposal.request-proposal-create') }} class="bg-blue-400 hover:bg-blue-500 px-2 py-1 rounded-md text-sm text-white">Send Request</a>
        </div>

    </section>



</x-app-layout>
