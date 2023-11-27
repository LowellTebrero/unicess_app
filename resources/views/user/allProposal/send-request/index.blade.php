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


        <div class=" rounded-lg border border-gray-200 shadow-sm m-5 overflow-x-auto h-[60vh] 2xl:h-[70vh]">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
                <thead>
                    <tr class="sticky top-0 bg-gray-100 z-20">
                        <th scope="col" class="px-6 py-4 font-medium ">Uploaded</th>
                        <th scope="col" class="px-6 py-4 font-medium ">Project Title</th>
                        <th scope="col" class="px-6 py-4 font-medium ">Member Type</th>
                        <th scope="col" class="px-6 py-4 font-medium ">Status</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 border-t border-gray-100" id="searchResults">
                    @foreach ($proposalRequest as $myproposal )


                <tr class="hover:bg-gray-50">

                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 rounded-full py-1 text-xs  text-gray-700">
                            {{ \Carbon\Carbon::parse($myproposal->created_at)->format("M d, Y: H:i:s")}}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <h1 class="text-xs">
                            {{ $myproposal->proposal->project_title}}
                        </h1>
                    </td>

                    <td class="px-6 py-4 text-xs">
                         @if ($myproposal->leader_member_type == NULL && $myproposal->leader_location == NULL)
                            <h1>Member</h1>
                        @elseif($myproposal->member_type == NULL)
                            <h1>Leader</h1>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 rounded-full py-1 text-xs  text-gray-700">
                            {{ $myproposal->status }}
                        </span>
                    </td>





                </tr>

                @endforeach
                </tbody>
            </table>
        </div>

    </section>



</x-app-layout>
