@php
$maxLength = 18; // Adjust the maximum length as needed
@endphp
<div class="relative shadow-md sm:rounded-lg w-full overflow-x-auto 2xl:h-[70vh] h-[60vh]">
    <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 sticky top-0 z-10">
            <tr>
                <th scope="col" class="px-2 sm:px-6 py-3 text-[.6rem] sm:text-xs">Name</th>
                <th scope="col" class="px-2 sm:px-6 py-3 text-[.6rem] sm:text-xs">Last Modified</th>
                <th scope="col" class="px-2 sm:px-6 py-3 text-[.6rem] sm:text-xs">Document type</th>
                <th scope="col" class="px-2 sm:px-6 py-3 text-[.6rem] sm:text-xs">File type</th>
                <th scope="col" class="px-2 sm:px-6 py-3 text-[.6rem] sm:text-xs">File size</th>
                <th scope="col" class="px-2 sm:px-6 py-3 text-[.6rem] sm:text-xs"><span>&nbsp;</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposals->medias as $mediaLibrary)
                @if (!empty($mediaLibrary->model_type == 'App\Models\Proposal'))
                    <tr class="bg-white border-b  hover:bg-gray-50 ">

                        <td class="px-2 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 flex items-center space-x-2">
                            <x-alpine-modal>
                                <x-slot name="scripts">
                                    <div class="flex items-center  space-x-2 " target="__blank">
                                        <div>
                                            <div class="hidden sm:block">
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
                                        </div>

                                        <div class="text-[.7rem] sm:text-xs text-left">
                                            @if (strlen($mediaLibrary->file_name) <= 10)
                                            <span>{{ Str::limit($mediaLibrary->file_name, 20) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                            @else
                                            <span>{{ Str::limit($mediaLibrary->file_name, 20) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </x-slot>

                                <x-slot name="title">
                                    <span>{{ Str::limit($mediaLibrary->file_name, 20) }}</span>
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
                        </td>

                        <td class="px-2 sm:px-6 py-4">
                            <span class="block text-[.7rem] sm:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                        </td>

                        <td class="px-2 sm:px-6 py-4">
                            <span class="block text-[.7rem] sm:text-xs 2xl:text-sm">{{ $mediaLibrary->collection_name }}</span>
                        </td>

                        <td class="px-2 sm:px-6 py-4">
                            <span class="block text-[.7rem] sm:text-xs 2xl:text-sm">
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

                        <td class="px-2 sm:px-6 py-4">
                            <span class="block text-[.7rem]  sm:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                        </td>


                        <td class="px-2 sm:px-6 py-4 whitespace-nowrap text-sm text-center  text-gray-800 relative">
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
