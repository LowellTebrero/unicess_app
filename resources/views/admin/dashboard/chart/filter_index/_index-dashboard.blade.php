<div class="flex space-x-4  m-5 mx-0 h-[9vh] text-gray-700">

    <div class="bg-slate-100 p-5 px-8 w-[10rem] hover:bg-white hover:border hover:border-teal-300 rounded-lg text-xs">
        <h1 class="tracking-wider">Pending</h1>
        <h1 class="text-xl">{{ $pendingCount }}</h1>
    </div>
    <div class="bg-slate-100 p-5 px-8 w-[10rem] hover:bg-white hover:border hover:border-teal-300 rounded-lg text-xs">
        <h1 class="tracking-wider">Ongoing</h1>
        <h1 class="text-xl">{{ $ongoingCount }}</h1>
    </div>
    <div class="bg-slate-100 p-5 px-8 w-[10rem] hover:bg-white hover:border hover:border-teal-300 rounded-lg text-xs">
        <h1 class="tracking-wider">Finished</h1>
        <h1 class="text-xl">{{ $finishedCount }}</h1>
    </div>
    <div class="bg-slate-100 p-5 px-8 w-[10rem] hover:bg-white hover:border hover:border-teal-300 rounded-lg text-xs">
        <h1 class="tracking-wider">Total</h1>
        <h1 class="text-xl">{{ $statusCount }}</h1>
    </div>
</div>


<div class="p-3 pt-0 px-0 overflow-x-auto h-[50vh] 2xl:h-[55vh] rounded-lg border  w-full">
    <table class="table-auto w-full relative">
        <thead
            class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
            <tr>
                {{--  <th class="p-2 pr-0 whitespace-nowrap hidden 2xl:block">
                    <div class="font-semibold text-left ">Uploader</div>
                </th>  --}}
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-left">Project Title</div>
                </th>

                <th class="p-2 whitespace-nowrap hidden sm:block 2xl:w-[5rem]">
                    <div class="font-semibold text-left">Uploaded</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">Status</div>
                </th>
                <th class="p-2 whitespace-nowrap">
                    <div class="font-semibold text-center">
                        <input type="checkbox" name="" id="selectAll">
                    </div>
                </th>
            </tr>
        </thead>


        <tbody class="text-xs divide-y divide-gray-100 ">

            @foreach ($allProposal as $proposal)
                <tr id="proposal_id{{ $proposal->id }}" class="hover:bg-gray-100">
                    {{--  <td class="p-3 pr-0 whitespace-nowrap hidden 2xl:block ">
                    <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                            <div class="relative flex items-center">
                                <div class="flex-shrink-0 mr-2 sm:mr-3">
                                    <img class="rounded-full" src="{{ !empty($proposal->user->avatar) ? url('upload/image-folder/profile-image/' . $proposal->user->avatar) : url('upload/profile.png') }}"
                                        width="30" height="30">
                                </div>
                                <div class="font-medium text-gray-800 text-[.7rem]">
                                    {{ $proposal->user->first_name }}
                                </div>
                            </div>
                        </a>
                    </td>  --}}
                    <td class="p-3 whitespace-nowrap">
                    <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                        <div
                            class="text-left text-gray-700 xl:text-[.7rem] flex items-center space-x-1">
                            <svg class="fill-yellow-400" xmlns="http://www.w3.org/2000/svg" height="30"
                                viewBox="0 96 960 960" width="30">
                                <path d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z" />
                            </svg>
                            <div>
                                {{ Str::limit($proposal->project_title, 80) }}
                            </div>

                        </div>
                        </a>
                    </td>

                    <td class="p-3 whitespace-nowrap  hidden sm:block 2xl:w-[5rem]">
                    <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                        <div class="text-left text-gray-700  xl:text-[.7rem]">
                           {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, Y,  g:i:s A')}}
                        </div>
                        </a>
                    </td>
                    <td class="p-3 whitespace-nowrap">
                    <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                        @if ($proposal->authorize == 'pending')
                            <div
                                class="text-md text-center text-gray-500 xl:text-[.8rem] ">
                                {{ $proposal->authorize }}</div>
                        @elseif ($proposal->authorize == 'ongoing')
                            <div
                                class="text-md text-center text-gray-500 xl:text-[.8rem] ">
                                {{ $proposal->authorize }}</div>
                        @elseif ($proposal->authorize == 'finished')
                            <div
                                class="text-md text-center text-gray-500 xl:text-[.8rem] ">
                                {{ $proposal->authorize }}</div>
                        @endif
                        </a>
                    </td>
                    <td class="p-3 whitespace-nowrap">
                        <div class="text-center text-gray-700 2xl:text-sm xl:text-[.6rem]">
                          <input type="checkbox" name="ids" class="checkbox_ids" id="checkbox_ids" value="{{ $proposal->id }}">
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
