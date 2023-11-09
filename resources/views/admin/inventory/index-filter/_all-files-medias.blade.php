<div class="flex justify-evenly 2xl:space-x-5 xl:space-x-2 p-5 xl:text-xs ">

    <div class="flex flex-col w-full">
        <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 ">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    {{--  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>  --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Size</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">created</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
                </thead>


                <tbody class="divide-y divide-gray-200">
                    @foreach ($medias as $media )
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-200">

                        <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800 ">{{  Str::limit($media->file_name, 70) }}</td>
                        {{--  <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-800 ">{{ $media->mime_type }}</td>  --}}
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-800 ">{{ $media->human_readable_size }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-800 ">{{ $media->created_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-left text-xs font-medium">
                                <div data-tooltip-target="tooltip-proposal" type="button" class="relative ">

                                    <x-alpine-modal>

                                        <x-slot name="scripts">

                                            <div class="flex" target="__blank">
                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                <img src="{{ asset('img/image-icon.png') }}"
                                                    class="2xl:w-[2rem]" width="30" alt="">
                                            @else
                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2rem]"
                                                    width="30" alt="">
                                            @endif



                                            </div>
                                        </x-slot>

                                        <x-slot name="title">
                                            <span class="">{{ Str::limit($media->file_name) }}</span>
                                        </x-slot>

                                        <div class="w-[50rem]">
                                            <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                                                src="{{ $media->getUrl()}}"></iframe>
                                        </div>
                                    </x-alpine-modal>

                                    <div class="absolute top-0 right-0">
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
