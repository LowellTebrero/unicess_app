

<div class="bg-white shadow-lg rounded-lg h-full text-gray-700 relative overflow-hidden">

    <nav id="nav" class="absolute top-0 h-full right-0 w-[0rem] bg-gray-500 z-10 text-white transition-all">

        <div class="p-4 relative">
            <a href="javascript:void(0)" class="absolute top-2 right-2 text-2xl" onclick="closeNav()">×</a>
            <h1 class="text-xs mt-5 mb-3">Options</h1>

            <div class="navoption2 text-gray-700 flex space-y-2 w-full ">
                <select class="text-xs 2xl:text-sm  rounded border-slate-400 w-full"
                    wire:model="selectedFaculty">
                    @foreach ($faculties as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <select wire:model="authorizing" name="authorizing" id="authorizing"
                    class="text-xs border-slate-400 2xl:text-sm rounded w-full">
                    <option value="">Authorize</option>
                    <option value="pending">Pending</option>
                    <option value="checked">Approved</option>
                    <option value="close">Declined</option>
                </select>

                <select wire:model="paginate" name="paginate" id="paginate" class="w-full text-xs rounded  2xl:text-sm border-slate-400">
                    <option value="13">13</option>
                    <option value="50">50</option>
                    <option value="70">70</option>
                </select>

                <!-- Modal toggle -->
                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="text-gray-700  bg-white block rounded w-full font-medium  text-xs 2xl:text-sm px-2 lg:px-5 py-2.5 " type="button">
                 Show Summary
                </button>
            </div>

        </div>

    </nav>

    <div class="py-2 flex justify-between items-center 2xl:px-8 px-4">
        <h4 class="tracking-wider 2xl:text-2xl font-semibold text-gray-700 text-xs sm:text-lg">Accounts Overview</h4>

        <div class="text-sm flex space-x-2">

            <!-- Modal toggle -->
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="hidden md:block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs 2xl:text-sm px-2 lg:px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Summary
            </button>

            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-4xl h-[55%] 2xl:h-[40%]">
                    <!-- Modal content -->
                    <div class="relative rounded-lg shadow bg-gray-700 h-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between 2xl:p-4 p-2 border-b rounded-t border-gray-600">
                            <h3 class="text-md sm:text-xl font-semibold text-white">
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
                        <div class="p-4 grid gap-3 grid-cols-2 text-white">
                            <div class="space-y-2">
                                <h1 class="text-base">Accounts</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 256 256"><path fill="currentColor" d="M243.6 148.8a6 6 0 0 1-8.4-1.2A53.58 53.58 0 0 0 192 126a6 6 0 0 1 0-12a26 26 0 1 0-25.18-32.5a6 6 0 0 1-11.62-3a38 38 0 1 1 59.91 39.63a65.69 65.69 0 0 1 29.69 22.27a6 6 0 0 1-1.2 8.4M189.19 213a6 6 0 0 1-2.19 8.2a5.9 5.9 0 0 1-3 .81a6 6 0 0 1-5.2-3a59 59 0 0 0-101.62 0a6 6 0 1 1-10.38-6a70.1 70.1 0 0 1 36.2-30.46a46 46 0 1 1 50.1 0A70.1 70.1 0 0 1 189.19 213M128 178a34 34 0 1 0-34-34a34 34 0 0 0 34 34m-58-58a6 6 0 0 0-6-6a26 26 0 1 1 25.18-32.51a6 6 0 1 0 11.62-3a38 38 0 1 0-59.91 39.63A65.69 65.69 0 0 0 11.2 140.4a6 6 0 1 0 9.6 7.2A53.58 53.58 0 0 1 64 126a6 6 0 0 0 6-6"/></svg>
                                    Total of Registered User ({{ $Usercount }})</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 256 256"><path fill="currentColor" d="M232.49 81.44A22 22 0 0 0 216 74h-58V56a38 38 0 0 0-38-38a6 6 0 0 0-5.37 3.32L76.29 98H32a14 14 0 0 0-14 14v88a14 14 0 0 0 14 14h172a22 22 0 0 0 21.83-19.27l12-96a22 22 0 0 0-5.34-17.29M30 200v-88a2 2 0 0 1 2-2h42v92H32a2 2 0 0 1-2-2M225.92 97.24l-12 96A10 10 0 0 1 204 202H86v-96.58l37.58-75.17A26 26 0 0 1 146 56v24a6 6 0 0 0 6 6h64a10 10 0 0 1 9.92 11.24"/></svg>
                                    Total of Aprroved User ({{$approved}})</h1>
                                <h1 class="tracking-wider flex space-x-2 items-center justify-start text-[.6rem] sm:text-sm">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 24 24"><path fill="currentColor" d="M17.385 21q-1.672 0-2.836-1.164Q13.385 18.67 13.385 17t1.164-2.836Q15.713 13 17.385 13q1.67 0 2.835 1.164T21.385 17q0 1.671-1.165 2.836T17.385 21m.384-4.165V14.5q0-.154-.115-.27q-.116-.115-.27-.115q-.153 0-.269.116q-.115.115-.115.269v2.333q0 .153.056.296q.056.144.186.275l1.525 1.525q.112.111.264.121q.152.01.282-.121q.131-.13.131-.273q0-.143-.13-.273zM5.615 20q-.666 0-1.14-.475Q4 19.051 4 18.385V5.615q0-.666.475-1.14Q4.949 4 5.615 4h4.637q.14-.587.623-.986T12 2.615q.654 0 1.134.4q.48.398.62.985h4.63q.667 0 1.141.475q.475.474.475 1.14v6.02q-.258-.133-.488-.233T19 11.223V5.615q0-.23-.192-.423Q18.615 5 18.385 5H16v1.423q0 .343-.23.576q-.23.232-.57.232H8.8q-.34 0-.57-.232Q8 6.766 8 6.423V5H5.615q-.23 0-.423.192Q5 5.385 5 5.615v12.77q0 .269.173.442t.442.173h6.127q.08.28.189.521q.11.24.28.479zm6.388-14.77q.345 0 .575-.232q.23-.234.23-.578q0-.345-.233-.575q-.234-.23-.578-.23q-.345 0-.575.234q-.23.233-.23.577q0 .345.234.575q.233.23.577.23"/></svg>
                                    Total of Pending User ({{ $pending }})</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 256 256"><path fill="currentColor" d="M128 26a102 102 0 1 0 102 102A102.12 102.12 0 0 0 128 26m0 192a90 90 0 1 1 90-90a90.1 90.1 0 0 1-90 90m-6-82V80a6 6 0 0 1 12 0v56a6 6 0 0 1-12 0m16 36a10 10 0 1 1-10-10a10 10 0 0 1 10 10"/></svg>
                                    Total of Declined User ({{$declined}})</h1>
                            </div>

                            <div class="space-y-2">
                                <h1 class="text-base">Roles</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm ">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 256 256"><path fill="currentColor" d="M112.6 158.43a58 58 0 1 0-57.2 0a93.83 93.83 0 0 0-50.19 38.29a6 6 0 0 0 10.05 6.56a82 82 0 0 1 137.48 0a6 6 0 0 0 10-6.56a93.83 93.83 0 0 0-50.14-38.29M38 108a46 46 0 1 1 46 46a46.06 46.06 0 0 1-46-46m211 97a6 6 0 0 1-8.3-1.74A81.8 81.8 0 0 0 172 166a6 6 0 0 1 0-12a46 46 0 1 0-17.08-88.73a6 6 0 1 1-4.46-11.14a58 58 0 0 1 50.14 104.3a93.83 93.83 0 0 1 50.19 38.29A6 6 0 0 1 249 205"/></svg>
                                    Total of College extension coordinator ({{ $college_extension_coordinator }})</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm ">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 256 256"><path fill="currentColor" d="M112.6 158.43a58 58 0 1 0-57.2 0a93.83 93.83 0 0 0-50.19 38.29a6 6 0 0 0 10.05 6.56a82 82 0 0 1 137.48 0a6 6 0 0 0 10-6.56a93.83 93.83 0 0 0-50.14-38.29M38 108a46 46 0 1 1 46 46a46.06 46.06 0 0 1-46-46m211 97a6 6 0 0 1-8.3-1.74A81.8 81.8 0 0 0 172 166a6 6 0 0 1 0-12a46 46 0 1 0-17.08-88.73a6 6 0 1 1-4.46-11.14a58 58 0 0 1 50.14 104.3a93.83 93.83 0 0 1 50.19 38.29A6 6 0 0 1 249 205"/></svg>
                                    Total of Extension Staff  ({{ $Extension_Staff }})</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm ">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 256 256"><path fill="currentColor" d="M112.6 158.43a58 58 0 1 0-57.2 0a93.83 93.83 0 0 0-50.19 38.29a6 6 0 0 0 10.05 6.56a82 82 0 0 1 137.48 0a6 6 0 0 0 10-6.56a93.83 93.83 0 0 0-50.14-38.29M38 108a46 46 0 1 1 46 46a46.06 46.06 0 0 1-46-46m211 97a6 6 0 0 1-8.3-1.74A81.8 81.8 0 0 0 172 166a6 6 0 0 1 0-12a46 46 0 1 0-17.08-88.73a6 6 0 1 1-4.46-11.14a58 58 0 0 1 50.14 104.3a93.83 93.83 0 0 1 50.19 38.29A6 6 0 0 1 249 205"/></svg>
                                    Total of Faculty ({{$Faculty}})</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm ">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 256 256"><path fill="currentColor" d="M112.6 158.43a58 58 0 1 0-57.2 0a93.83 93.83 0 0 0-50.19 38.29a6 6 0 0 0 10.05 6.56a82 82 0 0 1 137.48 0a6 6 0 0 0 10-6.56a93.83 93.83 0 0 0-50.14-38.29M38 108a46 46 0 1 1 46 46a46.06 46.06 0 0 1-46-46m211 97a6 6 0 0 1-8.3-1.74A81.8 81.8 0 0 0 172 166a6 6 0 0 1 0-12a46 46 0 1 0-17.08-88.73a6 6 0 1 1-4.46-11.14a58 58 0 0 1 50.14 104.3a93.83 93.83 0 0 1 50.19 38.29A6 6 0 0 1 249 205"/></svg>
                                    Total of Student ({{ $Student }})</h1>
                                <h1 class="tracking-wider flex space-x-4 items-center justify-start text-[.6rem] sm:text-sm ">
                                    <svg class="mr-2 w-[2rem] hidden sm:block" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 256 256"><path fill="currentColor" d="M112.6 158.43a58 58 0 1 0-57.2 0a93.83 93.83 0 0 0-50.19 38.29a6 6 0 0 0 10.05 6.56a82 82 0 0 1 137.48 0a6 6 0 0 0 10-6.56a93.83 93.83 0 0 0-50.14-38.29M38 108a46 46 0 1 1 46 46a46.06 46.06 0 0 1-46-46m211 97a6 6 0 0 1-8.3-1.74A81.8 81.8 0 0 0 172 166a6 6 0 0 1 0-12a46 46 0 1 0-17.08-88.73a6 6 0 1 1-4.46-11.14a58 58 0 0 1 50.14 104.3a93.83 93.83 0 0 1 50.19 38.29A6 6 0 0 1 249 205"/></svg>
                                    Total of New User ({{ $New_user }})</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <input type="text" name="search" wire:model.debounce.500ms="search" id="search" class="w-[9rem] sm:w-[10rem] text-xs  rounded 2xl:text-sm border-slate-400" placeholder="Search...">

            <button class="block md:hidden" onclick="openNav()">☰</button>

            <div class="navoption1">
                <select class="text-xs 2xl:text-sm  rounded border-slate-400 w-[5rem] lg:w-[10rem]"
                    wire:model="selectedFaculty">
                    @foreach ($faculties as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>

                <select wire:model="authorizing" name="authorizing" id="authorizing"
                    class="text-xs border-slate-400 2xl:text-sm rounded w-[5rem] lg:w-[10rem]">
                    <option value="">Authorize</option>
                    <option value="pending">Pending</option>
                    <option value="checked">Approved</option>
                    <option value="close">Declined</option>
                </select>

                <select wire:model="paginate" name="paginate" id="paginate" class="w-[2rem] lg:w-[5rem] text-xs rounded  2xl:text-sm border-slate-400">
                    <option value="13">13</option>
                    <option value="50">50</option>
                    <option value="70">70</option>
                </select>
            </div>
        </div>
    </div>
    <hr>

    <div class="overflow-x-auto p-2 pt-0 mt-2 xl:px-4 2xl:px-8 h-[68vh] 2xl:h-[75vh] ">
        <table class="table-auto w-full border-collapse">
            <thead class="text-[.7rem] text-gray-700 uppercase sticky top-0 bg-gray-200 w-full">
                <tr>
                    <th class="p-2 whitespace-nowrap text-left"><div>#</div></th>
                    <th class="p-2 whitespace-nowrap text-left">Username</th>
                    <th class="p-2 whitespace-nowrap text-left">First Name</th>
                    <th class="p-2 whitespace-nowrap text-left">Last Name</th>
                    <th class="p-2 whitespace-nowrap text-left">Email</th>
                    <th class="p-2 whitespace-nowrap text-left">Department Name</th>
                    {{-- <th class="p-2 whitespace-nowrap text-left hidden md:block">Role</th> --}}
                    <th class="p-2 whitespace-nowrap text-left">Authorize</th>
                    <th class="p-2 whitespace-nowrap text-left">Action</th>
                </tr>
            </thead>
            <tbody>

                @php
                $count = ($users->currentPage() - 1) * $users->perPage();
                 @endphp

                @forelse ($users as $user )


                    <tr class="text-xs 2xl:text-sm  hover:bg-slate-200 border-b  dark:border-gray-500 text-gray-600">

                        <td class="text-xs pl-2">{{ ++$count }}</td>

                        <td class="p-3 whitespace-nowrap">
                            <a href={{ route('admin.users.show', ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                            <div class="text-left">
                                <div>{{ $user->name == null ? '----------' : $user->name }}</div>
                            </div>
                            </a>
                        </td>
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

                        {{-- <td class="hidden md:block">
                            <a href={{ route('admin.users.show',  ['user' => $user->id, 'user_id' =>  $user->id ]) }}>
                            <div class="text-left">
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $name)
                                        <span class="block">{{ $name }}</span>
                                    @endforeach
                                @endif
                            </div>
                            </a>
                        </td> --}}
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
    <div class="px-4">{{ $users->links() }}</div>
</div>


    <x-messages/>

    <script>

        function openNav() {

            document.getElementById("nav").style.width = "10rem";

        }
        function closeNav() {

            document.getElementById("nav").style.width = "0";
        }
    </script>
