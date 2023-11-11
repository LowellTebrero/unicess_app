
<div class=" rounded-lg border border-gray-200 shadow-sm m-8 overflow-x-auto h-[70vh]">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
        <thead class="bg-gray-50">
            <tr class="sticky top-0 bg-gray-200 z-20">
                <th scope="col" class="px-6 py-4 font-medium ">Project Title</th>
                <th scope="col" class="px-6 py-4 font-medium ">Status</th>
                <th scope="col" class="px-6 py-4 font-medium ">Uploaded</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 border-t border-gray-100" id="searchResults">
            @foreach ($myproposal as $proposal )
            @foreach ($proposal->proposal_members as $prop )
            @if ($proposal->id == $prop->proposal_id)

        <tr class="hover:bg-gray-50">

            <td class="px-6 py-4">
                @foreach ($proposal->medias as $mediaLibrary)
                @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'proposalPdf'))
                    <div data-tooltip-target="tooltip-proposal" type="button"
                        class="relative">

                        <x-alpine-modal>

                            <x-slot name="scripts">
                                <span class="text-xs font-medium text-gray-900 tracking-wider">
                                    {{ Str::limit($proposal->project_title, 70) }}
                                </span>
                            </x-slot>

                            <x-slot name="title">
                                <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                            </x-slot>

                            <div class="w-[50rem]">
                                <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                                    src="{{ $proposal->getFirstMediaUrl('proposalPdf') }}"
                                    width=""></iframe>
                            </div>
                        </x-alpine-modal>
                    </div>


                @endif
            @endforeach
            </td>

            <td class="px-6 py-4">
                <span class="inline-flex items-center gap-1 rounded-full py-1 text-xs  text-gray-900">
                    {{ $proposal->authorize }}
                </span>
            </td>

            <td class="px-6 py-4">
                <span class="inline-flex items-center gap-1 rounded-full py-1 text-xs  text-gray-900">
                    {{ \Carbon\Carbon::parse($proposal->created_at)->format("M d, Y: H:i:s")}}
                </span>
            </td>



        </tr>
        @endif
        @endforeach
        @endforeach
        </tbody>
    </table>
</div>
