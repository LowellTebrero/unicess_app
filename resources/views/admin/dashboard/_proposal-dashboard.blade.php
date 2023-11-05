<div class="p-3 pt-0 px-0">
    <div class="overflow-x-auto">
        <table class="table-auto w-full relative">
            <thead
                class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky ">
                <tr>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Faculty Name</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Project Title</div>
                    </th>

                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Uploaded</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">Status</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">
                            <input type="checkbox" name="" id="select_all_ids">
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody class="text-xs divide-y divide-gray-100">
                @foreach ($allProposal as $proposal)
                    <tr id="proposal_id{{ $proposal->id }}" class="hover:bg-gray-100">
                        <td class="p-3 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                        class="rounded-full"
                                        src="{{ !empty($proposal->user->avatar) ? url('upload/image-folder/profile-image/' . $proposal->user->avatar) : url('upload/profile.png') }}"
                                        width="30" height="30" alt="Alex Shatov">
                                </div>
                                <div class="font-medium text-gray-800 text-[.7rem]">
                                    {{ $proposal->user->first_name }}
                                </div>
                            </div>
                        </a>
                        </td>
                        <td class="p-3 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>
                            <div
                                class="text-left  text-gray-700 2xl:text-sm xl:text-[.7rem]">
                                {{ Str::limit($proposal->project_title, 80) }}
                            </div>
                            </a>
                        </td>

                        <td class="p-3 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>
                            <div class="text-left text-gray-700 2xl:text-sm xl:text-[.6rem]">
                                {{ \Carbon\Carbon::parse($proposal->created_at)->format('F d Y') }}
                            </div>
                            </a>
                        </td>
                        <td class="p-3 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>
                            @if ($proposal->authorize == 'pending')
                                <div
                                    class="text-md text-center text-red-400 xl:text-[.7rem] 2xl:text-sm">
                                    {{ $proposal->authorize }}</div>
                            @elseif ($proposal->authorize == 'ongoing')
                                <div
                                    class="text-md text-center text-blue-500 xl:text-[.7rem] 2xl:text-sm">
                                    {{ $proposal->authorize }}</div>
                            @elseif ($proposal->authorize == 'finished')
                                <div
                                    class="text-md text-center text-green-700 xl:text-[.7rem] 2xl:text-sm">
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
</div>

<div class="mt-3 xl:ml-2 2xl:ml-0">
    <h1>{{ $allProposal->links() }}</h1>
</div>

