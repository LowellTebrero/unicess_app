<div class="p-5 py-3">
    {{--  <h1 class="">S-Y: {{ $currentYear }} - {{ $previousYear }}</h1>  --}}
    <div class="overflow-x-auto h-[70vh] rounded-lg border border-gray-200 shadow-sm  ">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
            <thead class="bg-gray-50">
          <tr class="">
            <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Username</th>
            <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Role Name</th>
            <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Faculty Name</th>
            <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Created</th>
            <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Status</th>
            <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600"></th>
            <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600"></th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 border-t border-gray-100">

          @foreach ($latestData as $evaluation )
            @foreach ($users as $user )
            @if ($user->id == $evaluation->users->id )

          <tr class="hover:bg-gray-50">
            <th class="flex gap-3 px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal text-gray-900">
                <div class="relative h-10 w-10 ">
                  <img class="rounded-full" id="showImage" src="{{ (!empty($user->avatar))? url('upload/image-folder/profile-image/'. $user->avatar): url('upload/profile.png') }}" alt="">
                  {{--  <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>  --}}
                </div>
                <div class="">
                  <div class="font-medium text-gray-700">{{ $user->name }}</div>
                  <div class="text-gray-400">{{ $user->email }}</div>
                </div>
              </th>


              <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4">
                @if (!empty($evaluation->users->getRoleNames()))
                   @foreach ($evaluation->users->getRoleNames() as $role )
                       <span class="block my-2 rounded-lg ">{{ $role }}</span>
                   @endforeach
               @endif
           </td>

           <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
            {{ $evaluation->users->faculty->name }}
           </td>

         <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-sm">
            {{ \Carbon\Carbon::parse($evaluation->created_at)->format('M d, Y,  g:i:s A')}}
          </td>

          <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4">
            @if ($evaluation->status  == 'pending')
            <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-500">

               {{ $evaluation->status }}
            </span>
            @elseif ($evaluation->status  == 'evaluated')
            <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
               Validated
            </span>
            @endif

        </td>

        <td class="xl:pl-4 xl:px-0 2xl:px-2 py-4">
            <div class="flex text-gray-800">
              <a href="{{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $currentYear]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-2 rounded-lg flex space-x-2">
                 <span>Update</span>
                  <svg class="fill-white hidden 2xl:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 96 960 960" width="20"><path d="M480.118 726Q551 726 600.5 676.382q49.5-49.617 49.5-120.5Q650 485 600.382 435.5q-49.617-49.5-120.5-49.5Q409 386 359.5 435.618q-49.5 49.617-49.5 120.5Q310 627 359.618 676.5q49.617 49.5 120.5 49.5Zm-.353-58Q433 668 400.5 635.265q-32.5-32.736-32.5-79.5Q368 509 400.735 476.5q32.736-32.5 79.5-32.5Q527 444 559.5 476.735q32.5 32.736 32.5 79.5Q592 603 559.265 635.5q-32.736 32.5-79.5 32.5ZM480 856q-146 0-264-83T40 556q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.169 240Q601 796 702.5 730.5 804 665 857 556q-53-109-154.331-174.5-101.332-65.5-222.5-65.5Q359 316 257.5 381.5 156 447 102 556q54 109 155.331 174.5 101.332 65.5 222.5 65.5Z"/></svg>
              </a>
            </div>
          </td>


          @if ($evaluation->status  == 'evaluated')
         <td class="px-4 xl:px-4 2xl:px-2">
            <a href="{{ route('evaluate-pdf',$evaluation->id ) }}" class="text-white 2xl:text-sm text-[.6rem] px-1 2xl:px-3 rounded-lg ">
                <svg class="fill-red-500 mr-1" xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 96 960 960" width="25">
                <path
                d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z" />
            </svg>
            </a>
          </td>
          @endif


          </tr>
          @endif
          @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
</div>
