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

    <section class="bg-white shadow rounded-lg h-full text-gray-600 overflow-hidden">

        @if ($proposals == null)
            <div class="flex justify-between p-2 2xl:p-3 bg-white rounded-tl rounded-tr">
                <div class="flex flex-col sm:flex-row sm:space-x-8 font-medium text-gray-700">
                    <h1 class="text-[.7rem] xl:text-sm tracking-wider">404 Error: Not Found</h1>

                </div>
                <a class="text-black text-xl focus:bg-red-500 focus:text-white hover:bg-red-400 font-medium  px-2 py-2 rounded" href={{ route('admin.extension-monitoring.index') }}>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </a>
            </div>
            <hr>

            <div class="flex items-center justify-center h-[100%]">
                <h1 class="text-2xl tracking-wide text-gray-700">404 Error:<span class="text-red-500"> Not Found</span> </h1>
            </div>

        @else
            <header class="flex justify-between p-2 2xl:p-3 {{ $proposals->authorize == 'pending' ? 'bg-red-200' : ($proposals->authorize == 'ongoing' ? 'bg-blue-200' : 'bg-green-200') }} rounded-tl rounded-tr">

                    <div class="items-center flex sm:flex-row sm:space-x-4 md:space-x-8 font-medium text-gray-700">
                        <h1 class="hidden sm:block text-[.7rem] xl:text-sm tracking-wider">
                            {{ Str::limit($proposals->project_title) }}</h1>
                    </div>

                <a class="text-black text-xl focus:bg-red-500 focus:text-white hover:bg-red-400 font-medium  px-2 py-2 rounded" href={{ route('admin.dashboard.index') }}>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </a>
            </header>
            <hr>

            {{--  Wrapper  --}}
            <div class="flex h-full ">
                {{--  Container-2  --}}
                <div class="w-full h-full flex flex-col relative">

                    <!-- Modal Upload modal documents -->
                    <div id="modal-upload-documents" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative rounded-lg shadow bg-gray-700">
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
                                <form action={{ route('admin.dashboard-update-user-proposal', $proposals->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')">
                                    @csrf @method('PUT')
                                <div class="p-4 md:p-5">
                                    <p class="text-sm leading-relaxed text-white tracking-wider">
                                        Note: Choose what is applicable
                                    </p>

                                        <div class="py-1 mt-5 grid grid-cols-2 gap-3 text-white">
                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Proposal
                                                    (PDF)</label>
                                                <input type="file" class="border text-xs" name="proposal_pdf" accept="application/pdf">
                                                @error('proposal_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Special Order
                                                    (PDF)</label>
                                                <input type="file" multiple class="border text-xs" name="special_order_pdf[]" accept="application/pdf" onchange="displaySpecialFileNames(this)">
                                                <div id="file-special-container" class="text-xs mt-1 font-thin"></div>
                                                @error('special_order_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Memorandum of Agreement
                                                    (PDF)</label>
                                                <input type="file" class="border text-xs" name="moa_pdf" accept="application/pdf">
                                                @error('moa_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>


                                            <div class="flex flex-col  mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Travel order
                                                    (PDF)</label>
                                                <input type="file" multiple class="border text-xs" name="travel_order_pdf[]" accept="application/pdf" onchange="displayTravelFileNames(this)">
                                                <div id="file-travel-container" class="text-xs mt-1 font-thin"></div>
                                                @error('travel_order_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="flex flex-col  mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Update Office order
                                                    (PDF)</label>
                                                <input type="file" multiple  class="border text-xs" name="office_order_pdf[]" accept="application/pdf" onchange="displayOfficeFileNames(this)">
                                                @error('office_order_pdf')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                <div id="file-office-container" class="text-xs mt-1 font-thin"></div>
                                            </div>

                                            <div class="flex flex-col  mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Attendance  <span class="text-xs">(Multiple Files)</span></label>
                                                <input type="file" multiple  class="border text-xs" name="attendance[]" onchange="displayAttendanceFileNames(this)">
                                                @error('attendance')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                <div id="file-attendance-container" class="text-xs mt-1 font-thin"></div>
                                            </div>
                                            <div class="flex flex-col  mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Attendance Monitoring  <span class="text-xs">(Multiple Files)</span></label>
                                                <input type="file" multiple  class="border text-xs" name="attendancem[]" onchange="displayAttendanceMFileNames(this)">
                                                @error('attendancem')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                <div id="file-attendancem-container" class="text-xs mt-1 font-thin"></div>
                                            </div>

                                            <div class="flex flex-col mb-1 w-full">
                                                <label class="text-xs font-light tracking-wider mb-1">Upload Other Files <span class="text-xs">(Multiple Files)</span></label>
                                                <input class="border text-xs "  type="file" multiple name="other_files[]" onchange="displayOtherFileNames(this)">
                                                <div id="file-othernames-container" class="text-xs mt-1 font-thin"></div>
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
                                <form action={{ route('admin.dashboard.update-project-details', $proposal->id ) }} method="POST" id="myForm" onsubmit="return confirm('Are you sure?')">
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



                                            <div class="mt-4 w-full h-[24vh] 2xl:h-[20vh] overflow-x-auto">


                                                <label class="xl:text-xs block text-white text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Project Member <span class="text-red-500">*</span></label>

                                                <select name="tags[]" id="tags" class="tags w-full text-xs" multiple="multiple" required>
                                                    @foreach($existingTags as $userId => $userName)
                                                        <option value="{{ $userId }}" selected>{{ $userName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Update</button>
                                    <button data-modal-hide="modal-edit-project-details" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
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
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to trash this project?</h3>
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
                                            @foreach ($uniqueformedias as $mediaLibrary )
                                                @if (!empty($mediaLibrary->collection_name == 'proposalPdf'))

                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Proposal File</h3>

                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-proposalPdf', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>
                                                @elseif (!empty($mediaLibrary->collection_name == 'moaPdf'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>

                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">MOA File</h3>

                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-moa', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'otherFile'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Other File</h3>

                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-otherfile', $formedia->id) }} class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'travelOrderPdf'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Travel Order File  </h3>
                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-travelorder', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'specialOrderPdf'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Special Order File  </h3>
                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-specialorder', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'officeOrderPdf'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Office Order File </h3>
                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-officeorder', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'Attendance'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Attendance File </h3>
                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-attendance', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'AttendanceMonitoring'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Attendance Monitoring File </h3>
                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-attendancem', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'NarrativeFile'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Narrative Report File  </h3>
                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                                    <a href={{ route('inventory-download-narrative', $mediaLibrary->model_id) }} type="button" class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/><path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/></svg>
                                                        Download
                                                    </a>
                                                </li>

                                                @elseif (!empty($mediaLibrary->collection_name == 'TerminalFile'))
                                                <li class="mb-10 mx-8 ">
                                                    <span class="absolute flex items-center justify-center w-6 h-6  rounded-full -left-3 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                                                        <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path fill="currentColor" d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z"/></svg>
                                                    </span>
                                                    <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Terminal Report File </h3>
                                                    <h1 class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Uploaded on {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }} </h1>
                                                    <a href={{ route('inventory-download-terminal', $mediaLibrary->model_id) }}  class="inline-flex items-center py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
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
                    <!-- Modal Show summary -->
                    <div id="modal-show-all-summary" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-4xl h-[60%]">
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

                                <div class="p-4 h-[45vh] 2xl:h-[50vh] overflow-auto scrollbar"  id="style-2">
                                    <h1 class="text-white text-base mb-2 tracking-wider">Details</h1>

                                    <div class="space-y-2">
                                        <p class="text-xs text-white tracking-wider">
                                        Created at:  {{ \Carbon\Carbon::parse($proposals->created_at)->format('M d, y g:i:s A') }}
                                        </p>
                                        <p class="text-xs text-white tracking-wider">
                                        Last Modified:  {{ \Carbon\Carbon::parse($proposals->updated_at)->format('M d, y g:i:s A') }}
                                        </p>
                                        <p class="text-xs text-white tracking-wider">
                                        Program/Project ID: {{ $proposals->uuid }}
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
                                            Total of Members: {{ $proposals->proposal_members->count() }}
                                        </p>
                                    </div>
                                    <div class="">
                                    <div class="mt-4 flex space-x-1  bg-gray-700">
                                        <h1 class="text-white text-base my-5 tracking-wider">Project Members</h1>

                                    </div>

                                    <div class="space-y-3">

                                        <div class="flex flex-col space-y-4">

                                                @foreach ($proposals->proposal_members as $proposal_mem)
                                                    @if ($proposal_mem !== null)
                                                        <div class="flex space-x-2">
                                                            <div>
                                                                <div class="flex space-x-2">
                                                                    <h1 class="xl:text-[.7rem] text-[.6rem] text-white tracking-wider">Name:</h1>
                                                                    <span class="font-light 2xl:text-xs xl:text-[.7rem] text-[.7rem] text-white tracking-wider">{{ $proposal_mem->user->name }}</span>
                                                                </div>

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
                    <!-- Modal Show summary-2 -->
                    {{-- <div id="modal-show-all-summary-2" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-4xl h-[60%]">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Program/Project Details
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-show-all-summary-2">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->

                                <div class="p-4 h-[45vh] 2xl:h-[50vh] overflow-auto scrollbar"  id="style-2">
                                    <h1 class="text-white text-base mb-2 tracking-wider">Details</h1>

                                    <div class="space-y-2">
                                        <p class="text-xs text-white tracking-wider">
                                        Created at:  {{ \Carbon\Carbon::parse($proposals->created_at)->format('M d, y g:i:s A') }}
                                        </p>
                                        <p class="text-xs text-white tracking-wider">
                                        Last Modified:  {{ \Carbon\Carbon::parse($proposals->updated_at)->format('M d, y g:i:s A') }}
                                        </p>
                                        <p class="text-xs text-white tracking-wider">
                                        Program/Project ID: {{ $proposals->uuid }}
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
                                            Total of Members: {{ $proposals->proposal_members->count() }}
                                        </p>
                                    </div>
                                    <div class="">
                                    <div class="mt-4 flex space-x-1  bg-gray-700">
                                        <h1 class="text-white text-base my-5 tracking-wider">Project Members</h1>

                                    </div>

                                    <div class="space-y-3">

                                        <div class="flex flex-col space-y-4">

                                                @foreach ($proposals->proposal_members as $proposal_mem)
                                                    @if ($proposal_mem !== null)
                                                        <div class="flex space-x-2">
                                                            <div>
                                                                <div class="flex space-x-2">
                                                                    <h1 class="xl:text-[.7rem] text-[.6rem] text-white tracking-wider">Name:</h1>
                                                                    <span class="font-light 2xl:text-xs xl:text-[.7rem] text-[.7rem] text-white tracking-wider">{{ $proposal_mem->user->name }}</span>
                                                                </div>

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
                    </div> --}}

                    <!-- Left side bar with the Buttons -->
                    <div class="bg-gray-100 h-full absolute z-30 right-0 bg-opacity-40 flex items-end justify-end transition-all" id="mySidebar">
                        <div class="h-full w-[0rem] bg-gray-700 transition-all" id="subSidebar">
                            <div class="p-4 w-full h-full transition-all" style="display: none" id="sidebar-title">
                                <div class="flex justify-between text-white">
                                    <h1 class="tracking-wider">Options</h1>
                                    <a href="javascript:void(0)" class="closebtn text-2xl" onclick="closeNav()">×</a>
                                </div>

                                <div class="p-3 space-y-2 flex justify-start flex-col">

                                    <div class="">
                                        <button data-modal-target="modal-show-all-summary" data-modal-toggle="modal-show-all-summary" class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
                                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 20 20"><g fill="none"><path d="M3.26 11.602C3.942 8.327 6.793 6 10 6c3.206 0 6.057 2.327 6.74 5.602a.5.5 0 0 0 .98-.204C16.943 7.673 13.693 5 10 5c-3.693 0-6.943 2.673-7.72 6.398a.5.5 0 0 0 .98.204z" fill="currentColor"/><path d="M10 8a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7zm-2.5 3.5a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0z" fill="currentColor"/></g></svg>
                                            Show Details
                                      </button>
                                    </div>

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
                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.098L16.796 8.302l-1.098-1.098L5 17.902zm-1 1v-2.52L17.18 4.288q.154-.137.34-.212q.186-.075.387-.075q.202 0 .39.063q.19.064.35.23l1.066 1.072q.166.16.226.35q.061.191.061.382q0 .203-.069.389q-.068.185-.218.339L6.52 20zM19.02 6.092l-1.112-1.111zm-2.783 1.67l-.539-.558l1.098 1.098z"/></svg>
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
                                            Trash this Project
                                    </button>

                                    <button data-modal-target="modal-track-documents" data-modal-toggle="modal-track-documents" class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
                                        <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M88 112a8 8 0 0 1 8-8h80a8 8 0 0 1 0 16H96a8 8 0 0 1-8-8m8 40h80a8 8 0 0 0 0-16H96a8 8 0 0 0 0 16m136-88v120a24 24 0 0 1-24 24H32a24 24 0 0 1-24-23.89V88a8 8 0 0 1 16 0v96a8 8 0 0 0 16 0V64a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16m-16 0H56v120a23.84 23.84 0 0 1-1.37 8H208a8 8 0 0 0 8-8Z"/></svg>
                                            Track Documents
                                    </button>

                                    <div class="flex flex-col text-xs">
                                        <select id="myStatusDropdown" class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2  ">
                                            <option value="pending"
                                                {{ old('pending', $proposals->authorize) == 'pending' ? 'selected' : '' }}>
                                                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="currentColor" d="M17.385 21q-1.672 0-2.836-1.164Q13.385 18.67 13.385 17t1.164-2.836Q15.713 13 17.385 13q1.67 0 2.835 1.164T21.385 17q0 1.671-1.165 2.836T17.385 21m1.655-1.798l.547-.546l-1.818-1.821v-2.72H17v3.047zM4 20V4h6.252q.14-.587.623-.986T12 2.615q.654 0 1.134.4q.48.398.62.985H20v7.635q-.258-.133-.488-.233T19 11.223V5h-3v2.23H8V5H5v14h6.742q.08.28.189.521q.11.24.28.479zm8.003-14.77q.345 0 .575-.232q.23-.234.23-.578q0-.345-.233-.575q-.234-.23-.578-.23q-.345 0-.575.234q-.23.233-.23.577q0 .345.233.575q.234.23.578.23"/></svg>
                                                Pending
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
                        </div>
                    </div>

                    <div class="flex justify-between px-4 2xl:py-2 xl:py-1 text-lg">
                        <div class="flex gap-4">
                            <h4 class="text-xs 2xl:text-sm tracking-wider">created: {{ \Carbon\Carbon::parse($proposals->created_at)->format('M d, y g:i:s A') }}</h4>
                            <h4 class="text-xs 2xl:text-sm tracking-wider">status: {{ $proposals->authorize }}</h4>
                            <h4 class="text-xs 2xl:text-sm tracking-wider">{{ $proposals->status }}</h4>
                        </div>
                        <div>
                            <div class="flex flex-row space-x-1" style="display:none;" id="showOptionFolder">
                                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="TrashFolder">Trash</button>
                                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="SelectFolder">Select all</button>
                                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="CancelFolder">Cancel</button>
                            </div>

                        </div>
                        <button class="openbtn" onclick="openNav()">☰</button>
                    </div>

                    <!-- Media -->
                    <div class="overflow-x-auto h-auto 2xl:h-[77vh] ">
                        <div class="flex py-3 items-center flex-wrap px-2">

                            @foreach($uniqueProposalFiles as $proposalfile)
                                @if ($proposalfile->collection_name == 'proposalPdf')
                                <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                    <div class=" absolute top-1 right-1">
                                        <div class="checkbox-wrapper-12">
                                            <div class="cbx">
                                            <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                            <label for="cbx-12"></label>
                                            <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                            </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal toggle -->
                                    <button data-modal-target="default-modal-proposal" data-modal-toggle="default-modal-proposal" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                        <span class="text-xs mt-4">Proposal Folder</span>
                                    </button>

                                    <!-- Main modal -->
                                    <div id="default-modal-proposal" tabindex="-1" aria-hidden="true" class="modal-wrapper hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                    <h3 class="text-xl font-semibold text-gray-600">
                                                    Proposal Folder
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-proposal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 grid grid-cols-3 gap-3">
                                                    @foreach ($proposals->medias as $media)
                                                    @if ($media->collection_name == 'proposalPdf')

                                                    <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                            <!-- Modal toggle -->
                                                        <button data-modal-target="proposal-media-modal{{ $media->id}}" data-modal-toggle="proposal-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                            <div x-cloak  x-data="{ 'showModalproposal{{ $media->id }}': false }" @keydown.escape="showModalproposal{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                <!-- Modal -->
                                                                <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalproposal{{ $media->id }}">

                                                                    <!-- Modal inner -->
                                                                    <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalproposal{{ $media->id }}"
                                                                        x-transition:enter="motion-safe:ease-out duration-300"
                                                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalproposal{{ $media->id }} = true">

                                                                        <!-- Title / Close-->
                                                                        <div class="flex items-center justify-between px-4 py-1">
                                                                            <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                            <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalproposal{{ $media->id }} = false">
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
                                                                <div id="detail-proposal-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                    <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                        <!-- Modal content -->
                                                                        <div class="relative bg-gray-700 rounded-lg shadow">
                                                                            <!-- Modal header -->
                                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                <h3 class="text-xl font-semibold text-white">
                                                                                    Details
                                                                                </h3>
                                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-proposal-modal{{ $media->id }}">
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
                                                                                    Report Type: Travel Order
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
                                                                                    Username uploader:
                                                                                    @foreach ($users as $user )
                                                                                        @if ($media->name == $user->id)
                                                                                            {{ $user->name }}
                                                                                        @endif
                                                                                    @endforeach
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

                                                                        <button data-modal-target="detail-proposal-modal{{ $media->id }}" data-modal-toggle="detail-proposal-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                        <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalproposal{{ $media->id }} = true">Rename</button>
                                                                        <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>


                                                                        <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                        </form>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="proposal-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-md font-semibold text-gray-600">
                                                                        {{ $media->file_name }}
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="proposal-media-modal{{ $media->id}}">
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
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div type="button">
                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                            <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                <!-- Dropdown toggle button -->
                                                <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder  flex items-center p-2 rounded-md" style="display: block">
                                                    <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                </button>
                                                <!-- Dropdown list -->
                                                <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                    <a href={{ route('inventory-download-proposalPdf', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                    <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if ($proposalfile->collection_name == 'moaPdf')
                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                        <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-moa" data-modal-toggle="default-modal-moa" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">MOA  Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-moa" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                        MOA Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-moa">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                        @foreach ($proposals->medias as $media)
                                                            @if ($media->collection_name == 'moaPdf')

                                                                <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                                    <!-- Modal toggle -->
                                                                    <button data-modal-target="moa-media-modal{{ $media->id}}" data-modal-toggle="moa-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                                    <div x-cloak  x-data="{ 'showModalmoa{{ $media->id }}': false }" @keydown.escape="showModalmoa{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                        <!-- Modal -->
                                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmoa{{ $media->id }}">

                                                                            <!-- Modal inner -->
                                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmoa{{ $media->id }}"
                                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmoa{{ $media->id }} = true">

                                                                                <!-- Title / Close-->
                                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmoa{{ $media->id }} = false">
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
                                                                        <div id="detail-moa-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                                <!-- Modal content -->
                                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                                    <!-- Modal header -->
                                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                        <h3 class="text-xl font-semibold text-white">
                                                                                            Details
                                                                                        </h3>
                                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-moa-modal{{ $media->id }}">
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
                                                                                            Report Type: MOA Folder
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
                                                                                            Username uploader:
                                                                                            @foreach ($users as $user )
                                                                                                @if ($media->name == $user->id)
                                                                                                    {{ $user->name }}
                                                                                                @endif
                                                                                            @endforeach
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

                                                                                <button data-modal-target="detail-moa-modal{{ $media->id }}" data-modal-toggle="detail-moa-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmoa{{ $media->id }} = true">Rename</button>
                                                                                <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                                <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="moa-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                        <!-- Modal content -->
                                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                            <!-- Modal header -->
                                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                                {{ $media->file_name }}
                                                                                </h3>
                                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="travelorder-media-modal{{ $media->id}}">
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
                                                            @endif
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-moa', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'otherFile')

                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                        <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button  data-modal-target="default-modal-otherfile" data-modal-toggle="default-modal-otherfile" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">Other Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-otherfile" tabindex="-1" aria-hidden="true" class="folder modal-wrapper hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">

                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">

                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">Other Folder</h3>
                                                        <button type="button" class="CloseButton text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-otherfile">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption" style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>

                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                        @foreach ($proposals->medias as $media)
                                                            @if ($media->collection_name == 'otherFile')

                                                                <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                                    <!-- Modal toggle -->
                                                                    <button data-modal-target="otherfile-media-modal{{ $media->id}}" data-modal-toggle="otherfile-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                                    <div x-cloak  x-data="{ 'showModalotherfile{{ $media->id }}': false }" @keydown.escape="showModalotherfile{{ $media->id }} = false"  class="absolute right-0 top-1">

                                                                        <!-- Modal -->
                                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalotherfile{{ $media->id }}">

                                                                            <!-- Modal inner -->
                                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalotherfile{{ $media->id }}"
                                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalotherfile{{ $media->id }} = true">

                                                                                <!-- Title / Close-->
                                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalotherfile{{ $media->id }} = false">
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
                                                                        <div id="detail-otherfile-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                                <!-- Modal content -->
                                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                                    <!-- Modal header -->
                                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                        <h3 class="text-xl font-semibold text-white">
                                                                                            Details
                                                                                        </h3>
                                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-otherfile-modal{{ $media->id }}">
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
                                                                                            Report Type: Other Files
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
                                                                                            Username uploader:
                                                                                            @foreach ($users as $user )
                                                                                                @if ($media->name == $user->id)
                                                                                                    {{ $user->name }}
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </p>

                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                        <div class="checkbox-wrapper-12 absolute top-1 right-3">
                                                                            <div class="cbx">
                                                                            <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                            <label for="cbx-12"></label>
                                                                            <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                            </svg>
                                                                            </div>
                                                                        </div>

                                                                        <div x-cloak x-data="{dropdownMenu: false}" class="absolute right-0 top-0">

                                                                            <!-- Dropdown toggle button -->
                                                                            <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
                                                                                <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                            </button>
                                                                            <!-- Dropdown list -->
                                                                            <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                <button data-modal-target="detail-otherfile-modal{{ $media->id }}" data-modal-toggle="detail-otherfile-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalotherfile{{ $media->id }} = true">Rename</button>
                                                                                <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                @if ($otherFilePdfCount > 1)
                                                                                <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                                @else
                                                                                <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                                </form>
                                                                                @endif


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div id="otherfile-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                        <!-- Modal content -->
                                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                            <!-- Modal header -->
                                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                                {{ $media->file_name }}
                                                                                </h3>
                                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="otherfile-media-modal{{ $media->id}}">
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
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-otherfile', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'travelOrderPdf')
                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                            <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-travelorder" data-modal-toggle="default-modal-travelorder" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4"> Travel Order Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-travelorder" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                        Travel Order Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-travelorder">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption" style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete" >Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>
                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                        @foreach ($proposals->medias as $media)
                                                        @if ($media->collection_name == 'travelOrderPdf')

                                                        <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                                <!-- Modal toggle -->
                                                            <button data-modal-target="travelorder-media-modal{{ $media->id}}" data-modal-toggle="travelorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                                <div x-cloak  x-data="{ 'showModalTravelOrder{{ $media->id }}': false }" @keydown.escape="showModalTravelOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                    <!-- Modal -->
                                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalTravelOrder{{ $media->id }}">

                                                                        <!-- Modal inner -->
                                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalTravelOrder{{ $media->id }}"
                                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalTravelOrder{{ $media->id }} = true">

                                                                            <!-- Title / Close-->
                                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalTravelOrder{{ $media->id }} = false">
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
                                                                    <div id="detail-travelorder-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                            <!-- Modal content -->
                                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                                <!-- Modal header -->
                                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                    <h3 class="text-xl font-semibold text-white">
                                                                                        Details
                                                                                    </h3>
                                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-travelorder-modal{{ $media->id }}">
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
                                                                                        Report Type: Travel Order
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
                                                                                        Username uploader:
                                                                                        @foreach ($users as $user )
                                                                                            @if ($media->name == $user->id)
                                                                                                {{ $user->name }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </p>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                    <div class="checkbox-wrapper-12">
                                                                        <div class="cbx">
                                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                        <label for="cbx-12"></label>
                                                                        <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                        </svg>
                                                                        </div>

                                                                        {{--  <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <defs>
                                                                            <filter id="goo-12">
                                                                            <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                                                            <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                                                            <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                                                            </filter>
                                                                        </defs>
                                                                        </svg>  --}}
                                                                    </div>

                                                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                                        <!-- Dropdown toggle button -->
                                                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
                                                                            <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                        </button>
                                                                        <!-- Dropdown list -->
                                                                        <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                            <button data-modal-target="detail-travelorder-modal{{ $media->id }}" data-modal-toggle="detail-travelorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalTravelOrder{{ $media->id }} = true">Rename</button>
                                                                            <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                            @if ($travelCount > 1)
                                                                            <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                            @else
                                                                            <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                            </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="travelorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                    <!-- Modal content -->
                                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                        <!-- Modal header -->
                                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                            <h3 class="text-md font-semibold text-gray-600">
                                                                            {{ $media->file_name }}
                                                                            </h3>
                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="travelorder-media-modal{{ $media->id}}">
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
                                                        @endif
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder  flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-travelorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'specialOrderPdf')
                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                        <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-specialorder" data-modal-toggle="default-modal-specialorder" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">Special Order Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-specialorder" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                            Special Order Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-specialorder">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption"  style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>
                                                    <div class="p-4 grid grid-cols-3 gap-3">
                                                        @foreach ($proposals->medias as $media)
                                                        @if ($media->collection_name == 'specialOrderPdf')

                                                            <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                                <!-- Modal toggle -->
                                                                <button data-modal-target="specialorder-media-modal{{ $media->id}}" data-modal-toggle="specialorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                                <div x-cloak  x-data="{ 'showModalSpecialOrder{{ $media->id }}': false }" @keydown.escape="showModalSpecialOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                    <!-- Modal -->
                                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalSpecialOrder{{ $media->id }}">

                                                                        <!-- Modal inner -->
                                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalSpecialOrder{{ $media->id }}"
                                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalSpecialOrder{{ $media->id }} = true">

                                                                            <!-- Title / Close-->
                                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalSpecialOrder{{ $media->id }} = false">
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
                                                                    <div id="detail-specialorder-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                            <!-- Modal content -->
                                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                                <!-- Modal header -->
                                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                    <h3 class="text-xl font-semibold text-white">
                                                                                        Details
                                                                                    </h3>
                                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-specialorder-modal{{ $media->id }}">
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
                                                                                        Report Type: Special Order
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
                                                                                        Username uploader:
                                                                                        @foreach ($users as $user )
                                                                                            @if ($media->name == $user->id)
                                                                                                {{ $user->name }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </p>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                    <div class="checkbox-wrapper-12">
                                                                        <div class="cbx">
                                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                        <label for="cbx-12"></label>
                                                                        <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                        </svg>
                                                                        </div>

                                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <defs>
                                                                            <filter id="goo-12">
                                                                            <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                                                            <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                                                            <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                                                            </filter>
                                                                        </defs>
                                                                        </svg>
                                                                    </div>

                                                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                                        <!-- Dropdown toggle button -->
                                                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
                                                                            <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                        </button>
                                                                        <!-- Dropdown list -->
                                                                        <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                            <button data-modal-target="detail-specialorder-modal{{ $media->id }}" data-modal-toggle="detail-specialorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalSpecialOrder{{ $media->id }} = true">Rename</button>
                                                                            <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                            @if ($specialPdfCount > 1)
                                                                            <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                            @else
                                                                            <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                            </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="specialorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                    <!-- Modal content -->
                                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                        <!-- Modal header -->
                                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                            <h3 class="text-md font-semibold text-gray-600">
                                                                            {{ $media->file_name }}
                                                                            </h3>
                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="specialorder-media-modal{{ $media->id}}">
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
                                                        @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-specialorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'officeOrderPdf')
                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                            <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-officeorder" data-modal-toggle="default-modal-officeorder" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">Office Order Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-officeorder" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                            Office Order Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-officeorder">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption"  style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>
                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                        @foreach ($proposals->medias as $media)
                                                        @if ($media->collection_name == 'officeOrderPdf')
                                                            <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                                <!-- Modal toggle -->
                                                                <button data-modal-target="officeorder-media-modal{{ $media->id}}" data-modal-toggle="officeorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                                <div x-cloak  x-data="{ 'showModalOfficeOrder{{ $media->id }}': false }" @keydown.escape="showModalOfficeOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                    <!-- Modal -->
                                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalOfficeOrder{{ $media->id }}">

                                                                        <!-- Modal inner -->
                                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalOfficeOrder{{ $media->id }}"
                                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalOfficeOrder{{ $media->id }} = true">

                                                                            <!-- Title / Close-->
                                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalOfficeOrder{{ $media->id }} = false">
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
                                                                    <div id="detail-officeorder-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                            <!-- Modal content -->
                                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                                <!-- Modal header -->
                                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                    <h3 class="text-xl font-semibold text-white">
                                                                                        Details
                                                                                    </h3>
                                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-officeorder-modal{{ $media->id }}">
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
                                                                                        Report Type: Office Order
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
                                                                                        Username uploader:
                                                                                        @foreach ($users as $user )
                                                                                            @if ($media->name == $user->id)
                                                                                                {{ $user->name }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </p>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                    <div class="checkbox-wrapper-12">
                                                                        <div class="cbx">
                                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                        <label for="cbx-12"></label>
                                                                        <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                        </svg>
                                                                        </div>

                                                                        {{--  <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <defs>
                                                                            <filter id="goo-12">
                                                                            <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                                                            <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                                                            <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                                                            </filter>
                                                                        </defs>
                                                                        </svg>  --}}
                                                                    </div>

                                                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                                        <!-- Dropdown toggle button -->
                                                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
                                                                            <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                        </button>
                                                                        <!-- Dropdown list -->
                                                                        <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                            <button data-modal-target="detail-officeorder-modal{{ $media->id }}" data-modal-toggle="detail-officeorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalOfficeOrder{{ $media->id }} = true">Rename</button>
                                                                            <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                            @if ($officeCount > 1)
                                                                            <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                            @else
                                                                            <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                            </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="officeorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                    <!-- Modal content -->
                                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                        <!-- Modal header -->
                                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                            <h3 class="text-md font-semibold text-gray-600">
                                                                            {{ $media->file_name }}
                                                                            </h3>
                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="officeorder-media-modal{{ $media->id}}">
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
                                                        @endif
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder  flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-officeorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'Attendance')
                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                            <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-attendance" data-modal-toggle="default-modal-attendance" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">Attendance Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-attendance" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                            Attendance Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-attendance">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption" style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>
                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                        @foreach ($proposals->medias as $media)
                                                        @if ($media->collection_name == 'Attendance')

                                                            <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                                <!-- Modal toggle -->
                                                                <button data-modal-target="attendance-media-modal{{ $media->id}}" data-modal-toggle="attendance-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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
                                                                <div x-cloak  x-data="{ 'showModalAttendance{{ $media->id }}': false }" @keydown.escape="showModalAttendance{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                    <!-- Modal -->
                                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalAttendance{{ $media->id }}">

                                                                        <!-- Modal inner -->
                                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalAttendance{{ $media->id }}"
                                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalAttendance{{ $media->id }} = true">

                                                                            <!-- Title / Close-->
                                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalAttendance{{ $media->id }} = false">
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
                                                                    <div id="detail-attendance-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                            <!-- Modal content -->
                                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                                <!-- Modal header -->
                                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                    <h3 class="text-xl font-semibold text-white">
                                                                                        Details
                                                                                    </h3>
                                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-attendance-modal{{ $media->id }}">
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
                                                                                        Report Type: Attendance
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
                                                                                        Username uploader:
                                                                                        @foreach ($users as $user )
                                                                                            @if ($media->name == $user->id)
                                                                                                {{ $user->name }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </p>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                    <div class="checkbox-wrapper-12">
                                                                        <div class="cbx">
                                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                        <label for="cbx-12"></label>
                                                                        <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                        </svg>
                                                                        </div>

                                                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <defs>
                                                                            <filter id="goo-12">
                                                                            <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                                                            <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                                                            <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                                                            </filter>
                                                                        </defs>
                                                                        </svg>
                                                                    </div>

                                                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                                        <!-- Dropdown toggle button -->
                                                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
                                                                            <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                        </button>
                                                                        <!-- Dropdown list -->
                                                                        <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                            <button data-modal-target="detail-attendance-modal{{ $media->id }}" data-modal-toggle="detail-attendance-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalAttendance{{ $media->id }} = true">Rename</button>
                                                                            <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                            @if ($attendancePdfCount > 1)
                                                                            <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                            @else
                                                                            <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                            </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                                <div id="attendance-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                    <!-- Modal content -->
                                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                        <!-- Modal header -->
                                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                            <h3 class="text-md font-semibold text-gray-600">
                                                                                {{ $media->file_name }}
                                                                            </h3>
                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="attendance-media-modal{{ $media->id}}">
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
                                                        @endif
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder  flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-attendance', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'AttendanceMonitoring')
                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                            <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-attendancemonitoring" data-modal-toggle="default-modal-attendancemonitoring" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">Attendance Monitoring Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-attendancemonitoring" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                            Attendance Monitoring Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-attendancemonitoring">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption" style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>
                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                        @foreach ($proposals->medias as $media)
                                                        @if ($media->collection_name == 'AttendanceMonitoring')

                                                            <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                                <!-- Modal toggle -->
                                                                <button data-modal-target="attendancemonitoring-media-modal{{ $media->id}}" data-modal-toggle="attendancemonitoring-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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
                                                                <div x-cloak  x-data="{ 'showModalAttendanceM{{ $media->id }}': false }" @keydown.escape="showModalAttendanceM{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                                    <!-- Modal -->
                                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalAttendanceM{{ $media->id }}">

                                                                        <!-- Modal inner -->
                                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalAttendanceM{{ $media->id }}"
                                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalAttendanceM{{ $media->id }} = true">

                                                                            <!-- Title / Close-->
                                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalAttendanceM{{ $media->id }} = false">
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
                                                                    <div id="detail-attendancemonitoring-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                            <!-- Modal content -->
                                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                                <!-- Modal header -->
                                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                                    <h3 class="text-xl font-semibold text-white">
                                                                                        Details
                                                                                    </h3>
                                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-attendancemonitoring-modal{{ $media->id }}">
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
                                                                                        Report Type: Attendance Monitoring
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
                                                                                        Username uploader:
                                                                                        @foreach ($users as $user )
                                                                                            @if ($media->name == $user->id)
                                                                                                {{ $user->name }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </p>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                    <div class="checkbox-wrapper-12">
                                                                        <div class="cbx">
                                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                        <label for="cbx-12"></label>
                                                                        <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                        </svg>
                                                                        </div>

                                                                        {{--  <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <defs>
                                                                            <filter id="goo-12">
                                                                            <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                                                            <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                                                            <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                                                            </filter>
                                                                        </defs>
                                                                        </svg>  --}}
                                                                    </div>

                                                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                                        <!-- Dropdown toggle button -->
                                                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
                                                                            <svg class=" absolute hover:fill-blue-600 top-2 right-0 fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                                        </button>
                                                                        <!-- Dropdown list -->
                                                                        <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                            <button data-modal-target="detail-attendancemonitoring-modal{{ $media->id }}" data-modal-toggle="detail-attendancemonitoring-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalAttendanceM{{ $media->id }} = true">Rename</button>
                                                                            <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                            @if ($attendancemPdfCount > 1)
                                                                            <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                            @else
                                                                            <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                            </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                                <div id="attendancemonitoring-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                                    <!-- Modal content -->
                                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                        <!-- Modal header -->
                                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                            <h3 class="text-md font-semibold text-gray-600">
                                                                                {{ $media->file_name }}
                                                                            </h3>
                                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="attendancemonitoring-media-modal{{ $media->id}}">
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

                                                        @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder  flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-attendancem', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'NarrativeFile')

                                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                            <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-narrative" data-modal-toggle="default-modal-narrative" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">Narrative Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-narrative" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                            Narrative Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-narrative">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption" style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>
                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                            @foreach ($proposals->medias as $media)
                                                            @if ($media->collection_name == 'NarrativeFile')
                                                                <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
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
                                                                                            File type: {{ $proposalfile->mime_type }}
                                                                                        </p>

                                                                                        <p class="text-sm leading-relaxed text-white">
                                                                                            Username uploader:
                                                                                            @foreach ($users as $user )
                                                                                                @if ($media->name == $user->id)
                                                                                                    {{ $user->name }}
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </p>

                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                        <div class="checkbox-wrapper-12">
                                                                        <div class="cbx">
                                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                        <label for="cbx-12"></label>
                                                                        <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                        </svg>
                                                                        </div>

                                                                        {{--  <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <defs>
                                                                            <filter id="goo-12">
                                                                            <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                                                            <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                                                            <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                                                            </filter>
                                                                        </defs>
                                                                        </svg>  --}}
                                                                    </div>

                                                                        <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                                            <!-- Dropdown toggle button -->
                                                                            <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
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
                                                                                @if ($narrativePdfCount > 1)
                                                                            <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                            @else
                                                                            <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                            </form>
                                                                            @endif
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
                                                                @endif
                                                            @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder  flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                        <a href={{ route('inventory-download-narrative', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($proposalfile->collection_name == 'TerminalFile')
                                    <div class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="folder_id{{$proposalfile->uuid}}">

                                            <div class=" absolute top-1 right-1">
                                            <div class="checkbox-wrapper-12">
                                                <div class="cbx">
                                                <input type="checkbox" class="hidden-checkbox-folder " name="ids" value="{{ $proposalfile->uuid }}" style="display:none">
                                                <label for="cbx-12"></label>
                                                <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                </svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-terminal" data-modal-toggle="default-modal-terminal" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            <span class="text-xs mt-4">Terminal Folder</span>
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-terminal" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                            Terminal Folder
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-terminal">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="flex flex-row space-x-1 p-2 showOption" style="display: none">
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                                                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                                                    </div>
                                                    <div class="p-4 grid grid-cols-3 gap-3">

                                                        @foreach ($proposals->medias as $media)
                                                        @if ($media->collection_name == 'TerminalFile')

                                                            <div class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
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
                                                                                        Username uploader:
                                                                                        @foreach ($users as $user )
                                                                                            @if ($media->name == $user->id)
                                                                                                {{ $user->name }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </p>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{--  <input type="checkbox" class="hidden-checkbox absolute top-0 right-0" style="display:none" name="ids" value="{{ $media->id }}">  --}}

                                                                    <div class="checkbox-wrapper-12">
                                                                        <div class="cbx">
                                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display:none">
                                                                        <label for="cbx-12"></label>
                                                                        <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                                        </svg>
                                                                        </div>

                                                                        {{--  <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                                        <defs>
                                                                            <filter id="goo-12">
                                                                            <feGaussianBlur result="blur" stdDeviation="4" in="SourceGraphic"></feGaussianBlur>
                                                                            <feColorMatrix result="goo-12" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" mode="matrix" in="blur"></feColorMatrix>
                                                                            <feBlend in2="goo-12" in="SourceGraphic"></feBlend>
                                                                            </filter>
                                                                        </defs>
                                                                        </svg>  --}}
                                                                    </div>

                                                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">

                                                                        <!-- Dropdown toggle button -->
                                                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons  flex items-center p-2 rounded-md" style="display: block">
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
                                                                            @if ($terminalPdfCount > 1)
                                                                            <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                                            @else
                                                                            <form action={{ route('inventory-trash-media', $media->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                            </form>
                                                                            @endif
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
                                                            @endif
                                                            @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div type="button">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0 top-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons-folder  flex items-center p-2 rounded-md" style="display: block">
                                                        <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                                        <a href={{ route('inventory-download-terminal', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                        <button class="TrashButton block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left">Trash</button>
                                                    </div>
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
        @endif
    </section>

    <x-messages />

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

     // Delete By Folder
     document.addEventListener('DOMContentLoaded', function () {

        var toggleAllButtons = document.getElementById('SelectFolder');
        var deleteSelectedButtons = document.getElementById('TrashFolder');

        toggleAllButtons.addEventListener('click', function () {
            // Get all checkboxes within the folder
            var checkboxes = document.querySelectorAll('.hidden-checkbox-folder');

            // Check if all checkboxes are checked within the folder
            var allChecked = Array.from(checkboxes).every(function (checkbox) {
                return checkbox.checked;
            });

            // Toggle the checked state of all checkboxes within the folder
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = !allChecked;
            });
        });

        deleteSelectedButtons.addEventListener('click', function () {
                // Filter out the checked checkboxes

                var checkedCheckboxes = Array.from(document.querySelectorAll('.hidden-checkbox-folder:checked'));

                // Create an array to store the IDs of checked checkboxes
                var all_ids = checkedCheckboxes.map(function (checkbox) {
                    return checkbox.value;
                });

                if (all_ids.length > 0 ) {
                    // Perform deletion logic for the checked checkboxes
                    if (confirm('Are you sure you want to move this to trash?')) {

                        $.ajax({
                            url: "{{ route('inventory.trash-folder-media-json') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                checkedCheckboxes.forEach(function (checkbox) {
                                    // Replace 'proposal_id' with the appropriate ID prefix
                                    $('#folder_id' + checkbox.value).remove();

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

        var TrashButtonFolder = document.querySelectorAll('.TrashButton');

        TrashButtonFolder.forEach(function (button) {

            button.addEventListener('click', function () {

                var hiddenCheckFolder = document.querySelectorAll('.hidden-checkbox-folder');
                var dropdownButtonFolder = document.querySelectorAll('.dropdownButtons-folder');
                var showOptionFold = document.getElementById('showOptionFolder');

                showOptionFold.style.display = 'block';


                hiddenCheckFolder.forEach(function (checkbox) {
                    if (checkbox.style.display === 'none' || checkbox.style.display === '') {
                        checkbox.style.display = 'block';
                    } else {
                        checkbox.style.display = 'none';
                    }
                });

                dropdownButtonFolder.forEach(function (button) {
                    if (button.style.display === 'block' ) {
                        button.style.display = 'none';
                    } else {
                        button.style.display = 'block';
                    }
                });
            });
        });

        var cancelFolders = document.getElementById('CancelFolder');

        cancelFolders.addEventListener('click', function () {

            var hiddenCheckFolder = document.querySelectorAll('.hidden-checkbox-folder');
            var dropdownButtonFolder = document.querySelectorAll('.dropdownButtons-folder');
            var showOptionFold = document.getElementById('showOptionFolder');


            showOptionFold.style.display = 'none';

            hiddenCheckFolder.forEach(function(checkbox) {
                checkbox.checked = false;
            });

            hiddenCheckFolder.forEach(function (checkbox) {
                if (checkbox.style.display === 'block' ) {
                    checkbox.style.display = 'none';
                } else {
                    checkbox.style.display = 'block';
                }
            });

            dropdownButtonFolder.forEach(function (button) {
                if (button.style.display === 'none' ) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });

        });

        var ButtonModals = document.querySelectorAll('.buttonModal');

        ButtonModals.forEach(function (button) {

            button.addEventListener('click', function () {

                var hiddenCheckFolder = document.querySelectorAll('.hidden-checkbox-folder');
                var dropdownButtonFolder = document.querySelectorAll('.dropdownButtons-folder');
                var showOptionFold = document.getElementById('showOptionFolder');



                if (showOptionFolder.style.display === 'block') {
                    showOptionFolder.style.display = 'none';
                }

                hiddenCheckFolder.forEach(function(checkbox) {
                    checkbox.checked = false;
                });



                hiddenCheckFolder.forEach(function (checkbox) {
                    if (checkbox.style.display === 'block') {
                        checkbox.style.display = 'none';
                    }
                });

                dropdownButtonFolder.forEach(function (button) {
                    if (button.style.display === 'none' ) {
                        button.style.display = 'block';
                    }
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {


        // Get the toggle all button
        var toggleAllButton = document.querySelectorAll('.selectAll');
        var deleteSelectedButton = document.querySelectorAll('.YesDelete');

        // Get all checkboxes inside the foreach loop
        var checkboxes = document.querySelectorAll('.hidden-checkbox');

        // Add click event listener to the toggle all buttons
        toggleAllButton.forEach(function (button) {
            button.addEventListener('click', function () {
                // Find the parent folder of the button
                var folder = button.closest('.folder');
                if (!folder) {
                    return; // No folder found, exit the function
                }

                // Get all checkboxes within the folder
                var checkboxes = folder.querySelectorAll('.hidden-checkbox');

                // Check if all checkboxes are checked within the folder
                var allChecked = Array.from(checkboxes).every(function (checkbox) {
                    return checkbox.checked;
                });

                // Toggle the checked state of all checkboxes within the folder
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = !allChecked;
                });
            });
        });


        deleteSelectedButton.forEach(function (button) {

            button.addEventListener('click', function () {
                // Filter out the checked checkboxes


                var checkedCheckboxes = Array.from(document.querySelectorAll('.hidden-checkbox:checked'));


                // Create an array to store the IDs of checked checkboxes
                var all_ids = checkedCheckboxes.map(function (checkbox) {
                    return checkbox.value;
                });


                if (all_ids.length > 0 ) {
                    // Perform deletion logic for the checked checkboxes
                    if (confirm('Are you sure you want to move this to trash?')) {

                        $.ajax({
                            url: "{{ route('inventory.trash-media-json') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                checkedCheckboxes.forEach(function (checkbox) {
                                    // Replace 'proposal_id' with the appropriate ID prefix
                                    $('#media_id' + checkbox.value).remove();
                                    $('#mediaLibrary' + checkbox.value).remove();
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

    });


    document.addEventListener('DOMContentLoaded', function () {
        // Get the delete all button
        var deleteAllButton = document.querySelectorAll('.deleteAllButton');

        deleteAllButton.forEach(function (button) {

            button.addEventListener('click', function () {


                var hiddenCheckboxes = document.querySelectorAll('.hidden-checkbox');
                var dropdownButton = document.querySelectorAll('.dropdownButtons');
                var showOptions = document.querySelectorAll('.showOption');

                showOptions.forEach(function (option) {
                    if (option.style.display === 'none' || option.style.display === '') {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });

                hiddenCheckboxes.forEach(function (checkbox) {
                    if (checkbox.style.display === 'none' || checkbox.style.display === '') {
                        checkbox.style.display = 'block';
                    } else {
                        checkbox.style.display = 'none';
                    }
                });

                dropdownButton.forEach(function (button) {
                    if (button.style.display === 'block' ) {
                        button.style.display = 'none';
                    } else {
                        button.style.display = 'block';
                    }
                });
            });
        });

        var cancelButton = document.querySelectorAll('.cancelButton');

        cancelButton.forEach(function (canbutton) {
            canbutton.addEventListener('click', function () {

            var hiddenCheckbox = document.querySelectorAll('.hidden-checkbox');
            var tooltipButtons = document.querySelectorAll('.dropdownButtons');
            var showOptions = document.querySelectorAll('.showOption');

                showOptions.forEach(function (option) {
                    if (option.style.display === 'block') {
                        option.style.display = 'none';
                    }
                });

            hiddenCheckbox.forEach(function(checkbox) {
                checkbox.checked = false;
            });

            hiddenCheckbox.forEach(function (checkbox) {
                if (checkbox.style.display === 'block' ) {
                    checkbox.style.display = 'none';
                } else {
                    checkbox.style.display = 'block';
                }
            });

            tooltipButtons.forEach(function (button) {
                if (button.style.display === 'none' ) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });

            });
        });

        var CloseButton = document.querySelectorAll('.CloseButton');

        CloseButton.forEach(function (buttons) {

            buttons.addEventListener('click', function () {

                var hiddenCheckboxes = document.querySelectorAll('.hidden-checkbox');
                var dropdownButtons = document.querySelectorAll('.dropdownButtons');
                var showOptions = document.querySelectorAll('.showOption');

                showOptions.forEach(function (option) {
                    if (option.style.display === 'block') {
                        option.style.display = 'none';
                    } else {
                        option.style.display = 'block';
                    }
                });

                hiddenCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });


                hiddenCheckboxes.forEach(function (checkbox) {
                    if ( checkbox.style.display = 'block') {
                        checkbox.style.display = 'none';
                    }else {
                        checkbox.style.display = 'none';
                    }
                });

                dropdownButtons.forEach(function (button) {
                    if (button.style.display === 'none' ) {
                        button.style.display = 'block';
                    } else {
                        button.style.display = 'block';
                    }
                });
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' || event.keyCode === 27) {

                var hiddenCheckboxes = document.querySelectorAll('.hidden-checkbox');
                var dropdownButtons = document.querySelectorAll('.dropdownButtons');

                hiddenCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });

                var showOptions = document.querySelectorAll('.showOption');

                showOptions.forEach(function (option) {
                    if (option.style.display === 'block') {
                        option.style.display = 'none';
                    } else {
                        option.style.display = 'block';
                    }
                });


                hiddenCheckboxes.forEach(function (checkbox) {
                    if ( checkbox.style.display = 'block') {
                        checkbox.style.display = 'none';
                    }else {
                        checkbox.style.display = 'none';
                    }
                });

                dropdownButtons.forEach(function (button) {
                    if (button.style.display === 'none' ) {
                        button.style.display = 'block';
                    } else {
                        button.style.display = 'block';
                    }
                });
            }
        });


        // Array of modal IDs
        var modalIds = ['default-modal-proposal', 'default-modal-otherfile', 'default-modal-moa','default-modal-travelorder'
                       ,'default-modal-specialorder','default-modal-officeorder','default-modal-attendance','default-modal-attendancemonitoring'
                       ,'default-modal-narrative','default-modal-terminal'];

        // Function to handle clicks on the modal
        function handleClickOnModal(event) {
            // Loop through each modal ID
            modalIds.forEach(function(modalId) {
                var modal = document.getElementById(modalId);
                if (modal && event.target === modal) {
                    // Clicked on a modal
                    console.log('Clicked on modal with ID:', modalId);
                    var inputchecks = document.querySelectorAll('.hidden-checkbox');
                    var dropButtons = document.querySelectorAll('.dropdownButtons');
                    var showOptions = document.querySelectorAll('.showOption');

                    inputchecks.forEach(function(checkboxes) {
                        checkboxes.checked = false;
                    });

                    showOptions.forEach(function (option) {
                        if (option.style.display === 'block') {
                            option.style.display = 'none';
                        }
                    });


                    inputchecks.forEach(function (checkboxex) {
                        if ( checkboxex.style.display = 'block') {
                            checkboxex.style.display = 'none';
                        }else {
                            checkboxex.style.display = 'none';
                        }
                    });

                    dropButtons.forEach(function (buttons) {
                        if (buttons.style.display === 'none' ) {
                            buttons.style.display = 'block';
                        } else {
                            buttons.style.display = 'block';
                        }
                    });
                }
            });
        }

        // Loop through each modal ID and attach the event listener
        modalIds.forEach(function(modalId) {
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.addEventListener('click', handleClickOnModal);
            }
        });
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
            var proposalId = {{ $proposals->id ?? 'null' }};
            $.ajax({
                url: '/api/update-data/' + proposalId,
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
        $('#myStatusDropdown').on('change', function() {
            var selectedValue = $(this).val();
            var proposalId = {{ $proposals->id ?? 'null' }};
            $.ajax({
                url: '/api/update-data/' + proposalId,
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

    $('input[type=file]').on('input', function() {
        var allFilesEmpty = true;

        // Iterate over all file inputs
        $('input[type=file]').each(function() {
            if ($(this).val() !== '') {
                allFilesEmpty = false;
                return false; // exit the loop early if any file input has a value
            }
        });

        // Set the disabled property of the button based on the condition
        $('#upload-file').prop('disabled', allFilesEmpty);
    });

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
    function displayOtherFileNames(input) {
        // Get the selected files
        var files = input.files;

        // Get the container where you want to display file names
        var container = document.getElementById('file-othernames-container');

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
    function displayAttendanceMFileNames(input) {
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
</script>

</x-admin-layout>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
