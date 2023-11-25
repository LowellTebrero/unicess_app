<x-admin-layout>

    <style>
        [x-cloak] { display: none }
    </style>
    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    <section class="2xl:min-h-[87vh] h-[85vh] mt-5 m-8 rounded-lg bg-white text-gray-700">
        <header class="p-5 py-4 justify-between items-center flex">
            <h1 class="2xl:text-2xl font-semibold tracking-wider text-gray-700">Proposal Request Overview</h1>
            <a href={{ route('admin.dashboard.member-request') }} class="hover:bg-gray-200 focus:bg-red-200 rounded px-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <main>
            <div class="p-7 m-10 rounded border flex xl:flex-row flex-col space-y-5 xl:space-y-0">

                <div class="w-full flex space-y-5 flex-col sm:flex-row sm:space-y-0 sm:space-x-4  xl:flex-col xl:space-y-5 xl:space-x-0  ">

                    <div>
                        <h1 class="mb-4 tracking-wider">Profile Information</h1>
                        <div class="flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full w-[3rem] border sm:w-[4rem] xl:w-[5rem] 2xl:w-[7rem]"
                            src="{{ !empty($ProposalRequest->user->avatar) ? url('upload/image-folder/profile-image/' . $ProposalRequest->user->avatar) : url('upload/profile.png') }}"
                            width="100" height="100">
                        </div>

                        <div class="text-gray-600 text-xs space-y-1 mt-2 tracking-wider">
                            <h1>Name : {{ $ProposalRequest->user->name }} </h1>
                            <h1>Email : {{ $ProposalRequest->user->email }} </h1>
                            @foreach (  $ProposalRequest->user->roles as $role )
                            <h1>Role : {{$role->name }} </h1>
                            @endforeach
                            <h1>Faculty : {{ $ProposalRequest->user->faculty->name }} </h1>
                        </div>
                    </div>

                    <div class="w-full text-gray-600">
                        <h1 class="mb-2 tracking-wider">Proposal Information</h1>
                        <div class="space-y-4">
                            <div>
                                <label class="text-xs tracking-wider ">Project Title:</label>
                                <h1 class="text-xs w-auto">{{ $ProposalRequest->proposal_title }}</h1>
                            </div>

                            <div>
                                <h1 class="text-xs tracking-wider mb-1">Member Type:</h1>
                                @if ($ProposalRequest->leader_member_type == !NULL)
                                <h1 class="text-xs tracking-wider">Leader: {{ $ProposalRequest->ceso->role_name }}</h1>
                                <h1 class="text-xs tracking-wider">Location: {{ $ProposalRequest->leader_location == NULL ? 'N/A' : $ProposalRequest->location->location_name }}</h1>
                                @elseif($ProposalRequest->member_type == !NULL)
                                <h1 class="text-xs tracking-wider">Member: {{ $ProposalRequest->member_type }}</h1>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="w-full text-gray-600">
                        <h1 class="mb-2 tracking-wider">Request Status</h1>
                        <div class="space-y-4">
                            <div>
                                @if ($ProposalRequest->status == 'pending')
                                <label class="text-xs tracking-wider">Pending </label>
                                @else
                                <label class="text-xs tracking-wider">Added Successfully</label>
                                @endif



                            </div>

                        </div>
                    </div>
                </div>


                <div class="w-full text-gray-600">
                    <h1 class="tracking-wider mb-2 ">Proof for Reference</h1>

                    <div class="flex flex-wrap">

                        @foreach ($ProposalRequest->medias as $mediaLibrary)
                            @if ((!empty($mediaLibrary->model_id)) && (!empty($mediaLibrary->collection_name)))


                                <div data-tooltip-target="tooltip-proposal" type="button" class="m-2 ml-0 flex flex-row bg-white w-[10rem] sm:w-[9rem] xl:w-[9rem] 2xl:w-[10rem] xl:min-h-[10vh] shadow-md rounded-lg hover:bg-slate-100 transition-all relative" id="proposal_id{{ $mediaLibrary->id }}">

                                    <x-alpine-modal>
                                        <x-slot name="scripts">
                                            <div class="flex items-center flex-col p-4 space-y-3" target="__blank">
                                                <div>
                                                    @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                                    <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[2rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'text/plain')
                                                    <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[2rem]" width="30">
                                                    @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                    <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[2rem]" width="30">
                                                    @else
                                                    <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[2rem]" width="30">
                                                    @endif
                                                </div>

                                                <div class="text-[.7rem] text-left">
                                                @if (strlen($mediaLibrary->file_name) <= 10)
                                                <span>{{ Str::limit($mediaLibrary->file_name, 20) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                                @else
                                                <span>{{ Str::limit($mediaLibrary->file_name, 15) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                                @endif
                                                </div>
                                            </div>
                                        </x-slot>

                                        <x-slot name="title">
                                            <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                                        </x-slot>

                                        <div class="w-[50rem]">
                                            {{--  <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposals->getFirstMediaUrl('proposalPdf') }}"></iframe>  --}}
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

                                    {{--  <input type="checkbox" id="checkboxes" class="absolute right-0 top-1" style="opacity: 0%">  --}}
                                    <input type="checkbox" class="hidden-checkbox absolute top-1 right-2"  style="display:none;" name="ids" value="{{ $mediaLibrary->id }}">
                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1 ">

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
                                                    <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModal = false">
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


                                        <div x-cloak x-data="{dropdownMenu: false}" class=" absolute right-0">
                                            <!-- Dropdown toggle button -->
                                            <button @click="dropdownMenu = ! dropdownMenu" class="tooltipButton  flex items-center p-2 rounded-md" style="display: block">
                                                <svg class=" absolute hover:fill-blue-500 top-2 right-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                            </button>
                                            <!-- Dropdown list -->
                                            <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-32 space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">


                                                <button class="text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>

                                                <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                 <button class="deleteAllButton block text-slate-800 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit" id="deleteAllButton">Delete</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            @endforeach
                    </div>
                </div>
            </div>
        </main>
    </section>


</x-admin-layout>
