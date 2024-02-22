    <style>
        [x-cloak] { display: none }

        .active-tab {
            /* Add your active styles here */
            background-color: #bdbdbd;
            color: #ffffff;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            }
    </style>

<x-admin-layout>
    @section('title', 'Trash | ' . config('app.name', 'UniCESS'))


    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    <section class="rounded-xl shadow text-slate-600 relative  bg-white h-full">

        <header class="flex justify-between p-5 py-4 flex-col sm:flex-row">
            <h1 class="xl:text-2xl sm:text-lg text-[.9rem] font-semibold tracking-wider text-slate-700">Trash Overview</h1>
            <div class="flex flex-row space-x-1" id="showOptionRestore" style="display: none">
                <button class="text-xs rounded text-white px-2 py-1 bg-blue-500" id="YesRestore">Restore</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-blue-500" id="selectAllRestore">Select all</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-blue-500" id="cancelButtonRestore">Cancel</button>
            </div>

            <div class="flex flex-row space-x-1" id="showOptionDelete" style="display: none">
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="YesDelete">Delete</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="selectAll">Select all</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="cancelButton">Cancel</button>
            </div>
            <div class="flex flex-row space-x-1" id="SecondshowOptionDelete" style="display: none">
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="SecondYesDelete">Delete</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="SecondselectAll">Select all</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="SecondcancelButton">Cancel</button>
            </div>
        </header>
        <hr>

        <div class="p-5">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
                <li class="me-2"  id="tab-trash">
                    <a href="#" onclick="showTab('trash')" aria-current="page"  class="inline-block p-4 rounded-t-lg ">Trash</a>
                </li>
                @if ($PermanentlyDelete->isNotEmpty())
                <li class="me-2"  id="tab-permanent">
                    <a href="#" onclick="showTab('permanent')"  class="inline-block p-4 rounded-t-lg">Permanently Deleted</a>
                </li>
                @endif

            </ul>
        </div>

        <div id="trash-content"  class="tab-content overflow-x-auto h-[55vh] 2xl:h-[65vh] rounded-lg border border-gray-200 shadow-sm mt-0 m-5" style="display: none;">
            <div class="flex justify-between  w-full ">
            </div>



            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
                <thead class="bg-gray-50">
                    <tr class="">
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">File</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Document Type</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">File Type</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Deleted By</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-medium text-gray-600">Date</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-center font-medium text-gray-600 w-[8rem]">Action</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                    @foreach ($proposals as $trashes )
                        <tr class="hover:bg-gray-50" id="media_id{{ $trashes->uuid }}">
                            <th class="flex gap-3 px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal text-gray-900">
                                <x-alpine-modal>
                                    <x-slot name="scripts">
                                        <div class="flex items-center  space-x-2 " target="__blank">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                            </div>

                                            <div class="text-xs text-left">
                                                @if (strlen($trashes->project_title) <= 10)
                                                <span>{{ Str::limit($trashes->project_title, 20) }} {{ substr($trashes->project_title, -$maxLength) }}</span>
                                                @else
                                                <span>{{ Str::limit($trashes->project_title, 20) }} {{ substr($trashes->project_title, -$maxLength) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </x-slot>

                                    <x-slot name="title">
                                        <span>Restoring project</span>
                                    </x-slot>

                                    <div class="w-[40rem] h-[12vh] flex flex-col items-center justify-center space-y-2">
                                        <h1 class="text-base mt-4 font-semibold text-gray-700">Restore Project?</h1>
                                        <span class="text-xs">{{ Str::limit($trashes->project_title) }}</span>
                                        <form action="{{ route('report-project.restore', $trashes->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="block text-white text-base px-3 hover:bg-blue-400 w-full text-left  bg-blue-500 py-1 rounded-xl" type="submit">Yes, Im sure</button>
                                        </form>
                                    </div>

                                </x-alpine-modal>

                            </th>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                Folder
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                <span class="block xl:text-xs 2xl:text-sm">
                                    Project
                                </span>
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
                                @foreach ($trashedRecord as $record )
                                    @if ($trashes->uuid == $record->uuid)
                                        <div class="relative h-5 w-5 flex space-x-2 items-center">
                                            <img class="rounded-full" id="showImage" src="{{ (!empty($record->user->avatar))? url('upload/image-folder/profile-image/'. $record->user->avatar): url('upload/profile.png') }}" alt="profileImage">
                                            <h1 class="font-medium text-gray-500 text-xs">{{ $record->user->first_name }}</h1>
                                        </div>
                                    @endif
                                @endforeach
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
                                {{ \Carbon\Carbon::parse($trashes->updated_at)->format('M d, Y,  g:i:s A')}}
                            </td>

                            <td class="xl:pl-4 2xl:pr-0 xl:px-0 2xl:px-2 py-4 relative">

                                <!-- Main modal -->
                                <div id="default-modal-project{{ $trashes->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Detail
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-project{{ $trashes->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 space-y-2">
                                                <p class="text-xs leading-relaxed text-white tracking-wide">
                                                Project Name: {{ $trashes->project_title }}
                                                </p>
                                                <p class="text-xs leading-relaxed text-white tracking-wide pb-2 border-b border-gray-600">
                                                Owner Name: {{ $trashes->user->name }}
                                                </p>


                                                <p class="text-xs leading-relaxed tracking-wide text-white pt-5">
                                                Deleted: {{ \Carbon\Carbon::parse($trashes->updated_at)->format('M d, Y,  g:i:s A')}}
                                                </p>
                                                <p class="text-xs leading-relaxed tracking-wide text-white">
                                                Created: {{ \Carbon\Carbon::parse($trashes->created_at)->format('M d, Y,  g:i:s A')}}
                                                </p>

                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="default-modal-project{{ $trashes->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="checkbox-wrapper-12">
                                    <div class="cbx">
                                    <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $trashes->uuid }}" style="display: none">
                                    <label for="cbx-12"></label>
                                    <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                        <path d="M2 8.36364L6.23077 12L13 2"></path>
                                    </svg>
                                    </div>
                                </div>

                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute left-[2.2rem] top-[1rem]">
                                    <!-- Dropdown toggle button -->
                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons flex items-center p-2 rounded-md" style="display: block">
                                        <svg class="absolute hover:fill-blue-500 top-2 left-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                    </button>
                                    <!-- Dropdown list -->
                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-[10rem] space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-project{{ $trashes->id }}" data-modal-toggle="default-modal-project{{ $trashes->id }}" class="block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Detail</button>
                                        <button class="restoreButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button"> Restore File</button>
                                        <button class="DeleteButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Permanently delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($trash as $trashes )
                        @foreach ($trashes->medias as $mediaLibrary )
                            <tr class="hover:bg-gray-50" id="media_id{{ $mediaLibrary->uuid }}">
                                <th class="flex gap-3 px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal text-gray-900">
                                    <x-alpine-modal>
                                        <x-slot name="scripts">
                                            <div class="flex items-center  space-x-2 " target="__blank">
                                                <div>
                                                    @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                                        <img src="{{ asset('img/image-icon.png') }}" class="xl:w-[2rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'text/plain')
                                                        <img src="{{ asset('img/text-document.png') }}" class="xl:w-[2rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                        <img src="{{ asset('img/docx.png') }}" class="xl:w-[2rem]" width="30">
                                                        @else
                                                        <img src="{{ asset('img/pdf.png') }}" class="xl:w-[2rem]" width="30">
                                                    @endif


                                                </div>

                                                <div class="text-xs text-left">
                                                    @if (strlen($mediaLibrary->file_name) <= 10)
                                                    <span>{{ Str::limit($mediaLibrary->file_name, 20) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                                    @else
                                                    <span>{{ Str::limit($mediaLibrary->file_name, 20) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </x-slot>

                                        <x-slot name="title">
                                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                                        </x-slot>

                                        <div class="w-[50rem]">
                                            {{--  <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposals->getFirstMediaUrl('proposalPdf') }}"></iframe>  --}}
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

                                </th>

                                <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                    @foreach ($mediaCollection as $collection )
                                        @if ( $mediaLibrary->id == $collection->media_id)
                                        {{ $collection->collection_name }}
                                        @endif
                                     @endforeach
                                </td>

                                <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                    <span class="block xl:text-xs 2xl:text-sm">
                                        @if ( $mediaLibrary->mime_type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                                        Docx
                                        @elseif ( $mediaLibrary->mime_type == "application/pdf")
                                        PDF
                                        @elseif ( $mediaLibrary->mime_type == "image/jpeg")
                                        Image
                                        @else
                                        {{ $mediaLibrary->mime_type }}
                                        @endif
                                    </span>
                                </td>

                                <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
                                    @foreach ($trashedRecord as $record )
                                        @if ($mediaLibrary->uuid == $record->uuid)
                                            <div class="relative h-5 w-5 flex space-x-2 items-center">
                                                <img class="rounded-full" id="showImage" src="{{ (!empty($record->user->avatar))? url('upload/image-folder/profile-image/'. $record->user->avatar): url('upload/profile.png') }}" alt="profileImage">
                                                <h1 class="font-medium text-gray-500 text-xs">{{ $record->user->first_name }}</h1>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>

                                <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
                                    {{ \Carbon\Carbon::parse($mediaLibrary->updated_at)->format('M d, Y,  g:i:s A')}}
                                </td>



                                <td class="xl:pl-4 2xl:pr-0 xl:px-0 2xl:px-2 py-4 relative">

                                    <!-- Main modal -->
                                    <div id="default-modal-media{{ $mediaLibrary->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Detail
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-media{{ $mediaLibrary->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 space-y-2">
                                                    <p class="text-xs leading-relaxed text-white tracking-wide">
                                                        Name: {{ $mediaLibrary->file_name }}
                                                    </p>
                                                    <hr>
                                                    <p class="text-xs leading-relaxed text-white pt-5 tracking-wide">
                                                        File Type:
                                                        @if ( $mediaLibrary->mime_type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                                                        Docx
                                                        @elseif ( $mediaLibrary->mime_type == "application/pdf")
                                                        PDF
                                                        @elseif ( $mediaLibrary->mime_type == "image/jpeg")
                                                        Image
                                                        @else
                                                        {{ $mediaLibrary->mime_type }}
                                                        @endif
                                                    </p>
                                                    <p class="text-xs leading-relaxed text-white tracking-wide">
                                                        File Size: {{ $mediaLibrary->size }} KB
                                                    </p>
                                                    <p class="text-xs leading-relaxed text-white tracking-wide">
                                                        Origin: {{ $trashes->project_title }}
                                                    </p>
                                                    <p class="text-xs leading-relaxed text-white tracking-wide">
                                                        File Owner:
                                                        @foreach ($users as $user )
                                                            @if ($mediaLibrary->name == $user->id)
                                                                {{ $user->name }}
                                                            @endif
                                                        @endforeach
                                                    </p>

                                                    <hr>
                                                    <p class="text-xs leading-relaxed tracking-wide text-white pt-5">
                                                        Deleted: {{ \Carbon\Carbon::parse($mediaLibrary->updated_at)->format('M d, Y,  g:i:s A')}}
                                                    </p>
                                                    <p class="text-xs leading-relaxed tracking-wide text-white">
                                                        Created: {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, Y,  g:i:s A')}}
                                                    </p>

                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">

                                                    <button data-modal-hide="default-modal-media{{ $mediaLibrary->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                          <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $mediaLibrary->uuid }}" style="display: none">
                                          <label for="cbx-12"></label>
                                          <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                          </svg>
                                        </div>


                                    </div>

                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute left-[2.2rem] top-[1rem]">
                                        <!-- Dropdown toggle button -->
                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons flex items-center p-2 rounded-md" style="display:block">
                                            <svg class="absolute hover:fill-blue-500 top-2 left-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                        </button>
                                        <!-- Dropdown list -->
                                        <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-[10rem] space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                            <!-- Modal toggle -->
                                            <button data-modal-target="default-modal-media{{ $mediaLibrary->id }}" data-modal-toggle="default-modal-media{{ $mediaLibrary->id }}" class="block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Detail</button>

                                            <button class="restoreButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button"> Restore File</button>
                                            <button class="DeleteButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Permanently delete</button>



                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach

                    @foreach ($evaluations as  $evaluation)
                        <tr class="hover:bg-gray-50" id="media_id{{ $evaluation->uuid }}">
                            <th class="flex gap-3 px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal text-gray-900">
                                <x-alpine-modal>
                                    <x-slot name="scripts">
                                        <div class="flex items-center  space-x-2 " target="__blank">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#6b90ff" d="M8 12h8v-2H8zm0-4h8V6H8zm11.95 12.475L15.9 15.2q-.425-.575-1.05-.887T13.5 14H4V4q0-.825.588-1.412T6 2h12q.825 0 1.413.588T20 4v16q0 .125-.012.238t-.038.237M6 22q-.825 0-1.412-.587T4 20v-4h9.5q.25 0 .463.113t.362.312l4.2 5.5q-.125.05-.262.063T18 22z"/></svg>
                                            </div>

                                            <div class="text-xs text-left">
                                            Evaluation ID : {{ $evaluation->uuid }}
                                            </div>
                                        </div>
                                    </x-slot>

                                    <x-slot name="title">
                                        <span>Evaluation ID: {{ Str::limit($evaluation->uuid) }}</span>
                                    </x-slot>

                                    <div class="w-[50rem]">
                                        Restore Evaluation?
                                        <form action="{{ route('admin.evaluation.restore', $evaluation->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Yes</button>
                                        </form>
                                    </div>
                                </x-alpine-modal>
                            </th>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">Evaluation File</td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                <span class="block xl:text-xs 2xl:text-sm">
                                    Evaluation
                                </span>
                            </td>


                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
                                @foreach ($trashedRecord as $record )
                                    @if ($evaluation->uuid == $record->uuid)
                                        <div class="relative h-5 w-5 flex space-x-2 items-center">
                                            <img class="rounded-full" id="showImage" src="{{ (!empty($record->user->avatar))? url('upload/image-folder/profile-image/'. $record->user->avatar): url('upload/profile.png') }}" alt="profileImage">
                                            <h1 class="font-medium text-gray-500 text-xs">{{ $record->user->first_name }}</h1>
                                        </div>
                                    @endif
                                @endforeach
                            </td>


                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs 2xl:text-xs">
                                {{ \Carbon\Carbon::parse($evaluation->udpated_at)->format('M d, Y,  g:i:s A')}}
                            </td>

                            <td class="xl:pl-4 2xl:pr-0 xl:px-0 2xl:px-2 py-4 relative">

                                <!-- Main modal -->
                                <div id="default-modal-evaluation{{ $evaluation->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Detail
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-evaluation{{ $evaluation->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 space-y-2">
                                                <p class="text-xs leading-relaxed text-white tracking-wide">Evaluation ID: {{ $evaluation->id }}</p>
                                                <p class="text-xs leading-relaxed text-white tracking-wide">Owner Name: {{ $evaluation->users->name }}</p><hr>
                                                <p class="text-xs leading-relaxed tracking-wide text-white pt-5">Deleted: {{ \Carbon\Carbon::parse($evaluation->updated_at)->format('M d, Y,  g:i:s A')}}</p>
                                                <p class="text-xs leading-relaxed tracking-wide text-white">Created: {{ \Carbon\Carbon::parse($evaluation->created_at)->format('M d, Y,  g:i:s A')}}</p>

                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="default-modal-evaluation{{ $evaluation->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="checkbox-wrapper-12">
                                    <div class="cbx">
                                      <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $evaluation->uuid }}" style="display: none">
                                      <label for="cbx-12"></label>
                                      <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                        <path d="M2 8.36364L6.23077 12L13 2"></path>
                                      </svg>
                                    </div>
                                </div>

                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute left-[2.2rem] top-[1rem]">
                                    <!-- Dropdown toggle button -->
                                    <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons flex items-center p-2 rounded-md" style="display: block">
                                        <svg class="absolute hover:fill-blue-500 top-2 left-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                    </button>
                                    <!-- Dropdown list -->
                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-[10rem] space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-evaluation{{ $evaluation->id }}" data-modal-toggle="default-modal-evaluation{{ $evaluation->id }}" class="block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Detail</button>
                                        <button class="restoreButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button"> Restore File</button>
                                        <button class="DeleteButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Permanently delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

        <div id="permanent-content"  class="tab-content overflow-x-auto h-[55vh] 2xl:h-[65vh] rounded-lg border border-gray-200 shadow-sm  mt-0 m-5" style="display: none;">



            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-gray-500">
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal">ID</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal">Name</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal">Type</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal">Deleted by</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 font-normal">Deleted date</th>
                        <th scope="col" class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-center font-normal w-[8rem]">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 border-t border-gray-100">

                    @foreach ($PermanentlyDelete as $deleted )
                        <tr class="hover:bg-gray-50 text-gray-400" id="media_id{{ $deleted->uuid }}">
                            <th class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs font-normal text-gray-400">
                                <h1>{{ $deleted->uuid }}</h1>
                            </th>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                <span class="block text-xs">
                                    {{ Str::limit($deleted->name, 50) }}
                                </span>
                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">
                                {{ $deleted->type }}
                            </td>


                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs">

                                <div class="relative h-5 w-5 flex space-x-2 items-center">
                                    <img class="rounded-full" id="showImage" src="{{ (!empty($deleted->user->avatar))? url('upload/image-folder/profile-image/'. $deleted->user->avatar): url('upload/profile.png') }}" alt="profileImage">
                                    <h1 class="font-medium text-gray-400 text-xs">{{ $deleted->user->first_name }}</h1>
                                </div>

                            </td>

                            <td class="px-4 xl:pl-4 xl:px-0 2xl:px-4 2xl:pl-4 py-4 text-xs ">
                                {{ \Carbon\Carbon::parse($deleted->created_at)->format('M d, Y,  g:i:s A')}}
                            </td>

                            <td class="xl:pl-4 2xl:pr-0 xl:px-0 2xl:px-2 py-4 relative">

                                <div class=" absolute top-5 right-14">
                                    <div class="checkbox-wrapper-12">
                                        <div class="cbx">
                                        <input type="checkbox" class="secondhidden-checkbox" name="ids" value="{{ $deleted->uuid }}" style="display: none">
                                        <label for="cbx-12"></label>
                                        <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                        </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="DeleteWrapper absolute left-[2.2rem] top-[1rem]" style="display: block;">
                                    <button class="SecondDeleteButton block text-slate-800 text-xs px-2  w-full text-left hover:text-black" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><g fill="none" stroke="#919191" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                    </button>
                                </div>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </section>


</x-admin-layout>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            var RestoreButton = document.getElementById('selectAllRestore');
            var RestoreSelectedButton = document.getElementById('YesRestore');
            var checkboxes = document.querySelectorAll('.hidden-checkbox');


            // Add click event listener to the toggle all button
            RestoreButton.addEventListener('click', function () {
                // Check if all checkboxes are checked

                var allChecked = Array.from(checkboxes).every(function (checkbox) {
                    return checkbox.checked;
                });

                // If all checkboxes are checked, reset all checkboxes; otherwise, check all checkboxes
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = !allChecked;
                });
            });
            RestoreSelectedButton.addEventListener('click', function () {
                // Filter out the checked checkboxes
                var checkedCheckboxes = Array.from(document.querySelectorAll('.hidden-checkbox:checked'));

                // Create an array to store the IDs of checked checkboxes
                var all_ids = checkedCheckboxes.map(function (checkbox) {
                    return checkbox.value;
                });


                if (all_ids.length > 0 ) {
                    // Perform deletion logic for the checked checkboxes
                    if (confirm('Are you sure you want to restore?')) {

                        $.ajax({
                            url: "{{ route('admin.trash.restore') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                checkedCheckboxes.forEach(function (checkbox) {
                                    // Replace 'proposal_id' with the appropriate ID prefix
                                    $('#media_id' + checkbox.value).remove();
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
                    toastr.warning('No checkboxes are selected for restoration.');
                }

            });

            var DeleteButton = document.getElementById('selectAll');
            var deleteSelectedButton = document.getElementById('YesDelete');
            var checkboxes = document.querySelectorAll('.hidden-checkbox');


            // Add click event listener to the toggle all button
            DeleteButton.addEventListener('click', function () {
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
                    if (confirm('Are you sure you want to permanently delete?')) {

                        $.ajax({
                            url: "{{ route('admin.trash.hardelete') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                checkedCheckboxes.forEach(function (checkbox) {
                                    // Replace 'proposal_id' with the appropriate ID prefix
                                    $('#media_id' + checkbox.value).remove();
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

            var SecondDeleteButton = document.getElementById('SecondselectAll');
            var SecondDeleteSelectedButton = document.getElementById('SecondYesDelete');
            var Secondcheckboxes = document.querySelectorAll('.secondhidden-checkbox');

            // Add click event listener to the toggle all button
            SecondDeleteButton.addEventListener('click', function () {
                // Check if all checkboxes are checked

                var allChecked = Array.from(Secondcheckboxes).every(function (checkbox) {
                    return checkbox.checked;
                });

                // If all checkboxes are checked, reset all checkboxes; otherwise, check all checkboxes
                Secondcheckboxes.forEach(function (checkbox) {
                    checkbox.checked = !allChecked;
                });
            });


            SecondDeleteSelectedButton.addEventListener('click', function () {
                // Filter out the checked checkboxes
                var checkedCheckboxes = Array.from(document.querySelectorAll('.secondhidden-checkbox:checked'));

                // Create an array to store the IDs of checked checkboxes
                var all_ids = checkedCheckboxes.map(function (checkbox) {
                    return checkbox.value;
                });


                if (all_ids.length > 0 ) {
                    // Perform deletion logic for the checked checkboxes
                    if (confirm('Are you sure you want to permanently delete?')) {

                        $.ajax({
                            url: "{{ route('admin.trash.permanently-delete') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                checkedCheckboxes.forEach(function (checkbox) {
                                    // Replace 'proposal_id' with the appropriate ID prefix
                                    $('#media_id' + checkbox.value).remove();
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
            var restoreButton = document.querySelectorAll('.restoreButton');
            var DeletePermanently = document.querySelectorAll('.DeleteButton');
            var DeleteSecondPermanently = document.querySelectorAll('.SecondDeleteButton');

            restoreButton.forEach(function (button) {

                button.addEventListener('click', function () {

                    var hiddenCheckboxes = document.querySelectorAll('.hidden-checkbox');
                    var dropdownButton = document.querySelectorAll('.dropdownButtons');
                    document.getElementById("showOptionRestore").style.display = "block";


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


            DeleteSecondPermanently.forEach(function (button) {

                button.addEventListener('click', function () {

                    var hiddenCheckboxes = document.querySelectorAll('.secondhidden-checkbox');
                    var dropdownButton = document.querySelectorAll('.DeleteWrapper');
                    document.getElementById("SecondshowOptionDelete").style.display = "block";


                    hiddenCheckboxes.forEach(function (checkbox) {
                        if (checkbox.style.display === 'none' || checkbox.style.display === '') {
                            checkbox.style.display = 'block';
                        } else {
                            checkbox.style.display = 'none';
                        }
                    });

                    dropdownButton.forEach(function (div) {
                        if (div.style.display === 'block' ) {
                            div.style.display = 'none';
                        } else {
                            div.style.display = 'block';
                        }
                    });
                });
            });

            DeletePermanently.forEach(function (button) {

                button.addEventListener('click', function () {

                    var hiddenCheckboxes = document.querySelectorAll('.hidden-checkbox');
                    var dropdownButton = document.querySelectorAll('.dropdownButtons');
                    document.getElementById("showOptionDelete").style.display = "block";


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

            var cancelButtonRestore = document.getElementById('cancelButtonRestore');
            var cancelButton = document.getElementById('cancelButton');
            var SecondcancelButton = document.getElementById('SecondcancelButton');

            cancelButtonRestore.addEventListener('click', function () {

                var hiddenCheckbox = document.querySelectorAll('.hidden-checkbox');
                var tooltipButtons = document.querySelectorAll('.dropdownButtons');

                hiddenCheckbox.forEach(function (checkbox) {
                    if (checkbox.style.display === 'block' ) {
                        checkbox.checked = false;
                        checkbox.style.display = 'none';
                    }
                });

                document.getElementById("showOptionRestore").style.display = "none";

                tooltipButtons.forEach(function (button) {
                    if (button.style.display === 'none' ) {
                        button.style.display = 'block';
                    } else {
                        button.style.display = 'none';
                    }
                });

            });

            SecondcancelButton.addEventListener('click', function () {

                var hiddenCheckbox = document.querySelectorAll('.secondhidden-checkbox');
                var tooltipButtons = document.querySelectorAll('.DeleteWrapper');

                hiddenCheckbox.forEach(function (checkbox) {
                    if (checkbox.style.display === 'block' ) {
                        checkbox.checked = false;
                        checkbox.style.display = 'none';
                    }
                });

                document.getElementById("SecondshowOptionDelete").style.display = "none";

                tooltipButtons.forEach(function (button) {
                    if (button.style.display === 'none' ) {
                        button.style.display = 'block';
                    } else {
                        button.style.display = 'none';
                    }
                });

            });

            cancelButton.addEventListener('click', function () {

                var hiddenCheckbox = document.querySelectorAll('.hidden-checkbox');
                var tooltipButtons = document.querySelectorAll('.dropdownButtons');

                hiddenCheckbox.forEach(function (checkbox) {
                    if (checkbox.style.display === 'block' ) {
                        checkbox.checked = false;
                        checkbox.style.display = 'none';
                    }
                });

                document.getElementById("showOptionDelete").style.display = "none";

                tooltipButtons.forEach(function (button) {
                    if (button.style.display === 'none' ) {
                        button.style.display = 'block';
                    } else {
                        button.style.display = 'none';
                    }
                });

            });
        });


    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('selectedTrashEmptyTab');
            if (storedTab) {
                // Show the stored tab content
                document.getElementById(storedTab + '-content').style.display = 'block';

                // Add 'active' class to the stored tab (if needed)
                document.querySelector('[onclick="showTab(\'' + storedTab + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-' + storedTab).classList.add('active-tab');
            } else {
                // If no stored tab, show the 'narrative-content' by default
                document.getElementById('trash-content').style.display = 'block';

                // Add 'active' class to the 'trash' tab (if needed)
                document.querySelector('[onclick="showTab(\'trash\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-trash').classList.add('active-tab');
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
            localStorage.setItem('selectedTrashEmptyTab', tabId);
        }
    </script>
