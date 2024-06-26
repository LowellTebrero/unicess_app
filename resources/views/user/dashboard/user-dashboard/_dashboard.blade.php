<div class="overflow-x-auto h-[45vh] 2xl:h-[52vh]">

    <table class="w-full text-left text-gray-500">
        <thead class="text-[.6rem] sm:text-xs text-gray-700 uppercase bg-gray-200 relative">
            <tr class="bg-gray-100 sticky top-0">
                <th class="2xl:px-6 xl:px-4 xl:pl-4 py-3 text-sx">Uploaded</th>
                <th class="2xl:px-6 xl:px-4 py-3 text-sx">Project Title</th>
                <th class="2xl:px-6 xl:px-4 py-3 text-sx">Uploader</th>
                <th class="2xl:px-6 xl:px-4 py-3 text-sx"> Status</th>
            </tr>
        </thead>


        <tbody>
            @foreach ($proposals as $proposal )
                @foreach ($proposal->proposal_members as $prop )
                    @if ($proposal->id == $prop->proposal_id)

                        <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-[.7rem] sm:text-xs ">

                            <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                    {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                </a>
                            </td>

                            <td class="2xl:px-6 xl:px-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                    {{ Str::limit($proposal->project_title, 100)}}
                                </a>
                            </td>

                            <td class="2xl:px-6 xl:px-4 py-4 xl:text-[.6rem] 2xl:text-[.8rem]">
                                <a class="xl:text-[.7rem]" href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                    {{ $proposal->user->name}}
                                </a>
                            </td>

                            <td class=" 2xl:px-6 xl:px-4 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">
                                <a class="xl:text-[.7rem]" href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                  <div class="flex gap-2 items-center">

                                    <div>
                                        @if ($proposal->authorize == 'pending')
                                        <div class="text-md">{{ $proposal->authorize}}</div>
                                        @elseif ($proposal->authorize == 'ongoing')
                                        <div class="text-md">{{ $proposal->authorize}}</div>
                                        @elseif ($proposal->authorize == 'finished')
                                        <div class="text-md">{{ $proposal->authorize}}</div>
                                        @endif
                                    </div>

                                    <div>
                                        @if ($proposal->status == 'inactive')
                                            <div class="text-md text-center text-red-700 text-[.6rem] xl:text-xs flex items-center justify-start space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path fill="#ff5757" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2"/></svg>
                                            </div>

                                        @elseif ($proposal->status == 'active')
                                            <div class="text-md text-center text-green-700 text-[.6rem] xl:text-xs flex items-center justify-start  space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path fill="#04dc3a" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                  </div>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach

        </tbody>
    </table>
</div>

