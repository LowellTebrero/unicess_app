@php
$maxLength = 18; // Adjust the maximum length as needed
@endphp

    @foreach ($inventory as $invent )
        @if ($invent->number == 1)
            <div class="flex flex-wrap folder" >
                <div class="flex flex-row space-x-1 p-2 showOption" style="display: none">
                    <button class="text-xs rounded text-white px-2 py-1 bg-red-500 YesDelete">Trash</button>
                    <button class="text-xs rounded text-white px-2 py-1 bg-red-500 selectAll">Select all</button>
                    <button class="text-xs rounded text-white px-2 py-1 bg-red-500 cancelButton">Cancel</button>
                </div>
                <div class="flex flex-col w-full">
                    <div class="p-2">
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

                                @foreach ($proposals->medias as $mediaLibrary)
                                    @if (!empty($mediaLibrary->model_type == 'App\Models\Proposal'))
                                        <tr class="hover:bg-gray-200" id="mediaLibrary{{ $mediaLibrary->id }}">
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

                                                    {{--  <input type="checkbox" class="hidden-checkbox absolute top-4 right-0" style="display:none" name="ids" value="{{ $mediaLibrary->id }}">  --}}

                                                    <div class="checkbox-wrapper-12">
                                                        <div class="cbx">
                                                        <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $mediaLibrary->id }}" style="display:none">
                                                        <label for="cbx-12"></label>
                                                        <svg fill="none" viewBox="0 0 15 14" height="14" width="15">
                                                            <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                        </svg>
                                                        </div>
                                                    </div>

                                                    <div x-cloak x-data="{dropdownMenu: false}" class=" absolute left-0 top-0">
                                                        <!-- Dropdown toggle button -->
                                                        <button @click="dropdownMenu = ! dropdownMenu" class="dropdownButtons flex items-center p-2 rounded-md" style="display:block">
                                                            <svg class="absolute hover:fill-blue-500 top-2 left-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                        </button>
                                                        <!-- Dropdown list -->
                                                        <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                            {{--  {{ $mediaCount }}  --}}
                                                            <button class="text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>

                                                            <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                            @if ($mediaCount > 1)
                                                                <button class="deleteAllButton block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                            @else
                                                                <form action={{ route('inventory-trash-media', $mediaLibrary->id) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Move to Trash</button>
                                                                </form>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif ($invent->number == 2)

            <div class="flex flex-row space-x-1 p-2 absolute z-10 top-[4.5rem] left-[5rem]" style="display:none" id="showOptionFolder">
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="TrashFolder">Trash</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="SelectFolder">Select all</button>
                <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="CancelFolder">Cancel</button>
            </div>

            <div class="flex py-3 items-center flex-wrap">
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
        @endif
    @endforeach


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

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



        // Delete By Files
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


            // Get the delete all button inside Modal
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




    </script>
