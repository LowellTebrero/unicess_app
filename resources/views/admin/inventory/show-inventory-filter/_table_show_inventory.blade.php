<div class="relative shadow-md sm:rounded-lg w-full">
    <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Last Modified</th>
                <th scope="col" class="px-6 py-3">File size</th>
                <th scope="col" class="px-6 py-3"><span>&nbsp;</span></th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b  hover:bg-gray-50 ">
                @foreach ($proposals->medias as $mediaLibrary)
                @if ((!empty($mediaLibrary->model_id)) && (!empty($mediaLibrary->collection_name == 'proposalPdf')))
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center ">
                    <x-alpine-modal>

                        <x-slot name="scripts">
                            <div scope="row" class="font-medium text-gray-900 whitespace-nowrap flex items-center ">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[1.5rem] mr-2" width="25"  alt="">
                            <span class="xl:text-xs 2xl:text-sm">{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </div>
                        </x-slot>

                        <x-slot name="title">
                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </x-slot>

                        <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposals->getFirstMediaUrl('proposalPdf') }}" width=""></iframe>
                        </div>
                    </x-alpine-modal>
                </th>

                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                </td>
                <td class="px-6 py-4 relative">

                    <x-tooltip-modal>

                        <a href={{ url('downloads-pdf', $proposals->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                        <form action="{{ route('admin.proposal.delete-media-proposal', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                            @csrf
                            @method('DELETE')
                        <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                            Delete
                        </button>
                        </form>
                    </x-tooltip-modal>

                </td>
                @endif
                @endforeach
            </tr>

            <tr class="bg-white border-b  hover:bg-gray-50 ">
                @foreach ($proposals->medias as $mediaLibrary)
                @if ((!empty($mediaLibrary->model_id)) && (!empty($mediaLibrary->collection_name == 'specialOrderPdf')))
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center ">
                    <x-alpine-modal>

                        <x-slot name="scripts">
                            <div scope="row" class="font-medium text-gray-900 whitespace-nowrap flex items-center ">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[1.5rem] mr-2" width="25"  alt="">
                            <span class="xl:text-xs 2xl:text-sm">{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </div>
                        </x-slot>

                        <x-slot name="title">
                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </x-slot>

                        <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposals->getFirstMediaUrl('specialOrderPdf') }}" width=""></iframe>
                        </div>
                        </x-alpine-modal>
                </th>

                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                </td>
                <td class="px-6 py-4 relative">

                    <x-tooltip-modal>

                        <a href={{ url('downloads-special-order', $proposals->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                        <form action="{{ route('admin.proposal.delete-media-proposal', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                            @csrf
                            @method('DELETE')
                        <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                            Delete
                        </button>
                        </form>
                    </x-tooltip-modal>

                </td>
                @endif
                @endforeach
            </tr>

            <tr class="bg-white border-b  hover:bg-gray-50 ">
                @foreach ($proposals->medias as $mediaLibrary)
                @if ((!empty($mediaLibrary->model_id)) && (!empty($mediaLibrary->collection_name == 'MoaPDF')))
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center ">
                    <x-alpine-modal>

                        <x-slot name="scripts">
                            <div scope="row" class="font-medium text-gray-900 whitespace-nowrap flex items-center ">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[1.5rem] mr-2" width="25"  alt="">
                            <span class="xl:text-xs 2xl:text-sm">{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </div>
                        </x-slot>

                        <x-slot name="title">
                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </x-slot>

                        <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposals->getFirstMediaUrl('MoaPDF') }}" width=""></iframe>
                        </div>
                        </x-alpine-modal>
                </th>

                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                </td>
                <td class="px-6 py-4 relative">

                    <x-tooltip-modal>

                        <a href={{ url('downloads-moa', $proposals->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                        <form action="{{ route('admin.proposal.delete-media-proposal', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                            @csrf
                            @method('DELETE')
                        <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                            Delete
                        </button>
                        </form>
                    </x-tooltip-modal>

                </td>
                @endif
                @endforeach
            </tr>
            <tr class="bg-white border-b  hover:bg-gray-50 ">
                @foreach ($proposals->medias as $mediaLibrary)
                @if ((!empty($mediaLibrary->model_id)) && (!empty($mediaLibrary->collection_name == 'officeOrder')))
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center ">
                    <x-alpine-modal>

                        <x-slot name="scripts">
                            <div scope="row" class="font-medium text-gray-900 whitespace-nowrap flex items-center ">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[1.5rem] mr-2" width="25"  alt="">
                            <span class="xl:text-xs 2xl:text-sm">{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </div>
                        </x-slot>

                        <x-slot name="title">
                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </x-slot>

                        <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposals->getFirstMediaUrl('officeOrder') }}" width=""></iframe>
                        </div>
                        </x-alpine-modal>
                </th>

                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                </td>
                <td class="px-6 py-4 relative">

                    <x-tooltip-modal>

                        <a href={{ url('downloads-office', $proposals->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                        <form action="{{ route('admin.proposal.delete-media-proposal', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                            @csrf
                            @method('DELETE')
                        <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                            Delete
                        </button>
                        </form>
                    </x-tooltip-modal>

                </td>
                @endif
                @endforeach
            </tr>
            <tr class="bg-white border-b  hover:bg-gray-50 ">
                @foreach ($proposals->medias as $mediaLibrary)
                @if ((!empty($mediaLibrary->model_id)) && (!empty($mediaLibrary->collection_name == 'travelOrder')))
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center ">
                    <x-alpine-modal>

                        <x-slot name="scripts">
                            <div scope="row" class="font-medium text-gray-900 whitespace-nowrap flex items-center ">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[1.5rem] mr-2" width="25"  alt="">
                            <span class="xl:text-xs 2xl:text-sm">{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </div>
                        </x-slot>

                        <x-slot name="title">
                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                        </x-slot>

                        <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposals->getFirstMediaUrl('travelOrder') }}" width=""></iframe>
                        </div>
                        </x-alpine-modal>
                </th>

                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                </td>
                <td class="px-6 py-4 relative">

                    <x-tooltip-modal>

                        <a href={{ url('downloads-travel', $proposals->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                        <form action="{{ route('admin.proposal.delete-media-proposal', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                            @csrf
                            @method('DELETE')
                        <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                            Delete
                        </button>
                        </form>
                    </x-tooltip-modal>

                </td>
                @endif
                @endforeach
            </tr>

            @foreach ($proposals->getMedia('otherFile') as $image)
            <tr class="bg-white border-b  hover:bg-gray-50">

                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center ">
                    <x-alpine-modal>

                        <x-slot name="scripts">
                            <div scope="row" class="font-medium text-gray-900 whitespace-nowrap flex items-center ">
                            @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                            <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[1.5rem] mr-2" width="25" alt="">
                            @elseif ($image->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                            <img src="{{ asset('img/docx.png') }}" class="2xl:w-[1.5rem] mr-2" width="25" alt="">
                            @else
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[1.5rem] mr-2" width="25" alt="">
                            @endif
                            <span class="xl:text-xs 2xl:text-sm">{{ Str::limit($image->file_name, 50) }}</span>
                            </div>
                        </x-slot>

                        <x-slot name="title">
                            <span>{{ Str::limit($image->file_name) }}</span>
                        </x-slot>

                        <div class="w-[50rem]">
                            @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')

                            <div><img class="shadow w-full " src="{{  $image->getUrl() }}"></div>

                            @elseif ($image->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                            <div class="p-5 flex items-center flex-col">
                                <h1 class="text-center">This file format does not support viewing download only.</h1>
                                <a href={{ url('download-media', $image->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                            </div>
                            @else
                            <div>
                            <iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $image->getUrl() }}"></iframe>
                            </div>
                            @endif
                        </div>
                    </x-alpine-modal>
                </th>



                <td class="px-6 py-4">
                    <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="block">{{ $image->human_readable_size }}</span>
                </td>
                <td class="px-6 py-4 relative">
                    {{--  Modal Starts here  --}}
            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

            <!-- Trigger for Modal -->

            <!-- Modal -->
            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                <!-- Modal inner -->
                <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between px-4 py-1">
                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                </div>
                <hr>

                <!-- content -->
                <div>

                    <form action="{{route('admin.proposal.rename-ongoing-proposal', $image->id)}}" method="POST">
                        @csrf @method('PUT')

                        <div class="flex flex-col items-center pt-5 px-4">
                        <input type="text" value="{{ $image->file_name }}" name="file_name" class=" w-full rounded">

                        <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-white">Rename</button>
                    </div>
                    </form>
                </div>
                </div>

            </div>


            <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                <!-- Dropdown toggle button -->
                <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2   rounded-md">
                    <svg class="absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                </button>
                <!-- Dropdown list -->
                <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">


                <button class="text-xs px-2" type="button" @click="showModal = true">Rename</button>
                <a href={{ route('admin.proposal.download-media-files', $image->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>

                <form action="{{ route('admin.proposal.delete-media-proposal', $image->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                    @csrf
                    @method('DELETE')
                <button class="block text-slate-800 text-xs px-2  hover:text-black" type="submit">
                    Delete
                </button>
                </form>
                </div>

            </div>
        </div>
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>
</div>
