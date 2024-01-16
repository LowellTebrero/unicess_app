<div class="bg-white shadow-lg rounded-lg  h-[82vh] 2xl:min-h-[87vh] m-8 mt-4 2xl:mt-5 text-gray-700">
        <div class="py-2 flex justify-between 2xl:px-8 px-4">
            <h4 class="tracking-wider 2xl:text-2xl font-semibold text-gray-700 text-lg">Accounts Overview</h4>

            <div class="text-sm flex space-x-2">

                <!-- Modal toggle -->
                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Summary
                </button>

                <!-- Main modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-xl h-[50%]">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Account Summary
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4 text-white space-y-2">
                                <div class="space-y-2">
                                    <h1 class="text-base">Accounts</h1>
                                    <h1 class="tracking-wider">Total of Registered Accounts ({{ $Usercount }})</h1>
                                    <h1 class="tracking-wider">Total of Aprroved Accounts ({{$approved}})</h1>
                                    <h1 class="tracking-wider">Total of Pending Accounts ({{ $pending }})</h1>
                                    <h1 class="tracking-wider">Total of Declined Accounts ({{$declined}})</h1>
                                </div>

                                <div class="space-y-2">
                                    <h1 class="text-base">Roles</h1>
                                    <h1 class="tracking-wider">Total of College extension coordinator ({{ $college_extension_coordinator }})</h1>
                                    <h1 class="tracking-wider">Total of Extension Staff  ({{ $Extension_Staff }})</h1>
                                    <h1 class="tracking-wider">Total of Faculty ({{$Faculty}})</h1>
                                    <h1 class="tracking-wider">Total of Student ({{ $Student }})</h1>
                                    <h1 class="tracking-wider">Total of New User ({{ $New_user }})</h1>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <input type="text" name="search" wire:model.debounce.500ms="search" id="search"
                    class="xl:text-xs  rounded 2xl:w-[20rem] 2xl:text-sm border-slate-400" placeholder="Search...">

                <select class="text-xs 2xl:text-sm xl:text-xs rounded border-slate-400"
                    wire:model="selectedFaculty">
                    @foreach ($faculties as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <select wire:model="authorizing" name="authorizing" id="authorizing"
                    class="text-xs xl:text-xs border-slate-400 2xl:text-sm rounded">
                    <option value="">All Authorize</option>
                    <option value="pending">Pending</option>
                    <option value="checked">Approved</option>
                    <option value="close">Declined</option>
                </select>

                <select wire:model="paginate" name="paginate" id="paginate" class="text-xs xl:text-xs rounded  2xl:text-sm border-slate-400">
                    <option value="13">13</option>
                    <option value="50">50</option>
                    <option value="70">70</option>
                </select>
            </div>
        </div>
        <hr>

        <div class="overflow-x-auto p-2 pt-0 mt-2 xl:px-4 2xl:px-8 h-[70vh] 2xl:h-[75vh] ">
            <table class="table-auto w-full border-collapse">
                <thead class="text-[.7rem] text-gray-700 uppercase sticky top-0 bg-gray-200 w-full">
                    <tr>
                        <th class="p-2 whitespace-nowrap text-left">First Name</th>
                        <th class="p-2 whitespace-nowrap text-left">Last Name</th>
                        <th class="p-2 whitespace-nowrap text-left">Email</th>
                        <th class="p-2 whitespace-nowrap text-left">Department Name</th>
                        <th class="p-2 whitespace-nowrap text-left">Role</th>
                        <th class="p-2 whitespace-nowrap text-left">Authorize</th>
                        <th class="p-2 whitespace-nowrap text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="">

                    @forelse ($users as $user )

                        <tr class="text-xs 2xl:text-sm  hover:bg-slate-200 border-b  dark:border-gray-500 text-gray-600">

                            <td class="p-3 whitespace-nowrap">
                                <a href={{ route('admin.users.show', ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                                <div class="text-left">
                                    <div>{{ $user->first_name == null ? '----------' : $user->first_name }}</div>
                                </div>
                                </a>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                   <a href={{ route('admin.users.show',  ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                                <div class="text-left">
                                    <div>{{ $user->last_name == null ? '----------' : $user->last_name }}</div>
                                </div>
                                   </a>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                   <a href={{ route('admin.users.show',  ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                                <div class="text-left">
                                    <div> {{ Str::limit($user->email == null ? '----------' : $user->email) }}</div>
                                </div>
                                   </a>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                   <a href={{ route('admin.users.show',  ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                                <div class="text-left">
                                    <div> {{ $user->faculty == null ? '----------' : $user->faculty->name }}</div>
                                </div>
                                   </a>
                            </td>

                            <td>
                                <a href={{ route('admin.users.show',  ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                                <div class="text-left">
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $name)
                                            <span class="block">{{ $name }}</span>
                                        @endforeach
                                    @endif
                                </div>
                                </a>
                            </td>
                            <td>
                                <a href={{ route('admin.users.show',  ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                                <div class="text-left">
                                    @if ($user->authorize == 'pending')
                                        <span class="text-red-600">pending</span>
                                    @elseif($user->authorize == 'checked')
                                        <span class="text-gray-600">approved</span>
                                    @else
                                        <span class="text-red-300">declined</span>
                                    @endif
                                </div>
                                </a>
                            </td>

                            <td class="text-center ">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm ('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2" href="">
                                        <svg class="hover:fill-red-600" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr colspan="12">
                            <td class="text-lg">
                                <h1 class="text-red-500">No Record Found</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="px-4 pb-2">{{ $users->links() }}</div>
    </div>
<x-messages/>
</div>
