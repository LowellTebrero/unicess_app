<x-alpine-modal>

    <x-slot name="scripts">
        <h1 class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 rounded">See details</h1>
    </x-slot>

    <x-slot name="title">
        Project Details
    </x-slot>



    <!-- content -->
    <div class="px-5 w-[50rem]">

        <div class="flex text-gray-700 mt-2 space-x-2">
            <div class="text-[.7rem] w-full">
                <label class="block font-bold mb-2" for="description">Project ID:</label>
                        <h1 class="text-[.8rem] py-2">{{ $proposal->id }}</h1>

            </div>

            <div class="text-[.7rem] w-full">
                <label class="block font-bold mb-2" for="description">Status:</label>
                <h1 class="text-[.8rem] py-2">{{ $proposal->authorize }}</h1>
            </div>
        </div>

        <div class="mb-4 w-full text-[.7rem]">
            <label class="block text-gray-700  font-bold mb-2"> Program Name:</label>

                <h1 class="text-[.8rem] py-2">{{ $proposal->programs->program_name }}</h1>
        </div>

        <div class="mb-4 text-gray-700">
            <label class="block font-bold mb-2 text-[.7rem]" for="project_title">Project
                title</label>
                <h1 class="text-[.8rem] py-2">{{ $proposal->project_title }}</h1>
        </div>


        <div class="flex space-x-4">
            <div class="mb-4 text-gray-700 w-full">
                <label class="block font-bold mb-2 text-[.7rem]" for="project_title">Project
                    Member</label>
                <div>
                    @foreach ($proposal->proposal_members as $proposal_mem)
                        @if ($proposal_mem !== null)
                                <h1 class="text-[.8rem] py-2">{{$proposal_mem->user->name }}</h1>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


        <div class="flex text-gray-700 mb-2 space-x-4">
            <div class="text-[.7rem] w-full">
                <label class="block font-bold mb-2" for="description">Started Date</label>
                <h1 class="text-[.8rem] py-2">{{$proposal->started_date == null ? 'No date' : $proposal->started_date->format('M. d, Y') }}</h1>


            </div>

            <div class="text-[.7rem] w-full">
                <label class="block font-bold mb-2" for="description">Finished Date</label>
                    <h1 class="text-[.8rem] py-2">{{$proposal->finished_date == null ? 'No date' : $proposal->finished_date->format('M. d, Y') }}</h1>

            </div>
        </div>

        <div class="flex justify-between mt-4">

            <!-- Modal toggle -->
            <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Edit
            </button>

            <!-- Main modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 bg-black bg-opacity-70 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow h-[60%]">


                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t ">
                            <h3 class="text-lg font-semibold text-gray-700 ">
                                Edit Project Information
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <form action={{ route('User-dashboard.update-project-details', $proposal->id) }} method="POST"  onsubmit="return confirm('Are you sure?')">
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
                                            <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Started Date</label>
                                            <input class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposal->started_date }}" name="started_date" id="started_date" type="datetime-local">
                                            @error('started_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="w-full">
                                            <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs"> Ended Date</label>
                                            <input class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposal->finished_date }}" name="finished_date" id="finished_date" type="datetime-local">
                                            @error('finished_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4 w-full overflow-x-auto h-[20vh]">


                                        <label class="xl:text-xs block text-gray-700 text-sm font-medium tracking-wider mb-2">Project Member</label>

                                        <select name="tags[]" id="tags" class="tags w-full" multiple="multiple" required>
                                            @foreach($existingTags as $userId => $userName)
                                                <option value="{{ $userId }}" selected>{{ $userName }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>

                            </div>
                            <!-- Modal footer -->
                            <div class="flex justify-between items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                Delete this Proposal
            </button>

            <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 bg-black bg-opacity-80 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this project?</h3>

                            <div class="flex space-x-4 items-center justify-center">
                                <form action={{ route('User-dashboard.delete-proposal', $proposal->id) }} method="POST">
                                    @csrf @method('DELETE')
                                    <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, Im sure
                                    </button>
                                </form>

                                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</x-alpine-modal>










