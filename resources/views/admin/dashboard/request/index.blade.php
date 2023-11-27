<x-admin-layout>

    <section class="2xl:min-h-[87vh] h-[85vh] mt-5 m-8 rounded-lg bg-white text-gray-700">
        <header class="p-5 py-4 justify-between items-center flex">
            <h1 class="2xl:text-2xl font-semibold tracking-wider text-gray-700">Proposal Request Overview</h1>
            <a href={{ route('admin.dashboard.index') }} class="hover:bg-gray-200 focus:bg-red-200 rounded px-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <main class="p-10">

            <div class="p-3 pt-0 px-0 overflow-x-auto h-[50vh] 2xl:h-[57vh] text-gray-700 border rounded">
                <table class="table-auto w-full relative">
                    <thead
                        class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky ">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Uploaded</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">User</div>
                            </th>
                            {{--  <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Project Title</div>
                            </th>  --}}

                            <th class="p-2 whitespace-nowrap hidden sm:block">
                                <div class="font-semibold text-left">Member Type</div>
                            </th>


                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Status</div>
                            </th>
                        </tr>
                    </thead>


                    <tbody class="text-xs divide-y divide-gray-100 ">

                        @foreach ($ProposalRequest as $proposal)
                            <tr class="hover:bg-gray-100">

                                <td class="p-3 whitespace-nowrap ">
                                    <a href={{ route('admin.dashboard.member-request-show',  ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                  <div class="text-left text-gray-600  xl:text-[.7rem]">
                                     {{--  {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, Y,  g:i:s A')}}  --}}
                                     {{ $proposal->created_at->diffForHumans() }}
                                  </div>
                                  </a>
                              </td>

                                <td class="p-3 whitespace-nowrap">
                                     <a href={{ route('admin.dashboard.member-request-show',  ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                                class="rounded-full"
                                                src="{{ !empty($proposal->user->avatar) ? url('upload/image-folder/profile-image/' . $proposal->user->avatar) : url('upload/profile.png') }}"
                                                width="30" height="30">
                                        </div>
                                        <div class="font-medium text-gray-600 text-[.7rem]">
                                            {{ $proposal->user->email }}
                                        </div>
                                    </div>
                                </a>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <a href={{ route('admin.dashboard.member-request-show',  ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                    <div class="text-left text-gray-600 xl:text-[.7rem]">
                                        @if ($proposal->leader_member_type == NULL && $proposal->leader_location == NULL)
                                            <h1>Member</h1>
                                        @elseif($proposal->member_type == NULL)
                                            <h1>Leader</h1>
                                        @endif
                                    </div>
                                    </a>
                                </td>


                                <td class="p-3 whitespace-nowrap">
                                    {{--  <a href={{ route('admin.dashboard.member-request-show',  ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>

                                        @foreach ($proposalMembers as $proposalmem )
                                            @if ($proposalmem->proposal_id == $proposal->proposal_id )
                                            <div class="text-center text-gray-600  xl:text-[.7rem]">
                                                <label class="text-xs tracking-wider">Added</label>
                                            </div>
                                            @endif

                                            @if($proposalmem->proposal_id !== $proposal->proposal_id || $proposalMembers->isEmpty())
                                            <div class="text-center text-gray-600  xl:text-[.7rem]">
                                                <label class="text-xs tracking-wider">Pending</label>
                                            </div>
                                            @endif
                                        @endforeach

                                    </a>  --}}


                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </main>
    </section>


</x-admin-layout>
