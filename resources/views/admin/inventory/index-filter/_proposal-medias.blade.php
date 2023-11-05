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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">created</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
                </thead>


                <tbody class="divide-y divide-gray-200">
                    @foreach ($proposals as $proposal )
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-200">


                        <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800">
                            <a href={{route('admin.inventory.show-inventory', $proposal->id)}}>
                            {{  Str::limit($proposal->project_title, 120) }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-800">
                            <a href={{route('admin.inventory.show-inventory', $proposal->id)}}>
                            {{ $proposal->authorize}}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-800">
                            <a href={{route('admin.inventory.show-inventory', $proposal->id)}}>
                            {{ $proposal->created_at }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                <div data-tooltip-target="tooltip-proposal" type="button" class="relative">

                                    @foreach ($proposal->medias as $mediaLibrary)
                                    @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'proposalPdf'))
                                        <div data-tooltip-target="tooltip-proposal" type="button" class="relative">

                                            <x-alpine-modal>

                                                <x-slot name="scripts">
                                                    <div class="flex" target="__blank">
                                                        <img src="{{ asset('img/pdf.png') }}" class="xl:w-[2rem]">
                                                    </div>
                                                </x-slot>

                                                <x-slot name="title">
                                                    <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                                                </x-slot>

                                                <div class="w-[50rem]">
                                                    <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                                                        src="{{ $proposal->getFirstMediaUrl('proposalPdf') }}"
                                                        width=""></iframe>
                                                </div>
                                            </x-alpine-modal>
                                        </div>




                                    {{--  <div class="absolute top-0 right-0">
                                        <x-tooltip-modal>
                                            <a href={{ route('admin.inventory.admin-download-media', $proposal->id) }} class="block text-xs px-2 py-2 hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                                        </x-tooltip-modal>
                                    </div>  --}}
                                </div>
                                @endif
                                @endforeach
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
