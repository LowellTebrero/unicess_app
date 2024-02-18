    <style>
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
    <div class="pl-5 py-2 space-x-2 flex justify-start">
        {{--  Upload  --}}
        <button data-modal-target="modal-upload-documents" data-modal-toggle="modal-upload-documents" class="px-2 py-2 bg-white border border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
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
                    <form action={{ route('inventroy-update-user-proposal', $proposals->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')">
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
                                <label class="text-xs font-light tracking-wider mb-1">Attendance <span class="text-xs">(Multiple Files)</span></label>
                                <input type="file" multiple  class="border text-xs" name="attendance[]" onchange="displayAttendanceFileNames(this)">
                                @error('attendance')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                <div id="file-attendance-container" class="text-xs mt-1 font-thin"></div>
                            </div>
                            <div class="flex flex-col  mb-1 w-full">
                                <label class="text-xs font-light tracking-wider mb-1">Attendance Monitoring <span class="text-xs">(Multiple Files)</span></label>
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

        {{--  Download  --}}
        <a class="border-blue-600 bg-white border px-2 py-2 rounded-xl text-blue-600 text-xs  2xl:text-xs flex hover:bg-blue-600 hover:text-white"
            href={{ url('download', $proposals->id) }}>
            <svg class=" mr-1" xmlns="http://www.w3.org/2000/svg" height="15"
                viewBox="0 96 960 960" width="20">
                <path fill="currentColor"
                    d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z" />
            </svg>
            Download this Project
        </a>

        {{--  Proposal Detail  --}}
        <div x-cloak  x-data="{ 'showModal{{ $proposals->id }}': false }" @keydown.escape="showModal{{ $proposals->id }} = false">

            <button class="hover:bg-blue-600 hover:text-white p-2 bg-white border border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" type="button" @click="showModal{{ $proposals->id }} = true">
                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 36 36"><path fill="currentColor" d="M32 6H4a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h28a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2m0 22H4V8h28Z" class="clr-i-outline clr-i-outline-path-1"/><path fill="currentColor" d="M9 14h18a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2" class="clr-i-outline clr-i-outline-path-2"/><path fill="currentColor" d="M9 18h18a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2" class="clr-i-outline clr-i-outline-path-3"/><path fill="currentColor" d="M9 22h10a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2" class="clr-i-outline clr-i-outline-path-4"/><path fill="none" d="M0 0h36v36H0z"/></svg>
                Project Details
            </button>

            <!-- Modal -->
            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal{{ $proposals->id }}">

                <!-- Modal inner -->
                <div class="w-[40rem] py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal{{ $proposals->id }}"
                    x-transition:enter="motion-safe:ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal{{ $proposals->id }} = false">

                    <!-- Title / Close-->
                    <div class="flex items-center justify-between px-4 py-1">
                        <h1 class="text-xs"> {{ Str::limit($proposals->project_title, 70) }}</h1>
                        <button type="button" class=" z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1  text-xl font-semibold" @click="showModal{{ $proposals->id }} = false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <hr>

                    <!-- content -->
                    <div class="p-5">
                        <div class="space-y-2">
                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Project ID:</label>
                                <h1 class="text-xs">{{ $proposals->uuid }}</h1>
                            </div>
                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Created:</label>
                                <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposals->created_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                            </div>

                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Modified:</label>
                                <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposals->updated_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                            </div>

                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Uploader:</label>
                                <h1 class="text-xs">{{ $proposals->user->name }}</h1>
                            </div>

                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Program name:</label>
                                <h1 class="text-xs">{{ $proposals->programs->program_name }}</h1>
                            </div>

                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Status:</label>
                                <h1 class="text-xs">{{ $proposals->authorize }}</h1>
                            </div>
                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Started date:</label>
                                <h1 class="text-xs tracking-wider">{{ $proposals->started_date == null ? 'No date' :  $proposals->started_date->format('M. d, Y') }}</h1>
                            </div>
                            <div>
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Finished date:</label>
                                <h1 class="text-xs tracking-wider">{{ $proposals->finished_date == null ? 'No date' :  $proposals->finished_date->format('M. d, Y') }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button data-modal-target="modal-track-documents" data-modal-toggle="modal-track-documents" class="px-2 py-2 bg-white border border-blue-600 rounded-xl text-blue-600 text-xs xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex hover:bg-blue-600 hover:text-white" type="button">
            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M88 112a8 8 0 0 1 8-8h80a8 8 0 0 1 0 16H96a8 8 0 0 1-8-8m8 40h80a8 8 0 0 0 0-16H96a8 8 0 0 0 0 16m136-88v120a24 24 0 0 1-24 24H32a24 24 0 0 1-24-23.89V88a8 8 0 0 1 16 0v96a8 8 0 0 0 16 0V64a16 16 0 0 1 16-16h160a16 16 0 0 1 16 16m-16 0H56v120a23.84 23.84 0 0 1-1.37 8H208a8 8 0 0 0 8-8Z"/></svg>
                Track Documents
        </button>

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
    </div>


    <script>
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
