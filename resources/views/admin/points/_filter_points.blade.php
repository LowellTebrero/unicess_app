@if ($latestData->isEmpty())
<div class="flex items-center justify-center h-[50vh]">
    <h1 class="text-gray-500">Its empty here</h1>
</div>
@else
<div class="rounded-lg border border-gray-200 shadow-sm m-5 mt-7 overflow-x-auto h-[65vh] 2xl:h-[75vh] text-gray-700">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
        <thead class="bg-gray-50">
            <tr class="sticky top-0 bg-gray-50 z-20">
                <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4 font-medium text-gray-600">Username</th>
                <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4 font-medium text-gray-600">Role Name</th>
                <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4 font-medium text-gray-600">Faculty Name</th>
                <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4 font-medium text-gray-600">Total Proposal</th>
                <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4 font-medium text-gray-600">Created</th>
                <th scope="col" class="px-4 xl:pl-4 xl:px-2 2xl:px-4 2xl:pl-2 py-4 font-medium text-gray-600">Points</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            @foreach ($latestData as $latestDatas )
            @foreach ($users as $user )
            @if ($user->id == $latestDatas->users->id )

        <tr class="hover:bg-gray-50">
            <th>
                <a href="{{ route('admin.points.show',  ['id' => $latestDatas->users->id, 'year' => $currentYear]) }}">
                <div class="flex gap-3 px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4 font-normal text-gray-900">
                    <div class="relative h-10 w-10 ">
                        <img class="rounded-full" id="showImage" src="{{ (!empty($user->avatar))? url('upload/image-folder/profile-image/'. $user->avatar): url('upload/profile.png') }}" alt="">
                    </div>
                    <div class="text-xs 2xl:text-sm">
                        <div class="font-medium text-gray-700">{{ $user->name }}</div>
                        <div class="text-gray-400">{{ $user->email }}</div>
                    </div>
                </div>
                </a>
            </th>

            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4">
                <a href="{{ route('admin.points.show',  ['id' => $latestDatas->users->id, 'year' => $currentYear]) }}">
                @if (!empty($latestDatas->users->getRoleNames()))
                @foreach ($latestDatas->users->getRoleNames() as $role )
                    <span class="block my-2  rounded-lg">{{ $role }}</span>
                @endforeach
                @endif
                </a>
            </td>

            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4">
                <a href="{{ route('admin.points.show',  ['id' => $latestDatas->users->id, 'year' => $currentYear]) }}">
                <span class="px-2 py-1">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                    {{ $user->faculty->name }}
                </span>
                </a>
            </td>

            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4 ">
                <a href="{{ route('admin.points.show',  ['id' => $latestDatas->users->id, 'year' => $currentYear]) }}">
                {{ $latestDatas->users->proposals->count()}}
                </a>
            </td>

            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4">
                <a href="{{ route('admin.points.show',  ['id' => $latestDatas->users->id, 'year' => $currentYear]) }}">
                <span class="text-xs 2xl:text-sm ">
                    <span class="h-1.5 w-1.5 rounded-full"></span>
                    {{ \Carbon\Carbon::parse($latestDatas->created_at)->format('M d, Y,  g:i:s A')}}
                </span>
                </a>
            </td>

            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-2 py-4">
                <a href="{{ route('admin.points.show',  ['id' => $latestDatas->users->id, 'year' => $currentYear]) }}">
                <div class="flex gap-2 text-gray-800">
                   @if ($latestDatas->total_points > 0)
                   {{ $latestDatas->total_points }}
                   @else
                   0
                   @endif
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
@endif
