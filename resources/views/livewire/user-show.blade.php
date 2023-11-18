<div class="bg-white shadow-lg rounded-lg  min-h-[85vh] 2xl:min-h-[87vh] m-8 text-gray-700">
        <div class="py-2 flex justify-between 2xl:px-8 px-4">
            <h4 class="tracking-wider 2xl:text-2xl font-semibold text-gray-700 text-lg">Account Overview</h4>

            <div class="text-sm">
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

        <div class="overflow-x-auto p-2 xl:px-4 2xl:px-8 h-[70vh] 2xl:h-[75vh] ">
            <table class="table-auto w-full border-collapse">

                <thead class="text-[.7rem] text-gray-700 uppercase">
                    <tr class="sticky top-0 bg-gray-200 w-full">
                        <th class="p-2 whitespace-nowrap text-left">First Name</th>
                        <th class="p-2 whitespace-nowrap text-left">Last Name</th>
                        <th class="p-2 whitespace-nowrap text-left">Email</th>
                        <th class="p-2 whitespace-nowrap text-left">Faculty Name</th>
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
                                        <span class="text-green-400">approved</span>
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
                                        <svg class="fill-red-500 text-center" xmlns="http://www.w3.org/2000/svg" height="20"
                                            viewBox="0 96 960 960" width="30">
                                            <path
                                                d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z" />
                                        </svg>
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
