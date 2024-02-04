    <style>
        .active-tab {
    /* Add your active styles here */
    background-color: #ffbb00;
    color: #ffffff;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    }
    </style>
<x-app-layout>
    @section('title', 'My Documents | ' . config('app.name', 'UniCESS'))
    @if (Auth::user()->authorize == 'checked')
        @unlessrole('admin|New User')
            @php
            $maxLength = 18; // Adjust the maximum length as needed
            @endphp

            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <?php flash()->addError($error); ?>
            @endforeach
            @endif

            <section class="bg-white rounded-lg h-[82vh] 2xl:h-[87vh] mt-4 2xl:mt-5 m-8 text-slate-700">

                <header class="p-4 flex justify-between sm:flex-col space-y-2 sm:space-y-0 md:flex-row flex-col space-x-0">
                    <h1 class="font-semibold tracking-wider sm:text-xl xl:text-2xl text-slate-700 text-base">My Documents Overview</h1>
                </header>
                <hr>

            <div class="p-5">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
                    <li class="me-2"  id="tab-travel">
                        <a href="#" onclick="showTab('travel')" aria-current="page"  class="inline-block p-4 rounded-t-lg ">Travel Order</a>
                    </li>
                    <li class="me-2"  id="tab-special">
                        <a href="#" onclick="showTab('special')"  class="inline-block p-4 rounded-t-lg">Special Order</a>
                    </li>
                    <li class="me-2"  id="tab-office">
                        <a href="#" onclick="showTab('office')"  class="inline-block p-4 rounded-t-lg">Office Order</a>
                    </li>
                    <li class="me-2"  id="tab-attendance">
                        <a href="#" onclick="showTab('attendance')"  class="inline-block p-4 rounded-t-lg">Attendance</a>
                    </li>
                    <li class="me-2"  id="tab-attendancem">
                        <a href="#" onclick="showTab('attendancem')"  class="inline-block p-4 rounded-t-lg">Attendance Monitoring</a>
                    </li>
                    <li class="me-2"  id="tab-narrative">
                        <a href="#" onclick="showTab('narrative')"  class="inline-block p-4 rounded-t-lg">Narrative Report</a>
                    </li>
                    <li class="me-2"  id="tab-terminal">
                        <a href="#"  onclick="showTab('terminal')" class="inline-block p-4 rounded-t-lg">Terminal Report</a>
                    </li>
                </ul>

            </div>



            <div id="travel-content"  class="tab-content border rounded-lg m-4 p-2" style="display: none;">
                <h1 class="text-lg font-medium mb-2 ml-2">Travel Order</h1>
                <div class="overflow-x-auto h-[40vh] 2xl:h-[60vh] ">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
                                <div class="flex space-x-2 items-center justify-center text-gray-500">
                                    <h1 class="text-xs 2xl:text-sm">It’s empty here</h1>
                                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="currentColor" d="M8.5 8.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2m.303 2.5c-1.274 0-2.52.377-3.58 1.084a.5.5 0 0 0 .554.832A5.454 5.454 0 0 1 12.803 13h.797a.5.5 0 0 0 0-1zM2 10a8 8 0 1 1 16 0a8 8 0 0 1-16 0m8-7a7 7 0 1 0 0 14a7 7 0 0 0 0-14"/></svg>
                                </div>
                                @else
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-4 py-3">Uploaded</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Extension Program/Project Title</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Status</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 w-[20rem]">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if ($proposals == null)
                            <tr>
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Project</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal)
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

                                    @foreach ($proposal->proposalfiles as $proposalfile )
                                        @if (($proposalfile->document_type == 'travelorder') != null)
                                        <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-xs ">

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                                </a>
                                            </td>

                                            <td class="2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ Str::limit($proposal->project_title, 100)}}
                                                </a>
                                            </td>

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'travelorder') == null)
                                                <div class="text-md  text-red-400">pending</div>
                                                @else
                                                <div class="text-md  text-green-500">uploaded</div>
                                                @endif

                                            </td>

                                            <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'travelorder') == null)
                                                    <button data-modal-target="default-upload-modal-travelorder{{ $proposal->id }}" data-modal-toggle="default-upload-modal-travelorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Upload Travel Order
                                                    </button>
                                                    @else
                                                    <button data-modal-target="default-already-uploaded-travelorder{{ $proposal->id }}" data-modal-toggle="default-already-uploaded-travelorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Show Travel Order
                                                    </button>
                                                @endif

                                                <!-- Already uploaded modal -->
                                                <div id="default-already-uploaded-travelorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-[80%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-x-auto">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-700 dark:border-gray-600 z-10 sticky top-0">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Show Travel Order Files
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-already-uploaded-travelorder{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                                                                @if (($proposalfile->document_type == 'travelorder') != null)
                                                                    @foreach ($proposalfile->medias as $mediaLibrary)
                                                                    <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                                        <x-alpine-modal>
                                                                            <x-slot name="scripts">
                                                                                <div class="flex items-center p-4 space-x-2" target="__blank">
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
                                                                                            <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                            <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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
                                                                                <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                    <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                    <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                    <form action={{ route('report-travelorder.trash', [ 'id' => $mediaLibrary->id, 'travelOrderId' => $proposalfile->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to trash</button>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 absolute w-full bottom-0 z-10 bg-gray-700">
                                                                <button data-modal-hide="default-already-uploaded-travelorder{{ $proposal->id }}" data-modal-target="default-update-modal-travelorder{{ $proposal->id }}"  data-modal-toggle="default-update-modal-travelorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                    Add File(s)
                                                                </button>
                                                                <button data-modal-hide="default-already-uploaded-travelorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Update Travel order modal -->
                                                <div id="default-update-modal-travelorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Add Travel Order File
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-update-modal-travelorder{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <form action={{ route('report-travelorder.update', $proposalfile->id) }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Upload your file here.
                                                                    </label>
                                                                    <input type="file" multiple name="travelorder_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUpdateTravelFileNames(this)"/>
                                                                    <div id="file-travelupdate-container" class="text-xs mt-1 font-thin text-white"></div>
                                                                    @error('travelorder_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-toggle="default-already-uploaded-travelorder{{ $proposal->id }}" data-modal-hide="default-update-modal-travelorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload modal -->
                                                <div id="default-upload-modal-travelorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Upload Travel Order
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-upload-modal-travelorder{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <form action={{ route('report-travelorder.store') }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Travel Order
                                                                    </label>
                                                                    <input type="file" multiple name="travelorder_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border"  onchange="displayUploadTravelFileNames(this)"  />
                                                                    <div id="file-travelupload-container" class="text-xs mt-1 font-thin text-white"></div>
                                                                    @error('travelorder_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-hide="default-upload-modal-travelorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach

                                @endif
                            @endforeach
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="special-content"  class="tab-content border rounded-lg m-4 p-2" style="display: none;">
                <h1 class="text-lg font-medium mb-2 ml-2">Special Order</h1>
                <div class="overflow-x-auto h-[40vh] 2xl:h-[60vh] ">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
                                <div class="flex space-x-2 items-center justify-center text-gray-500">
                                    <h1 class="text-xs 2xl:text-sm">It’s empty here</h1>
                                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="currentColor" d="M8.5 8.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2m.303 2.5c-1.274 0-2.52.377-3.58 1.084a.5.5 0 0 0 .554.832A5.454 5.454 0 0 1 12.803 13h.797a.5.5 0 0 0 0-1zM2 10a8 8 0 1 1 16 0a8 8 0 0 1-16 0m8-7a7 7 0 1 0 0 14a7 7 0 0 0 0-14"/></svg>
                                </div>
                                @else
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-4 py-3">Uploaded</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Extension Program/Project Title</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Status</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 w-[20rem]">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if ($proposals == null)
                            <tr>
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Project</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

                                    @foreach ($proposal->proposalfiles as $proposalfile )
                                    @if (($proposalfile->document_type == 'specialorder') != null)
                                        <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-xs ">

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                                </a>
                                            </td>

                                            <td class="2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ Str::limit($proposal->project_title, 100)}}
                                                </a>
                                            </td>

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'specialorder') == null)
                                                <div class="text-md  text-red-400">pending</div>
                                                @else
                                                <div class="text-md  text-green-500">uploaded</div>
                                                @endif

                                            </td>

                                            <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'specialorder') == null)
                                                    <button data-modal-target="default-upload-modal-specialorder{{ $proposal->id }}" data-modal-toggle="default-upload-modal-specialorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Upload Special Order
                                                    </button>
                                                    @else
                                                    <button data-modal-target="default-already-uploaded-specialorder{{ $proposal->id }}" data-modal-toggle="default-already-uploaded-specialorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Show Special Order
                                                    </button>
                                                @endif

                                                <!-- Already uploaded modal -->
                                                <div id="default-already-uploaded-specialorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-[80%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-x-auto">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-700 dark:border-gray-600 z-10 sticky top-0">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Show Special Order Files
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-already-uploaded-specialorder{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                                <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                                                                    @if (($proposalfile->document_type == 'specialorder') != null)
                                                                    @foreach ($proposalfile->medias as $mediaLibrary)
                                                                        <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                                            <x-alpine-modal>
                                                                                <x-slot name="scripts">
                                                                                    <div class="flex items-center p-4 space-x-2" target="__blank">
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
                                                                                                <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                                <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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
                                                                                    <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                        <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                        <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                        <form action={{ route('report-specialorder.delete',[ 'id' => $mediaLibrary->id, 'specialOrderId' => $proposalfile->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                                                        </form>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 absolute w-full bottom-0 z-10 bg-gray-700">
                                                                    <button data-modal-hide="default-already-uploaded-specialorder{{ $proposal->id }}" data-modal-target="default-update-modal-specialorder{{ $proposal->id }}"  data-modal-toggle="default-update-modal-specialorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                        Add File(s)
                                                                    </button>
                                                                    <button data-modal-hide="default-already-uploaded-specialorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                                <!-- Update Special modal -->
                                                <div id="default-update-modal-specialorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Add special Order File
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-update-modal-specialorder{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <form action={{ route('report-specialorder.update', $proposalfile->id) }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Upload your file here.
                                                                    </label>
                                                                    <input type="file" multiple name="specialorder_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUpdateSpecialFileNames(this)" />
                                                                    <div id="file-updatespecial-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('specialorder_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-toggle="default-already-uploaded-specialorder{{ $proposal->id }}" data-modal-hide="default-update-modal-specialorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload modal -->
                                                <div id="default-upload-modal-specialorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Upload Special Order
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-upload-modal-narrative{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <form action={{ route('report-specialorder.store') }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Special Order
                                                                    </label>
                                                                    <input type="file" multiple name="specialorder_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUploadSpecialFileNames(this)"/>
                                                                    <div id="file-uploadspecial-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('specialorder_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-hide="default-upload-modal-specialorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="office-content"  class="tab-content border rounded-lg m-4 p-2" style="display: none;">
                <h1 class="text-lg font-medium mb-2 ml-2">Office Order</h1>
                <div class="overflow-x-auto h-[40vh] 2xl:h-[60vh] ">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
                                <div class="flex space-x-2 items-center justify-center text-gray-500">
                                    <h1 class="text-xs 2xl:text-sm">It’s empty here</h1>
                                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="currentColor" d="M8.5 8.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2m.303 2.5c-1.274 0-2.52.377-3.58 1.084a.5.5 0 0 0 .554.832A5.454 5.454 0 0 1 12.803 13h.797a.5.5 0 0 0 0-1zM2 10a8 8 0 1 1 16 0a8 8 0 0 1-16 0m8-7a7 7 0 1 0 0 14a7 7 0 0 0 0-14"/></svg>
                                </div>
                                @else
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-4 py-3">Uploaded</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Extension Program/Project Title</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Status</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 w-[20rem]">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if ($proposals == null)
                            <tr>
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Project</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

                                    @foreach ($proposal->proposalfiles as $proposalfile )
                                    @if (($proposalfile->document_type == 'officeorder') != null)
                                    <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-xs ">

                                        <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                            <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                            </a>
                                        </td>

                                        <td class="2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                            <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                {{ Str::limit($proposal->project_title, 100)}}
                                            </a>
                                        </td>

                                        <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                             @if (($proposalfile->document_type == 'officeorder') == null)
                                            <div class="text-md  text-red-400">pending</div>
                                            @else
                                            <div class="text-md  text-green-500">uploaded</div>
                                            @endif

                                        </td>

                                        <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                             @if (($proposalfile->document_type == 'officeorder') == null)
                                                <button data-modal-target="default-upload-modal-officeorder{{ $proposal->id }}" data-modal-toggle="default-upload-modal-officeorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                    Upload Office Order
                                                </button>
                                                @else
                                                <button data-modal-target="default-already-uploaded-officeorder{{ $proposal->id }}" data-modal-toggle="default-already-uploaded-officeorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                    Show Office Order
                                                </button>
                                            @endif

                                            <!-- Already uploaded modal -->
                                            <div id="default-already-uploaded-officeorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl h-[80%]">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-x-auto">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-700 dark:border-gray-600 z-10 sticky top-0">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Show Office Order  Files
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-already-uploaded-officeorder{{ $proposal->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>

                                                            <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                                                                @if (($proposalfile->document_type == 'officeorder') != null)
                                                                @foreach ($proposalfile->medias as $mediaLibrary)
                                                                    <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                                        <x-alpine-modal>
                                                                            <x-slot name="scripts">
                                                                                <div class="flex items-center p-4 space-x-2" target="__blank">
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
                                                                                            <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                            <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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
                                                                                <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                    <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                    <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                    <form action={{ route('report-officeorder.trash',[ 'id' => $mediaLibrary->id, 'officeOrderId' => $proposalfile->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 absolute w-full bottom-0 z-10 bg-gray-700">
                                                                <button data-modal-hide="default-already-uploaded-officeorder{{ $proposal->id }}" data-modal-target="default-update-modal-officeorder{{ $proposal->id }}"  data-modal-toggle="default-update-modal-officeorder{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                    Add File(s)
                                                                </button>
                                                                <button data-modal-hide="default-already-uploaded-officeorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>

                                            <!-- Update Office modal -->
                                            <div id="default-update-modal-officeorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Add Office Order File
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-update-modal-officeorder{{ $proposal->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>

                                                        <form action={{ route('report-officeorder.update', $proposalfile->id) }} method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                <label class="text-base leading-relaxed text-white">
                                                                Upload your file here.
                                                                </label>
                                                                <input type="file" multiple name="officeorder_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUpdateOfficeFileNames(this)" />
                                                                <div id="file-updateoffice-container" class="text-xs mt-1 font-thin"></div>
                                                                @error('officeorder_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                <button data-modal-toggle="default-already-uploaded-officeorder{{ $proposal->id }}" data-modal-hide="default-update-modal-officeorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Upload modal -->
                                            <div id="default-upload-modal-officeorder{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Upload Office Order
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-upload-modal-narrative{{ $proposal->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <form action={{ route('report-officeorder.store') }} method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                <label class="text-base leading-relaxed text-white">
                                                                Office Order REPORT
                                                                </label>
                                                                <input type="file" multiple name="officeorder_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUploadOfficeFileNames(this)"/>
                                                              <div id="file-uploadoffice-container" class="text-xs mt-1 font-thin"></div>
                                                                @error('officeorder_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                <button data-modal-hide="default-upload-modal-officeorder{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="attendance-content"  class="tab-content border rounded-lg m-4 p-2" style="display: none;">
                <h1 class="text-lg font-medium mb-2 ml-2">Attendance</h1>
                <div class="overflow-x-auto h-[40vh] 2xl:h-[60vh] ">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
                                <div class="flex space-x-2 items-center justify-center text-gray-500">
                                    <h1 class="text-xs 2xl:text-sm">It’s empty here</h1>
                                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="currentColor" d="M8.5 8.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2m.303 2.5c-1.274 0-2.52.377-3.58 1.084a.5.5 0 0 0 .554.832A5.454 5.454 0 0 1 12.803 13h.797a.5.5 0 0 0 0-1zM2 10a8 8 0 1 1 16 0a8 8 0 0 1-16 0m8-7a7 7 0 1 0 0 14a7 7 0 0 0 0-14"/></svg>
                                </div>
                                @else
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-4 py-3">Uploaded</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Extension Program/Project Title</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Status</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 w-[20rem]">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if ($proposals == null)
                            <tr>
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Project</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

                                    @foreach ($proposal->proposalfiles as $proposalfile )
                                        @if (($proposalfile->document_type == 'attendance') != null)
                                        <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-xs ">

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                                </a>
                                            </td>

                                            <td class="2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ Str::limit($proposal->project_title, 100)}}
                                                </a>
                                            </td>

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'attendance') == null)
                                                <div class="text-md  text-red-400">pending</div>
                                                @else
                                                <div class="text-md  text-green-500">uploaded</div>
                                                @endif

                                            </td>

                                            <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'attendance') == null)
                                                    <button data-modal-target="default-upload-modal-attendance{{ $proposal->id }}" data-modal-toggle="default-upload-modal-attendance{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Upload Attendance
                                                    </button>
                                                    @else
                                                    <button data-modal-target="default-already-uploaded-attendance{{ $proposal->id }}" data-modal-toggle="default-already-uploaded-attendance{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Show Attendance
                                                    </button>
                                                @endif

                                                <!-- Already uploaded modal -->
                                                <div id="default-already-uploaded-attendance{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-[80%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-x-auto">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-700 dark:border-gray-600 z-10 sticky top-0">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Show Attendance Files
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-already-uploaded-attendance{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                                <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                                                                    @if (($proposalfile->document_type == 'attendance') != null)
                                                                    @foreach ($proposalfile->medias as $mediaLibrary)
                                                                        <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                                            <x-alpine-modal>
                                                                                <x-slot name="scripts">
                                                                                    <div class="flex items-center p-4 space-x-2" target="__blank">
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
                                                                                                <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                                <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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
                                                                                    <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                        <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                        <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                        <form action={{ route('report-attendance.trash',[ 'id' => $mediaLibrary->id, 'attendanceId' => $proposalfile->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                                        </form>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 absolute w-full bottom-0 z-10 bg-gray-700">
                                                                    <button data-modal-hide="default-already-uploaded-attendance{{ $proposal->id }}" data-modal-target="default-update-modal-attendance{{ $proposal->id }}"  data-modal-toggle="default-update-modal-attendance{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                        Add File(s)
                                                                    </button>
                                                                    <button data-modal-hide="default-already-uploaded-attendance{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                                <!-- Update Attendance modal -->
                                                <div id="default-update-modal-attendance{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Add Attendance File
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-update-modal-attendance{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <form action={{ route('report-attendance.update', $proposalfile->id) }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Upload your file here.
                                                                    </label>
                                                                    <input type="file" multiple name="attendance_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUpdateAttendanceFileNames(this)" />
                                                                    <div id="file-updateattendance-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('attendance_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-toggle="default-already-uploaded-attendance{{ $proposal->id }}" data-modal-hide="default-update-modal-attendance{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload modal -->
                                                <div id="default-upload-modal-attendance{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Upload Attendance Report
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-upload-modal-attendance{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <form action={{ route('report-attendance.store') }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Attendance
                                                                    </label>
                                                                    <input type="file" multiple name="attendance_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUploadeAttendanceFileNames(this)" />
                                                                    <div id="file-uploadattendance-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('attendance_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-hide="default-upload-modal-attendance{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                 @endif
                            @endforeach
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="attendancem-content"  class="tab-content border rounded-lg m-4 p-2" style="display: none;">
                <h1 class="text-lg font-medium mb-2 ml-2">Attendance Monitoring</h1>
                <div class="overflow-x-auto h-[40vh] 2xl:h-[60vh] ">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
                                <div class="flex space-x-2 items-center justify-center text-gray-500">
                                    <h1 class="text-xs 2xl:text-sm">It’s empty here</h1>
                                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="currentColor" d="M8.5 8.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2m.303 2.5c-1.274 0-2.52.377-3.58 1.084a.5.5 0 0 0 .554.832A5.454 5.454 0 0 1 12.803 13h.797a.5.5 0 0 0 0-1zM2 10a8 8 0 1 1 16 0a8 8 0 0 1-16 0m8-7a7 7 0 1 0 0 14a7 7 0 0 0 0-14"/></svg>
                                </div>
                                @else
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-4 py-3">Uploaded</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Extension Program/Project Title</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Status</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 w-[20rem]">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if ($proposals == null)
                            <tr>
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Project</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

                                    @foreach ($proposal->proposalfiles as $proposalfile )
                                    @if (($proposalfile->document_type == 'attendancem') != null)
                                        <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-xs ">

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                                </a>
                                            </td>

                                            <td class="2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ Str::limit($proposal->project_title, 100)}}
                                                </a>
                                            </td>

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">
                                                @if (($proposalfile->document_type == 'attendancem') == null)
                                                <div class="text-md  text-red-400">pending</div>
                                                @else
                                                <div class="text-md  text-green-500">uploaded</div>
                                                @endif
                                            </td>

                                            <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'attendancem') == null)
                                                    <button data-modal-target="default-upload-modal-attendancemonitoring{{ $proposal->id }}" data-modal-toggle="default-upload-modal-attendancemonitoring{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Upload Attendance Monitoring
                                                    </button>
                                                    @else
                                                    <button data-modal-target="default-already-uploaded-attendancemonitoring{{ $proposal->id }}" data-modal-toggle="default-already-uploaded-attendancemonitoring{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Show Attendance Monitoring
                                                    </button>
                                                @endif

                                                <!-- Already uploaded modal -->
                                                <div id="default-already-uploaded-attendancemonitoring{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-[80%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-x-auto">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-700 dark:border-gray-600 z-10 sticky top-0">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Show Attendance Monitoring  Files
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-already-uploaded-attendancemonitoring{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                                <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                                                                    @if (($proposalfile->document_type == 'attendancem') != null)
                                                                    @foreach ($proposalfile->medias as $mediaLibrary)
                                                                        <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                                            <x-alpine-modal>
                                                                                <x-slot name="scripts">
                                                                                    <div class="flex items-center p-4 space-x-2" target="__blank">
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
                                                                                                <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                                <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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
                                                                                    <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                        <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                        <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                        <form action={{ route('report-attendancem.trash',[ 'id' => $mediaLibrary->id, 'attendancemId' => $proposalfile->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                                        </form>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 absolute w-full bottom-0 z-10 bg-gray-700">
                                                                    <button data-modal-hide="default-already-uploaded-attendancemonitoring{{ $proposal->id }}" data-modal-target="default-update-modal-attendancemonitoring{{ $proposal->id }}"  data-modal-toggle="default-update-modal-attendancemonitoring{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                        Add File(s)
                                                                    </button>
                                                                    <button data-modal-hide="default-already-uploaded-attendancemonitoring{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                                <!-- Update attendancemonitoring modal -->
                                                <div id="default-update-modal-attendancemonitoring{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Add Attendance Monitoring File
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-update-modal-attendancemonitoring{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <form action={{ route('report-attendancem.update', $proposalfile->id) }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Upload your file here.
                                                                    </label>
                                                                    <input type="file" multiple name="attendancem_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUpdateAttendanceMFileNames(this)" />
                                                                    <div id="file-updateattendancem-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('attendancem_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-toggle="default-already-uploaded-attendancemonitoring{{ $proposal->id }}" data-modal-hide="default-update-modal-attendancemonitoring{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload modal -->
                                                <div id="default-upload-modal-attendancemonitoring{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Upload Attendance Monitoring
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-upload-modal-attendancemonitoring{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <form action={{ route('report-attendancem.store') }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Attendance Monitoring
                                                                    </label>
                                                                    <input type="file" multiple name="attendancem_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUploadeAttendanceMFileNames(this)" />
                                                                    <div id="file-uploadattendancem-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('attendancem_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-hide="default-upload-modal-attendancemonitoring{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="narrative-content"  class="tab-content border rounded-lg m-4 p-2" style="display: none;">
                <h1 class="text-lg font-medium mb-2 ml-2">Narrative Report</h1>
                <div class="overflow-x-auto h-[40vh] 2xl:h-[60vh] ">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
                                <div class="flex space-x-2 items-center justify-center text-gray-500">
                                    <h1 class="text-xs 2xl:text-sm">It’s empty here</h1>
                                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="currentColor" d="M8.5 8.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2m.303 2.5c-1.274 0-2.52.377-3.58 1.084a.5.5 0 0 0 .554.832A5.454 5.454 0 0 1 12.803 13h.797a.5.5 0 0 0 0-1zM2 10a8 8 0 1 1 16 0a8 8 0 0 1-16 0m8-7a7 7 0 1 0 0 14a7 7 0 0 0 0-14"/></svg>
                                </div>
                                @else
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-4 py-3">Uploaded</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Extension Program/Project Title</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Status</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 w-[20rem]">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if ($proposals == null)
                            <tr>
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Project</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)


                                    @foreach ($proposal->proposalfiles as $proposalfile )
                                        @if (($proposalfile->document_type == 'narrativereport') != null)
                                        <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-xs ">

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                                </a>
                                            </td>

                                            <td class="2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                    {{ Str::limit($proposal->project_title, 100)}}
                                                </a>
                                            </td>

                                            <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                 @if (($proposalfile->document_type == 'narrativereport') == null)
                                                <div class="text-md  text-red-400">pending</div>
                                                @else
                                                <div class="text-md  text-green-500">uploaded</div>
                                                @endif

                                            </td>

                                            <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                 @if (($proposalfile->document_type == 'narrativereport') == null)
                                                    <button data-modal-target="default-upload-modal-narrative{{ $proposal->id }}" data-modal-toggle="default-upload-modal-narrative{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Upload Narrative Report
                                                    </button>
                                                    @else
                                                    <button data-modal-target="default-already-uploaded-narrative{{ $proposal->id }}" data-modal-toggle="default-already-uploaded-narrative{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                        Show Narrative
                                                    </button>
                                                @endif

                                                <!-- Already uploaded modal -->
                                                <div id="default-already-uploaded-narrative{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-[80%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-x-auto">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-700 dark:border-gray-600 z-10 sticky top-0">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Show Narrative Files
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-already-uploaded-narrative{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                                <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                                                                    @if (($proposalfile->document_type == 'narrativereport') != null)
                                                                    @foreach ($proposalfile->medias as $mediaLibrary)
                                                                        <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                                            <x-alpine-modal>
                                                                                <x-slot name="scripts">
                                                                                    <div class="flex items-center p-4 space-x-2" target="__blank">
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
                                                                                                <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                                <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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
                                                                                    <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                        <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                        <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                        <form action={{ route('report-narrative.trash',[ 'id' => $mediaLibrary->id, 'narrativeId' => $proposalfile->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                                        </form>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 absolute w-full bottom-0 z-10 bg-gray-700">
                                                                    <button data-modal-hide="default-already-uploaded-narrative{{ $proposal->id }}" data-modal-target="default-update-modal-narrative{{ $proposal->id }}"  data-modal-toggle="default-update-modal-narrative{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                        Add File(s)
                                                                    </button>
                                                                    <button data-modal-hide="default-already-uploaded-narrative{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                                <!-- Update Narrative modal -->
                                                <div id="default-update-modal-narrative{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Add Narrative File
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-update-modal-narrative{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <form action={{ route('report-narrative.update', $proposalfile->id) }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    Upload your file here.
                                                                    </label>
                                                                    <input type="file" multiple name="narrative_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" <div id="file-updatenarrative-container" class="text-xs mt-1 font-thin"></div> />
                                                                    <div id="file-updatenarrative-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('narrative_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-toggle="default-already-uploaded-narrative{{ $proposal->id }}" data-modal-hide="default-update-modal-narrative{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload modal -->
                                                <div id="default-upload-modal-narrative{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Upload Narrative Report
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-upload-modal-narrative{{ $proposal->id }}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <form action={{ route('report-narrative.store') }} method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                    <label class="text-base leading-relaxed text-white">
                                                                    NARRATIVE REPORT
                                                                    </label>
                                                                    <input type="file" multiple name="narrative_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUploadNarrativeFileNames(this)" />
                                                                    <div id="file-uploadnarrative-container" class="text-xs mt-1 font-thin"></div>
                                                                    @error('narrative_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                </div>
                                                                <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                <!-- Modal footer -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                    <button data-modal-hide="default-upload-modal-narrative{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="terminal-content" class="tab-content border rounded-lg m-4 p-2" style="display: none;">
                <h1 class="text-lg font-medium mb-2 ml-2">Terminal Report</h1>
                <div class="overflow-x-auto h-[45vh] 2xl:h-[60vh]">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
                                <div class="flex space-x-2 items-center justify-center text-gray-500">
                                    <h1 class="text-xs 2xl:text-sm">It’s empty here</h1>
                                    <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="currentColor" d="M8.5 8.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0m4 1a1 1 0 1 0 0-2a1 1 0 0 0 0 2m.303 2.5c-1.274 0-2.52.377-3.58 1.084a.5.5 0 0 0 .554.832A5.454 5.454 0 0 1 12.803 13h.797a.5.5 0 0 0 0-1zM2 10a8 8 0 1 1 16 0a8 8 0 0 1-16 0m8-7a7 7 0 1 0 0 14a7 7 0 0 0 0-14"/></svg>
                                </div>

                                @else
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-4 py-3">Uploaded</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Extension Program/Project Title</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3">Status</th>
                                <th scope="col" class="2xl:px-6 xl:px-4 xl:pl-0 py-3 w-[20rem]">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if ($proposals == null)
                            <tr>
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Project</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

                                    @foreach ($proposal->proposalfiles as $proposalfile )
                                        @if (($proposalfile->document_type == 'terminalreport') != null)
                                            <tr class="border-b text-gray-700 bg-white hover:bg-gray-100 text-xs ">

                                                <td class=" 2xl:px-6 xl:px-4 xl:pl-4 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                    <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                        {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A')}}
                                                    </a>
                                                </td>

                                                <td class="2xl:px-6 xl:px-4 xl:pl-0 py-4 xl:text-[.6rem] 2xl:text-[.7rem]">
                                                    <a href={{ route('User-dashboard.show-proposal', $proposal->id) }}>
                                                        {{ Str::limit($proposal->project_title, 100)}}
                                                    </a>
                                                </td>

                                                <td class=" 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'terminalreport') == null)
                                                    <div class="text-md  text-red-400">pending</div>
                                                    @else
                                                    <div class="text-md  text-green-500">uploaded</div>
                                                    @endif

                                                </td>

                                                <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                                @if (($proposalfile->document_type == 'terminalreport') == null)
                                                        <button data-modal-target="default-upload-modal-terminal{{ $proposal->id }}" data-modal-toggle="default-upload-modal-terminal{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                            Upload Terminal Report
                                                        </button>
                                                        @else
                                                        <button data-modal-target="default-already-uploaded-terminal{{ $proposal->id }}" data-modal-toggle="default-already-uploaded-terminal{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                            Show Terminal
                                                        </button>
                                                    @endif

                                                    <!-- Already uploaded modal -->
                                                    <div id="default-already-uploaded-terminal{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-4xl h-[80%]">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 overflow-x-auto h-full">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 sticky top-0 z-10 bg-gray-700">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Show terminal Files
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-already-uploaded-terminal{{ $proposal->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>

                                                                    <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                                                                        @if (($proposalfile->document_type == 'terminalreport') != null)
                                                                        @foreach ($proposalfile->medias as $mediaLibrary)
                                                                            <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                                                <x-alpine-modal>
                                                                                    <x-slot name="scripts">
                                                                                        <div class="flex items-center p-4 space-x-2" target="__blank">
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
                                                                                                    <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                                                    <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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
                                                                                        <div x-show="dropdownMenu" class="z-50 absolute right-5 py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                            <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                                            <form action={{ route('report-terminal.trash',[ 'id' => $mediaLibrary->id, 'terminalId' => $proposalfile->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                                            </form>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                    <!-- Modal footer -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 absolute w-full bottom-0 z-10 bg-gray-700">
                                                                        <button data-modal-hide="default-already-uploaded-terminal{{ $proposal->id }}" data-modal-target="default-update-modal-terminal{{ $proposal->id }}"  data-modal-toggle="default-update-modal-terminal{{ $proposal->id }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                                                            Add File(s)
                                                                        </button>
                                                                        <button data-modal-hide="default-already-uploaded-terminal{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <!-- Update terminal modal -->
                                                    <div id="default-update-modal-terminal{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Add Terminal File
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-update-modal-terminal{{ $proposal->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>

                                                                <form action={{ route('report-terminal.update', $proposalfile->id) }} method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <!-- Modal body -->
                                                                    <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                        <label class="text-base leading-relaxed text-white">
                                                                        Upload your file here.
                                                                        </label>
                                                                        <input type="file" multiple name="terminal_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUpdateTerminalFileNames(this)" />
                                                                        <div id="file-updateterminal-container" class="text-xs mt-1 font-thin"></div>
                                                                        @error('terminal_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                    </div>
                                                                    <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                    <!-- Modal footer -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                        <button data-modal-toggle="default-already-uploaded-terminal{{ $proposal->id }}" data-modal-hide="default-update-modal-terminal{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload modal -->
                                                    <div id="default-upload-modal-terminal{{ $proposal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Upload Terminal Report
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-upload-modal-terminal{{ $proposal->id }}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <form action={{ route('report-terminal.store') }} method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <!-- Modal body -->
                                                                    <div class="p-4 md:p-5 space-y-4 flex flex-col text-white">
                                                                        <label class="text-base leading-relaxed text-white">
                                                                        TERMINAL REPORT
                                                                        </label>
                                                                        <input type="file" multiple name="terminal_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" onchange="displayUploadTerminalFileNames(this)" />
                                                                        <div id="file-uploadterminal-container" class="text-xs mt-1 font-thin"></div>
                                                                        @error('terminal_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                                    </div>
                                                                    <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                                    <!-- Modal footer -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                        <button data-modal-hide="default-upload-modal-terminal{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

            </section>

        @endunlessrole

    @elseif (Auth::user()->authorize == 'close')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                Your account have been declined for some reason, <br> the admin is reviewing your account details
                <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
            </h1>
        </div>

    @elseif (Auth::user()->authorize == 'pending')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                You are not authorize yet, <br> Please fill-out your Profile Information
                <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
            </h1>
        </div>
    @endif



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('selectedTab');
            if (storedTab) {
                // Show the stored tab content
                document.getElementById(storedTab + '-content').style.display = 'block';

                // Add 'active' class to the stored tab (if needed)
                document.querySelector('[onclick="showTab(\'' + storedTab + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-' + storedTab).classList.add('active-tab');
            } else {
                // If no stored tab, show the 'narrative-content' by default
                document.getElementById('narrative-content').style.display = 'block';

                // Add 'active' class to the 'narrative' tab (if needed)
                document.querySelector('[onclick="showTab(\'narrative\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-narrative').classList.add('active-tab');
            }
        });

        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Remove 'active' class from all tabs (if needed)
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Remove 'active-tab' class from all <li> elements (if needed)
            document.querySelectorAll('li').forEach(function (li) {
                li.classList.remove('active-tab');
            });

            // Show the selected tab content
            document.getElementById(tabId + '-content').style.display = 'block';

            // Add 'active' class to the clicked tab (if needed)
            document.querySelector('[onclick="showTab(\'' + tabId + '\')"]').classList.add('active');

            // Add 'active-tab' class to the corresponding <li>
            document.getElementById('tab-' + tabId).classList.add('active-tab');

            // Store the selected tab in localStorage
            localStorage.setItem('selectedTab', tabId);
        }
    </script>

    <script>
        function displayUploadTravelFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-travelupload-container');

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
        function displayUpdateTravelFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-travelupdate-container');

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

        function displayUploadSpecialFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-uploadspecial-container');

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
        function displayUpdateSpecialFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-updatespecial-container');

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

        function displayUploadOfficeFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-uploadoffice-container');

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
        function displayUpdateOfficeFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-updateoffice-container');

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

        function displayUploadeAttendanceFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-uploadattendance-container');

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
        function displayUpdateAttendanceFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-updateattendance-container');

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

        function displayUploadeAttendanceMFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-uploadattendancem-container');

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
        function displayUpdateAttendanceMFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-updateattendancem-container');

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

        function displayUploadNarrativeFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-uploadnarrative-container');

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
        function displayUpdateNarrativeFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-updatenarrative-container');

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

        function displayUploadTerminalFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-uploadterminal-container');

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
        function displayUpdateTerminalFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-updateterminal-container');

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






</x-app-layout>




