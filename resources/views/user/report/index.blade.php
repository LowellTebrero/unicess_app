<x-app-layout>
    @section('title', 'Reports | ' . config('app.name', 'UniCESS'))
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
            <h1 class="font-semibold tracking-wider sm:text-xl xl:text-2xl text-slate-700 text-base">Report Overview</h1>
        </header>
        <hr>

        <div class="flex flex-col space-y-5 p-5 h-[50vh] mt-0 2xl:mt-8">
            <div class="">
                <h1 class="text-lg font-medium mb-2">Narrative Report</h1>
                <div class="overflow-x-auto xl:h-[25vh] 2xl:h-[20vh]">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
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
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Proposal</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

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

                                            @if ($proposal->narrativereport->isEmpty())
                                            <div class="text-md  text-red-400">pending</div>
                                            @else
                                            <div class="text-md  text-green-500">uploaded</div>
                                            @endif

                                        </td>

                                        <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                            @if ($proposal->narrativereport->isEmpty())
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
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
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
                                                                @foreach ($proposal->narrativereport as $narrative)
                                                                    @foreach ($narrative->medias as $mediaLibrary)
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
                                                                                <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                    <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                    <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                                    @foreach ($proposal->narrativereport as $narrative)
                                                                                    <form action={{ route('report-narrative.delete',[ 'id' => $mediaLibrary->id, 'narrativeId' => $narrative->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                                                    </form>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
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
                                                        @foreach ($proposal->narrativereport as $narrative)
                                                        <form action={{ route('report-narrative.update', $narrative->id) }} method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5 space-y-4 flex flex-col">
                                                                <label class="text-base leading-relaxed text-white">
                                                                Upload your file here.
                                                                </label>
                                                                <input type="file" multiple name="narrative_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" />
                                                                @error('narrative_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                <button data-modal-toggle="default-already-uploaded-narrative{{ $proposal->id }}" data-modal-hide="default-update-modal-narrative{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                            </div>
                                                        </form>
                                                        @endforeach
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
                                                            <div class="p-4 md:p-5 space-y-4 flex flex-col">
                                                                <label class="text-base leading-relaxed text-white">
                                                                NARRATIVE REPORT
                                                                </label>
                                                                <input type="file" multiple name="narrative_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" />
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
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="">
                <h1 class="text-lg font-medium mb-2">Terminal Report</h1>
                <div class="overflow-x-auto xl:h-[25vh] 2xl:h-[20vh]">

                    <table class="w-full text-left text-gray-500">
                        <thead class="text-[.6rem] text-gray-700 uppercase bg-gray-200 relative">
                            <tr class="bg-gray-100 sticky top-0">
                                @if ($proposalMembers->count() <= 0)
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
                                <td class="px-6 py-4 xl:text-[.9rem] text-red-400">No Proposal</td>
                            </tr>
                            @else
                                @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )
                                @if ($proposal->id == $prop->proposal_id)

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

                                            @if ($proposal->terminalreport->isEmpty())
                                            <div class="text-md  text-red-400">pending</div>
                                            @else
                                            <div class="text-md  text-green-500">uploaded</div>
                                            @endif

                                        </td>

                                        <td class=" w-[20rem] 2xl:px-6 xl:px-4 xl:pl-0 py-4  xl:text-[.6rem] 2xl:text-[.8rem]">

                                            @if ($proposal->terminalreport->isEmpty())
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
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
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
                                                                @foreach ($proposal->terminalreport as $terminal)
                                                                    @foreach ($terminal->medias as $mediaLibrary)
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
                                                                                <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                                                    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                                                    <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                                    <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                                                    @foreach ($proposal->terminalreport as $terminal)
                                                                                    <form action={{ route('report-terminal.delete',[ 'id' => $mediaLibrary->id, 'terminalId' => $terminal->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                                                    </form>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
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
                                                        @foreach ($proposal->terminalreport as $terminal)
                                                        <form action={{ route('report-terminal.update', $terminal->id) }} method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5 space-y-4 flex flex-col">
                                                                <label class="text-base leading-relaxed text-white">
                                                                Upload your file here.
                                                                </label>
                                                                <input type="file" multiple name="terminal_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" />
                                                                @error('terminal_file')<span class="text-red-500  text-xs">{{ $message }}</span>@enderror
                                                            </div>
                                                            <input type="text" value="{{ $proposal->id }}" name="proposal_id" hidden>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                                <button data-modal-toggle="default-already-uploaded-terminal{{ $proposal->id }}" data-modal-hide="default-update-modal-terminal{{ $proposal->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                            </div>
                                                        </form>
                                                        @endforeach
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
                                                            <div class="p-4 md:p-5 space-y-4 flex flex-col">
                                                                <label class="text-base leading-relaxed text-white">
                                                                TERMINAL REPORT
                                                                </label>
                                                                <input type="file" multiple name="terminal_file[]" class="text-base leading-relaxed text-gray-500 dark:text-gray-400 border" />
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
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
