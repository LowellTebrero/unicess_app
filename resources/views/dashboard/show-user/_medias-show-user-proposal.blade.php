<div class="flex py-3 items-center xl:flex-wrap 2xl:flex-nowrap ">

    @foreach ($proposals->medias as $mediaLibrary)
        @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'proposalPdf'))
            <div data-tooltip-target="tooltip-proposal" type="button"
                class="bg-white  flex w-full xl:w-52 shadow-md rounded-lg hover:bg-slate-200 transition-all m-2 relative">

                <x-alpine-modal>

                    <x-slot name="scripts">
                        <div class="flex p-5 xl:p-3 2xl:p-5 w-full" target="__blank">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem]" width="30"
                                alt="">

                            <div class="text-xs ml-2 text-left">
                                <span class="">{{ Str::limit($mediaLibrary->file_name, 17) }}</span>
                                <span class="block">{{ $mediaLibrary->human_readable_size }}</span>
                            </div>

                        </div>
                    </x-slot>

                    <x-slot name="title">
                        <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                    </x-slot>

                    <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                            src="{{ $proposals->getFirstMediaUrl('proposalPdf') }}"
                            width=""></iframe>
                    </div>
                </x-alpine-modal>
            </div>

            <div id="tooltip-proposal" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <span class="text-xs">{{ $mediaLibrary->file_name }}</span>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        @endif
    @endforeach

    {{--  Special Order PDF  --}}
    @foreach ($proposals->medias as $mediaLibrary)
        @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'specialOrderPdf'))
            <div data-tooltip-target="tooltip-special_order" type="button"
                class="bg-white  flex w-full xl:w-52 shadow-md rounded-lg hover:bg-slate-200 transition-all m-2 relative">

                <x-alpine-modal>

                    <x-slot name="scripts">
                        <div class="flex p-5 xl:p-3 2xl:p-5 w-full" target="__blank">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem]" width="30"
                                alt="">

                            <div class="text-xs ml-2 text-left">
                                <span class="">{{ Str::limit($mediaLibrary->file_name, 17) }}</span>
                                <span class="block">{{ $mediaLibrary->human_readable_size }}</span>
                            </div>

                        </div>
                    </x-slot>

                    <x-slot name="title">
                        <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                    </x-slot>

                    <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                            src="{{ $proposals->getFirstMediaUrl('specialOrderPdf') }}"
                            width=""></iframe>
                    </div>
                </x-alpine-modal>


                {{--  <x-tooltip-modal>
                    <a href={{ url('downloads-pdf', $proposals->id) }}
                        class="block text-xs px-2 py-2 hover:text-black"
                        x-data="{ dropdownMenu: false }">Download</a>

                    @if ($proposal_member->leader_member_type == !null)
                        <form action="{{ route('inventory-delete-media', $mediaLibrary->id) }}"
                            method="POST" enctype="multipart/form-data"
                            onsubmit="return confirm ('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="block text-slate-800 text-xs px-2  hover:text-black"
                                type="submit">Delete</button>
                        </form>
                    @endif
                </x-tooltip-modal>  --}}
            </div>

            <div id="tooltip-special_order" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <span class="text-xs">{{ $mediaLibrary->file_name }}</span>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        @endif
    @endforeach

    {{--  Moa PDF  --}}
    @foreach ($proposals->medias as $mediaLibrary)
        @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'MoaPDF'))
            <div data-tooltip-target="tooltip-moa"
                class="bg-white  flex w-full xl:w-52 shadow-md rounded-lg hover:bg-slate-200 transition-all m-2 relative">

                <x-alpine-modal>

                    <x-slot name="scripts">
                        <div class="flex p-5 xl:p-3 2xl:p-5 w-full" target="__blank">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem]" width="30"
                                alt="">
                            <div class="text-xs ml-2 text-left">
                                <span class="">{{ Str::limit($mediaLibrary->file_name, 15) }}</span>
                                <span class="block">{{ $mediaLibrary->human_readable_size }}</span>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="title">
                        <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                    </x-slot>

                    <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                            src="{{ $proposals->getFirstMediaUrl('MoaPDF') }}" width=""></iframe>
                    </div>
                </x-alpine-modal>

                {{--  <x-tooltip-modal>
                    <a href={{ url('downloads-moa', $proposals->id) }}
                        class="block text-xs px-2 py-2 hover:text-black"
                        x-data="{ dropdownMenu: false }">Download</a>
                    @if ($proposal_member->leader_member_type == !null)
                        <form action="{{ route('inventory-delete-media', $mediaLibrary->id) }}"
                            method="POST" enctype="multipart/form-data"
                            onsubmit="return confirm ('Are you sure?')">
                            @csrf @method('DELETE')
                            <button class="block text-slate-800 text-xs px-2 hover:text-black"
                                type="submit">Delete</button>
                        </form>
                    @endif
                </x-tooltip-modal>  --}}
            </div>
            <div id="tooltip-moa" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <span class="text-xs">{{ $mediaLibrary->file_name }}</span>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        @endif
    @endforeach

    {{--  Office Order PDF  --}}
    @foreach ($proposals->medias as $mediaLibrary)
        @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'officeOrder'))
            <div data-tooltip-target="tooltip-office"
                class="bg-white  flex w-full xl:w-52 shadow-md rounded-lg hover:bg-slate-200  transition-all m-2 relative">

                <x-alpine-modal>
                    <x-slot name="scripts">
                        <div class="flex p-5 xl:p-3 2xl:p-5  w-full">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem]" width="30"
                                alt="">

                            <div class="text-xs ml-2 text-left">
                                <span class="">{{ Str::limit($mediaLibrary->file_name, 17) }}</span>
                                <span class="block">{{ $mediaLibrary->human_readable_size }}</span>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="title">
                        <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                    </x-slot>

                    <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                            src="{{ $proposals->getFirstMediaUrl('officeOrder') }}"
                            width=""></iframe>
                    </div>
                </x-alpine-modal>


                {{--  <x-tooltip-modal>

                    <a href={{ url('downloads-office', $proposals->id) }}
                        class="block text-xs px-2 py-2 hover:text-black"
                        x-data="{ dropdownMenu: false }">Download</a>

                    @if ($proposal_member->leader_member_type == !null)
                        <form action="{{ route('inventory-delete-media', $mediaLibrary->id) }}"
                            method="POST" enctype="multipart/form-data"
                            onsubmit="return confirm ('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="block text-slate-800 text-xs px-2  hover:text-black"
                                type="submit">Delete</button>
                        </form>
                    @endif
                </x-tooltip-modal>  --}}

            </div>
            <div id="tooltip-office" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <span class="text-xs">{{ $mediaLibrary->file_name }}</span>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        @endif
    @endforeach

    {{--  Travel Order PDF  --}}
    @foreach ($proposals->medias as $mediaLibrary)
        @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'travelOrder'))
            <div data-tooltip-target="tooltip-travel"
                class="bg-white  flex w-full xl:w-52 shadow-md rounded-lg hover:bg-slate-200  transition-all m-2 relative">


                <x-alpine-modal>
                    <x-slot name="scripts">
                        <div class="flex p-5 xl:p-3 2xl:p-5  w-full">
                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem]" width="30"
                                alt="">

                            <div class="text-xs ml-2 text-left">
                                <span class="">{{ Str::limit($mediaLibrary->file_name, 17) }}</span>
                                <span class="block">{{ $mediaLibrary->human_readable_size }}</span>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="title">
                        <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                    </x-slot>

                    <div class="w-[50rem]">
                        <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                            src="{{ $proposals->getFirstMediaUrl('travelOrder') }}"
                            width=""></iframe>
                    </div>
                </x-alpine-modal>



            </div>
            <div id="tooltip-travel" role="tooltip"
                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <span class="text-xs">{{ $mediaLibrary->file_name }}</span>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        @endif
    @endforeach
</div>
