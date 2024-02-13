
@foreach ($inventory as $invent )
    @if ($invent->number == 1)
        <div class="flex p-5 px-2 xl:px-3 2xl:px-4 flex-wrap">
            @foreach ($proposals as $proposal )
            @foreach ($proposal->proposal_members as $prop )
                @if ($proposal->id == $prop->proposal_id)
                        <div class="bg-slate-100 shadow rounded-md hover:bg-slate-200 p-2 flex m-3 relative">

                            <a class="block  w-[10rem] text-[.7rem]"
                                href={{ route('inventory.show', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                <svg class="fill-blue-500 hover:fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="55"
                                    viewBox="0 96 960 960" width="55">
                                    <path d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z" />
                                </svg>
                                {{ Str::ucfirst(Str::lower(Str::limit($proposal->project_title, 50))) }}
                            </a>

                            <div x-cloak  x-data="{ 'showModal{{ $proposal->id }}': false }" @keydown.escape="showModal{{ $proposal->id }} = false" class="absolute top-0 right-2">

                                <!-- Modal -->
                                <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal{{ $proposal->id }}">

                                    <!-- Modal inner -->
                                    <div class="w-[40rem] py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal{{ $proposal->id }}"
                                        x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal{{ $proposal->id }} = false">

                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-between px-4 py-1">
                                            <h1 class="text-xs"> {{ Str::limit($proposal->project_title, 70) }}</h1>
                                            <button type="button" class=" z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1  text-xl font-semibold" @click="showModal{{ $proposal->id }} = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <hr>

                                        <!-- content -->
                                        <div class="p-5">
                                            <div class="space-y-2">
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Project ID:</label>
                                                    <h1 class="text-xs">{{ $proposal->uuid }}</h1>
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Created:</label>
                                                    <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposal->created_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                                                </div>

                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Modified:</label>
                                                    <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposal->updated_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                                                </div>

                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Uploader:</label>
                                                    <h1 class="text-xs">{{ $proposal->user->name }}</h1>
                                                </div>

                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Program name:</label>
                                                    <h1 class="text-xs">{{ $proposal->programs->program_name }}</h1>
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Started date:</label>
                                                    <h1 class="text-xs tracking-wider">{{ $proposal->started_date == null ? 'No date' :  $proposal->started_date->format('M. d, Y') }}</h1>
                                                </div>
                                                <div>
                                                    <label class="text-xs text-gray-700 font-semibold tracking-wider">Finished date:</label>
                                                    <h1 class="text-xs tracking-wider">{{ $proposal->finished_date == null ? 'No date' :  $proposal->finished_date->format('M. d, Y') }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="popup-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to trash this project?</h3>

                                                <div class="flex space-x-4 items-center justify-center">
                                                    <form action={{ route('inventory-delete-proposals', $proposal->id) }} method="POST">
                                                        @csrf @method('DELETE')
                                                        <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, Im sure
                                                        </button>
                                                    </form>
                                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div x-cloak x-data="{dropdownMenu: false}" class="absolute left-0">
                                    <!-- Dropdown toggle button -->
                                    <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2 rounded-md absolute top-0 right-0">
                                        <svg class="absolute hover:fill-blue-500 top-2 left-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                    </button>
                                    <!-- Dropdown list -->
                                    <div x-show="dropdownMenu" class="z-50 absolute right-[-5] py-2 mt-2 bg-white rounded-md shadow-xl w-[10rem] space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                        x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                        <button class="text-xs px-3 py-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal{{ $proposal->id }} = true">Properties</button>

                                        <a href={{ url('download', $proposal->id) }}
                                            class="block text-xs px-3 py-2  text-left hover:text-gray-700 hover:bg-gray-200 focus:bg-green-200"
                                            x-data="{ dropdownMenu: false }">Download to zip
                                        </a>

                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="hover:bg-gray-200 w-full focus:bg-red-200 py-2 text-xs px-3  text-left" type="button">
                                            Trash this Project
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>

    @elseif ($invent->number == 2)
        <div class="flex flex-wrap relative px-4">

            <div class="flex flex-col w-full">
                <div class="overflow-x-auto xl:h-[74vh] 2xl:h-[80vh]">
                    <table class="w-full">
                        <thead>
                            <tr class="sticky top-0 bg-white z-20">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                            <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploader</th>
                            <th scope="col" class="py-3 text-right text-xs font-medium text-gray-500 uppercase"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($proposals as $proposal )
                                @foreach ($proposal->proposal_members as $prop )

                                    @if ($proposal->id == $prop->proposal_id)

                                        <tr class="hover:bg-gray-200 ">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-600  w-[1/4]">
                                                <a href={{ route('inventory.show', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                                <div class="flex items-center space-x-2">
                                                    <svg class="fill-blue-500 hover:fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="40"
                                                    viewBox="0 96 960 960" width="40">
                                                    <path
                                                    d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z" />
                                                </svg>
                                                    <h1 class="text-xs">{{ Str::ucfirst(Str::lower(Str::limit($proposal->project_title, 90))) }}</h1>
                                                </div>
                                            </a>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 ">
                                                <a href={{ route('inventory.show', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                                <h1 class="text-xs">{{ \Carbon\Carbon::parse($proposal->created_at)->format("M d, Y")}}</h1>
                                                </a>
                                            </td>

                                            <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-700 relative">
                                                <a href={{ route('inventory.show', ['id' => $proposal->id, 'notification' => $proposal->id ]) }}>
                                                <h1 class="text-xs">{{ $proposal->user->name }}</h1>
                                                </a>
                                            </td>
                                            <td class="py-4 whitespace-nowrap text-left  text-gray-700 relative">
                                                <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute top-4 left-0 ">

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                        <!-- Modal inner -->
                                                        <div class="w-[40rem] py-4 bg-white rounded-lg shadow-lg" x-show="showModal"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h1 class="text-xs"> {{ Str::limit($proposal->project_title, 70) }}</h1>
                                                                <button type="button" class=" z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1  text-xl font-semibold" @click="showModal = false">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <hr>

                                                            <!-- content -->
                                                            <div class="p-5">
                                                                <div class="space-y-2">
                                                                    <div>
                                                                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Project ID:</label>
                                                                        <h1 class="text-xs">{{ $proposal->uuid }}</h1>
                                                                    </div>
                                                                    <div>
                                                                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Created:</label>
                                                                        <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposal->created_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                                                                    </div>

                                                                    <div>
                                                                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Modified:</label>
                                                                        <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($proposal->updated_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                                                                    </div>

                                                                    <div>
                                                                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Uploader:</label>
                                                                        <h1 class="text-xs">{{ $proposal->user->name }}</h1>
                                                                    </div>

                                                                    <div>
                                                                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Program name:</label>
                                                                        <h1 class="text-xs">{{ $proposal->programs->program_name }}</h1>
                                                                    </div>
                                                                    <div>
                                                                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Started date:</label>
                                                                        <h1 class="text-xs tracking-wider">{{ $proposal->started_date == null ? 'No date' :  $proposal->started_date->format('M. d, Y') }}</h1>
                                                                    </div>
                                                                    <div>
                                                                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Finished date:</label>
                                                                        <h1 class="text-xs tracking-wider">{{ $proposal->finished_date == null ? 'No date' :  $proposal->finished_date->format('M. d, Y') }}</h1>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="popup-modal" tabindex="-1" class="fixed top-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative w-full max-w-md max-h-full">
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                                <div class="p-6 text-center">
                                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                    </svg>
                                                                    <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Trash this project?</h3>

                                                                    <div class="flex space-x-4 items-center justify-center">
                                                                        <form action={{ route('inventory-delete-proposals', $proposal->id) }} method="POST">
                                                                            @csrf @method('DELETE')
                                                                            <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                                Yes, Im sure
                                                                            </button>
                                                                        </form>
                                                                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div x-cloak x-data="{dropdownMenu: false}">
                                                        <!-- Dropdown toggle button -->
                                                        <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2 rounded-md absolute top-0 right-5">
                                                            <svg class="absolute hover:fill-blue-500 top-2 left-0 fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                                                        </button>
                                                        <!-- Dropdown list -->
                                                        <div x-show="dropdownMenu" class="z-50 absolute right-0 top-4 py-2 mt-2 bg-white rounded-md shadow-xl w-[10rem] space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                                                            <button class="text-xs px-3 py-2 hover:bg-gray-200 w-full text-left" type="button" @click="showModal = true">Properties</button>

                                                            <a href={{ url('download', $proposal->id) }}
                                                                class="block text-xs px-3 py-2  text-left hover:text-gray-700 hover:bg-gray-200 focus:bg-green-200"
                                                                x-data="{ dropdownMenu: false }">Download to zip
                                                            </a>

                                                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="hover:bg-gray-200 w-full focus:bg-red-200 py-2 text-xs px-3  text-left" type="button">
                                                                Trash this Project
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endforeach
