
<div class="rounded-lg border border-gray-200 shadow-sm m-5 overflow-x-auto h-[70vh]">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
        <thead class="bg-gray-50">
            <tr class="sticky top-0 bg-gray-200 z-20">
                <th scope="col" class="px-6 py-4 font-medium ">Project Title</th>
                <th scope="col" class="px-6 py-4 font-medium ">Members</th>
                <th scope="col" class="px-6 py-4 font-medium ">Status</th>
                <th scope="col" class="px-6 py-4 font-medium ">Uploaded</th>

            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 border-t border-gray-100" id="searchResults">
            @foreach ($proposals as $proposal )

        <tr class="hover:bg-gray-50">

            <td class="px-6 py-4">

                    @foreach ($proposal->medias as $mediaLibrary)
                    @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'proposalPdf'))
                        <div data-tooltip-target="tooltip-proposal" type="button"
                            class="relative">

                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <span class="text-[.7rem] 2xl:text-xs font-medium text-gray-700 tracking-wider">
                                        {{ Str::limit($proposal->project_title, 70) }}
                                    </span>
                                </x-slot>

                                <x-slot name="title">
                                    <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                                </x-slot>

                                <div class="w-[50rem]">
                                    <iframe class="2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                                        src="{{ $proposal->getFirstMediaUrl('proposalPdf') }}"
                                        width=""></iframe>
                                </div>
                            </x-alpine-modal>
                        </div>


                    @endif
                @endforeach

            </td>

            <td class="px-4 py-4 text-sm whitespace-nowrap ">
                <div class="flex items-center">
                    @foreach ($proposal->proposal_members as $props )
                        <img class="object-cover w-6 h-6 -mx-1 border-2 border-white bg-white rounded-full  shrink-0" src="{{ (!empty($props->user->avatar))? url('upload/image-folder/profile-image/'. $props->user->avatar): url('upload/profile.png') }}" alt="">
                    @endforeach
                    {{--  <p class="flex items-center justify-center w-6 h-6 -mx-1 text-xs text-blue-600 bg-blue-100 border-2 border-white rounded-full">+4</p>  --}}
                </div>
            </td>

            <td class="px-6 py-4">
                <span class="inline-flex items-center gap-1 rounded-full py-1 text-xs  text-gray-700">
                    {{ $proposal->authorize }}
                </span>
            </td>

            <td class="px-6 py-4">
                <span class="inline-flex items-center gap-1 rounded-full py-1 text-[.7rem] 2xl:text-xs  text-gray-700">
                    {{ \Carbon\Carbon::parse($proposal->created_at)->format("M d, Y: H:i:s")}}
                </span>
            </td>



        </tr>
        @endforeach
        </tbody>
    </table>
</div>
