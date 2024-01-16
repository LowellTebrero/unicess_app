@php
$maxLength = 18; // Adjust the maximum length as needed
@endphp
<div class="relative shadow-md sm:rounded-lg w-full overflow-x-auto 2xl:h-[70vh] h-[60vh]">
    <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 sticky top-0 z-10">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Last Modified</th>
                <th scope="col" class="px-6 py-3">Document type</th>
                <th scope="col" class="px-6 py-3">File type</th>
                <th scope="col" class="px-6 py-3">File size</th>
                <th scope="col" class="px-6 py-3"><span>&nbsp;</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proposals->medias as $mediaLibrary)
            @if (!empty($mediaLibrary->model_type == 'App\Models\Proposal'))
                    <tr class="bg-white border-b  hover:bg-gray-50 ">

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

                        <td class="px-6 py-4">
                            <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->collection_name }}</span>
                        </td>

                        <td class="px-6 py-4">
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

                        <td class="px-6 py-4">
                            <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                        </td>


                        <td class="px-6 py-4 relative ">
                            <div class="absolute right-4 top-0">
                                <x-tooltip-modal>

                                    <a href={{ url('downloads-pdf', $proposals->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                                    <form action="{{ route('admin.inventory.delete-media', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                        @csrf
                                        @method('DELETE')
                                    <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                                        Delete
                                    </button>
                                    </form>
                                </x-tooltip-modal>
                            </div>

                        </td>
                    </tr>
                @endif
            @endforeach

            @foreach ($proposals->narrativereport as $narrative)
                @foreach ($narrative->medias as $mediaLibrary)
                    @if (!empty($narrative))
                    <tr class="bg-white border-b  hover:bg-gray-50 ">

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

                        <td class="px-6 py-4">
                            <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->collection_name }}</span>
                        </td>

                        <td class="px-6 py-4">
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

                        <td class="px-6 py-4">
                            <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                        </td>


                        <td class="px-6 py-4 relative">
                            <div class="absolute right-4 top-0">
                            <x-tooltip-modal>

                                <a href={{ url('downloads-pdf', $narrative->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                                <form action="{{ route('admin.inventory.delete-media', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                    @csrf
                                    @method('DELETE')
                                <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                                    Delete
                                </button>
                                </form>
                            </x-tooltip-modal>
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            @endforeach

            @foreach ($proposals->terminalreport as $terminal)
            @foreach ($terminal->medias as $mediaLibrary)
                @if (!empty($terminal))
                <tr class="bg-white border-b  hover:bg-gray-50 ">

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

                    <td class="px-6 py-4">
                        <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->updated_at }}</span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->collection_name }}</span>
                    </td>

                    <td class="px-6 py-4">
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

                    <td class="px-6 py-4">
                        <span class="block xl:text-xs 2xl:text-sm">{{ $mediaLibrary->human_readable_size }}</span>
                    </td>


                    <td class="px-6 py-4 relative">
                        <div class="absolute right-4 top-0">
                        <x-tooltip-modal>

                            <a href={{ url('downloads-pdf', $narrative->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                            <form action="{{ route('admin.inventory.delete-media', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                @csrf
                                @method('DELETE')
                            <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                                Delete
                            </button>
                            </form>
                        </x-tooltip-modal>
                        </div>
                    </td>
                </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
