
    <style>
        [x-cloak] { display: none }
        form button:disabled,
        form button[disabled] {
            border: 1px solid #999999;
            background-color: #cccccc;
            color: #666666;
        }


        #style-2::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            width: .8rem;
            border-radius: 10px;

        }

        #style-2::-webkit-scrollbar
        {
            width: .8rem;
            border-radius: 10px;
            background-color: rgb(55 65 81);
        }

        #style-2::-webkit-scrollbar-thumb
        {
            width: .8rem;
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #7d8086;
        }
    </style>

    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <?php flash()->addError($error); ?>
    @endforeach
    @endif

    <x-admin-layout>

        <section class="bg-white shadow rounded-xl m-8 mt-4 2xl:mt-5 h-[82vh] 2xl:min-h-[87vh] text-gray-600 overflow-hidden">


            <div class="flex justify-between p-2 2xl:p-3 bg-blue-500 rounded-tl rounded-tr ">
                <div class="flex flex-col sm:flex-row sm:space-x-8 font-medium text-white">
                    <h1 class="text-[.7rem] xl:text-sm tracking-wider">Created:
                        {{ \Carbon\Carbon::parse($proposals->created_at)->format('F-d-Y') }}</h1>
                    <h1 class="text-[.7rem] xl:text-sm tracking-wider">Status: {{ $proposals->authorize }}</h1>
                    <h1 class="text-[.7rem] xl:text-sm tracking-wider">Program/Project ID: {{ $proposals->id }}</h1>

                </div>
                <a class="text-black text-white text-xl focus:bg-red-500 focus:text-white hover:bg-red-400 font-medium  px-2 py-2 rounded" href={{ route('admin.dashboard.index') }}>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </a>
            </div>
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
                        <div class="flex   justify-between">
                            <h1 class="text-base font-medium tracking-wide">Summary:</h1>
                            <button data-modal-target="modal-show-all-summary" data-modal-toggle="modal-show-all-summary" class="px-2 py-1 bg-white border border-gray-600 rounded  text-gray-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-gray-600 hover:text-white" type="button">
                                {{--  <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17"
                                    height="17" viewBox="0 0 16 16">
                                    <g fill="currentColor">
                                        <path
                                            d="m5.369 7.92l2.14-2.14v5.752h1v-5.68l2.066 2.067l.707-.707l-2.957-2.956h-.707L4.662 7.212l.707.707Z" />
                                        <path
                                            d="M14 8A6 6 0 1 1 2 8a6 6 0 0 1 12 0Zm-1 0A5 5 0 1 0 3 8a5 5 0 0 0 10 0Z" />
                                    </g>
                                </svg>  --}}
                                Show All
                            </button>
                            <!-- Modal Upload modal documents -->
                            <div id="modal-show-all-summary" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-4xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Program/Project Details
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-show-all-summary">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->

                                        <div class="p-4">
                                            <h1 class="text-white text-base mb-2 tracking-wider">Details</h1>

                                            <div class="space-y-2">
                                                <p class="text-xs text-white tracking-wider">
                                                Created at:  {{ \Carbon\Carbon::parse($proposals->created_at)->format('M d, y g:i:s A') }}
                                                </p>
                                                <p class="text-xs text-white tracking-wider">
                                                Last Modified:  {{ \Carbon\Carbon::parse($proposals->updated_at)->format('M d, y g:i:s A') }}
                                                </p>
                                                <p class="text-xs text-white tracking-wider">
                                                Program/Project ID: {{ $proposals->id }}
                                                </p>
                                                <p class="text-xs text-white tracking-wider">
                                                Project Title: {{ $proposals->project_title }}
                                                </p>

                                                <p class="text-xs text-white tracking-wider">
                                                Status: {{ $proposals->authorize }}
                                                </p>

                                                <p class="text-xs text-white tracking-wider">
                                                Uploader: {{ $proposals->user->name }}
                                                </p>
                                                <p class="text-xs text-white tracking-wider">
                                                Started date: {{ $proposals->started_date == null ? 'No date' :  $proposals->started_date->format('M. d, Y') }}
                                                </p>
                                                <p class="text-xs text-white tracking-wider">
                                                Finished date: {{ $proposals->finished_date == null ? 'No date' :  $proposals->finished_date->format('M. d, Y') }}
                                                </p>
                                                <p class="text-xs text-white tracking-wide">
                                                    Total of Users: {{ $proposals->proposal_members->count() }}
                                                </p>
                                            </div>
                                            <div class="h-[40vh] 2xl:h-[50vh] overflow-auto">
                                            <div class="mt-4 flex space-x-1 sticky top-0 z-10 bg-gray-700">

                                                <h1 class="text-white text-base my-5 tracking-wider">Project Users</h1>
                                                <button data-tooltip-target="tooltip-right" data-tooltip-placement="right" type="button" class="text-center text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" opacity=".5"/><path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M10.125 8.875a1.875 1.875 0 1 1 2.828 1.615c-.475.281-.953.708-.953 1.26V13"/><circle cx="12" cy="16" r="1" fill="currentColor"/></g></svg>
                                                </button>


                                                    <div id="tooltip-right" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-white rounded-lg shadow-sm opacity-0 tooltip ">

                                                        <div class="flex flex-col space-y-2 text-gray-700">
                                                            <div class="text-xs tracking-wider flex space-x-2 items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#15c160" d="m10.562 14.492l-2.497-2.496q-.14-.14-.344-.15q-.204-.01-.363.15q-.16.16-.16.354t.16.354l2.638 2.638q.242.243.566.243q.323 0 .565-.243l5.477-5.477q.14-.14.15-.344q.01-.204-.15-.363q-.16-.16-.354-.16t-.354.16zM12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924q-1.216-1.214-1.925-2.856Q3 13.87 3 12.003q0-1.866.708-3.51q.709-1.643 1.924-2.859q1.214-1.216 2.856-1.925Q10.13 3 11.997 3q1.866 0 3.51.708q1.643.709 2.859 1.924q1.216 1.214 1.925 2.856Q21 10.13 21 11.997q0 1.866-.708 3.51q-.709 1.643-1.924 2.859q-1.214 1.216-2.856 1.925Q13.87 21 12.003 21"/></svg>
                                                                <h1>Uploaded Narrative</h1>
                                                            </div>

                                                            <div class="text-xs tracking-wider flex space-x-2 items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path fill="#0091ff" d="m10.562 14.492l-2.497-2.496q-.14-.14-.344-.15q-.204-.01-.363.15q-.16.16-.16.354t.16.354l2.638 2.638q.242.243.566.243q.323 0 .565-.243l5.477-5.477q.14-.14.15-.344q.01-.204-.15-.363q-.16-.16-.354-.16t-.354.16zM12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924q-1.216-1.214-1.925-2.856Q3 13.87 3 12.003q0-1.866.708-3.51q.709-1.643 1.924-2.859q1.214-1.216 2.856-1.925Q10.13 3 11.997 3q1.866 0 3.51.708q1.643.709 2.859 1.924q1.216 1.214 1.925 2.856Q21 10.13 21 11.997q0 1.866-.708 3.51q-.709 1.643-1.924 2.859q-1.214 1.216-2.856 1.925Q13.87 21 12.003 21"/></svg>
                                                                <h1>Uploaded Terminal</h1>
                                                            </div>

                                                        </div>

                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                            </div>



                                            <div class="space-y-3">
                                                <div class="flex flex-row">
                                                    <div>
                                                        <p class="xl:text-[.7rem] text-[.6rem] text-white tracking-wider">
                                                            Project Leader:

                                                            @foreach ($proposals->proposal_members as $proposal_mem)
                                                            @if ($proposal_mem->leader_member_type !== null)

                                                                {{ $proposal_mem->leader_member_type != null ? $proposal_mem->user->name : 'None' }}
                                                            @endif
                                                            @endforeach
                                                        </p>
                                                        <p class="xl:text-[.7rem] text-[.6rem] text-white tracking-wider">
                                                            Leader Role:
                                                            @foreach ($proposals->proposal_members as $proposal_mem)
                                                            @if ($proposal_mem->leader_member_type !== null)
                                                            {{ $proposal_mem->leader_member_type != null ? $proposal_mem->ceso_role->role_name : 'None' }}
                                                            @endif
                                                            @endforeach
                                                        </p>
                                                        <p class="xl:text-[.7rem] text-[.6rem] text-white tracking-wider">
                                                            Leader Location:
                                                            @foreach ($proposals->proposal_members as $proposal_mem)
                                                            @if ($proposal_mem->location_id !== null)
                                                                {{ $proposal_mem->location_id != null ? $proposal_mem->locations->location_name : 'None' }}
                                                            @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <p class="text-xs text-white tracking-wide flex flex-col justify-center items-center">
                                                        <span class="flex flex-col  ml-1">
                                                            @foreach ($proposals->proposal_members as $proposal_mem)
                                                            @foreach ($proposals->narrativereport as $narrative)
                                                            @if ( $proposal_mem->leader_member_type !== null && $narrative->user_id == $proposal_mem->user_id)
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#15c160" d="m10.562 14.492l-2.497-2.496q-.14-.14-.344-.15q-.204-.01-.363.15q-.16.16-.16.354t.16.354l2.638 2.638q.242.243.566.243q.323 0 .565-.243l5.477-5.477q.14-.14.15-.344q.01-.204-.15-.363q-.16-.16-.354-.16t-.354.16zM12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924q-1.216-1.214-1.925-2.856Q3 13.87 3 12.003q0-1.866.708-3.51q.709-1.643 1.924-2.859q1.214-1.216 2.856-1.925Q10.13 3 11.997 3q1.866 0 3.51.708q1.643.709 2.859 1.924q1.216 1.214 1.925 2.856Q21 10.13 21 11.997q0 1.866-.708 3.51q-.709 1.643-1.924 2.859q-1.214 1.216-2.856 1.925Q13.87 21 12.003 21"/></svg>
                                                            @endif
                                                            @endforeach
                                                            @endforeach
                                                        </span>
                                                        <span class="flex flex-col  ml-1">
                                                            @foreach ($proposals->proposal_members as $proposal_mem)
                                                            @foreach ($proposals->terminalreport as $terminal)
                                                            @if ( $proposal_mem->leader_member_type !== null && $terminal->user_id == $proposal_mem->user_id)
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#0091ff" d="m10.562 14.492l-2.497-2.496q-.14-.14-.344-.15q-.204-.01-.363.15q-.16.16-.16.354t.16.354l2.638 2.638q.242.243.566.243q.323 0 .565-.243l5.477-5.477q.14-.14.15-.344q.01-.204-.15-.363q-.16-.16-.354-.16t-.354.16zM12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924q-1.216-1.214-1.925-2.856Q3 13.87 3 12.003q0-1.866.708-3.51q.709-1.643 1.924-2.859q1.214-1.216 2.856-1.925Q10.13 3 11.997 3q1.866 0 3.51.708q1.643.709 2.859 1.924q1.216 1.214 1.925 2.856Q21 10.13 21 11.997q0 1.866-.708 3.51q-.709 1.643-1.924 2.859q-1.214 1.216-2.856 1.925Q13.87 21 12.003 21"/></svg>
                                                            @endif
                                                            @endforeach
                                                            @endforeach
                                                        </span>
                                                    </p>
                                                </div>

                                                <div class="flex flex-col space-y-4">

                                                        @foreach ($proposals->proposal_members as $proposal_mem)
                                                           @if ($proposal_mem->member_type !== null)

                                                                <div class="flex space-x-2">
                                                                    <div>
                                                                        <div class="flex space-x-2">
                                                                            <h1 class="xl:text-[.7rem] text-[.6rem] text-white tracking-wider"> Member Name:</h1>
                                                                            <span class="font-light 2xl:text-xs xl:text-[.7rem] text-[.7rem] text-white tracking-wider">{{ $proposal_mem->member_type !== null ? $proposal_mem->user->name : '' }}</span>
                                                                        </div>
                                                                        <div class="flex space-x-2">
                                                                            <h1 class="xl:text-[.7rem] text-[.6rem] text-white tracking-wider"> Member Type:</h1>
                                                                            <span class="font-light 2xl:text-xs  xl:text-[.7rem] text-[.7rem] text-white tracking-wider">{{ $proposal_mem->member_type }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex flex-col">
                                                                        @foreach ($proposals->narrativereport as $narrative)
                                                                        @if ($narrative->user_id == $proposal_mem->user_id)
                                                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#15c160" d="m10.562 14.492l-2.497-2.496q-.14-.14-.344-.15q-.204-.01-.363.15q-.16.16-.16.354t.16.354l2.638 2.638q.242.243.566.243q.323 0 .565-.243l5.477-5.477q.14-.14.15-.344q.01-.204-.15-.363q-.16-.16-.354-.16t-.354.16zM12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924q-1.216-1.214-1.925-2.856Q3 13.87 3 12.003q0-1.866.708-3.51q.709-1.643 1.924-2.859q1.214-1.216 2.856-1.925Q10.13 3 11.997 3q1.866 0 3.51.708q1.643.709 2.859 1.924q1.216 1.214 1.925 2.856Q21 10.13 21 11.997q0 1.866-.708 3.51q-.709 1.643-1.924 2.859q-1.214 1.216-2.856 1.925Q13.87 21 12.003 21"/></svg>
                                                                        @endif
                                                                        @endforeach

                                                                        @foreach ($proposals->terminalreport as $terminal)
                                                                        @if ($terminal->user_id == $proposal_mem->user_id)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#0091ff" d="m10.562 14.492l-2.497-2.496q-.14-.14-.344-.15q-.204-.01-.363.15q-.16.16-.16.354t.16.354l2.638 2.638q.242.243.566.243q.323 0 .565-.243l5.477-5.477q.14-.14.15-.344q.01-.204-.15-.363q-.16-.16-.354-.16t-.354.16zM12.003 21q-1.866 0-3.51-.708q-1.643-.709-2.859-1.924q-1.216-1.214-1.925-2.856Q3 13.87 3 12.003q0-1.866.708-3.51q.709-1.643 1.924-2.859q1.214-1.216 2.856-1.925Q10.13 3 11.997 3q1.866 0 3.51.708q1.643.709 2.859 1.924q1.216 1.214 1.925 2.856Q21 10.13 21 11.997q0 1.866-.708 3.51q-.709 1.643-1.924 2.859q-1.214 1.216-2.856 1.925Q13.87 21 12.003 21"/></svg>
                                                                        @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                </div>
                                            </div>
                                        </div>


                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="w-full">
                            <div class="w-full">
                                <label class="block text-gray-700 text-[.7rem] font-semibold xl:text-[.7rem]"> Project Title:</label>
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
                                <label class="block text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem]">Started Date:</label>
                                <h1 class="xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                {{ \Carbon\Carbon::parse($proposals->started_date)->format('F-d-Y') }}</h1>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="w-full">
                                <label class="block text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem]">Ended Date:</label>
                                <h1 class="xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full  text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                {{ \Carbon\Carbon::parse($proposals->finished_date)->format('F-d-Y') }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="flex 2xl:space-x-3 xl:space-y-3 xl:mb-2 2xl:space-y-0  xl:flex-col 2xl:flex-row">
                        <div class="w-full">
                            <label class="block text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem]">Project Leader</label>
                            @foreach ($proposals->proposal_members as $proposal_mem)
                                <h1 class=" xl:text-[.7rem] text-[.7rem] appearance-none rounded w-full  text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    {{ $proposal_mem->leader_member_type != null ? $proposal_mem->user->name : '' }}
                                </h1>
                            @endforeach
                        </div>
                    </div>


                    <div class="mb-2 mt-5 xl:mt-0 w-full overflow-x-auto h-[15vh] 2xl:h-[20vh]">
                        <div class="w-full sticky top-0 z-10 bg-gray-100 xl:bg-white">
                        <label class="text-gray-700 font-semibold xl:text-[.7rem] text-[.7rem] ">Project Member(s)</label>
                        </div>

                        @foreach ($proposals->proposal_members as $proposal_mem)

                                @if ($proposal_mem->member_type !== null)
                                    <div class="pb-2">
                                        <div>
                                            <h1 class="xl:text-[.7rem] text-[.6rem] font-medium text-gray-700 tracking-wider"> Name:</h1>
                                            <span class="font-light 2xl:text-xs xl:text-[.7rem] text-[.7rem]">{{ $proposal_mem->member_type !== null ? $proposal_mem->user->name : '' }}</span>
                                        </div>
                                        <div>
                                            <h1 class="xl:text-[.7rem] text-[.6rem] font-medium text-gray-700 tracking-wider"> Type:</h1>
                                            <span class="font-light 2xl:text-xs  xl:text-[.7rem] text-[.7rem]">{{ $proposal_mem->member_type }}</span>
                                        </div>
                                    </div>
                                @endif

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

                    <!-- Modal Upload modal documents -->
                    <div id="modal-upload-documents" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Upload Documents
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-upload-documents">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action={{ route('admin.dashboard-update-user-proposal', $proposals->id) }} method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                <div class="p-4 md:p-5">
                                    <p class="text-sm leading-relaxed text-white tracking-wider">
                                        Note: Choose what is applicable
                                    </p>

                                        <div class="py-1 mt-5 grid grid-cols-2 gap-3 text-white">
                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Proposal
                                                    (PDF)</label>
                                                <input type="file" class="border text-xs" name="proposal_pdf">
                                                @error('proposal_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Special Order
                                                    (PDF)</label>
                                                <input type="file" class="border text-xs" name="special_order_pdf">
                                                @error('special_order_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Memorandum of Agreement
                                                    (PDF)</label>
                                                <input type="file" class="border text-xs" name="moa_pdf">
                                                @error('moa_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>


                                            <div class="flex flex-col  mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Travel order
                                                    (PDF)</label>
                                                <input type="file"  class="border text-xs" name="travel_order">
                                                @error('travel_order')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="flex flex-col  mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Office order
                                                    (PDF)</label>
                                                <input type="file"  class="border text-xs" name="office_order">
                                                @error('office_order')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Upload Other Files <span class="text-xs">(Multiple Files)</span></label>
                                                <input class="border text-xs "  type="file" multiple name="other_files[]" onchange="displayFileNames(this)">
                                                <div id="file-names-container" class="text-xs mt-1"></div>
                                                @error('other_files')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>
                                        </div>

                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button id="upload-file" disabled type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit here</button>
                                    <button data-modal-hide="modal-upload-documents" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit Project details -->
                    <div id="modal-edit-project-details" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4  border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Edit Project Details <span class="text-xs text-red-400">(*)required</span>
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-edit-project-details">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action={{ route('admin.dashboard.update-project-details', $proposal->id ) }} method="POST" id="myForm">
                                    @csrf @method('PUT')
                                    <div class="p-4 md:p-5">
                                        <div class="flex 2xl:space-y-4 space-x-4 2xl:space-x-0 flex-row 2xl:flex-col">
                                            <div class="w-full">
                                                <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs" for="program_id">Program Name <span class="text-red-500">*</span></label>
                                                <select id="program_id" class="rounded-md xl:text-xs w-full border-zinc-400  py-2 px-3" name="program_id" value="{{ old('program_id') }}" required>
                                                    @foreach ($program as $id => $program_name ) <option value="{{ $id }}" @if ($id == $proposal->program_id) selected="selected" @endif >{{ $program_name }}</option> @endforeach
                                                </select>
                                                @error('program_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="w-full">
                                                <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs" for="project_title">Project Title <span class="text-red-500">*</span></label>
                                                <input class="border-zinc-400 xl:text-xs shadow appearance-none border rounded w-full  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="project_title" id="project_title" type="text" value="{{ $proposal->project_title }}" placeholder="project title" required>
                                                @error('project_title') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>

                                        <div class="flex space-y-2 flex-col mt-3">

                                            <div class="flex space-x-4 w-full" >
                                                <div class="w-full">
                                                    <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Started Date</label>
                                                    <input class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposal->started_date }}" name="started_date" id="started_date" type="datetime-local">
                                                    @error('started_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="w-full">
                                                    <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Ended Date</label>
                                                    <input class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposal->finished_date }}" name="finished_date" id="finished_date" type="datetime-local">
                                                    @error('finished_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="flex space-x-4 w-full">

                                                <div class="w-full">
                                                    <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Project leader</label>
                                                    <select name="leader_id" class="rounded-md xl:text-xs w-full  border-zinc-400" value="{{ old('leader') }}" id="leader_id">
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
                                                    <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Role of Project Leader</label>
                                                    <select id="leader_member_type" name="leader_member_type" value="{{ old('leader_member_type') }}" class="rounded-md xl:text-xs w-full border-zinc-400">
                                                        <option value="">Select Role</option>
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
                                                    <div id="error-leader_member_type" style="color: red;"></div>

                                                </div>

                                                <div class="w-full">
                                                    <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Location</label>
                                                    <select id="location_id" type="text"  class="rounded-md xl:text-xs w-full border-zinc-400" name="location_id" value="{{ old('location_id') }}">
                                                        <option value="">Select Location</option>
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
                                                    <div id="error-location_id" style="color: red;"></div>

                                                </div>
                                            </div>

                                            <div class="mt-4 w-full h-[24vh] 2xl:h-[20vh] overflow-x-auto">

                                                <div class="sticky top-0 bg-gray-700 w-full">
                                                    <button name="add" id="add" type="button" class="bg-slate-500 rounded text-white px-2 py-1  text-sm xl:text-xs border-zinc-400">Add Member</button>
                                                </div>

                                                <table id="table" class="w-full">
                                                    <thead class="sticky top-6 bg-gray-700">
                                                    <tr class="text-sm text-gray-500">
                                                        <th class="xl:text-xs  text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Member Name</th>
                                                        <th class="xl:text-xs  text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Member Type</th>
                                                        <th class="xl:text-xs  text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Action</th>
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
                                                                <option value="">Select Username</option>
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
                                                                <option value="">Select Type</option>
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
                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Update</button>
                                    <button data-modal-hide="modal-edit-project-details" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete Project  -->
                    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this project?</h3>
                                    <div class="flex space-x-2 items-center justify-center">
                                        <form action={{ route('admin.proposal.admin-delete-project-proposal', $proposals->id) }} method="POST" class="">
                                            @csrf @method('DELETE')
                                                <button class="text-white w-full bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Yes I’m sure</button>
                                        </form>

                                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Track documents -->
                    <div id="modal-track-documents" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Track Project Documents
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-track-documents">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->

                            <div class="relative p-4 w-full max-h-full">
                                <div class="p-4 md:p-5 h-[50vh] overflow-x-auto scrollbar" id="style-2">
                                    <ul class="relative border-l  border-gray-500  ms-3.5 mb-4 md:mb-5">
                                        @foreach ($formedia->medias as $mediaLibrary)
                                        @if (!empty($mediaLibrary->collection_name == 'proposalPdf'))

                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Proposal File
                                                @foreach ($latest->medias as $media )
                                                @if ($media->collection_name == $mediaLibrary->collection_name)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">Latest</span>
                                                @endif
                                                @endforeach
                                            </h3>
                                            <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</time>
                                            <a href={{ route('inventory-download-proposalPdf', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>
                                        @elseif (!empty($mediaLibrary->collection_name == 'MoaPDF'))
                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">MOA File
                                                @foreach ($latest->medias as $media )
                                                @if ($media->collection_name == $mediaLibrary->collection_name)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">Latest</span>
                                                @endif
                                                @endforeach
                                            </h3>
                                            <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</time>
                                            <a href={{ route('inventory-download-moa', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>
                                        @elseif (!empty($mediaLibrary->collection_name == 'specialOrderPdf'))
                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Special Order File
                                                @foreach ($latest->medias as $media )
                                                @if ($media->collection_name == $mediaLibrary->collection_name)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">Latest</span>
                                                @endif
                                                @endforeach
                                            </h3>
                                            <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</time>
                                            <a href={{ route('inventory-download-specialPdf', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>
                                        @elseif (!empty($mediaLibrary->collection_name == 'travelOrder'))
                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Travel Order File
                                                @foreach ($latest->medias as $media )
                                                @if ($media->collection_name == $mediaLibrary->collection_name)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">Latest</span>
                                                @endif
                                                @endforeach
                                            </h3>
                                            <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</time>
                                            <a href={{ route('inventory-download-travelPdf', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>
                                        @elseif (!empty($mediaLibrary->collection_name == 'officeOrder'))
                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>

                                            <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Office Order  File
                                                @foreach ($latest->medias as $media )
                                                @if ($media->collection_name == $mediaLibrary->collection_name)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">Latest</span>
                                                @endif
                                                @endforeach

                                            </h3>
                                            <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</time>
                                            <a href={{ route('inventory-download-officePdf', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>
                                        @elseif (!empty($mediaLibrary->collection_name == 'otherFile'))
                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Other File(s)
                                                @foreach ($latest->medias as $media )
                                                @if ($media->collection_name == $mediaLibrary->collection_name)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-3">Latest</span>
                                                @endif
                                                @endforeach
                                            </h3>
                                            <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</time>
                                            <a href={{ route('inventory-download-otherfile', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach



                                        @foreach ($formedia->narrativereport as $narrative)
                                            @foreach ($narrative->medias as $mediaLibrary )
                                                @if (!empty($mediaLibrary->collection_name == 'NarrativeFile'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Narrative Report File <span class="text-xs font-normal ml-2 mt-1">( <span class="text-sm font-medium">{{ $narrativeCount }} / {{ $memberCount }}</span> ) User has been uploaded</span></h3>
                                                    <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</time>
                                                    <a href={{ route('inventory-download-narrative', $formedia->id) }} type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>
                                                @endif
                                            @endforeach
                                        @endforeach

                                        @foreach ($formedia->terminalreport as $terminal)
                                            @foreach ($terminal->medias as $mediaLibrary )
                                                @if (!empty($mediaLibrary->collection_name == 'TerminalFile'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Terminal Report File <span class="text-xs font-normal ml-2 mt-1">( <span class="text-sm font-medium">{{ $terminalCount }} / {{ $memberCount }}</span> ) User has been uploaded</span></h3>
                                                    <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }} </time>
                                                    <a href={{ route('inventory-download-terminal', $formedia->id) }}  class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- Left side bar with the Buttons -->
                    <div class="bg-gray-100 h-full absolute z-30 right-0 bg-opacity-40 flex items-end justify-end transition-all" id="mySidebar">
                        <div class="h-full w-[0rem] bg-gray-700 transition-all" id="subSidebar">
                            <div class="p-4 w-full h-full transition-all" style="display: none" id="sidebar-title">
                                <div class="flex justify-between text-white">
                                    <h1 class="tracking-wider">Options</h1>
                                    <a href="javascript:void(0)" class="closebtn text-2xl" onclick="closeNav()">×</a>
                                </div>

                                <div class="p-3 space-y-2 flex justify-start flex-col">

                                    <!-- Modal toggle -->
                                    <button data-modal-target="modal-upload-documents" data-modal-toggle="modal-upload-documents" class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17"
                                            height="17" viewBox="0 0 16 16">
                                            <g fill="currentColor">
                                                <path
                                                    d="m5.369 7.92l2.14-2.14v5.752h1v-5.68l2.066 2.067l.707-.707l-2.957-2.956h-.707L4.662 7.212l.707.707Z" />
                                                <path
                                                    d="M14 8A6 6 0 1 1 2 8a6 6 0 0 1 12 0Zm-1 0A5 5 0 1 0 3 8a5 5 0 0 0 10 0Z" />
                                            </g>
                                        </svg>
                                        Upload Documents
                                    </button>
                                    <button data-modal-target="modal-edit-project-details" data-modal-toggle="modal-edit-project-details" class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17"
                                            height="17" viewBox="0 0 16 16">
                                            <g fill="currentColor">
                                                <path
                                                    d="m5.369 7.92l2.14-2.14v5.752h1v-5.68l2.066 2.067l.707-.707l-2.957-2.956h-.707L4.662 7.212l.707.707Z" />
                                                <path
                                                    d="M14 8A6 6 0 1 1 2 8a6 6 0 0 1 12 0Zm-1 0A5 5 0 1 0 3 8a5 5 0 0 0 10 0Z" />
                                            </g>
                                        </svg>
                                        Edit Project Details
                                    </button>
                                    <a class="border-blue-600 bg-white border px-2 py-2 rounded-xl text-blue-600 text-xs  2xl:text-xs  flex hover:bg-blue-600 hover:text-white"
                                        href={{ url('download', $proposal->id) }}>
                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" height="15"
                                            viewBox="0 96 960 960" width="20">
                                            <path fill="currentColor"
                                                d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z" />
                                        </svg>
                                        Download this Project
                                    </a>
                                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="bg-white border w-full border-blue-600 rounded-xl text-blue-600 2xl:text-xs text-xs space-x-2 flex p-2 hover:bg-blue-600 hover:text-white" type="button">
                                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 32 32"><path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z"/><path fill="currentColor" d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z"/></svg>
                                             Delete this Project
                                    </button>
                                    <button data-modal-target="modal-track-documents" data-modal-toggle="modal-track-documents" class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M88 112a8 8 0 0 1 8-8h80a8 8 0 0 1 0 16H96a8 8 0 0 1-8-8m8 40h80a8 8 0 0 0 0-16H96a8 8 0 0 0 0 16m136-88v120a24 24 0 0 1-24 24H32a24 24 0 0 1-24-23.89V88a8 8 0 0 1 16 0v96a8 8 0 0 0 16 0V64a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16m-16 0H56v120a23.84 23.84 0 0 1-1.37 8H208a8 8 0 0 0 8-8Z"/></svg>
                                            Track Documents
                                    </button>
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
                            @if (!empty($mediaLibrary->model_type == 'App\Models\Proposal'))
                                <div class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                    <x-alpine-modal>
                                        <x-slot name="scripts">
                                            <div class="flex items-center flex-col p-4 space-y-3 h-full" target="__blank">
                                                <div>
                                                    @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                                    <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.4rem] w-[3rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'text/plain')
                                                    <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.4rem] w-[3rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                    <img src="{{asset('img/docx.png')}}" class="xl:w-[2.4rem] w-[3rem]" width="30">
                                                    @else
                                                    <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.4rem] w-[3rem]" width="30">
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

                                    <!-- Detail modal -->
                                    <div id="detail-project-media-modal{{ $mediaLibrary->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                            <!-- Modal content -->
                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                    <h3 class="text-xl font-semibold text-white">
                                                        Details
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-project-media-modal{{ $mediaLibrary->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-2">
                                                    <p class="text-sm leading-relaxed text-white">
                                                        Uploaded at: {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, Y g:i:s A') }}
                                                    </p>
                                                    <p class="text-sm leading-relaxed text-white">
                                                        Project Type: {{ $mediaLibrary->collection_name }}
                                                    </p>
                                                    <p class="text-sm leading-relaxed text-white">
                                                        File name: {{ $mediaLibrary->file_name }}
                                                    </p>
                                                    <p class="text-sm leading-relaxed text-white">
                                                        File size: {{ $mediaLibrary->size }} kb
                                                    </p>

                                                    <p class="text-sm leading-relaxed text-white">
                                                        File type: {{ $mediaLibrary->mime_type }}
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1">

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

                                        <div data-tooltip-target="tooltip-proposal" type="button">
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

                                                    <button data-modal-target="detail-project-media-modal{{ $mediaLibrary->id }}" data-modal-toggle="detail-project-media-modal{{ $mediaLibrary->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                    <button class="text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                    <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                    <button class="deleteAllButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit" id="deleteAllButton">Delete</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endforeach

                            @if ($proposals->narrativereport->isNotEmpty())

                                <div class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[12vh] 2xl:[h-17vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="narrativereport">

                                    <!-- Modal toggle -->
                                    <button data-modal-target="default-modal-narrative{{ $proposals->id }}" data-modal-toggle="default-modal-narrative{{ $proposals->id }}" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                        <span class="text-xs mt-4">Narrative Folder</span>
                                    </button>

                                    <!-- Main modal -->
                                    <div id="default-modal-narrative{{ $proposals->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                    <h3 class="text-xl font-semibold text-gray-600">
                                                       Narrative Folder
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-narrative{{ $proposals->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 grid grid-cols-3 gap-3">
                                                   @foreach ($proposals->narrativereport as $narrative )
                                                       @foreach ($narrative->medias as $media )

                                                       <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                            <!-- Modal toggle -->
                                                           <button data-modal-target="narrative-media-modal{{ $media->id}}" data-modal-toggle="narrative-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                    <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @elseif ($media->mime_type == 'text/plain')
                                                                    <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                    <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @else
                                                                    <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @endif
                                                                <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                           </button>
                                                            <div x-cloak  x-data="{ 'showModalNarrative{{ $media->id }}': false }" @keydown.escape="showModalNarrative{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                <!-- Modal -->
                                                                <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalNarrative{{ $media->id }}">

                                                                    <!-- Modal inner -->
                                                                    <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalNarrative{{ $media->id }}"
                                                                        x-transition:enter="motion-safe:ease-out duration-300"
                                                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalNarrative{{ $media->id }} = true">

                                                                        <!-- Title / Close-->
                                                                        <div class="flex items-center justify-between px-4 py-1">
                                                                            <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                            <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalNarrative{{ $media->id }} = false">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                        <hr>

                                                                        <!-- content -->
                                                                        <div>
                                                                            <form action="{{route('inventory-rename-media', $media->id)}}" method="POST">
                                                                                @csrf @method('PUT')
                                                                                <div class="flex flex-col items-center pt-5 px-4">
                                                                                <input type="text" value="{{ $media->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Detail modal -->
                                                                <div id="detail-narrative-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                    <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                        <!-- Modal content -->
                                                                        <div class="relative bg-gray-700 rounded-lg shadow">
                                                                            <!-- Modal header -->
                                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                <h3 class="text-xl font-semibold text-white">
                                                                                    Details
                                                                                </h3>
                                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-narrative-modal{{ $media->id }}">
                                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                                    </svg>
                                                                                    <span class="sr-only">Close modal</span>
                                                                                </button>
                                                                            </div>
                                                                            <!-- Modal body -->
                                                                            <div class="p-4 md:p-5 space-y-2">
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    Uploaded at: {{ \Carbon\Carbon::parse($media->created_at)->format('M d, y g:i:s A') }}
                                                                                </p>
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    Report Type: Narrative
                                                                                </p>
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    File name: {{ $media->file_name }}
                                                                                </p>
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    File size: {{ $media->size }} kb
                                                                                </p>

                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    File type: {{ $media->mime_type }}
                                                                                </p>

                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    Username uploader: {{ $narrative->users->name }}
                                                                                </p>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                                    <!-- Dropdown toggle button -->
                                                                    <button @click="dropdownMenu = ! dropdownMenu" class="tooltipButton  flex items-center p-2 rounded-md" style="display: block">
                                                                        <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                    </button>
                                                                    <!-- Dropdown list -->
                                                                    <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                        <button data-modal-target="detail-narrative-modal{{ $media->id }}" data-modal-toggle="detail-narrative-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                        <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalNarrative{{ $media->id }} = true">Rename</button>
                                                                        <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                        <form action={{ route('report-narrative.delete',[ 'id' => $media->id, 'narrativeId' => $narrative->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                           <div id="narrative-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-md font-semibold text-gray-600">
                                                                           {{ $media->file_name }}
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="narrative-media-modal{{ $media->id}}">
                                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                            </svg>
                                                                            <span class="sr-only">Close modal</span>
                                                                        </button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div>
                                                                        @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                        <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                        @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                        <div class="p-5 flex items-center flex-col">
                                                                            <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                            <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                        </div>

                                                                        @else
                                                                            <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       @endforeach
                                                   @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-tooltip-target="tooltip-narrativereport" type="button">
                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

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

                                                    <a href={{ route('inventory-download-narrative', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                    <form action={{ route('admin.dashboard.narrative-delete',$proposals->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($proposals->terminalreport->isNotEmpty())
                                <div class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[12vh] 2xl:[h-17vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="narrativereport">

                                    <!-- Modal toggle -->
                                    <button data-modal-target="default-modal-terminal{{ $proposals->id }}" data-modal-toggle="default-modal-terminal{{ $proposals->id }}" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                        <span class="text-xs mt-4">Terminal Folder</span>
                                    </button>

                                    <!-- Main modal -->
                                    <div id="default-modal-terminal{{ $proposals->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                    <h3 class="text-xl font-semibold text-gray-600">
                                                       Terminal Folder
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-terminal{{ $proposals->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 grid grid-cols-3 gap-3">
                                                   @foreach ($proposals->terminalreport as $terminal )
                                                       @foreach ($terminal->medias as $media )

                                                       <div class="w-full shadow rounded-lg transition-all  relative">
                                                        <!-- Modal toggle -->
                                                           <button data-modal-target="terminal-media-modal{{ $media->id}}" data-modal-toggle="terminal-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                    <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @elseif ($media->mime_type == 'text/plain')
                                                                    <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                    <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @else
                                                                    <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                @endif
                                                                <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>

                                                           </button>

                                                            <div x-cloak  x-data="{ 'showModalTerminal{{ $media->id }}': false }" @keydown.escape="showModalTerminal{{ $media->id }} = false"  x-data="{ 'showModalTerminalDetail{{ $media->id }}': false }" @keydown.escape="showModalTerminalDetail{{ $media->id }} = false" class="absolute right-0 top-1">

                                                                <!-- Modal -->
                                                                <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalTerminal{{ $media->id }}">

                                                                    <!-- Modal inner -->
                                                                    <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalTerminal{{ $media->id }}"
                                                                        x-transition:enter="motion-safe:ease-out duration-300"
                                                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalTerminal{{ $media->id }} = true">

                                                                        <!-- Title / Close-->
                                                                        <div class="flex items-center justify-between px-4 py-1">
                                                                            <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                            <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalTerminal{{ $media->id }} = false">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                        <hr>

                                                                        <!-- content -->
                                                                        <div>
                                                                            <form action="{{route('inventory-rename-media', $media->id)}}" method="POST">
                                                                                @csrf @method('PUT')
                                                                                <div class="flex flex-col items-center pt-5 px-4">
                                                                                <input type="text" value="{{ $media->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Detail modal -->
                                                                <div id="detail-terminal-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                    <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                        <!-- Modal content -->
                                                                        <div class="relative bg-gray-700 rounded-lg shadow">
                                                                            <!-- Modal header -->
                                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                <h3 class="text-xl font-semibold text-gray-600">
                                                                                    Details
                                                                                </h3>
                                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-terminal-modal{{ $media->id }}">
                                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                                    </svg>
                                                                                    <span class="sr-only">Close modal</span>
                                                                                </button>
                                                                            </div>
                                                                            <!-- Modal body -->
                                                                            <div class="p-4 md:p-5 space-y-2">
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    Uploaded at: {{ \Carbon\Carbon::parse($media->created_at)->format('M d, y g:i:s A') }}
                                                                                </p>
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    Report Type: Terminal
                                                                                </p>
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    File name: {{ $media->file_name }}
                                                                                </p>
                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    File size: {{ $media->size }} kb
                                                                                </p>

                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    File type: {{ $media->mime_type }}
                                                                                </p>

                                                                                <p class="text-sm leading-relaxed text-white">
                                                                                    Username uploader: {{ $terminal->users->name }}
                                                                                </p>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">

                                                                    <!-- Dropdown toggle button -->
                                                                    <button @click="dropdownMenu = ! dropdownMenu" class="tooltipButton  flex items-center p-2 rounded-md" style="display: block">
                                                                        <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                    </button>
                                                                    <!-- Dropdown list -->
                                                                    <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                        <!-- Modal toggle -->
                                                                        <button data-modal-target="detail-terminal-modal{{ $media->id }}" data-modal-toggle="detail-terminal-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                        <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalTerminal{{ $media->id }} = true">Rename</button>
                                                                        <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                        <form action={{ route('report-terminal.delete',[ 'id' => $media->id, 'terminalId' => $terminal->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                           <div id="terminal-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-md font-semibold text-gray-600">
                                                                           {{ $media->file_name }}
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="terminal-media-modal{{ $media->id}}">
                                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                            </svg>
                                                                            <span class="sr-only">Close modal</span>
                                                                        </button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div>
                                                                        @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                        <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                        @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                        <div class="p-5 flex items-center flex-col">
                                                                            <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                            <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                        </div>

                                                                        @else
                                                                            <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{$media->getUrl() }}"></iframe></div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       @endforeach
                                                   @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-tooltip-target="tooltip-narrativereport" type="button">

                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

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

                                                    <a href={{ route('inventory-download-terminal', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                    <form action={{ route('admin.dashboard.terminal-delete',$proposals->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </section>

        <x-messages />

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>

            document.addEventListener('DOMContentLoaded', function () {
                var leaderIdSelect = document.getElementById('leader_id');
                var leaderMemberTypeSelect = document.getElementById('leader_member_type');
                var locationIdSelect = document.getElementById('location_id');

                leaderIdSelect.addEventListener('change', function () {
                    var leaderIdValue = leaderIdSelect.value.trim();
                    var isLeaderIdFilled = leaderIdValue !== '';

                    leaderMemberTypeSelect.disabled = !isLeaderIdFilled;
                    locationIdSelect.disabled = !isLeaderIdFilled;

                    if (isLeaderIdFilled) {
                        leaderMemberTypeSelect.setAttribute('required', 'required');
                        locationIdSelect.setAttribute('required', 'required');
                    } else {
                        leaderMemberTypeSelect.removeAttribute('required');
                        locationIdSelect.removeAttribute('required');
                    }
                });
            });




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
                                    <option value="">Select Username</option>
                                    @foreach ($members as $id => $name )
                                    <option value="{{ $id }}"
                                    >{{ $name }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="pr-4 pt-2">
                                <select name="member[`+index+`][type]" class="rounded-md xl:text-xs w-full border-zinc-400" required >
                                    <option value="">Select Type</option>
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

        <script>
            function displayFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-names-container');

                // Clear the container before adding new file names
                container.innerHTML = '';

                // Display file names
                for (var i = 0; i < files.length; i++) {
                    var fileName = files[i].name;

                    // Create a paragraph element for each file name
                    var p = document.createElement('p');
                    p.textContent = fileName;

                    // Append the paragraph to the container
                    container.appendChild(p);
                }
            }


        </script>


    </x-admin-layout>


