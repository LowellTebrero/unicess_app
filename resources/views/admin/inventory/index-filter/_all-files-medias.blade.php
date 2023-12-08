<div class="flex justify-evenly 2xl:space-x-5 xl:space-x-2 p-5 pb-0 xl:text-xs ">
    <div class="flex flex-col w-full">
        <div class="">
        <div class="min-w-full inline-block align-middle">
            <div class="overflow-x-auto xl:h-[65vh] 2xl:h-[70vh] border">
                <table class="min-w-full divide-y divide-gray-200 ">
                <thead>
                <tr class="sticky top-0 bg-gray-100 z-20">
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th scope="col" class="px-6 pr-0 py-3 text-left text-xs font-medium text-gray-500 uppercase w-[7rem]">Size</th>
                    <th scope="col" class="px-6 pr-0 py-3 text-left text-xs font-medium text-gray-500 uppercase w-[10rem]">created</th>
                    <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase w-[5rem]">Action</th>
                </tr>
                </thead>


                <tbody class="divide-y divide-gray-200">
                    @foreach ($medias as $media )
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-200">

                        <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800">
                            <div data-tooltip-target="tooltip-proposal" type="button" class="relative ">

                                <x-alpine-modal>

                                    <x-slot name="scripts">

                                        <div class="flex items-center space-x-2">
                                            <div class="flex" target="__blank">
                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                <img src="{{ asset('img/image-icon.png') }}"
                                                    class="2xl:w-[2rem]" width="30" alt="">

                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                <img src="{{ asset('img/docx.png') }}" class="2xl:w-[2rem]" width="25" alt="">
                                                @else
                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2rem]"
                                                    width="30" alt="">
                                                @endif
                                            </div>
                                            <div>
                                                {{  Str::limit($media->file_name, 70) }}
                                            </div>

                                         </div>
                                    </x-slot>

                                    <x-slot name="title">
                                        <span class="">{{ Str::limit($media->file_name) }}</span>
                                    </x-slot>

                                    <div class="w-[50rem]">
                                        @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')

                                        <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>

                                        @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                        <div class="p-5 flex items-center flex-col">
                                            <h1 class="text-center">This file format does not support viewing download only.</h1>
                                            <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                        </div>
                                        @else
                                        <div>
                                        <iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe>
                                        </div>
                                        @endif
                                    </div>
                                </x-alpine-modal>


                            </div>
                        </td>
                        {{--  <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-800 ">{{ $media->mime_type }}</td>  --}}
                        <td class="px-6 py-4 pr-0 whitespace-nowrap text-xs text-gray-800 ">{{ $media->human_readable_size }}</td>
                        <td class="px-6 py-4 pr-0 whitespace-nowrap text-xs text-gray-800 ">{{ $media->created_at }}</td>
                        <td class="whitespace-nowrap text-left text-xs font-medium relative">

                            <div data-tooltip-target="tooltip-proposal" type="button" class="relative ">

                                   <div class="absolute right-10 bottom-5">
                                    <x-tooltip-modal>
                                        <a href={{ route('admin.inventory.admin-download-media', $media->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>


                                        {{--  <form action="{{ route('admin.proposal.delete-media-proposal', $mediaLibrary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                            @csrf
                                            @method('DELETE')
                                        <button class="block text-slate-800 text-xs px-2 hover:text-black" type="submit">
                                            Delete
                                        </button>
                                        </form>  --}}
                                    </x-tooltip-modal>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
