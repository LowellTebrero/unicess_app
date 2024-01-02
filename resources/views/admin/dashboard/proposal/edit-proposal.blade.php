
    <style>
        [x-cloak] { display: none }
        form button:disabled,
        form button[disabled] {
            border: 1px solid #999999;
            background-color: #cccccc;
            color: #666666;
        }
    </style>

    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    <x-admin-layout>

        <section class="bg-white shadow rounded-xl m-8 mt-5 xl:min-h-[85vh] 2xl:min-h-[87vh] text-gray-600">

            @if ($proposals->authorize == 'pending')
            <div class="flex justify-between p-2 2xl:p-3 bg-red-200 rounded-tl rounded-tr">
                <div class="flex flex-col sm:flex-row sm:space-x-8 font-medium text-gray-700">
                    <h1 class="text-[.7rem] xl:text-sm tracking-wider">Uploaded:
                        {{ \Carbon\Carbon::parse($proposals->created_at)->format('F-d-Y') }}</h1>
                    <h1 class="text-[.7rem] xl:text-sm tracking-wider">Status: {{ $proposals->authorize }}</h1>
                    <h1 class="text-[.7rem] xl:text-sm tracking-wider">Proposal ID: {{ $proposals->id }}</h1>

                </div>
                <a class="text-black text-xl focus:bg-red-500 focus:text-white hover:bg-red-400 font-medium  px-2 py-2 rounded" href={{ route('admin.dashboard.index') }}>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </a>
            </div>

            @elseif ($proposals->authorize == 'ongoing')

            <div class="flex justify-between p-2 2xl:p-3 bg-blue-200 rounded-tl rounded-tr">
                <div class="flex space-x-8 font-medium text-gray-700">
                    <h1 class="text-xs xl:text-sm tracking-wider">Uploaded:
                        {{ \Carbon\Carbon::parse($proposals->created_at)->format('F-d-Y') }}</h1>
                    <h1 class="text-xs xl:text-sm tracking-wider">Status: {{ $proposals->authorize }}</h1>
                    <h1 class="text-xs xl:text-sm tracking-wider">Proposal ID: {{ $proposals->id }}</h1>

                </div>
                 <a class="text-black text-xl focus:bg-blue-500 focus:text-white hover:bg-blue-400 font-medium  px-2 py-2 rounded" href={{ route('admin.dashboard.index') }}>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </a>
            </div>

            @elseif ($proposals->authorize == 'finished')
            <div class="flex justify-between p-2 2xl:p-3 bg-green-200 rounded-tl rounded-tr">
                <div class="flex space-x-8 font-medium text-gray-700">
                    <h1 class="text-xs xl:text-sm tracking-wider">Uploaded:
                        {{ \Carbon\Carbon::parse($proposals->created_at)->format('F-d-Y') }}</h1>
                    <h1 class="text-xs xl:text-sm tracking-wider">Status: {{ $proposals->authorize }}</h1>
                    <h1 class="text-xs xl:text-sm tracking-wider">Proposal ID: {{ $proposals->id }}</h1>

                </div>
                 <a class="text-black text-xl focus:bg-green-500 focus:text-white hover:bg-green-400 font-medium  px-2 py-2 rounded" href={{ route('admin.dashboard.index') }}>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </a>
            </div>

            @endif
            <hr>

            {{--  Wrapper  --}}
            <div class="xl:flex">

                {{--  Container-1  --}}
                <div class="proposal-sidebar shadow-2xl transition-all xl:relative text-xs  bg-slate-100 xl:bg-white xl:shadow-none rounded-lg  2xl:w-1/4 xl:w-[20rem] px-5 py-2 xl:border-r pt-7  xl:pt-2">
                    <button class="xl:hidden block absolute top-2 right-2 leftclose-button text-red-500">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    </button>

                    <div class="flex flex-col space-y-2 mb-4">
                        <div class="w-full">
                            <div class="w-full">
                                <label class="block text-gray-700 text-[.7rem] font-semibold xl:text-[.7rem]"> Project Proposal Title:</label>
                                <h1 class="xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full py-1  text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    {{ $proposals->project_title }}</h1>
                            </div>
                        </div>

                        <div class="w-full ">
                            <label class="block text-gray-700 xl:text-[.7rem] text-[.7rem] font-semibold"> Program Name:</label>
                            <h1 class="xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full  text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                {{ $proposals->programs->program_name }}</h1>
                        </div>


                    </div>

                    <div class="flex space-x-4 mb-3">
                        <div class="w-full">

                            <div class="w-full">
                                <label class="block text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem]"
                                    >Started Date:</label>
                                <h1
                                    class="xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    {{ \Carbon\Carbon::parse($proposals->started_date)->format('F-d-Y') }}</h1>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="w-full">
                                <label class="block text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem]">Ended Date:</label>
                                <h1
                                    class="xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full  text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    {{ \Carbon\Carbon::parse($proposals->finished_date)->format('F-d-Y') }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="flex 2xl:space-x-3 xl:space-y-3 xl:mb-2 2xl:space-y-0  xl:flex-col 2xl:flex-row">
                        <div class="w-full">

                            <label class="block text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem]">Project Leader</label>
                            @foreach ($proposals->proposal_members as $proposal_mem)
                                <h1
                                    class=" xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full  text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    {{ $proposal_mem->leader_member_type != null ? $proposal_mem->user->name : '' }}
                                </h1>
                            @endforeach
                        </div>
                        <div class="w-full">

                            <label class="block text-gray-700  font-semibold xl:text-[.7rem] text-[.7rem]"
                                >Role of Leader:</label>
                            @foreach ($proposals->proposal_members as $proposal_mem)
                                <h1
                                    class="xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full  text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    {{ $proposal_mem->leader_member_type != null ? $proposal_mem->ceso_role->role_name : '' }}
                                </h1>
                            @endforeach
                        </div>
                    </div>


                    <div class="mb-2 mt-5 xl:mt-0 w-full overflow-x-auto h-[25vh]">
                        <div class="w-full sticky top-0 z-10 bg-gray-100 xl:bg-white">
                            <label class="text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem] ">Project Members</label>
                        </div>

                            @foreach ($proposals->proposal_members as $proposal_mem)
                            <div class="pb-2">
                                @if ($proposal_mem->member_type !== null)
                                <div>
                                    <h1 class="xl:text-[.7rem] text-[.6rem] font-medium text-gray-700 tracking-wider"> Name:</h1>
                                    <span class="font-light 2xl:text-xs xl:text-[.7rem] text-[.7rem]">{{ $proposal_mem->member_type !== null ? $proposal_mem->user->name : '' }}</span>
                                </div>
                                <div>
                                    <h1 class="xl:text-[.7rem] text-[.6rem] font-medium text-gray-700 tracking-wider"> Type:</h1>
                                    <span class="font-light 2xl:text-xs  xl:text-[.7rem] text-[.7rem]">{{ $proposal_mem->member_type }}</span>
                                </div>
                                @endif
                            </div>
                            @endforeach
                    </div>

                    <div class="flex flex-col">
                        <div class="flex flex-col text-xs">
                            <label class="text-gray-700 font-semibold tracking-wider mb-2 xl:text-[.7rem] text-[.7rem]">Change status here:</label>
                            <select id="myDropdown" class="xl:text-[.7rem] text-[.7rem] border-slate-500 rounded-lg">
                                <option value="pending"
                                    {{ old('pending', $proposals->authorize) == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="ongoing"
                                    {{ old('pending', $proposals->authorize) == 'ongoing' ? 'selected' : '' }}>Ongoing
                                </option>
                                <option value="finished"
                                    {{ old('pending', $proposals->authorize) == 'finished' ? 'selected' : '' }}>
                                    Finished</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{--  Container-2  --}}
                <div class="w-full flex flex-col relative">

                    <div class="bg-gray-100 h-full absolute z-30 right-0 bg-opacity-40 flex items-end justify-end transition-all" id="mySidebar">
                        <div class="h-full w-[0rem] bg-gray-700 transition-all" id="subSidebar">
                            <div class="p-4 w-full h-full transition-all" style="display: none" id="sidebar-title">
                                <div class="flex justify-between text-white">
                                    <h1 class="tracking-wider">Options</h1>
                                    <a href="javascript:void(0)" class="closebtn text-2xl" onclick="closeNav()">×</a>
                                </div>

                                <div class=" p-3  space-y-2 flex justify-start  flex-col">

                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = true">

                                        <!-- Trigger for Modal -->
                                        <button class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" type="button" @click="showModal = true">
                                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17"
                                            height="17" viewBox="0 0 16 16">
                                            <g fill="currentColor">
                                                <path
                                                    d="m5.369 7.92l2.14-2.14v5.752h1v-5.68l2.066 2.067l.707-.707l-2.957-2.956h-.707L4.662 7.212l.707.707Z" />
                                                <path
                                                    d="M14 8A6 6 0 1 1 2 8a6 6 0 0 1 12 0Zm-1 0A5 5 0 1 0 3 8a5 5 0 0 0 10 0Z" />
                                            </g>
                                        </svg> Upload file
                                        </button>
                                        <!-- Modal -->

                                        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40" x-show="showModal" >

                                            <!-- Modal inner -->
                                            <div class="w-1/4  text-left bg-blue-500 rounded-lg shadow-lg" x-show="showModal"
                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                <!-- Title / Close-->
                                                <div class="flex items-center justify-between px-4 rounded-tl rounded-tr bg-blue-700 py-4 ">
                                                    <h5 class="text-white max-w-none text-sm tracking-wider">Upload file</h5>
                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 font-medium text-md px-1 rounded hover:bg-blue-600 focus:bg-blue-800 " @click="showModal = false" onClick="window.location.reload()">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <hr>

                                                <!-- content -->
                                                <div class="p-6 space-y-4">

                                                    <p class="text-xs text-center leading-relaxed text-white tracking-wider">
                                                        Note: Choose what is applicable
                                                    </p>

                                                        <div class="py-1 mt-5 flex flex-col text-white">

                                                            <div class="flex flex-col mb-1">
                                                                <label for="" class="text-sm font-light tracking-wider mb-1">Memorandum of Agreement
                                                                    PDF</label>
                                                                <input type="file" name="moa"
                                                                    class="filepond text-xs text-slate-700 border-none  file:bg-transparent file:border-none rounded file:bg-gray-100 file:mr-4 file:py-1 file:px-4" credits="false">
                                                            </div>


                                                            <div class="flex flex-col  mb-1">
                                                                <label for="" class="text-sm font-light tracking-wider mb-1">Travel order
                                                                    PDF</label>
                                                                <input type="file" name="travel_order"
                                                                    class="filepond text-xs text-slate-700 border-none  file:bg-transparent file:border-none rounded file:bg-gray-100 file:mr-4 file:py-2 file:px-4" credits="false">
                                                            </div>

                                                            <div class="flex flex-col  mb-1">
                                                                <label for="" class="text-sm font-light tracking-wider mb-1">Office order
                                                                    PDF</label>
                                                                <input type="file" name="office_order"
                                                                    class="filepond text-xs text-slate-700 border-none file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4" credits="false">
                                                            </div>

                                                            <div class="flex flex-col  mb-1">
                                                                <label for="" class="text-sm font-light tracking-wider mb-1">Other Files</label>
                                                                <input type="file" multiple name="other_files[]"
                                                                    class="filepond text-xs text-slate-700 border-none file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4" credits="false">
                                                            </div>


                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = true">

                                        <!-- Trigger for Modal -->
                                        <button class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 2xl:text-xs text-xs space-x-2 flex" type="button" @click="showModal = true">
                                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17"
                                            height="17" viewBox="0 0 16 16">
                                            <g fill="currentColor">
                                                <path
                                                    d="m5.369 7.92l2.14-2.14v5.752h1v-5.68l2.066 2.067l.707-.707l-2.957-2.956h-.707L4.662 7.212l.707.707Z" />
                                                <path
                                                    d="M14 8A6 6 0 1 1 2 8a6 6 0 0 1 12 0Zm-1 0A5 5 0 1 0 3 8a5 5 0 0 0 10 0Z" />
                                            </g>
                                        </svg> Edit Information
                                        </button>
                                        <!-- Modal -->

                                        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40" x-show="showModal" >

                                            <!-- Modal inner -->
                                            <div class="w-1/2  text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                                <!-- Title / Close-->
                                                <div class="flex items-center justify-between px-4 rounded-tl rounded-tr bg-blue-700 py-4 ">
                                                    <h3 class="text-lg font-semibold text-white">
                                                        Edit Proposal Information
                                                    </h3>
                                                    <button type="button" class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="showModal = false">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>


                                                </div>
                                                <hr>

                                                <!-- content -->
                                                <div class="p-6 space-y-4">

                                                        <form action={{ route('admin.dashboard.update-project-details', $proposal->id ) }} method="POST">
                                                            @csrf @method('PUT')


                                                        <!-- Modal body -->
                                                        <div class="p-6 space-y-6">

                                                            <div class="flex space-y-4 flex-col">
                                                                <div class="w-full">
                                                                    <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs" for="program_id">Program Name <span class="text-red-500">*</span></label>
                                                                    <select id="program_id" class="rounded-md xl:text-xs w-full border-zinc-400  py-2 px-3" name="program_id" value="{{ old('program_id') }}" required>
                                                                        @foreach ($program as $id => $program_name ) <option value="{{ $id }}" @if ($id == $proposal->program_id) selected="selected" @endif >{{ $program_name }}</option> @endforeach
                                                                    </select>
                                                                    @error('program_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="w-full">
                                                                    <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs" for="project_title">Proposal Title <span class="text-red-500">*</span></label>
                                                                    <input class="border-zinc-400 xl:text-xs shadow appearance-none border rounded w-full  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="project_title" id="project_title" type="text" value="{{ $proposal->project_title }}" placeholder="project title" required>
                                                                    @error('project_title') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>

                                                            <div class="flex space-y-2 flex-col mt-3">

                                                                <div class="flex space-x-4 w-full" >
                                                                    <div class="w-full">
                                                                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Started Date  <span class="text-red-500">*</span></label>
                                                                        <input required class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposal->started_date }}" name="started_date" id="started_date" type="date">
                                                                        @error('started_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                                    </div>

                                                                    <div class="w-full">
                                                                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs"> Ended Date  <span class="text-red-500">*</span></label>
                                                                        <input required class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposal->finished_date }}" name="finished_date" id="finished_date" type="date">
                                                                        @error('finished_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="flex space-x-4 w-full">

                                                                    <div class="w-full">
                                                                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Project leader <span class="text-red-500">*</span></label>
                                                                        <select name="leader_id" class="rounded-md xl:text-xs w-full  border-zinc-400" value="{{ old('leader') }}" id="leader" onchange="RequiredGet(this)">
                                                                            <option value="">Select Username</option>
                                                                            @foreach ($members as $id => $name )
                                                                                <option value="{{ $id }}"
                                                                                @foreach ($proposal->proposal_members as $proposal_mem)
                                                                                @if ($proposal_mem->leader_member_type != null ? $proposal_mem->user_id == $id : '')
                                                                                selected="selected"
                                                                                @endif
                                                                                @endforeach
                                                                            >{{ $name }}</option>

                                                                            @endforeach
                                                                        </select>
                                                                        @error('project_leader') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                                    </div>

                                                                    <div class="w-full">
                                                                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Role of Project Leader <span class="text-red-500">*</span></label>
                                                                        <select onchange="yesnoCheck(this)" id="leader_member_type" name="leader_member_type" value="{{ old('leader_member_type') }}" class="rounded-md xl:text-xs w-full border-zinc-400">
                                                                            @foreach ($ceso_roles as $id => $role_name )

                                                                            <option value="{{ $id }}"
                                                                            @foreach ($proposal->proposal_members as $proposal_mem)
                                                                            @if ($id == $proposal_mem->leader_member_type)
                                                                            selected="selected"
                                                                            @endif
                                                                            @endforeach
                                                                            >{{ $role_name }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('role_name') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                                    </div>

                                                                    <div class="w-full">
                                                                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Location <span class="text-red-500">*</span></label>
                                                                        <select id="location_id" type="text"  class="rounded-md xl:text-xs w-full border-zinc-400 " name="location_id" value="{{ old('location_id') }}">
                                                                            @foreach ($locations as $id => $name )
                                                                            <option value="{{ $id }}"
                                                                            @foreach ($proposal->proposal_members as $proposal_mem)
                                                                            @if ($id == $proposal_mem->location_id)
                                                                                selected="selected"
                                                                            @endif
                                                                            @endforeach
                                                                            >{{ $name }}</option>
                                                                        @endforeach
                                                                        </select>
                                                                        @error('location_name') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="pt-4 w-full">

                                                                    <div>
                                                                        <button name="add" id="add" type="button" class="bg-slate-500 rounded text-white px-2 py-1  text-sm xl:text-xs border-zinc-400">Add Member</button>
                                                                    </div>

                                                                    <table id="table" class="w-full">
                                                                        <thead>
                                                                        <tr class="text-sm text-gray-500">
                                                                            <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Member Name</th>
                                                                            <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Member Type</th>
                                                                            <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Action</th>
                                                                        </tr>
                                                                        </thead>

                                                                        <tbody>

                                                                            @php($count=0)
                                                                            @foreach ($proposal->proposal_members as $proposal_mem)
                                                                            @if ($proposal_mem->member_type !== null)
                                                                            @php($count++)


                                                                            <tr>
                                                                            <td class="pr-4 pt-2">
                                                                                <select name="member[{{ $count }}][id]" class="rounded-md xl:text-xs w-full border-zinc-400" id="member" required>
                                                                                    @foreach ($members as $id => $participation_name )
                                                                                        <option value="{{ $id }}"
                                                                                            @if ($proposal_mem->member_type != null ? $proposal_mem->user_id == $id : '')
                                                                                            selected="selected"
                                                                                            @endif>
                                                                                            {{ $participation_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>

                                                                            <td class="pr-4 pt-2">

                                                                                <select name="member[{{ $count }}][type]" class="rounded-md xl:text-xs w-full border-zinc-400">
                                                                                    @foreach ($parts_names as $id => $name ) <option value="{{ $name }}"

                                                                                        @if ($proposal_mem->member_type != null ? $proposal_mem->member_type == $name : '')
                                                                                        selected="selected"
                                                                                        @endif
                                                                                        >
                                                                                        {{ $name }}
                                                                                    @endforeach
                                                                                </option>
                                                                            </select>
                                                                            </td>

                                                                            <td>
                                                                                <button type="button" class="bg-red-500 remove-table-row text-xs text-white px-2 py-1 rounded">Remove</button>
                                                                            </td>
                                                                        </tr>
                                                                            @endif
                                                                            @endforeach

                                                                    </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="flex items-center p-6 space-x-2 border-gray-200 rounded-b dark:border-gray-600">
                                                            <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                                                            <button @click="showModal = false"  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="border-blue-600 bg-white border px-2 py-2 rounded-xl text-blue-600 text-xs  2xl:text-xs  flex"
                                        href={{ url('download', $proposal->id) }}>
                                        <svg class="fill-blue-600 mr-1" xmlns="http://www.w3.org/2000/svg" height="15"
                                            viewBox="0 96 960 960" width="20">
                                            <path
                                                d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z" />
                                        </svg>
                                        Download Proposal
                                    </a>

                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = true">

                                        <!-- Trigger for Modal -->
                                        <button class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 2xl:text-xs text-xs space-x-2 flex" type="button" @click="showModal = true">
                                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 32 32"><path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z"/><path fill="currentColor" d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z"/></svg>
                                             Delete this Proposal
                                        </button>

                                        <!-- Modal -->

                                        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40" x-show="showModal" >

                                            <!-- Modal inner -->
                                            <div class="w-1/4  text-left bg-gray-700 rounded-lg shadow-lg" x-show="showModal"
                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                                <!-- Title / Close-->
                                                <div class="flex items-center justify-end px-4 rounded-tl rounded-tr py-4 pb-2 ">

                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="showModal = false">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                    </button>

                                                </div>


                                                <!-- content -->
                                                <div class="p-6 pt-2 space-y-4 flex-col flex items-center justify-center">
                                                    <div class="flex flex-col space-y-2">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-3 text-lg font-normal text-gray-400 dark:text-gray-300">Are you sure you want to delete this product?</h3>
                                                    </div>

                                                    <div class="flex space-x-4 justify-center ">

                                                    <form action={{ route('admin.proposal.admin-delete-project-proposal', $proposals->id) }} method="POST" class="">
                                                        @csrf @method('DELETE')
                                                            <button class="text-white w-full bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Yes I am sure</button>
                                                    </form>
                                                    <div>
                                                    <button @click="showModal = false" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between px-4 2xl:py-2 xl:py-1 text-lg ">
                        <button class="leftbtn-slide block xl:hidden">☰</button>
                        <div class="flex space-x-2">
                            <button>&nbsp;</button>
                            <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="YesDelete" style="display: none">Delete</button>
                            <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="selectAll" style="display: none">Select all</button>
                            <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="cancelButton" style="display: none">Cancel</button>
                        </div>

                        <button class="openbtn" onclick="openNav()">☰</button>
                    </div>

                    {{--  Media  --}}
                    <div class="overflow-x-auto h-[74vh] 2xl:h-[77vh]">
                        <div class="flex py-3 items-center flex-wrap px-2">
                            @foreach ($proposals->medias as $mediaLibrary)
                            @if ((!empty($mediaLibrary->model_id)) && (!empty($mediaLibrary->collection_name)))

                                <div data-tooltip-target="tooltip-proposal" type="button" class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:min-h-[14vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                    <x-alpine-modal>
                                        <x-slot name="scripts">
                                            <div class="flex items-center flex-col p-4 space-y-3" target="__blank">
                                                <div>
                                                    @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                                    <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'text/plain')
                                                    <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                    <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                    @else
                                                    <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                    @endif
                                                </div>

                                                <div class="text-[.7rem] text-left">
                                                @if (strlen($mediaLibrary->file_name) <= 10)
                                                <span>{{ Str::limit($mediaLibrary->file_name, 20) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                                @else
                                                <span>{{ Str::limit($mediaLibrary->file_name, 15) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                                @endif
                                                </div>
                                            </div>
                                        </x-slot>

                                        <x-slot name="title">
                                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                                        </x-slot>

                                        <div class="w-[50rem]">

                                            @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                            <div><img class="shadow w-full " src="{{  $mediaLibrary->getUrl() }}"></div>
                                            @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                            <div class="p-5 flex items-center flex-col">
                                                <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                <a href={{ url('download-media', $mediaLibrary->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                            </div>

                                            @else
                                                <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $mediaLibrary->getUrl() }}"></iframe></div>
                                            @endif
                                        </div>
                                    </x-alpine-modal>


                                    <input type="checkbox" class="hidden-checkbox absolute top-1 right-2"  style="display:none;" name="ids" value="{{ $mediaLibrary->id }}">
                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                        <!-- Modal -->
                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                            <!-- Modal inner -->
                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                <!-- Title / Close-->
                                                <div class="flex items-center justify-between px-4 py-1">
                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModal = false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <hr>

                                                <!-- content -->
                                                <div>
                                                    <form action="{{route('inventory-rename-media', $mediaLibrary->id)}}" method="POST">
                                                        @csrf @method('PUT')
                                                        <div class="flex flex-col items-center pt-5 px-4">
                                                        <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class=" w-full rounded">
                                                        <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-white">Rename</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                            <!-- Dropdown toggle button -->
                                            <button @click="dropdownMenu = ! dropdownMenu" class="tooltipButton  flex items-center p-2 rounded-md" style="display: block">
                                                <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                            </button>
                                            <!-- Dropdown list -->
                                            <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">


                                                <button class="text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                 <button class="deleteAllButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit" id="deleteAllButton">Delete</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <x-messages />




        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Get the toggle all button
                var toggleAllButton = document.getElementById('selectAll');

                var deleteSelectedButton = document.getElementById('YesDelete');

                // Get all checkboxes inside the foreach loop
                var checkboxes = document.querySelectorAll('.hidden-checkbox');

                // Add click event listener to the toggle all button
                toggleAllButton.addEventListener('click', function () {
                    // Check if all checkboxes are checked

                    var allChecked = Array.from(checkboxes).every(function (checkbox) {
                        return checkbox.checked;
                    });

                    // If all checkboxes are checked, reset all checkboxes; otherwise, check all checkboxes
                    checkboxes.forEach(function (checkbox) {
                        checkbox.checked = !allChecked;
                    });
                });


                deleteSelectedButton.addEventListener('click', function () {
                    // Filter out the checked checkboxes
                    var checkedCheckboxes = Array.from(document.querySelectorAll('.hidden-checkbox:checked'));

                    // Create an array to store the IDs of checked checkboxes
                    var all_ids = checkedCheckboxes.map(function (checkbox) {
                        return checkbox.value;
                    });


                    if (all_ids.length > 0 ) {
                        // Perform deletion logic for the checked checkboxes
                        if (confirm('Are you sure you want to delete?')) {

                            $.ajax({
                                url: "{{ route('admin.proposal.delete-media-proposal') }}",
                                type: "DELETE",
                                data: {
                                    ids: all_ids,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function (response) {
                                    checkedCheckboxes.forEach(function (checkbox) {
                                        // Replace 'proposal_id' with the appropriate ID prefix
                                        $('#proposal_id' + checkbox.value).remove();
                                    });
                                    if (response.success) {
                                        toastr.success(response.success);
                                        // Additional logic if needed
                                    } else if (response.error) {
                                        toastr.error(response.error);
                                        // Additional error handling logic
                                    }
                                },
                                error: function (error) {
                                    console.log(error);
                                    toastr.error('Error in AJAX request');
                                }
                            });
                        };


                    } else {
                        toastr.warning('No checkboxes are selected for deletion.');
                    }

                });


            });

            document.addEventListener('DOMContentLoaded', function () {
                // Get the delete all button
                var deleteAllButton = document.querySelectorAll('.deleteAllButton');

                deleteAllButton.forEach(function (button) {

                    button.addEventListener('click', function () {

                        var hiddenCheckboxes = document.querySelectorAll('.hidden-checkbox');
                        var tooltipButton = document.querySelectorAll('.tooltipButton');
                        document.getElementById("cancelButton").style.display = "block";
                        document.getElementById("YesDelete").style.display = "block";
                        document.getElementById("selectAll").style.display = "block";

                        hiddenCheckboxes.forEach(function (checkbox) {
                            if (checkbox.style.display === 'none' || checkbox.style.display === '') {
                                checkbox.style.display = 'block';
                            } else {
                                checkbox.style.display = 'none';
                            }
                        });

                        tooltipButton.forEach(function (button) {
                            if (button.style.display === 'block' ) {
                                button.style.display = 'none';
                            } else {
                                button.style.display = 'block';
                            }
                        });
                    });
                });

                var cancelButton = document.getElementById('cancelButton');

                cancelButton.addEventListener('click', function () {

                    var hiddenCheckbox = document.querySelectorAll('.hidden-checkbox');
                    var tooltipButtons = document.querySelectorAll('.tooltipButton');

                    hiddenCheckbox.forEach(function (checkbox) {
                        if (checkbox.style.display === 'block' ) {
                            checkbox.style.display = 'none';
                        } else {
                            checkbox.style.display = 'block';
                        }
                    });

                    cancelButton.style.display = "none";
                    document.getElementById("YesDelete").style.display = "none";
                    document.getElementById("selectAll").style.display = "none";

                    tooltipButtons.forEach(function (button) {
                        if (button.style.display === 'none' ) {
                            button.style.display = 'block';
                        } else {
                            button.style.display = 'none';
                        }
                    });

                });


            });




                let leftbutton = document.querySelector(".leftbtn-slide")
                let leftsidebar = document.querySelector(".proposal-sidebar")
                let leftclosebutton = document.querySelector(".leftclose-button")

                leftbutton.addEventListener('click',() => {
                    leftsidebar.classList.toggle('active');
                });

                leftclosebutton.addEventListener('click',() => {
                    leftsidebar.classList.remove('active');
                });

                function openNav() {
                    document.getElementById("mySidebar").style.width = "100%";
                    document.getElementById("subSidebar").style.width = "15rem";
                    document.getElementById("sidebar-title").style.display= "inline-block";
                }

                function closeNav() {
                    document.getElementById("mySidebar").style.width = "0";
                    document.getElementById("subSidebar").style.width = "0";
                    document.getElementById("sidebar-title").style.display= "none";
                }

            $(document).ready(function() {
                $('#myDropdown').on('change', function() {
                    var selectedValue = $(this).val();

                    $.ajax({
                        url: '/api/update-data/{{ $proposals->id }}',
                        method: 'POST',
                        data: {
                            selected_value: selectedValue,
                            _token: '{{ csrf_token() }}' // Add CSRF token for security
                        },

                        success: function(response) {
                           window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });

            document.addEventListener('FilePond:loaded',(e) => {
                console.log('FilePond is for use', e.detail);
                const inputElements = document.querySelectorAll('input.filepond');

                Array.from(inputElements).forEach(inputElement => {
                    const filepond = FilePond.create(inputElement);
                })

                FilePond.setOptions({
                    credits: false,
                    server: {
                        process: '/api/filepond/{{ $proposals->id }}',
                        revert: '/api/revert/{{ $mediaLibrary->id }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }

                    }
                });
            });


            $('input[type=file]').change(function() {
                if ($('input[type=files]').val() == '') {
                    $('button').attr('disabled', true)
                } else {
                    $('button').attr('disabled', false);
                }
            })



                var count = {{ $count }};


                $(document).on('click', '.remove-table-row', function(){
                    count--;
                    $(this).parents('tr').remove();

                });


                $('#add').click(function(){
                    count++;
                    addDivAndSetSelectName(count);
                });


                function addDivAndSetSelectName(index){

                    $('#table').append(
                        `<tr>
                            <td class="pr-4 pt-2">
                                <select name="member[`+index+`][id]" class="rounded-md xl:text-xs w-full border-zinc-400" id="member" required >
                                    @foreach ($members as $id => $name )
                                    <option value="{{ $id }}"
                                    >{{ $name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="pr-4 pt-2">
                                <select  name="member[`+index+`][type]" class="rounded-md xl:text-xs w-full border-zinc-400" required >
                                    @foreach ($parts_names as $id => $name )
                                    <option value="{{ $name }}"
                                    @if ($id == old('parts_names_id'))
                                        selected="selected"
                                    @endif
                                    >{{ $name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="pr-2">
                                <button type="button" class="bg-red-500 remove-table-row text-xs text-white px-2 py-1 rounded">Remove</button>
                            </td>
                        </tr>`
                    );
                }


        </script>

    </x-admin-layout>


