<x-app-layout>
    @section('title', 'Show Inventory | ' . config('app.name', 'UniCESS'))
    @if (Auth::user()->authorize == 'checked')
    @unlessrole('admin|New User')
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

        .tab-content {
            display: none;
        }



    </style>

    @if ($errors->any())
            @foreach ($errors->all() as $error)
            <?php flash()->addError($error); ?>
            @endforeach
    @endif

        <section class="bg-white shadow rounded-xl h-full relative text-gray-700">

            @if ($proposals == null)

            <div class="flex justify-between p-5 py-3">
                <h1 class="text-lg tracking-wide">404 Error: Not Found</h1>
                <a href={{ route('User-dashboard.index') }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
            <hr>
            <div class="flex items-center justify-center h-[100%] flex-col space-y-4">
                <img class="w-[12rem]" src="{{ asset('img/not-found.svg') }}" alt="">
                <h1 class="text-2xl tracking-wide text-gray-700">404 Error:<span class="text-red-500"> Not Found</span> </h1>
            </div>

            @else
            <!-- Modal Upload modal documents -->
            <div id="modal-upload-documents" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-4xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-[70vh] overflow-y-auto  scrollbar" id="style-2">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 sticky top-0 z-10 w-full bg-gray-700">
                            <h3 class="text-base sm:text-xl font-semibold text-gray-900 dark:text-white">
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
                        <form action={{ route('inventroy-update-user-proposal', $proposals->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')">
                            @csrf @method('PUT')
                        <div class="p-4 md:p-5">
                            <p class="text-xs sm:text-sm leading-relaxed text-white tracking-wider">
                                Note: Choose what is applicable
                            </p>

                                <div class="py-1 mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3 text-white">
                                    <div class="flex flex-col mb-1 w-full">
                                        <label class="text-[.7rem] sm:text-xs font-light tracking-wider mb-1 2xl:text-sm">Update Proposal (PDF)</label>
                                        <input type="file" class="border text-[.7rem] sm:text-xs" name="proposal_pdf">
                                        @error('proposal_pdf')<span class="text-red-500  text-[.7rem] sm:text-xs">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="flex flex-col mb-1 w-full ">
                                        <label class="text-[.7rem] sm:text-xs font-light tracking-wider mb-1 2xl:text-sm">Update Memorandum of Agreement (PDF)</label>
                                        <input type="file" class="border text-[.7rem] sm:text-xs" name="moa_pdf">
                                        @error('moa_pdf')<span class="text-red-500  text-[.7rem] sm:text-xs">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="w-full">
                                        <label class="text-[.7rem] sm:text-xs block text-white  font-medium mb-2 2xl:text-sm">Office Order (PDF) <span class="text-[.7rem] sm:text-xs">(Multiple files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"
                                        name="office_order_pdf[]" multiple id="office_order_pdf" type="file" accept="application/pdf" onchange="displayOfficeFileNames(this)">
                                        <div id="file-office-container" class="text-[.7rem] sm:text-xs mt-1 font-thin"></div>

                                    </div>

                                    <div class="w-full">
                                        <label class="text-[.7rem] sm:text-xs block text-white  font-medium mb-2 2xl:text-sm">Travel Order (PDF) <span class="text-[.7rem] sm:text-xs">(Multiple files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"
                                        name="travel_order_pdf[]" multiple id="travel_order_pdf" type="file" accept="application/pdf"  onchange="displayTravelFileNames(this)">
                                        <div id="file-travel-container" class="text-[.7rem] sm:text-xs mt-1 font-thin"></div>
                                    </div>

                                    <div class="w-full">
                                        <label class="text-[.7rem] sm:text-xs block text-white  font-medium mb-2 2xl:text-sm">Special Order (PDF) <span class="text-[.7rem] sm:text-xs">(Multiple files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"
                                        name="special_order_pdf[]" multiple id="special_order_pdf" type="file" accept="application/pdf" onchange="displaySpecialFileNames(this)">
                                        <div id="file-special-container" class="text-[.7rem] sm:text-xs mt-1 font-thin"></div>
                                    </div>

                                    <div class="w-full">
                                        <label class="text-[.7rem] sm:text-xs block text-white  font-medium mb-2 2xl:text-sm">Attendance <span class="text-[.7rem] sm:text-xs">(Multiple files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"
                                        name="attendance[]" multiple id="attendance" type="file" onchange="displayAttendanceFileNames(this)">
                                        <div id="file-attendance-container" class="text-[.7rem] sm:text-xs mt-1 font-thin"></div>
                                    </div>
                                    <div class="w-full">
                                        <label class="text-[.7rem] sm:text-xs block text-white  font-medium mb-2 2xl:text-sm">Attendance Monitoring <span class="text-[.7rem] sm:text-xs">(Multiple files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"
                                        name="attendancem[]" multiple id="attendancem" type="file" onchange="displayAttendancemFileNames(this)">
                                        <div id="file-attendancem-container" class="text-[.7rem] sm:text-xs mt-1 font-thin"></div>
                                    </div>

                                    <div class="flex flex-col w-full">
                                        <label class="text-[.7rem] sm:text-xs font-light tracking-wider mb-2 2xl:text-sm">Upload Other Files <span class="text-[.7rem] sm:text-xs">(Multiple Files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"  type="file" multiple name="other_files[]" onchange="displayFileNames(this)">
                                        <div id="file-names-container" class="text-[.7rem] sm:text-xs mt-1"></div>
                                        @error('other_files')<span class="text-red-500  text-[.7rem] sm:text-xs">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="flex flex-col w-full">
                                        <label class="text-[.7rem] sm:text-xs font-light tracking-wider mb-2 2xl:text-sm">Narrative Report <span class="text-[.7rem] sm:text-xs">(Multiple Files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"  type="file" multiple name="narrative_report[]" onchange="displayNarrativeFileNames(this)">
                                        <div id="file-narrative-container" class="text-[.7rem] sm:text-xs mt-1"></div>

                                    </div>

                                    <div class="flex flex-col w-full">
                                        <label class="text-[.7rem] sm:text-xs font-light tracking-wider mb-2 2xl:text-sm">Terminal Report <span class="text-[.7rem] sm:text-xs">(Multiple Files)</span></label>
                                        <input class="border text-[.7rem] sm:text-xs w-full"  type="file" multiple name="terminal_report[]" onchange="displayTerminalFileNames(this)">
                                        <div id="file-terminal-container" class="text-[.7rem] sm:text-xs mt-1"></div>

                                    </div>
                                </div>

                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 ">
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
                    <div class="relative  rounded-lg shadow bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-3 sm:p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-sm sm:text-xl font-semibold text-gray-900 dark:text-white">
                                Edit Project Details <span class="text-[.7rem] sm:text-xs text-red-400">(*)required</span>
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-edit-project-details">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action={{ route('inventory.update-project-details', $proposals->id ) }} method="POST"  onsubmit="return confirm('Are you sure?')">
                            @csrf @method('PUT')
                            <div class="p-4 md:p-5">
                                <div class="flex flex-col sm:flex-row sm:space-x-4 w-full">
                                    <div class="w-full">
                                        <label class="text-[.7rem] sm:text-xs block text-white font-medium mb-2 tracking-wider" for="program_id">Program Name <span class="text-red-500">*</span></label>
                                        <select id="program_id" class="rounded-md text-[.7rem] sm:text-xs w-full border-zinc-400 px-3" name="program_id" value="{{ old('program_id') }}" required>
                                            @foreach ($program as $id => $program_name ) <option value="{{ $id }}" @if ($id == $proposals->program_id) selected="selected" @endif >{{ $program_name }}</option> @endforeach
                                        </select>
                                        @error('program_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="w-full">
                                        <label class="text-[.7rem] sm:text-xs block text-white font-medium mb-2 tracking-wider" for="project_title">Proposal Title <span class="text-red-500">*</span></label>
                                        <input class="border-zinc-400 text-[.7rem] sm:text-xs shadow appearance-none border rounded w-full  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="project_title" id="project_title" type="text" value="{{ $proposals->project_title }}" placeholder="project title" required>
                                        @error('project_title') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="flex space-y-2 flex-col mt-3">

                                    <div class="flex flex-col sm:flex-row sm:space-x-4 w-full" >
                                        <div class="w-full">
                                            <label class="text-[.7rem] sm:text-xs block text-white font-medium mb-2 tracking-wider">Started Date <span class="text-xs">(optional)</span></label>
                                            <input  class="border-zinc-400 text-[.7rem] sm:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposals->started_date }}" name="started_date" id="started_date" type="datetime-local">
                                            @error('started_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="w-full">
                                            <label class="text-[.7rem] sm:text-xs block text-white font-medium mb-2 tracking-wider">Ended Date <span class="text-xs">(optional)</span></label>
                                            <input class="border-zinc-400 text-[.7rem] sm:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposals->finished_date }}" name="finished_date" id="finished_date" type="datetime-local">
                                            @error('finished_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4 w-full h-[25vh] 2xl:h-[20vh] overflow-x-auto">
                                        <label class="text-[.7rem] sm:text-xs block text-white font-medium tracking-wider mb-2 sticky top-0 w-full z-10 bg-gray-700">Project Member <span class="text-red-500">*</span></label>

                                        <select name="tags[]" id="tags" class="tags w-full text-xs" multiple="multiple" required>
                                            @foreach($existingTags as $userId => $userName)
                                                <option class="text-xs" value="{{ $userId }}" selected>{{ $userName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs sm:text-sm px-5 py-2.5 text-center ">Update</button>
                                <button data-modal-hide="modal-edit-project-details" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-xs sm:text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Track documents -->
            <div id="modal-track-documents" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative rounded-lg shadow bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-sm sm:text-xl font-semibold text-gray-900 dark:text-white">
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
                                    @foreach ($uniqueformedias as $mediaLibrary )
                                        @if (!empty($mediaLibrary->collection_name == 'proposalPdf'))

                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Proposal File</h3>

                                            <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                            <a href={{ route('inventory-download-proposalPdf', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>
                                        @elseif (!empty($mediaLibrary->collection_name == 'moaPdf'))
                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>

                                            <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">MOA File</h3>

                                            <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                            <a href={{ route('inventory-download-moa', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>

                                        @elseif (!empty($mediaLibrary->collection_name == 'otherFile'))
                                        <li class="mb-10 mx-8 ">
                                            <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                            </span>
                                            <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Other File</h3>

                                            <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                            <a href={{ route('inventory-download-otherfile', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                Download
                                            </a>
                                        </li>




                                             @elseif (!empty($mediaLibrary->collection_name == 'travelOrderPdf'))
                                            <li class="mb-10 mx-8 ">
                                                <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                </span>
                                                <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Travel Order File  </h3>
                                                <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                <a href={{ route('inventory-download-travelorder', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                    Download
                                                </a>
                                            </li>

                                             @elseif (!empty($mediaLibrary->collection_name == 'specialOrderPdf'))
                                            <li class="mb-10 mx-8 ">
                                                <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                </span>
                                                <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Special Order File  </h3>
                                                <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                <a href={{ route('inventory-download-specialorder', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                    Download
                                                </a>
                                            </li>

                                             @elseif (!empty($mediaLibrary->collection_name == 'officeOrderPdf'))
                                            <li class="mb-10 mx-8 ">
                                                <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                </span>
                                                <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Office Order File </h3>
                                                <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                <a href={{ route('inventory-download-officeorder', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                    Download
                                                </a>
                                            </li>

                                             @elseif (!empty($mediaLibrary->collection_name == 'Attendance'))
                                            <li class="mb-10 mx-8 ">
                                                <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                </span>
                                                <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Attendance File </h3>
                                                <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                <a href={{ route('inventory-download-attendance', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                    Download
                                                </a>
                                            </li>

                                             @elseif (!empty($mediaLibrary->collection_name == 'AttendanceMonitoring'))
                                            <li class="mb-10 mx-8 ">
                                                <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                </span>
                                                <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Attendance Monitoring File </h3>
                                                <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                <a href={{ route('inventory-download-attendancem', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                    Download
                                                </a>
                                            </li>

                                             @elseif (!empty($mediaLibrary->collection_name == 'NarrativeFile'))
                                            <li class="mb-10 mx-8 ">
                                                <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                </span>
                                                <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Narrative Report File  </h3>
                                                <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                <a href={{ route('inventory-download-narrative', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                    Download
                                                </a>
                                            </li>

                                             @elseif (!empty($mediaLibrary->collection_name == 'TerminalFile'))
                                            <li class="mb-10 mx-8 ">
                                                <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                    <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                </span>
                                                <h3 class="flex items-start mb-1  text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">Terminal Report File </h3>
                                                <h1 class="block mb-3 text-[.7rem] sm:text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }} </h1>
                                                <a href={{ route('inventory-download-terminal', $mediaLibrary->model_id) }}  class="inline-flex items-center py-2 px-3 text-[.7rem] sm:text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                    Download
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-200 bg-opacity-40 h-full absolute  z-20" id="mySidebar">
                <div class="w-[0rem] rounded bg-gray-600 h-full transition-all" id="subSidebar">
                    <div class="p-4 w-full h-full transition-all" style="display: none" id="sidebar-title">
                        <div class="flex justify-between text-white">
                            <h1 class="tracking-wider">Options</h1>
                            <a href="javascript:void(0)" class="closebtn text-2xl hover:bg-gray-700 px-2 rounded" onclick="closeNav()">×</a>
                        </div>

                        <div class="py-2 space-y-2 mt-5 flex flex-col transition-all ">

                            <button data-modal-target="modal-upload-documents" data-modal-toggle="modal-upload-documents" class="p-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
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

                            <button data-modal-target="modal-edit-project-details" data-modal-toggle="modal-edit-project-details" class="p-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
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

                            <button data-modal-target="modal-track-documents" data-modal-toggle="modal-track-documents" class="p-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
                                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M88 112a8 8 0 0 1 8-8h80a8 8 0 0 1 0 16H96a8 8 0 0 1-8-8m8 40h80a8 8 0 0 0 0-16H96a8 8 0 0 0 0 16m136-88v120a24 24 0 0 1-24 24H32a24 24 0 0 1-24-23.89V88a8 8 0 0 1 16 0v96a8 8 0 0 0 16 0V64a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16m-16 0H56v120a23.84 23.84 0 0 1-1.37 8H208a8 8 0 0 0 8-8Z"/></svg>
                                    Track Documents
                            </button>

                            <a class="p-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 xl:text-[.8rem] 2xl:text-xs text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" href={{ url('download', $proposals->id) }}>
                                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M82.34 117.66A8 8 0 0 1 88 104h32V40a8 8 0 0 1 16 0v64h32a8 8 0 0 1 5.66 13.66l-40 40a8 8 0 0 1-11.32 0ZM216 144a8 8 0 0 0-8 8v56H48v-56a8 8 0 0 0-16 0v56a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16v-56a8 8 0 0 0-8-8Z"/></svg>
                                Download to zip
                            </a>

                            <ul class="flex flex-col">
                                <li class="me-2"  id="tab-mydocument">

                                    <a href="#" onclick="showTab('mydocument')" aria-current="page"  class="p-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white">
                                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M216 74h-86l-28.27-21.2a14 14 0 0 0-8.4-2.8H40a14 14 0 0 0-14 14v136a14 14 0 0 0 14 14h176a14 14 0 0 0 14-14V88a14 14 0 0 0-14-14M38 64a2 2 0 0 1 2-2h53.33a2 2 0 0 1 1.2.4L118 80L94.53 97.6a2 2 0 0 1-1.2.4H38Zm180 136a2 2 0 0 1-2 2H40a2 2 0 0 1-2-2v-90h55.33a14 14 0 0 0 8.4-2.8L130 86h86a2 2 0 0 1 2 2Zm-60-48a6 6 0 0 1-6 6h-48a6 6 0 0 1 0-12h48a6 6 0 0 1 6 6"/></svg>
                                        My Documents
                                    </a>
                                </li>
                                <li class="me-2"  id="tab-document">
                                    <a href="#" onclick="showTab('document')"  class="p-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white">
                                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M216 74h-86l-28.27-21.2a14 14 0 0 0-8.4-2.8H40a14 14 0 0 0-14 14v136a14 14 0 0 0 14 14h176a14 14 0 0 0 14-14V88a14 14 0 0 0-14-14M38 64a2 2 0 0 1 2-2h53.33a2 2 0 0 1 1.2.4L118 80L94.53 97.6a2 2 0 0 1-1.2.4H38Zm180 136a2 2 0 0 1-2 2H40a2 2 0 0 1-2-2v-90h55.33a14 14 0 0 0 8.4-2.8L130 86h86a2 2 0 0 1 2 2Zm-60-48a6 6 0 0 1-6 6h-48a6 6 0 0 1 0-12h48a6 6 0 0 1 6 6"/></svg>
                                        All Documents
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

                <header class="flex justify-between p-4">
                    <h1 class="tracking-wider sm:text-sm text-xs"> {{ Str::limit($proposals->project_title, 80) }} </h1>
                    <a class="text-red-500 text-xl font-bold hover:bg-gray-200 focus:bg-red-200 rounded" href={{ URL::previous() }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </header>
                <hr>
                <div class="w-full flex flex-col p-4 pt-0 h-[70vh] overflow-x-auto">

                    <div class="flex justify-between sm:px-5 pt-4 space-x-4 text-lg sticky top-0 bg-white z-10">
                        <button class="openbtn" onclick="openNav()">☰</button>
                        <select id="myDropdown" class="rounded text-xs w-[5rem] sm:w-[7rem]">
                            @foreach ($inventory as $invent )
                            <option value="1" {{ old('1', $invent->number) == '1' ? 'selected' : '' }}>Tiles</option>
                            <option value="2" {{ old('2', $invent->number) == '2' ? 'selected' : '' }}>Medium Icon</option>
                            @endforeach
                        </select>
                    </div>



                    <div id="document-content"  class="tab-content  md:px-5 2xl:px-10" style="display: none;">
                        @include('user.inventory.show._show-media')
                    </div>

                    <div id="mydocument-content"  class="tab-content md:px-5 2xl:px-10 " style="display: none;">
                        @include('user.inventory.show._show_my_media')
                    </div>

                </div>
            @endif
        </section>

        <script>
            $('input[type=file]').change(function(){
            if($('input[type=files]').val()==''){
                $('#upload-file').attr('disabled',true)
            }
            else{
            $('#upload-file').attr('disabled',false);
            }})

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


            $(document).ready(function () {
                $('#myDropdown').on('change', function () {
                    var selectedValue = $(this).val();

                    $.ajax({
                        url: '/api/update-customize-user-show/2' ,
                        method: 'POST',
                        data: {
                            selected_value: selectedValue,
                            _token: '{{ csrf_token() }}' // Add CSRF token for security
                        },

                        success: function (response) {

                            window.location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });




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
            function displayTravelFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-travel-container');

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
            function displaySpecialFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-special-container');

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
            function displayOfficeFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-office-container');

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
            function displayAttendanceFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-attendance-container');

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
            function displayAttendancemFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-attendancem-container');

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
            function displayNarrativeFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-narrative-container');

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
            function displayTerminalFileNames(input) {
                // Get the selected files
                var files = input.files;

                // Get the container where you want to display file names
                var container = document.getElementById('file-terminal-container');

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

    @else

        <div class="flex items-center justify-center">
            <h1 class="text-gray-500 tracking-wide">Its Empty here </h1>
        </div>


        @endunlessrole

    @elseif (Auth::user()->authorize == 'close')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                Your account has been declined for some reason, <br> the admin is reviewing your account details
                <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
            </h1>
        </div>
    @endif
</x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function showTab(tabId) {
            // Toggle visibility of list items
            document.getElementById('tab-mydocument').style.display = (tabId === 'mydocument') ? 'none' : 'block';
            document.getElementById('tab-document').style.display = (tabId === 'document') ? 'none' : 'block';

            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Remove 'active' class from all tabs (if needed)
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Show the selected tab content
            document.getElementById(tabId + '-content').style.display = 'block';

            // Add 'active' class to the clicked tab (if needed)
            document.querySelector('[onclick="showTab(\'' + tabId + '\')"]').classList.add('active');

            // Store the selected tab in localStorage
            localStorage.setItem('selectedDocument', tabId);
        }

        document.addEventListener("DOMContentLoaded", function () {
            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('selectedDocument');
            if (storedTab) {
                showTab(storedTab); // Call showTab function with stored tabId
            } else {
                // If no stored tab, show the 'document' tab by default
                showTab('document');
            }
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.tags').select2({
                placeholder: 'Select Option',
                allowClear: true,
                tags: true,
                width: '100%',
            });

            $('#tags').select2({
                ajax: {
                    url: "{{ route('proposal.getusername') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params){
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data){
                        return {
                            results: $.map(data, function(user){
                                return {
                                    id: user.id,
                                    text: user.name
                                }
                            })
                        };
                    },
                },
                placeholder: "Start typing to search name",
                width: '100%',

            });
        });

    </script>
