<x-admin-layout>

    @section('title', 'Show Terminal | ' . config('app.name', 'UniCESS'))
    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <?php flash()->addError($error); ?>
    @endforeach
    @endif

    <section class="text-gray-700 h-[82vh] 2xl:min-h-[87vh] m-8 mt-5  bg-white rounded-xl shadow">

        <header class="flex justify-between p-5 py-4">
            <div>
                <h1 class="tracking-wider 2xl:text-2xl font-semibold text-lg">Show Terminal User </h1>
            </div>
            <a href={{ route('admin.dashboard.terminal-index') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <main class="p-10 ">

            <div class="h-[25vh] overflow-x-auto">
                <table class="table-auto relative w-full">
                    <thead class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Uploaded at</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Uploader Name</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Member Name</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Extension Program/Project Title</div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="text-xs divide-y divide-gray-100 ">

                        @foreach ($terminalReports as $terminal)

                        <tr class="hover:bg-gray-100">
                            <td class="p-3 whitespace-nowrap">
                            <button data-modal-target="default-modal{{ $terminal->id }}" data-modal-toggle="default-modal{{ $terminal->id }}" class="text-left text-xs py-2.5" type="button">
                            {{ \Carbon\Carbon::parse($terminal->created_at)->format('M d, Y,  g:i:s A')}}
                            </button>
                            </td>

                            <td class="p-3 whitespace-nowrap">

                                <button data-modal-target="default-modal{{ $terminal->id }}" data-modal-toggle="default-modal{{ $terminal->id }}" class="text-left text-xs py-2.5" type="button">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                                class="rounded-full"
                                                src="{{ !empty($terminal->users->avatar) ? url('upload/image-folder/profile-image/' . $terminal->users->avatar) : url('upload/profile.png') }}"
                                                width="30" height="30">
                                        </div>
                                        <div class=" text-gray-600 text-[.7rem]">
                                            {{ $terminal->users->name }}
                                            <h1 class="text-xs tracking-wider">{{ $terminal->users->email }}</h1>
                                        </div>
                                    </div>
                                    </button>

                            </td>

                            <td class="p-3 whitespace-nowrap text-left">
                                @foreach ($terminal->users->proposals as $user)
                                @if ($user->proposal_id == $terminal->proposal_id)

                                    <button data-modal-target="default-modal{{ $terminal->id }}" data-modal-toggle="default-modal{{ $terminal->id }}" class="text-left text-xs py-2.5" type="button">
                                        @if ($user->leader_member_type == !null)
                                        <h1 class="text-xs tracking-wider">Leader Type: {{ $user->ceso_role->role_name }}</h1>
                                        @else
                                        <h1 class="text-xs tracking-wider">Member Type: {{ $user->member_type }}</h1>
                                        @endif
                                    </button>

                                @endif
                                @endforeach
                            </td>

                            <td class="p-3 whitespace-nowrap text-left">
                                <button data-modal-target="default-modal{{ $terminal->id }}" data-modal-toggle="default-modal{{ $terminal->id }}" class="text-left text-xs py-2.5" type="button">
                                    {{Str::limit($terminal->proposals->project_title, 50)}}
                                    </button>

                            </td>

                            <!-- Main modal -->
                            <div id="default-modal{{ $terminal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-4xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{Str::limit($terminal->proposals->project_title, 80)}}
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal{{ $terminal->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>



                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 grid grid-cols-2 xl:grid-cols-3 gap-2 w-full">
                                                    @foreach ($terminal->medias as $mediaLibrary)
                                                    <div data-tooltip-target="tooltip-proposal" type="button" class="text-white shadow-md rounded-lg hover:bg-gray-600 transition-all m-2 relative" id="proposal_id{{ $mediaLibrary->id }}">

                                                        <x-alpine-modal>
                                                            <x-slot name="scripts">
                                                                <div class="flex items-center p-4 space-x-2" target="__blank">
                                                                    <div>
                                                                        @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                                                        <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                        @elseif ($mediaLibrary->mime_type == 'text/plain')
                                                                        <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                        @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                        <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                                        @else
                                                                        <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
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
                                                                            <input type="text" value="{{ $mediaLibrary->file_name }}" name="file_name" class="text-gray-700 w-full rounded">
                                                                            <button type="submit" class="p-2 bg-blue-500 rounded mt-5 text-gray-700">Rename</button>
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

                                                                    <button class="text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Rename</button>
                                                                    <a href={{ url('download-media', $mediaLibrary->id) }} class="block text-xs px-2 hover:text-black text-gray-700 hover:bg-gray-200 w-full text-left" x-data="{dropdownMenu: false}">Download</a>

                                                                    <form action={{ route('report-terminal.delete',[ 'id' => $mediaLibrary->id, 'terminalId' => $terminal->id]) }} method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="block text-gray-700 text-xs px-2 hover:bg-gray-200 w-full text-left hover:text-black" type="submit">Delete</button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                    </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </main>

    </section>
</x-admin-layout>
