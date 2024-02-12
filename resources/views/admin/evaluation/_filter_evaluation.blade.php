    <!-- 1st Sem Evaluation -->
    <div class="tab-content p-5 py-3" id="first_sem-content" style="display: none;">
        {{--  <h1 class="">S-Y: {{ $currentYear }} - {{ $previousYear }}</h1>  --}}
        <div class="overflow-x-auto h-[65vh] 2xl:h-[70vh] rounded-lg border border-gray-200 shadow-sm ">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
                <thead class="bg-gray-50">
                    <tr class="">
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Username</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Role Name</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Faculty Name</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Created</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Status</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-center font-medium text-gray-600">Action</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                    @foreach ($firstSemesterEvaluations as $evaluation )

                        <tr class="hover:bg-gray-50">
                            <th class="flex gap-3 px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal text-gray-900">
                                <div class="relative h-10 w-10 ">
                                <img class="rounded-full" id="showImage" src="{{ (!empty($evaluation->users->avatar))? url('upload/image-folder/profile-image/'. $evaluation->users->avatar): url('upload/profile.png') }}" alt="">
                                </div>
                                <div class="">
                                <div class="font-medium text-gray-700">{{ $evaluation->users->name }}</div>
                                <div class="text-gray-400">{{ $evaluation->users->email }}</div>
                                </div>
                            </th>


                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4">
                                @if (!empty($evaluation->users->getRoleNames()))
                                    @foreach ($evaluation->users->getRoleNames() as $role )
                                        <span class="block my-2 rounded-lg text-xs">{{ $role }}</span>
                                    @endforeach
                                @endif
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                {{ $evaluation->users->faculty->name }}
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
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

                            <td class="xl:pl-4 2xl:pr-0 xl:px-0 2xl:px-2 py-4">

                                <div class="flex text-gray-800 space-x-3 items-center justify-center">
                                    <a href="{{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $currentYear, 'notification' => $evaluation->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-2 rounded-lg flex space-x-2">
                                        <span class="text-xs">Update</span>
                                        <svg class="fill-white hidden 2xl:block" xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 96 960 960" width="18"><path d="M480.118 726Q551 726 600.5 676.382q49.5-49.617 49.5-120.5Q650 485 600.382 435.5q-49.617-49.5-120.5-49.5Q409 386 359.5 435.618q-49.5 49.617-49.5 120.5Q310 627 359.618 676.5q49.617 49.5 120.5 49.5Zm-.353-58Q433 668 400.5 635.265q-32.5-32.736-32.5-79.5Q368 509 400.735 476.5q32.736-32.5 79.5-32.5Q527 444 559.5 476.735q32.5 32.736 32.5 79.5Q592 603 559.265 635.5q-32.736 32.5-79.5 32.5ZM480 856q-146 0-264-83T40 556q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.169 240Q601 796 702.5 730.5 804 665 857 556q-53-109-154.331-174.5-101.332-65.5-222.5-65.5Q359 316 257.5 381.5 156 447 102 556q54 109 155.331 174.5 101.332 65.5 222.5 65.5Z"/></svg>
                                    </a>

                                    @if ($evaluation->status  == 'evaluated')
                                        <a href="{{ route('evaluate-pdf',$evaluation->id ) }}" class="text-white 2xl:text-sm text-[.6rem] px-1 2xl:px-3 rounded-lg ">
                                            <svg class="fill-green-500 mr-1 hover:fill-green-600" xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 96 960 960" width="25">
                                            <path
                                            d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z" />
                                        </svg>
                                        </a>
                                    @endif

                                    <button data-modal-target="popup-modal{{ $evaluation->id }}" data-modal-toggle="popup-modal{{ $evaluation->id }}" type="button" class="first-delete-button">
                                        <svg class="hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                    </button>

                                    <div id="popup-modal{{ $evaluation->id }}" tabindex="-1" class="modal-content top-0 left-0 right-0 md:inset-0 m-0 fixed z-50 bg-black hidden bg-opacity-30 overflow-x-hidden overflow-y-auto max-h-full">

                                        <div class="relative w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal{{ $evaluation->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Trash this evaluation?</h3>

                                                    <div class="flex space-x-4 items-center justify-center">

                                                        <button data-modal-hide="popup-modal{{ $evaluation->id }}"  data-evaluation-id="{{ $evaluation->id }}" class="delete-button text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, Im sure
                                                        </button>

                                                        <button data-modal-hide="popup-modal{{ $evaluation->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <!-- 2nd Sem Evaluation -->
    <div class="tab-content p-5 py-3" id="second_sem-content" style="display: none;">
        {{--  <h1 class="">S-Y: {{ $currentYear }} - {{ $previousYear }}</h1>  --}}
        <div class="overflow-x-auto h-[65vh] 2xl:h-[70vh] rounded-lg border border-gray-200 shadow-sm ">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
                <thead class="bg-gray-50">
                    <tr class="">
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Username</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Role Name</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Faculty Name</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Created</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Status</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-center font-medium text-gray-600">Action</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 border-t border-gray-100">


                        @foreach ($secondSemesterEvaluations as $evaluation )

                        <tr class="hover:bg-gray-50">
                            <th class="flex gap-3 px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal text-gray-900">
                                <div class="relative h-10 w-10 ">
                                <img class="rounded-full" id="showImage" src="{{ (!empty($evaluation->users->avatar))? url('upload/image-folder/profile-image/'. $evaluation->users->avatar): url('upload/profile.png') }}" alt="">
                                </div>
                                <div class="">
                                <div class="font-medium text-gray-700">{{ $evaluation->users->name }}</div>
                                <div class="text-gray-400">{{ $evaluation->users->email }}</div>
                                </div>
                            </th>


                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4">
                                @if (!empty($evaluation->users->getRoleNames()))
                                    @foreach ($evaluation->users->getRoleNames() as $role )
                                        <span class="block my-2 rounded-lg text-xs">{{ $role }}</span>
                                    @endforeach
                                @endif
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                {{ $evaluation->users->faculty->name }}
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
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

                            <td class="xl:pl-4 2xl:pr-0 xl:px-0 2xl:px-2 py-4">

                                <div class="flex text-gray-800 space-x-3 items-center justify-center">
                                    <a href="{{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $currentYear, 'notification' => $evaluation->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-2 rounded-lg flex space-x-2">
                                        <span class="text-xs">Update</span>
                                        <svg class="fill-white hidden 2xl:block" xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 96 960 960" width="18"><path d="M480.118 726Q551 726 600.5 676.382q49.5-49.617 49.5-120.5Q650 485 600.382 435.5q-49.617-49.5-120.5-49.5Q409 386 359.5 435.618q-49.5 49.617-49.5 120.5Q310 627 359.618 676.5q49.617 49.5 120.5 49.5Zm-.353-58Q433 668 400.5 635.265q-32.5-32.736-32.5-79.5Q368 509 400.735 476.5q32.736-32.5 79.5-32.5Q527 444 559.5 476.735q32.5 32.736 32.5 79.5Q592 603 559.265 635.5q-32.736 32.5-79.5 32.5ZM480 856q-146 0-264-83T40 556q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.169 240Q601 796 702.5 730.5 804 665 857 556q-53-109-154.331-174.5-101.332-65.5-222.5-65.5Q359 316 257.5 381.5 156 447 102 556q54 109 155.331 174.5 101.332 65.5 222.5 65.5Z"/></svg>
                                    </a>

                                    @if ($evaluation->status  == 'evaluated')
                                        <a href="{{ route('evaluate-pdf',$evaluation->id ) }}" class="text-white 2xl:text-sm text-[.6rem] px-1 2xl:px-3 rounded-lg ">
                                            <svg class="fill-green-500 mr-1 hover:fill-green-600" xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 96 960 960" width="25">
                                            <path
                                            d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z" />
                                        </svg>
                                        </a>
                                    @endif

                                    <button data-modal-target="popup-modal{{ $evaluation->id }}" data-modal-toggle="popup-modal{{ $evaluation->id }}" type="button" class="first-delete-button">
                                        <svg class="hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                    </button>

                                    <div id="popup-modal{{ $evaluation->id }}" tabindex="-1" class="modal-content top-0 left-0 right-0 md:inset-0 m-0 fixed z-50 bg-black hidden bg-opacity-30 overflow-x-hidden overflow-y-auto max-h-full">

                                        <div class="relative w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal{{ $evaluation->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Trash this evaluation?</h3>

                                                    <div class="flex space-x-4 items-center justify-center">

                                                        <button data-modal-hide="popup-modal{{ $evaluation->id }}"  data-evaluation-id="{{ $evaluation->id }}" class="delete-button text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, Im sure
                                                        </button>

                                                        <button data-modal-hide="popup-modal{{ $evaluation->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

