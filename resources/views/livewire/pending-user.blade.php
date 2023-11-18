<div>
    <x-modals wire:model="show">
        <!-- Title / Close-->
        <div class="flex items-center justify-between mb-5 px-4 pt-4">
            <h5 class="mr-3 text-gray-500 max-w-none">Pending account that needs to be update</h5>
            <button type="button" class=" z-50 cursor-pointer text-gray-500 focus:text-red-600 text-md focus:bg-red-100 hover:bg-gray-100 rounded font-semibold  px-2 py-1" @click="show = false">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <hr>

        <!-- content -->
        <div class="w-full">
            <div class="overflow-x-auto p-5">

                    <table class="table-auto w-full p-5 pt-0">
                        @foreach ($pendingAccount as $pendinguser )
                        @if ($pendinguser)
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50 sticky top-0">
                            <tr>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Created</div></th>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Role</div></th>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Email</div></th>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-center">Status</div></th>
                                <th class="p-2 whitespace-nowrap"><div class="font-semibold text-center">Action</div></th>
                            </tr>
                        </thead>

                        @else
                        <h1 class="text-red-500">No pending User</h1>
                        @endif
                        @endforeach

                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($pendingAccount as $pendinguser )
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left text-xs text-gray-500">{{ $pendinguser->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">

                                    <div class="text-left text-gray-700">
                                        @if (!empty($pendinguser->getRoleNames()))
                                        @foreach ($pendinguser->getRoleNames() as $name )
                                            <span class="block">{{ $name }}</span>
                                        @endforeach
                                    @endif
                                    </div>
                                </td>

                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium text-green-500">{{ $pendinguser->email }}</div>
                                </td>

                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-md text-center text-red-400">{{ $pendinguser->authorize == 'pending' ? "Pending" : ""}}</div>
                                </td>

                                <td class="p-2 whitespace-nowrap flex flex-row justify-center items-center space-x-2">

                                    <a href={{ route('admin.users.show', ['user' => $pendinguser->id, 'user_id' => $pendinguser->id ] ) }} class="text-blue-400 mb-1">Edit</a>
                                </td>

                            </tr>
                            @empty
                            <h1 class="text-red-500">No pending User</h1>
                            @endforelse

                        </tbody>
                    </table>

            </div>
    </div>

    </x-modals>
</div>
