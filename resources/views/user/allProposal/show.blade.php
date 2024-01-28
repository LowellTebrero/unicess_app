    <style>
        [x-cloak] { display: none }
    </style>


    <x-app-layout>

    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    @if (Auth::user()->authorize == 'checked')
        @unlessrole('admin|New User')
            <style>
                [x-cloak] {display: none}
            </style>

            <section class="m-8 rounded-lg  relative mt-4 2xl:mt-5 h-[82vh] 2xl:h-[87vh]  bg-white text-gray-700 overflow-x-auto">

                @if ($proposal == null)
                <div class="flex justify-between p-5 py-3">
                    <h1 class="text-lg tracking-wide">404 Error: Not Found</h1>
                    <a href={{ URL::previous() }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <hr>
                <div class="flex items-center justify-center mt-12">
                    <h1 class="text-2xl tracking-wide text-gray-700">404 Error:<span class="text-red-500"> Not Found</span> </h1>
                </div>

                @else
                <div class="p-4 flex justify-between items-center bg-white sticky top-0 z-10">
                    <h1 class="font-semibold tracking-wider md:text-lg text-base xl:text-2xl">Show Program/Projects</h1>
                    <a href={{ URL::previous() }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <hr>

                <div>
                    <h1 class="text-sm p-4">{{ $proposal->project_title }}</h1>
                </div>
                <main class="p-4 grid 2xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-3 grid-cols-1  gap-4">
                    @foreach ($proposal->medias as $mediaLibrary)
                        <div data-tooltip-target="tooltip-proposal" type="button" class="relative">
                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <div class="flex space-x-2 p-4 bg-slate-100 hover:bg-slate-200 shadow-sm rounded">
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
                                    {{--  <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposal->getFirstMediaUrl('proposalPdf') }}"></iframe>  --}}
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
                        </div>
                    @endforeach

                    @if ($proposal->travelorder->isEmpty())
                    @else
                        <div class="bg-white shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="travelorder">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-travelorder" data-modal-toggle="default-modal-travelorder" class="text-sm p-2 text-center h-full flex space-x-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Travel Order</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-travelorder" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                               Travel Order
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-travelorder">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">
                                           @foreach ($proposal->travelorder as $travel )
                                               @foreach ($travel->medias as $media )

                                               <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
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
                                                    {{--  <div x-cloak  x-data="{ 'showModalTravelOrder{{ $media->id }}': false }" @keydown.escape="showModalTravelOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">
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
                                                                            Username uploader: {{ $travel->users->name }}
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

                                                                <button data-modal-target="detail-travelorder-modal{{ $media->id }}" data-modal-toggle="detail-travelorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalNarrative{{ $media->id }} = true">Rename</button>
                                                                <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>  --}}
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
                                               @endforeach
                                           @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($proposal->specialorder->isEmpty())
                    @else
                        <div class="bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="specialorder">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-specialorder" data-modal-toggle="default-modal-specialorder" class="text-sm p-2 text-center h-full flex  space-x-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Special Order</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-specialorder" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Special Order
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-specialorder">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">
                                           @foreach ($proposal->specialorder as $special )
                                               @foreach ($special->medias as $media )

                                               <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
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
                                                    {{--  <div x-cloak  x-data="{ 'showModalSpecialOrder{{ $media->id }}': false }" @keydown.escape="showModalSpecialOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">
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
                                                                            Username uploader: {{ $special->users->name }}
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

                                                                <button data-modal-target="detail-specialorder-modal{{ $media->id }}" data-modal-toggle="detail-specialorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalNarrative{{ $media->id }} = true">Rename</button>
                                                                <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>  --}}
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
                                               @endforeach
                                           @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposal->officeorder->isEmpty())
                    @else
                        <div class="bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="officeorder">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-officeorder" data-modal-toggle="default-modal-officeorder" class="text-sm p-4 text-center h-full flex space-x-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Office Order</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-officeorder" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Office Order
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-officeorder">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">
                                        @foreach ($proposal->officeorder as $office )
                                            @foreach ($office->medias as $media )

                                            <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
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
                                                    {{--  <div x-cloak  x-data="{ 'showModalOfficeOrder{{ $media->id }}': false }" @keydown.escape="showModalOfficeOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">
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
                                                                            Username uploader: {{ $office->users->name }}
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

                                                                <button data-modal-target="detail-officeorder-modal{{ $media->id }}" data-modal-toggle="detail-officeorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalNarrative{{ $media->id }} = true">Rename</button>
                                                                <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>  --}}
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
                                            @endforeach
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($proposal->attendance->isEmpty())
                    @else
                        <div class=" bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="attendance">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-attendance" data-modal-toggle="default-modal-attendance" class="text-sm p-4 text-center h-full flex space-x-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Attendance</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-attendance" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Attendance
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-attendance">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">
                                           @foreach ($proposal->attendance as $attend )
                                               @foreach ($attend->medias as $media )

                                               <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
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
                                                    {{--  <div x-cloak  x-data="{ 'showModalAttendance{{ $media->id }}': false }" @keydown.escape="showModalAttendance{{ $media->id }} = false" class="absolute right-0 top-1 ">
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
                                                                            Username uploader: {{ $attend->users->name }}
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

                                                                <button data-modal-target="detail-attendance-modal{{ $media->id }}" data-modal-toggle="detail-attendance-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalNarrative{{ $media->id }} = true">Rename</button>
                                                                <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>  --}}
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
                                               @endforeach
                                           @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposal->attendancemonitoring->isEmpty())
                    @else
                        <div class=" bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="attendancemonitoring">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-attendancemonitoring" data-modal-toggle="default-modal-attendancemonitoring" class="text-sm p-4 text-center h-full flex space-x-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Attendance Monitoring</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-attendancemonitoring" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Attendance Monitoring
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-attendancemonitoring">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">
                                           @foreach ($proposal->attendancemonitoring as $attendm )
                                               @foreach ($attendm->medias as $media )

                                               <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
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
                                                    {{--  <div x-cloak  x-data="{ 'showModalAttendanceM{{ $media->id }}': false }" @keydown.escape="showModalAttendanceM{{ $media->id }} = false" class="absolute right-0 top-1 ">
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
                                                                            Username uploader: {{ $attendm->users->name }}
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

                                                                <button data-modal-target="detail-attendancemonitoring-modal{{ $media->id }}" data-modal-toggle="detail-attendancemonitoring-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalNarrative{{ $media->id }} = true">Rename</button>
                                                                <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>  --}}
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
                                               @endforeach
                                           @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposal->narrativereport->isEmpty())
                    @else
                        <div class=" bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="narrativereport">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-narrative" data-modal-toggle="default-modal-narrative" class="text-sm p-4 text-center h-full flex space-x-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Narrative</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-narrative" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                               Narrative
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-narrative">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">
                                           @foreach ($proposal->narrativereport as $narrative )
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
                                                    {{--  <div x-cloak  x-data="{ 'showModalNarrative{{ $media->id }}': false }" @keydown.escape="showModalNarrative{{ $media->id }} = false" class="absolute right-0 top-1 ">



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
                                                            </div>
                                                        </div>
                                                    </div>  --}}
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


                        </div>
                    @endif

                    @if ($proposal->terminalreport->isEmpty())
                    @else
                        <div class="bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="narrativereport">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-terminal" data-modal-toggle="default-modal-terminal" class="text-sm p-4 text-center h-full flex space-x-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Terminal</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-terminal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                               Terminal
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-terminal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">
                                           @foreach ($proposal->terminalreport as $terminal )
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

                                                    {{--  <div x-cloak  x-data="{ 'showModalTerminal{{ $media->id }}': false }" @keydown.escape="showModalTerminal{{ $media->id }} = false"  x-data="{ 'showModalTerminalDetail{{ $media->id }}': false }" @keydown.escape="showModalTerminalDetail{{ $media->id }} = false" class="absolute right-0 top-1">

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
                                                            </div>
                                                        </div>
                                                    </div>  --}}
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
                        </div>
                    @endif
                </main>
                @endif
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

</x-app-layout>

    <script src="{{ asset('js/lightbox.js') }}"></script>




