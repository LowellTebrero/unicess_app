
@php
$maxLength = 18; // Adjust the maximum length as needed
@endphp

@foreach ($inventory as $invent )
    @if ($invent->number == 1)
        <div class="flex flex-wrap">


            <div class="flex flex-col w-full">
                <div class="p-2">
                    @if ($myuniqueProposalFiles->isEmpty())
                        <div class="h-[45vh] 2xl:h-[60vh] flex flex-col items-center justify-center space-y-2 w-full">
                            <img class="w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
                            <h1 class="text-md text-gray-500">It’s empty here</h1>
                        </div>
                    @else
                        <table class="w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"></th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"></th>
                            </tr>
                            </thead>
                            <tbody>


                                @foreach ($myfiles->medias as $mediaLibrary)
                                @if (!empty($mediaLibrary->model_type == 'App\Models\Proposal'))

                                    <tr class="hover:bg-gray-200 ">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 flex items-center space-x-2">
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
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">

                                            <h1 class="text-xs">{{ $mediaLibrary->collection_name }}</h1>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">

                                            <h1 class="text-xs">{{ $mediaLibrary->human_readable_size }}</h1>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 relative">

                                            <h1 class="text-xs">{{ $mediaLibrary->created_at }}</h1>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center  text-gray-800 relative">
                                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute top-4 left-0">

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
                                                            <button type="button" class=" z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1  text-xl font-semibold" @click="showModal = false">
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


                                                <div x-cloak x-data="{dropdownMenu: false}" class=" absolute left-0">
                                                    <!-- Dropdown toggle button -->
                                                    <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2 rounded-md">
                                                        <svg class="absolute hover:fill-blue-500 top-2 left-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                    </button>
                                                    <!-- Dropdown list -->
                                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">


                                                        <button class="text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>

                                                        <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>


                                                        <form action="{{ route('inventory-trash-media', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to trash</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @endforeach


                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

    @elseif ($invent->number == 2)
        <div class="flex py-3 items-center flex-wrap">

            @if ($myuniqueProposalFiles->isEmpty())
            <div class="h-[45vh] 2xl:h-[60vh] flex flex-col items-center justify-center space-y-2 w-full">
                <img class="w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
                <h1 class="text-md text-gray-500">It’s empty here</h1>
            </div>

            @else
            @foreach($myuniqueProposalFiles as $proposalfile)

                @if (($proposalfile->collection_name == 'proposalPdf') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="proposal">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-myproposal" data-modal-toggle="default-modal-myproposal" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Proposal Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-myproposal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                        Proposal Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-myproposal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">
                                        @foreach ($myfiles->medias as $media)
                                            @if ($media->collection_name == 'proposalPdf')

                                                <div data-tooltip-target="tooltip-myproposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="myproposal-media-modal{{ $media->id}}" data-modal-toggle="myproposal-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                    <div x-cloak  x-data="{ 'showModalmyproposal{{ $media->id }}': false }" @keydown.escape="showModalmyproposal{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                        <!-- Detail modal -->
                                                        <div id="detail-myproposal-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-xl font-semibold text-white">
                                                                            Details
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myproposal-modal{{ $media->id }}">
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
                                                                            Report Type: Proposal File
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



                                                            <!-- Modal -->
                                                            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmyproposal{{ $media->id }}">

                                                                <!-- Modal inner -->
                                                                <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmyproposal{{ $media->id }}"
                                                                    x-transition:enter="motion-safe:ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmyproposal{{ $media->id }} = true">

                                                                    <!-- Title / Close-->
                                                                    <div class="flex items-center justify-between px-4 py-1">
                                                                        <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                        <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmyproposal{{ $media->id }} = false">
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

                                                                    <button data-modal-target="detail-myproposal-modal{{ $media->id }}" data-modal-toggle="detail-myproposal-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                    <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmyproposal{{ $media->id }} = true">Rename</button>
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
                                                <div id="myproposal-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="myproposal-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-myproposal" type="button">
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

                                        <a href={{ route('inventory-download-travelorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'moaPdf') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="mymoa">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-mymoa" data-modal-toggle="default-modal-mymoa" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">MOA  Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-mymoa" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                        MOA Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-mymoa">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                            @if ($media->collection_name == 'moaPdf')

                                                <div data-tooltip-target="tooltip-mymoa" type="button" class="w-full shadow rounded-lg transition-all  relative">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="mymoa-media-modal{{ $media->id}}" data-modal-toggle="mymoa-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                    <div x-cloak  x-data="{ 'showModalmyproposal{{ $media->id }}': false }" @keydown.escape="showModalmyproposal{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                        <!-- Detail modal -->
                                                        <div id="detail-myproposal-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-xl font-semibold text-white">
                                                                            Details
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myproposal-modal{{ $media->id }}">
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
                                                                            Report Type: Moa File
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

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmyproposal{{ $media->id }}">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmyproposal{{ $media->id }}"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmyproposal{{ $media->id }} = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmyproposal{{ $media->id }} = false">
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

                                                                <button data-modal-target="detail-myproposal-modal{{ $media->id }}" data-modal-toggle="detail-myproposal-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmyproposal{{ $media->id }} = true">Rename</button>
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

                                                <div id="mymoa-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="mymoa-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-mymoa" type="button">
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

                                        <a href={{ route('inventory-download-travelorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'otherFile') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="myotherfile">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-myotherfile" data-modal-toggle="default-modal-myotherfile" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Other Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-myotherfile" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                        Other Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-myotherfile">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                            @if ($media->collection_name == 'otherFile')

                                                <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="myotherfile-media-modal{{ $media->id}}" data-modal-toggle="myotherfile-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                    <div x-cloak  x-data="{ 'showmyotherfile{{ $media->id }}': false }" @keydown.escape="showmyotherfile{{ $media->id }} = false" class="absolute right-0 top-1 ">


                                                        <!-- Detail modal -->
                                                        <div id="detail-myotherfile-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-xl font-semibold text-white">
                                                                            Details
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myotherfile-modal{{ $media->id }}">
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
                                                                            Report Type: Moa File
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

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showmyotherfile{{ $media->id }}">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showmyotherfile{{ $media->id }}"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showmyotherfile{{ $media->id }} = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showmyotherfile{{ $media->id }} = false">
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

                                                                <button data-modal-target="detail-myotherfile-modal{{ $media->id }}" data-modal-toggle="detail-myotherfile-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showmyotherfile{{ $media->id }} = true">Rename</button>
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

                                                <div id="myotherfile-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="myotherfile-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-myotherfile" type="button">
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

                                        <a href={{ route('inventory-download-travelorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'travelOrderPdf') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="mytravelorder">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-mytravelorder" data-modal-toggle="default-modal-mytravelorder" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4"> Travel Order Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-mytravelorder" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                        Travel Order Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-mytravelorder">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                            @if ($media->collection_name == 'travelOrderPdf')

                                                <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="mytravelorder-media-modal{{ $media->id}}" data-modal-toggle="mytravelorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                    <div x-cloak  x-data="{ 'showmyotherfile{{ $media->id }}': false }" @keydown.escape="showmyotherfile{{ $media->id }} = false" class="absolute right-0 top-1 ">


                                                        <!-- Detail modal -->
                                                        <div id="detail-myotherfile-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-xl font-semibold text-white">
                                                                            Details
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myotherfile-modal{{ $media->id }}">
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
                                                                            Report Type: Moa File
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

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showmyotherfile{{ $media->id }}">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showmyotherfile{{ $media->id }}"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showmyotherfile{{ $media->id }} = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showmyotherfile{{ $media->id }} = false">
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

                                                                <button data-modal-target="detail-myotherfile-modal{{ $media->id }}" data-modal-toggle="detail-myotherfile-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showmyotherfile{{ $media->id }} = true">Rename</button>
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

                                                <div id="mytravelorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="mytravelorder-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-mytravelorder" type="button">
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

                                        <a href={{ route('inventory-download-travelorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'specialOrderPdf') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="myspecialorder">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-myspecialorder" data-modal-toggle="default-modal-myspecialorder" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Special Order Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-myspecialorder" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                            Special Order Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-myspecialorder">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">
                                        @foreach ($myfiles->medias as $media)
                                        @if ($media->collection_name == 'specialOrderPdf')

                                            <div data-tooltip-target="tooltip-myspecialorder" type="button" class="w-full shadow rounded-lg transition-all  relative" >
                                                <!-- Modal toggle -->
                                                <button data-modal-target="myspecialorder-media-modal{{ $media->id}}" data-modal-toggle="myspecialorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                <div x-cloak  x-data="{ 'showModalmySpecialOrder{{ $media->id }}': false }" @keydown.escape="showModalmySpecialOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                    <!-- Detail modal -->
                                                    <div id="detail-myspecialorder-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                    <h3 class="text-xl font-semibold text-white">
                                                                        Details
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myspecialorder-modal{{ $media->id }}">
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

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmySpecialOrder{{ $media->id }}">

                                                        <!-- Modal inner -->
                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmySpecialOrder{{ $media->id }}"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmySpecialOrder{{ $media->id }} = true">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmySpecialOrder{{ $media->id }} = false">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <hr>

                                                            <!-- content -->
                                                            <div>
                                                                <form action="{{route('inventory-rename-media', $proposalfile->id)}}" method="POST">
                                                                    @csrf @method('PUT')
                                                                    <div class="flex flex-col items-center pt-5 px-4">
                                                                    <input type="text" value="{{ $proposalfile->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                    <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
                                                                </div>
                                                                </form>
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

                                                            <button data-modal-target="detail-myspecialorder-modal{{ $media->id }}" data-modal-toggle="detail-myspecialorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmySpecialOrder{{ $media->id }} = true">Rename</button>
                                                            <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                                            <form action={{ route('inventory-trash-media', $proposalfile->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div id="myspecialorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                            <h3 class="text-md font-semibold text-gray-600">
                                                            {{ $media->file_name }}
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="myspecialorder-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-myspecialorder" type="button">
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

                                        <a href={{ route('inventory-download-specialorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'officeOrderPdf') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="myofficeorder">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-myofficeorder" data-modal-toggle="default-modal-myofficeorder" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Office Order Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-myofficeorder" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                            Office Order Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-myofficeorder">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                        @if ($media->collection_name == 'officeOrderPdf')
                                            <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                <!-- Modal toggle -->
                                                <button data-modal-target="myofficeorder-media-modal{{ $media->id}}" data-modal-toggle="myofficeorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                <div x-cloak  x-data="{ 'showModalmyOfficeOrder{{ $media->id }}': false }" @keydown.escape="showModalmyOfficeOrder{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                    <!-- Detail modal -->
                                                    <div id="detail-myofficeorder-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                    <h3 class="text-xl font-semibold text-white">
                                                                        Details
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myofficeorder-modal{{ $media->id }}">
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

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmyOfficeOrder{{ $media->id }}">
                                                        <!-- Modal inner -->
                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmyOfficeOrder{{ $media->id }}"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmyOfficeOrder{{ $media->id }} = true">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmyOfficeOrder{{ $media->id }} = false">
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

                                                            <button data-modal-target="detail-myofficeorder-modal{{ $media->id }}" data-modal-toggle="detail-myofficeorder-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmyOfficeOrder{{ $media->id }} = true">Rename</button>
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

                                            <div id="myofficeorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                            <h3 class="text-md font-semibold text-gray-600">
                                                            {{ $media->file_name }}
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="myofficeorder-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-myofficefolder" type="button">
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

                                        <a href={{ route('inventory-download-officeorder', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'Attendance') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="myattendance">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-myattendance" data-modal-toggle="default-modal-myattendance" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Attendance Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-myattendance" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                            Attendance Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-myattendance">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                        @if ($media->collection_name == 'Attendance')

                                            <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                <!-- Modal toggle -->
                                                <button data-modal-target="myattendance-media-modal{{ $media->id}}" data-modal-toggle="myattendance-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                <div x-cloak  x-data="{ 'showModalmyAttendance{{ $media->id }}': false }" @keydown.escape="showModalmyAttendance{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmyAttendance{{ $media->id }}">
                                                        <!-- Modal inner -->
                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmyAttendance{{ $media->id }}"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmyAttendance{{ $media->id }} = true">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmyAttendance{{ $media->id }} = false">
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
                                                    <div id="detail-myattendance-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                    <h3 class="text-xl font-semibold text-white">
                                                                        Details
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myattendance-modal{{ $media->id }}">
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

                                                            <button data-modal-target="detail-myattendance-modal{{ $media->id }}" data-modal-toggle="detail-myattendance-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmyAttendance{{ $media->id }} = true">Rename</button>
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

                                            <div id="myattendance-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                            <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="myattendance-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-myattendance" type="button">
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

                                        <a href={{ route('inventory-download-attendance', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'AttendanceMonitoring') != null)
                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="myattendancemonitoring">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-myattendancemonitoring" data-modal-toggle="default-modal-myattendancemonitoring" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Attendance Monitoring Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-myattendancemonitoring" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                            Attendance Monitoring Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-myattendancemonitoring">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                        @if ($media->collection_name == 'AttendanceMonitoring')

                                            <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                <!-- Modal toggle -->
                                                <button data-modal-target="myattendancemonitoring-media-modal{{ $media->id}}" data-modal-toggle="myattendancemonitoring-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                <div x-cloak  x-data="{ 'showModalmyAttendanceM{{ $media->id }}': false }" @keydown.escape="showmyModalAttendanceM{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showmyModalAttendanceM{{ $media->id }}">
                                                        <!-- Modal inner -->
                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmyAttendanceM{{ $media->id }}"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showmyModalAttendanceM{{ $media->id }} = true">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showmyModalAttendanceM{{ $media->id }} = false">
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
                                                    <div id="detail-myattendancemonitoring-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-gray-700 rounded-lg shadow">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                    <h3 class="text-xl font-semibold text-white">
                                                                        Details
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myattendancemonitoring-modal{{ $media->id }}">
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

                                                            <button data-modal-target="detail-myattendancemonitoring-modal{{ $media->id }}" data-modal-toggle="detail-myattendancemonitoring-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                            <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmyAttendanceM{{ $media->id }} = true">Rename</button>
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

                                            <div id="myattendancemonitoring-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                            <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="myattendancemonitoring-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-myattendancemonitoring" type="button">
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

                                        <a href={{ route('inventory-download-attendancem', $proposals->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'NarrativeFile') != null)

                    <div class="w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="mynarrativereport">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-mynarrative" data-modal-toggle="default-modal-mynarrative" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Narrative Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-mynarrative" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                            Narrative Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-mynarrative">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                            @if ($media->collection_name == 'NarrativeFile')
                                                <div data-tooltip-target="tooltip-proposal" type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="mynarrative-media-modal{{ $media->id}}" data-modal-toggle="mynarrative-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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


                                                    <div x-cloak  x-data="{ 'showModalmyNarrative{{ $media->id }}': false }" @keydown.escape="showModalmyNarrative{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmyNarrative{{ $media->id }}">
                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmyNarrative{{ $media->id }}"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmyNarrative{{ $media->id }} = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmyNarrative{{ $media->id }} = false">
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
                                                        <div id="detail-mynarrative-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-xl font-semibold text-white">
                                                                            Details
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-mynarrative-modal{{ $media->id }}">
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

                                                                <button data-modal-target="detail-mynarrative-modal{{ $media->id }}" data-modal-toggle="detail-mynarrative-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmyNarrative{{ $media->id }} = true">Rename</button>
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


                                                <div id="mynarrative-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="mynarrative-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-mynarrativereport" type="button">
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (($proposalfile->collection_name == 'TerminalFile') != null)
                    <div class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[17vh] 2xl:h-[12vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="myterminalreport">

                        <!-- Modal toggle -->
                        <button data-modal-target="default-modal-myterminal" data-modal-toggle="default-modal-myterminal" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 36 36"><path fill="#269" d="M0 29a4 4 0 0 0 4 4h24a4 4 0 0 0 4-4V12a4 4 0 0 0-4-4h-9c-3.562 0-3-5-8.438-5H4a4 4 0 0 0-4 4z"/><path fill="#55ACEE" d="M30 10h-6.562C18 10 18.562 15 15 15H6a4 4 0 0 0-4 4v10a1 1 0 1 1-2 0a4 4 0 0 0 4 4h26a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4"/></svg>
                            <span class="text-xs mt-4">Terminal Folder</span>
                        </button>

                        <!-- Main modal -->
                        <div id="default-modal-myterminal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                        <h3 class="text-xl font-semibold text-gray-600">
                                            Terminal Folder
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-myterminal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 grid grid-cols-3 gap-3">

                                        @foreach ($myfiles->medias as $media)
                                            @if ($media->collection_name == 'TerminalFile')

                                                <div class="w-full shadow rounded-lg transition-all  relative">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="myterminal-media-modal{{ $media->id}}" data-modal-toggle="myterminal-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
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

                                                    <div x-cloak  x-data="{ 'showModalmyTerminal{{ $media->id }}': false }" @keydown.escape="showModalmyTerminal{{ $media->id }} = false"  x-data="{ 'showModalmyTerminalDetail{{ $media->id }}': false }" @keydown.escape="showModalmyTerminalDetail{{ $media->id }} = false" class="absolute right-0 top-1">

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalmyTerminal{{ $media->id }}">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModalmyTerminal{{ $media->id }}"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModalmyTerminal{{ $media->id }} = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModalmyTerminal{{ $media->id }} = false">
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
                                                        <div id="detail-myterminal-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                            <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                                                <!-- Modal content -->
                                                                <div class="relative bg-gray-700 rounded-lg shadow">
                                                                    <!-- Modal header -->
                                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                                        <h3 class="text-xl font-semibold text-gray-600">
                                                                            Details
                                                                        </h3>
                                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-myterminal-modal{{ $media->id }}">
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
                                                                <button data-modal-target="detail-myterminal-modal{{ $media->id }}" data-modal-toggle="detail-myterminal-modal{{ $media->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                                                <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalmyTerminal{{ $media->id }} = true">Rename</button>
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

                                                <div id="myterminal-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="myterminal-media-modal{{ $media->id}}">
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

                        <div data-tooltip-target="tooltip-myterminalreport" type="button">

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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @endif
        </div>
    @endif
@endforeach
