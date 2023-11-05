<div>
    <div class="py-10">
        @if ($proposals->getFirstMediaUrl('otherFile') == !null)
            <h1 class="text-slate-500 text-sm">Additional files</h1>
        @endif


        <div class="flex flex-wrap">
            @foreach ($proposals->getMedia('otherFile') as $image)
                <div
                    class="bg-white  flex w-full  xl:w-48 shadow-md rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                    {{--  Modal Starts here  --}}
                    <div x-cloak x-data="{ 'showModal': false }" @keydown.escape="showModal = false"
                        class="absolute right-0 top-1">

                        <!-- Trigger for Modal -->

                        <!-- Modal -->
                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                            x-show="showModal">

                            <!-- Modal inner -->
                            <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg"
                                x-show="showModal" x-transition:enter="motion-safe:ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                @click.away="showModal = true">

                                <!-- Title / Close-->
                                <div class="flex items-center justify-between px-4 py-1">
                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                    <button type="button"
                                        class=" z-50 cursor-pointer text-red-500 text-xl font-semibold"
                                        @click="showModal = false">X</button>
                                </div>
                                <hr>

                                <!-- content -->
                                <div class="">
                                    <form action="{{ route('inventory-rename-media', $image->id) }}"
                                        method="POST">
                                        @csrf @method('PUT')

                                        <div class="flex flex-col items-center pt-5 px-4">
                                            <input type="text" value="{{ $image->file_name }}"
                                                name="file_name" class=" w-full rounded">

                                            <button type="submit"
                                                class="p-2 bg-blue-500 rounded mt-5 text-white">Rename</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div x-cloak x-data="{ dropdownMenu: false }" class=" absolute right-0">
                            <!-- Dropdown toggle button -->
                            <button @click="dropdownMenu = ! dropdownMenu"
                                class="flex items-center p-2 rounded-md">
                                <svg class="absolute hover:fill-blue-500 top-2 right-0 fill-slate-700"
                                    xmlns="http://www.w3.org/2000/svg" height="24"
                                    viewBox="0 96 960 960" width="24">
                                    <path
                                        d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z" />
                                </svg>
                            </button>
                            <!-- Dropdown list -->
                            <div x-show="dropdownMenu"
                                class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32"
                                x-on:keydown.escape.window="dropdownMenu = false"
                                @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                x-transition:enter="motion-safe:ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">


                                <button class="text-xs px-2" type="button"
                                    @click="showModal = true">Rename</button>
                                <a href={{ route('inventory-download-media', $image->id) }}
                                    class="block text-xs px-2 py-2 hover:text-black"
                                    x-data="{ dropdownMenu: false }">Download</a>

                                @if ($proposal_member->leader_member_type == !null)
                                    <form action="{{ route('inventory-delete-media', $image->id) }}"
                                        method="POST" enctype="multipart/form-data"
                                        onsubmit="return confirm ('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button class="block text-slate-800 text-xs px-2  hover:text-black"
                                            type="submit">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>


                    <x-alpine-modal>

                        <x-slot name="scripts">
                            <div class="flex p-5 xl:p-3 2xl:p-5  w-full">

                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                    <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]"
                                        width="30" alt="">
                                @else
                                    <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem]"
                                        width="30" alt="">
                                @endif

                                <div class="text-xs ml-2 text-left">
                                    <span
                                        class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->file_name, 15) }}</span>
                                    <span class="block">{{ $image->human_readable_size }}</span>
                                </div>
                            </div>
                        </x-slot>

                        <x-slot name="title">
                            <span
                                class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->file_name) }}</span>
                        </x-slot>

                        <div class="w-[50rem]">
                            @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                <div class=""><img class="shadow w-full "
                                        src="{{ $image->getUrl() }}"></div>
                            @else
                                <div><iframe class="shadow mt-2 w-full h-[80vh]"
                                        src="{{ $image->getUrl() }}"></iframe></div>
                            @endif
                        </div>
                    </x-alpine-modal>
                </div>
            @endforeach
        </div>
    </div>
</div>
