<div>
    <div class="p-3 relative">
        <div class="text-gray-700 flex w-full gap-2 ">

            <input type="text" name="searchAdminEvaluation" wire:model.debounce.500ms="searchAdminEvaluation" id="searchAdminEvaluation" class="w-[9rem] sm:w-[10rem] text-xs  rounded border-slate-400" placeholder="Search...">


            <select wire:model="EvaluationSemester" name="EvaluationSemester" id="EvaluationSemester" class="w-[7rem] text-xs rounded  border-slate-400">
                <option value="1" {{ $EvaluationSemester == 1 ? 'selected' : '' }}>1st Semester</option>
                <option value="2" {{ $EvaluationSemester == 2 ? 'selected' : '' }}>2nd Semester</option>
            </select>

            <select class="text-xs rounded border-slate-400 w-[8rem]" wire:model="collegesStatus">
                <option  value="">Colleges</option>
                <option  value="BSED">BSED</option>
                <option  value="CME">CME</option>
                <option  value="COE">COE</option>
                <option  value="CAS">CAS</option>
                <option  value="Graduate School">Graduate School</option>
            </select>


            <select wire:model="facultyName" name="facultyName" id="facultyName" class="w-[11rem] text-xs rounded  border-slate-400">
                @foreach ($departments as $id => $name ) <option value="{{ $id }}">{{ $name }}</option> @endforeach
            </select>

            <select class="text-xs rounded border-slate-400 w-[6rem]" wire:model="Status">
                <option  value="">Status</option>
                <option  value="pending">Pending</option>
                <option  value="evaluated">Validated</option>
            </select>

            <select wire:model="yearStatus" name="yearStatus" id="yearStatus" class="w-[6rem] text-xs rounded  border-slate-400">
                @foreach ($years as $year )
                <option value="{{ $year }}" @if ($yearStatus == date('Y')) selected="selected" @endif>{{ $year }}</option>
                @endforeach
            </select>

            {{-- <select wire:model="date" name="date" id="date" class="w-[7rem] text-xs rounded border-slate-400">
                <option value="">Anytime</option>
                <option value="week">Older than a week</option>
                <option value="month">Older than a month</option>
                <option value="six_months">Older than six months</option>
                <option value="year">Older than a year</option>
            </select> --}}


            <select wire:model="paginateAdminEvaluation" name="paginateAdminEvaluation" id="paginateAdminEvaluation" class="w-[5rem] text-xs rounded  border-slate-400">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="70">70</option>
            </select>


        </div>
    </div>

    <div class="overflow-x-auto p-2 pt-0 h-[56vh] 2xl:h-[75vh] ">
        <table class="table-auto w-full border-collapse">
            <thead class="text-[.7rem] text-gray-700 uppercase sticky top-0 bg-gray-200 w-full">
                @if ($evaluations->isNotEmpty())
                <tr>
                    <th>
                        <div><span>&nbsp;</span></div>

                    </th>

                    <th class="p-2 whitespace-nowrap hidden 2xl:block">
                        <div class="font-semibold text-left ">Uploader</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Name</div>
                    </th>

                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">Colleges</div>
                    </th>
                    <th class="p-2 whitespace-nowrap hidden sm:block">
                        <div class="font-semibold text-left">Uploaded</div>
                    </th>
                    <th class="py-2 whitespace-nowrap w-[1rem]">
                        <div class="font-semibold text-center">Total Points</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-right">Status</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left"></div>
                    </th>
                </tr>
                @endif

            </thead>
            <tbody>

                @php
                    $count = ($evaluations->currentPage() - 1) * $evaluations->perPage();
                @endphp





                @forelse ($evaluations as $evaluation )

                <tr class="hover:bg-gray-100 border ">

                    <td class="text-xs pl-2">{{ ++$count }}</td>

                    <td class="p-3 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                    class="rounded-full"
                                    src="{{ !empty($evaluation->user->avatar) ? url('upload/image-folder/profile-image/' . $evaluation->user->avatar) : url('upload/profile.png') }}"
                                    width="30" height="30">
                            </div>
                            <div>
                                <div class="font-medium text-gray-600 text-[.7rem]">
                                    {{ $evaluation->users->name }}
                                </div>
                                <div class="text-gray-400 text-xs">{{ $evaluation->users->email }}</div>
                            </div>

                        </div>
                    </td>




                    <td class="p-3 whitespace-nowrap text-center">
                        <div class=" text-gray-600 text-[.6rem] xl:text-xs">
                            {{ $evaluation->colleges_name}}
                        </div>
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        <div class="text-left text-gray-600  text-[.6rem] xl:text-[.7rem]">
                            {{ \Carbon\Carbon::parse($evaluation->created_at)->format('M d, Y,  g:i:s A')}}
                        </div>
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        <div class="text-left text-gray-600  text-[.6rem] xl:text-[.7rem]">
                            {{ $evaluation->total_points}}
                        </div>
                    </td>

                    <td class="p-3 pr-0 whitespace-nowrap">
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

                    <td class="p-3 pl-0 whitespace-nowrap">
                        <div class="flex text-gray-800 space-x-3 items-end">
                            <a href="{{ route('admin.evaluation.show', ['id' => $evaluation->id, 'year' => $currentYear, 'notification' => $evaluation->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-2 rounded-lg flex space-x-2">
                                <span class="text-xs">Update</span>
                                <svg class="fill-white hidden 2xl:block" xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 96 960 960" width="18"><path d="M480.118 726Q551 726 600.5 676.382q49.5-49.617 49.5-120.5Q650 485 600.382 435.5q-49.617-49.5-120.5-49.5Q409 386 359.5 435.618q-49.5 49.617-49.5 120.5Q310 627 359.618 676.5q49.617 49.5 120.5 49.5Zm-.353-58Q433 668 400.5 635.265q-32.5-32.736-32.5-79.5Q368 509 400.735 476.5q32.736-32.5 79.5-32.5Q527 444 559.5 476.735q32.5 32.736 32.5 79.5Q592 603 559.265 635.5q-32.736 32.5-79.5 32.5ZM480 856q-146 0-264-83T40 556q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.169 240Q601 796 702.5 730.5 804 665 857 556q-53-109-154.331-174.5-101.332-65.5-222.5-65.5Q359 316 257.5 381.5 156 447 102 556q54 109 155.331 174.5 101.332 65.5 222.5 65.5Z"/></svg>
                            </a>


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

                            @if ($evaluation->status  == 'evaluated')
                            <a href="{{ route('evaluate-pdf',$evaluation->id ) }}" class="text-white 2xl:text-sm text-[.6rem] px-1 2xl:px-3 rounded-lg ">
                                <svg class="fill-green-500 mr-1 hover:fill-green-600" xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 96 960 960" width="25">
                                <path
                                d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z" />
                            </svg>
                            </a>
                        @endif

                        </div>
                    </td>

                </tr>

                @empty
                    <tr colspan="12">
                        <td class="text-lg">
                            <div class="h-[45vh] 2xl:h-[52vh] flex flex-col items-center justify-center space-y-2">
                                <img class="w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
                                <h1 class="text-md text-gray-500">Not Found!</h1>
                            </div>
                        </td>

                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    <div class="px-4 text-xs"  wire:key="paginate-admin-evaluations">{{ $evaluations->links() }}</div>
</div>
