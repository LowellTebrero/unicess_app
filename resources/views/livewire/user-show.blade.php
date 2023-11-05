
    <div class="bg-white shadow-lg rounded-lg min-h-[87vh]  m-8 mt-5">
        <div class="py-4 flex justify-between px-8">
            <h4 class=" tracking-wider text-2xl font-semibold text-gray-700">Account Overview</h4>

            <div class="text-sm">


                <input type="text" name="search" wire:model.debounce.500ms="search" id="search"
                    class="xl:text-xs border-slate-500 rounded w-[20rem]" placeholder="Search...">

                <select name="" id="" class=" text-xs rounded"
                    wire:model="selectedFaculty">
                    @foreach ($faculties as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <select name="" id="" class=" xl:text-xs rounded"
                    wire:model="selectedRole">
                    @foreach ($roled as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <select wire:model="authorizing" name="authorizing" id="authorizing"
                    class=" xl:text-xs rounded ">
                    <option value="">All Authorize</option>
                    <option value="pending">Pending</option>
                    <option value="checked">Approved</option>
                    <option value="close">Declined</option>
                </select>

                <select wire:model="paginate" name="paginate" id="paginate" class="text-xs rounded ">
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="70">70</option>
                </select>
            </div>
        </div>
        <hr>

        <div class="overflow-x-auto p-2 rounded mt-12 px-8">
            <table class="table-auto w-full border-collapse ">

                <thead class="text-[.7rem] text-gray-800 uppercase bg-slate-200">
                    <tr>
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

                        <tr class="xl:text-xs 2xl:text-sm  hover:bg-slate-200 border-b  dark:border-gray-500 text-gray-600">

                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">
                                    <div>{{ $user->first_name == null ? '----------' : $user->first_name }}</div>
                                </div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">
                                    <div>{{ $user->last_name == null ? '----------' : $user->last_name }}</div>
                                </div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">
                                    <div> {{ Str::limit($user->email == null ? '----------' : $user->email) }}</div>
                                </div>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left">
                                    <div> {{ $user->faculty == null ? '----------' : $user->faculty->name }}</div>
                                </div>
                            </td>

                            <td>
                                <div class="text-left">
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $name)
                                            <span class="block">{{ $name }}</span>
                                        @endforeach
                                    @endif
                            </td>
                            <td>
                                <div class="text-left">
                                    @if ($user->authorize == 'pending')
                                        <span class="text-red-600">pending</span>
                                    @elseif($user->authorize == 'checked')
                                        <span class="text-green-500">approved</span>
                                    @else
                                        <span class="text-red-300">declined</span>
                                    @endif
                                </div>
                            </td>

                            <td class=" space-x-1 flex xl:flex-row  xl:items-center justifiy-center">
                                <a class="rounded-md p-1 text-white bg-blue-500"
                                    href={{ route('admin.users.show', $user->id) }}>View </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm ('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-2" href="">
                                        <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" height="20"
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
            <div class="p-2">{{ $users->links() }}</div>
        </div>
    </div>

<x-messages/>
</div>
