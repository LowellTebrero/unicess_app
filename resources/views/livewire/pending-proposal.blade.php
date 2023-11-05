<div>
    <x-modals wire:model="show">

        <!-- Title / Close-->
        <div class="flex items-center justify-between pb-2 px-4 pt-4 bg-red-200">

            <h5 class="mr-3 text-gray-700 font-medium max-w-none tracking-wider">
                @if ($Count > 0)
                    {{ $Count }} pending project proposal
                @else
                    No pending project proposal
                @endif
            </h5>

            <button type="button" class="flex  z-50 cursor-pointer text-white bg-red-500 text-md px-2 py-2 hover:bg-red-600 rounded " @click="show = false">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <hr>

        <!-- content -->
        <div class="w-full p-4 pt-1">

            <div class="overflow-x-auto">
                <table class="table-auto w-full p-5">
                    @if ($projectProposals->isEmpty())
                    @else
                        <thead class="text-xs font-semibold uppercase text-gray-500  sticky top-0">
                            <tr>
                                @if ($projectProposals == !null)
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Uploaded</div>
                                    </th>

                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Project Title</div>
                                    </th>

                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Action</div>
                                @endif
                                </th>
                            </tr>
                        </thead>
                    @endif

                    <tbody class="text-xs divide-y divide-gray-100">
                        @foreach ($projectProposals as $proposal)
                            <tr>

                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left text-[.7rem] text-gray-500">
                                        {{ $proposal->created_at->diffForHumans() }}</div>
                                </td>

                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium text-gray-500">
                                        {{ Str::limit($proposal->project_title, 100) }}</div>
                                </td>

                                <td class="p-2 whitespace-nowrap flex flex-row justify-center items-center space-x-2">


                                    <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}
                                        class="text-blue-400 mb-1  flex space-x-1 text-right">
                                        <svg class="fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="20"
                                            viewBox="0 96 960 960" width="20">
                                            <path
                                                d="M480.118 726Q551 726 600.5 676.382q49.5-49.617 49.5-120.5Q650 485 600.382 435.5q-49.617-49.5-120.5-49.5Q409 386 359.5 435.618q-49.5 49.617-49.5 120.5Q310 627 359.618 676.5q49.617 49.5 120.5 49.5Zm-.353-58Q433 668 400.5 635.265q-32.5-32.736-32.5-79.5Q368 509 400.735 476.5q32.736-32.5 79.5-32.5Q527 444 559.5 476.735q32.5 32.736 32.5 79.5Q592 603 559.265 635.5q-32.736 32.5-79.5 32.5ZM480 856q-146 0-264-83T40 556q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.169 240Q601 796 702.5 730.5 804 665 857 556q-53-109-154.331-174.5-101.332-65.5-222.5-65.5Q359 316 257.5 381.5 156 447 102 556q54 109 155.331 174.5 101.332 65.5 222.5 65.5Z" />
                                        </svg>
                                        <span>View</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </x-modals>
</div>
