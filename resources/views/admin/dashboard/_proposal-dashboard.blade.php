<div class="p-3 pt-0 px-0 overflow-x-auto h-[50vh] 2xl:h-[57vh] text-gray-700">
        <table class="table-auto w-full relative">
            <thead
                class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky ">
                <tr>
                    <th class="p-2 whitespace-nowrap hidden 2xl:block">
                        <div class="font-semibold text-left ">Uploader</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Project Title</div>
                    </th>

                    <th class="p-2 whitespace-nowrap hidden sm:block">
                        <div class="font-semibold text-left">Uploaded</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">Status</div>
                    </th>

                </tr>
            </thead>


            <tbody class="text-xs divide-y divide-gray-100 ">

                @foreach ($allProposal as $proposal)
                    <tr class="hover:bg-gray-100">
                        <td class="p-3 whitespace-nowrap hidden 2xl:block">
                            <a href={{ route('admin.dashboard.edit-proposal',  ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                        class="rounded-full"
                                        src="{{ !empty($proposal->user->avatar) ? url('upload/image-folder/profile-image/' . $proposal->user->avatar) : url('upload/profile.png') }}"
                                        width="30" height="30">
                                </div>
                                <div class="font-medium text-gray-600 text-[.7rem]">
                                    {{ $proposal->user->first_name }}
                                </div>
                            </div>
                        </a>
                        </td>
                        <td class="p-3 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                            <div
                                class="text-left text-gray-600 xl:text-[.7rem]">
                                    {{ Str::limit($proposal->project_title, 80) }}
                            </div>
                            </a>
                        </td>

                        <td class="p-3 whitespace-nowrap  hidden sm:block">
                            <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                            <div class="text-left text-gray-600  xl:text-[.7rem]">
                               {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, Y,  g:i:s A')}}
                            </div>
                            </a>
                        </td>
                        <td class="p-3 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                            @if ($proposal->authorize == 'pending')
                                <div
                                    class="text-md text-center text-red-400 xl:text-[.7rem] ">
                                    {{ $proposal->authorize }}</div>
                            @elseif ($proposal->authorize == 'ongoing')
                                <div
                                    class="text-md text-center text-blue-500 xl:text-[.7rem] ">
                                    {{ $proposal->authorize }}</div>
                            @elseif ($proposal->authorize == 'finished')
                                <div
                                    class="text-md text-center text-green-700 xl:text-[.7rem] ">
                                    {{ $proposal->authorize }}</div>
                            @endif
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>


