<div class="overflow-x-auto h-[52vh]">
<table class="w-full text-left text-gray-500">
    <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
        <tr class="bg-gray-300 sticky top-0">
            @if ($proposalMembers->count() <= 0)

            @else
            <th></th>
            <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 ">Uploaded</th>
            <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Project Title</th>
            {{--  <th scope="col" class="px-6 py-3">Started Date</th>  --}}
            <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Uploader</th>
            <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 "> Status</th>
            @endif
        </tr>
    </thead>


    <tbody>


        @if ($proposals == null)

        <tr>
            <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Proposal</td>
        </tr>

        @else

            @foreach ($proposals as $index => $proposal )
            @foreach ($proposal->proposal_members as $prop )

            @if ($proposal->id == $prop->proposal_id)



                <tr class="border-b text-gray-800 bg-white hover:bg-gray-100 text-xs ">

                    <td class="pl-4 font-medium py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                        <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                            {{ $index + 0 }}
                        </a>
                    </td>

                    <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                        <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                            {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                        </a>
                    </td>


                    <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                        <a class="text-xs" href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                            {{ Str::limit($proposal->project_title, 100)}}
                        </a>
                    </td>

                    <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.8rem]">
                        <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                            {{ $proposal->user->name}}
                        </a>
                     </td>
                    {{--  <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">
                        <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                            {{ \Carbon\Carbon::parse($proposal->finished_date)->format('F d, Y')}}
                        </a>
                    </td>  --}}
                    <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">
                        <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                    @if ($proposal->authorize == 'pending')
                    <div class="text-md  text-red-400">{{ $proposal->authorize}}</div>
                    @elseif ($proposal->authorize == 'ongoing')
                    <div class="text-md  text-blue-500">{{ $proposal->authorize}}</div>
                    @elseif ($proposal->authorize == 'finished')
                    <div class="text-md  text-green-500">{{ $proposal->authorize}}</div>
                    @endif
                    </a>
                    </td>

                </tr>


            @endif

            @endforeach
            @endforeach
            @endif

        </tbody>
    </table>
</div>

