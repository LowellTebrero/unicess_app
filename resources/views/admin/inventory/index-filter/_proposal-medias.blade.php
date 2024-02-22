
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 2xl:grid-cols-7 gap-3 p-4 pt-7">

   

    @foreach ($proposals as $proposal )
    <div class="bg-slate-100 shadow rounded-md hover:bg-slate-200 p-2 flex relative">

        <a class="block  w-[10rem] text-[.7rem]"
            href={{ route('admin.inventory.show-inventory', $proposal->id ) }}>
            <svg class="fill-yellow-400 hover:fill-yellow-500" xmlns="http://www.w3.org/2000/svg" height="55"
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
                                <label class="text-xs text-gray-700 font-semibold tracking-wider">Status:</label>
                                <h1 class="text-xs">{{ $proposal->authorize }}</h1>
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
                            <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Trash this project?</h3>

                            <div class="flex space-x-4 items-center justify-center">
                                <form action={{ route('admin.inventory.delete-project-proposal', $proposal->id) }} method="POST">
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
    @endforeach
</div>

