@foreach ($inventory as $invent )
    @if ($invent->number == 1)
    <div class="flex flex-wrap">

        @php
        $maxLength = 18; // Adjust the maximum length as needed
        @endphp

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


                                                    <form action="{{ route('inventory-delete-media', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
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
    </div>
</div>
</div>
        @elseif ($invent->number == 2)
        <div class="flex py-3 items-center flex-wrap">
            @php
            $maxLength = 18; // Adjust the maximum length as needed
            @endphp


            @foreach ($proposals->medias as $mediaLibrary)
            @if (!empty($mediaLibrary->model_type == 'App\Models\Proposal'))
                    <div data-tooltip-target="tooltip-proposal" type="button" class="bg-white w-full sm:w-[10rem] xl:w-[10rem] xl:min-h-[14vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative">

                        <x-alpine-modal>
                            <x-slot name="scripts">
                                <div class="flex items-center flex-col p-4 space-y-3" target="__blank">
                                    <div>
                                        @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                        <img src="{{asset('img/image-icon.png') }}" class="xl:w-[3rem]" width="30">
                                         @elseif ($mediaLibrary->mime_type == 'text/plain')
                                        <img src="{{asset('img/text-document.png') }}" class="xl:w-[3rem]" width="30">
                                        @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                        <img src="{{asset('img/docx.png')}}" class="xl:w-[3rem]" width="30">
                                        @else
                                        <img src="{{asset('img/pdf.png')}}" class="xl:w-[3rem]" width="30">
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

                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

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
                                                <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class=" w-full rounded">
                                                <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-white">Rename</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail modal -->
                            <div id="detail-project-media-modal{{ $mediaLibrary->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0  left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full bg-opacity-0">
                                    <!-- Modal content -->
                                    <div class="relative bg-gray-700 rounded-lg shadow">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                            <h3 class="text-xl font-semibold text-white">
                                                Details
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-project-media-modal{{ $mediaLibrary->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-2">
                                            <p class="text-sm leading-relaxed text-white">
                                                Uploaded at: {{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, Y g:i:s A') }}
                                            </p>
                                            <p class="text-sm leading-relaxed text-white">
                                                Project Type: {{ $mediaLibrary->collection_name }}
                                            </p>
                                            <p class="text-sm leading-relaxed text-white">
                                                File name: {{ $mediaLibrary->file_name }}
                                            </p>
                                            <p class="text-sm leading-relaxed text-white">
                                                File size: {{ $mediaLibrary->size }} kb
                                            </p>

                                            <p class="text-sm leading-relaxed text-white">
                                                File type: {{ $mediaLibrary->mime_type }}
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                <!-- Dropdown toggle button -->
                                <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2 rounded-md">
                                    <svg class="absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                </button>
                                <!-- Dropdown list -->
                                <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                    x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                    <button data-modal-target="detail-project-media-modal{{ $mediaLibrary->id }}" data-modal-toggle="detail-project-media-modal{{ $mediaLibrary->id }}" class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button">Details</button>
                                    <button class="text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                    <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
                                    <form action="{{ route('inventory-delete-media', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                        @csrf
                                        @method('DELETE')
                                        <button class="block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            @endif
            @endforeach

            @if ($proposals->narrativereport->isEmpty())
            @else
                <div class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[14vh]  shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="narrativereport">

                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal-narrative" data-modal-toggle="default-modal-narrative" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                        <span class="text-xs mt-4">Narrative Folder</span>
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal-narrative" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-5xl h-[80%]">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
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
                                <div class="p-4 grid grid-cols-3 gap-3">
                                   @foreach ($proposals->narrativereport as $narrative )
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
                                            <div x-cloak  x-data="{ 'showModalNarrative{{ $media->id }}': false }" @keydown.escape="showModalNarrative{{ $media->id }} = false" class="absolute right-0 top-1 ">

                                                <!-- Modal -->
                                                {{--  <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalNarrative{{ $media->id }}">

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
                                                </div>  --}}

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
                                                        {{--  <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalNarrative{{ $media->id }} = true">Rename</button>  --}}
                                                        <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
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
                                       @endforeach
                                   @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div data-tooltip-target="tooltip-narrativereport" type="button">
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

            @if ($proposals->terminalreport->isEmpty())
            @else
                <div class="bg-white w-[10rem] sm:w-[10rem] xl:w-[10rem] xl:h-[14vh] shadow-md rounded-lg hover:bg-slate-100 transition-all m-2 relative" id="narrativereport">

                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal-terminal" data-modal-toggle="default-modal-terminal" class="text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                        <span class="text-xs mt-4">Terminal Folder</span>
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal-terminal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-5xl h-[80%]">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
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
                                <div class="p-4 grid grid-cols-3 gap-3">
                                   @foreach ($proposals->terminalreport as $terminal )
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

                                            <div x-cloak  x-data="{ 'showModalTerminal{{ $media->id }}': false }" @keydown.escape="showModalTerminal{{ $media->id }} = false"  x-data="{ 'showModalTerminalDetail{{ $media->id }}': false }" @keydown.escape="showModalTerminalDetail{{ $media->id }} = false" class="absolute right-0 top-1">

                                                <!-- Modal -->
                                                <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModalTerminal{{ $media->id }}">

                                                    {{--  <!-- Modal inner -->
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
                                                    </div>  --}}
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
                                                        {{--  <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModalTerminal{{ $media->id }} = true">Rename</button>  --}}
                                                        <a href={{ url('download-media', $media->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>
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
                                       @endforeach
                                   @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div data-tooltip-target="tooltip-narrativereport" type="button">

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
        </div>
    @endif
@endforeach
