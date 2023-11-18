<div>
    <x-modals wire:model="show">

        <!-- Title / Close-->
        <div class="flex items-center justify-between pb-2 px-4 pt-4 bg-green-200">

            <h5 class="mr-3 text-gray-700 font-medium max-w-none tracking-wider">
                @if ($Count > 0 )
                {{ $Count }} finished project proposal
                @else
                No finished project proposal
                @endif
                </h5>

                <button type="button" class="flex z-50 cursor-pointer text-white bg-green-500 hover:bg-green-600 text-md px-2 py-2 rounded  " @click="show = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
        <hr>



        <!-- content -->
        <div class="w-full p-4 pt-2">

        <div class="overflow-x-auto ">
            @if ($projectProposals->isEmpty())
            @else

            <table class="table-auto w-full p-5">
                <thead class="text-xs font-semibold uppercase text-gray-500  sticky top-0">
                    <tr>

                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Uploaded</div>
                        </th>

                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Project Title</div>
                        </th>

                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Uploaded</div>
                    </th>
                    </tr>
                </thead>
                @endif

                <tbody class="text-xs xl:text-xs 2xl:text-sm divide-y divide-gray-100">
                    @forelse ($projectProposals as $proposal )
                    <tr class="hover:bg-gray-200">

                        <td class="p-2 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                <div class="text-left text-[.7rem] text-gray-500">{{ $proposal->created_at->diffForHumans() }}</div>
                            </a>
                        </td>

                        <td class="p-2 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                            <div class="text-left font-medium text-gray-500">{{ Str::limit($proposal->project_title, 90) }}</div>
                            </a>
                        </td>

                        <td class="p-2 whitespace-nowrap">
                            <a href={{ route('admin.dashboard.edit-proposal', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                            <div class="text-left font-medium text-gray-500">{{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, Y,  g:i:s A')}}</div>
                            </a>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>

        </div>

    </div>


    </x-modals>
</div>
