

<div>
    <div class="p-3 relative">
        <div class="text-gray-700 flex w-full gap-2 ">

            <input type="text" name="search" wire:model.debounce.500ms="search" id="search" class="w-[9rem] sm:w-[10rem] text-xs  rounded border-slate-400" placeholder="Search...">

            <select class="text-xs  rounded border-slate-400 w-[8rem]" wire:model="collegesStatus">
                <option  value="">Colleges</option>
                <option  value="BSED">BSED</option>
                <option  value="CME">CME</option>
                <option  value="COE">COE</option>
                <option  value="CAS">CAS</option>
                <option  value="Graduate School">Graduate School</option>
            </select>

            <select class="text-xs  rounded border-slate-400 w-[8rem]" wire:model="status">
                <option  value="">Status</option>
                <option  value="pending">Pending</option>
                <option  value="ongoing">Ongoing</option>
                <option  value="finished">Finished</option>
            </select>



            <select class="text-xs  rounded border-slate-400 w-[6rem]" wire:model="activationStatus">
                <option  value="">Activation Status</option>
                <option  value="active">Active</option>
                <option  value="inactive">Inactive</option>
            </select>



            <select wire:model="Proposalsemester" name="Proposalsemester" id="Proposalsemester" class="w-[7rem] text-xs rounded  border-slate-400">
                <option value="1" {{ $Proposalsemester == 1 ? 'selected' : '' }}>1st Semester</option>
                <option value="2" {{ $Proposalsemester == 2 ? 'selected' : '' }}>2nd Semester</option>
            </select>

            <select wire:model="yearStatus" name="yearStatus" id="yearStatus" class="w-[6rem] text-xs rounded  border-slate-400">
                @foreach ($years as $year )
                <option value="{{ $year }}" @if ($yearStatus == date('Y')) selected="selected" @endif>{{ $year }}</option>
                @endforeach
            </select>

            <select wire:model="date" name="date" id="date" class="w-[7rem] text-xs rounded border-slate-400">
                <option value="">Anytime</option>
                <option value="week">Older than a week</option>
                <option value="month">Older than a month</option>
                <option value="six_months">Older than six months</option>
                <option value="year">Older than a year</option>
            </select>


            <select wire:model="paginateAllProposal" name="paginateAllProposal" id="paginateAllProposal" class="w-[5rem] text-xs rounded  border-slate-400">
                <option value="12">12</option>
                <option value="50">50</option>
                <option value="70">70</option>
            </select>


        </div>
    </div>

    <div class="overflow-x-auto p-2 pt-0 h-[56vh] 2xl:h-[75vh] ">
        <table class="table-auto w-full border-collapse">
            <thead class="text-[.7rem] text-gray-700 uppercase sticky top-0 z-30 bg-gray-200 w-full">
                @if ($allProposal->isNotEmpty())
                <tr>
                    <th>
                        <div><span>&nbsp;</span></div>

                    </th>

                    <th class="p-2 whitespace-nowrap hidden 2xl:block">
                        <div class="font-semibold text-left ">Uploader</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Extension Program of Projects</div>
                    </th>

                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">Colleges</div>
                    </th>
                    <th class="p-2 whitespace-nowrap hidden sm:block">
                        <div class="font-semibold text-left">Uploaded</div>
                    </th>
                    <th class="py-2 whitespace-nowrap w-[1rem]">
                        <div class="font-semibold text-center"></div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Status</div>
                    </th>
                    <th class="py-2 whitespace-nowrap">
                        <div class="font-semibold text-center"></div>
                    </th>
                </tr>
                @endif

            </thead>
            <tbody>

                @php
                    $count = ($allProposal->currentPage() - 1) * $allProposal->perPage();
                @endphp

                @forelse ($allProposal as $proposal )

                <tr class="hover:bg-gray-100 border ">

                    <td class="text-xs pl-2">{{ ++$count }}</td>
                    <td class="p-3 whitespace-nowrap hidden 2xl:block">
                        <a href={{ route('admin.extension-monitoring.show',  $proposal->id) }}>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                    class="rounded-full"
                                    src="{{ !empty($proposal->user->avatar) ? url('upload/image-folder/profile-image/' . $proposal->user->avatar) : url('upload/profile.png') }}"
                                    width="30" height="30">
                            </div>
                            <div class="font-medium text-gray-600 text-[.7rem]">
                                {{ $proposal->user->first_name }}
                            </div>
                        </div>
                    </a>
                    </td>
                    <td class="p-3 whitespace-nowrap">
                        <a href={{ route('admin.extension-monitoring.show', $proposal->id) }}>

                            <div class="text-left text-gray-600 text-[.6rem] xl:text-xs flex gap-1 items-center">
                                <svg class="fill-yellow-400 hover:fill-yellow-500" xmlns="http://www.w3.org/2000/svg" height="20"
                                viewBox="0 96 960 960" width="20">
                                <path d="M141 896q-24 0-42-18.5T81 836V316q0-23 18-41.5t42-18.5h280l60 60h340q23 0 41.5 18.5T881 376v460q0 23-18.5 41.5T821 896H141Z" />
                            </svg>
                                {{ Str::limit($proposal->project_title, 70) }}
                            </div>
                        </a>
                    </td>

                    <td class="p-3 whitespace-nowrap text-center">
                        <a href={{ route('admin.extension-monitoring.show', $proposal->id) }}>

                            <div class=" text-gray-600 text-[.6rem] xl:text-xs">
                                {{ $proposal->colleges_name }}
                            </div>
                        </a>
                    </td>

                    <td class="p-3 whitespace-nowrap  hidden sm:block">
                        <a href={{ route('admin.extension-monitoring.show', $proposal->id) }}>
                        {{--  <div class="text-left text-gray-600  text-[.6rem] xl:text-[.7rem]">
                            {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, Y,  g:i:s A')}}
                        </div>  --}}
                        <div class="text-left text-gray-600  text-[.6rem] xl:text-[.7rem]">
                            {{ $proposal->created_at->diffForHumans()}}
                        </div>
                        </a>
                    </td>


                    <td class="py-3 whitespace-nowrap w-[1rem]">
                        <a href={{ route('admin.extension-monitoring.show', $proposal->id) }}>
                        @if ($proposal->status == 'inactive')
                            <div
                                class="text-md text-center text-red-700 text-[.6rem] xl:text-xs flex items-center justify-start space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path fill="#ff5757" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2"/></svg>

                            </div>


                        @elseif ($proposal->status == 'active')
                        <div
                        class="text-md text-center text-green-700 text-[.6rem] xl:text-xs flex items-center justify-start  space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path fill="#04dc3a" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2"/></svg>

                    </div>
                        @endif
                        </a>
                    </td>

                    <td class="p-3 pl-0 whitespace-nowrap">
                        <a href={{ route('admin.extension-monitoring.show', $proposal->id) }}>
                        @if ($proposal->authorize == 'pending')
                            <div
                                class="text-md text-center  text-[.6rem] xl:text-xs ">
                                {{ $proposal->authorize }}</div>
                        @elseif ($proposal->authorize == 'ongoing')
                            <div
                                class="text-md text-center  text-[.6rem] xl:text-xs ">
                                {{ $proposal->authorize }}</div>
                        @elseif ($proposal->authorize == 'finished')
                            <div
                                class="text-md text-center text-[.6rem] xl:text-xs ">
                                {{ $proposal->authorize }}</div>
                        @endif
                        </a>
                    </td>

                    <td class="relative pl-4">

                        <div id="popup-modal" tabindex="-1" class="fixed inset-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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

                        <div x-cloak x-data="{dropdownMenu: false}" class="absolute left-0 top-3">
                            <!-- Dropdown toggle button -->
                            <button @click="dropdownMenu = ! dropdownMenu" class="flex items-center p-2 rounded-md absolute top-0 right-0 z-10">
                                <svg class="absolute hover:fill-blue-500 top-[-5]  z-10 left-0  fill-slate-600" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                            </button>
                            <!-- Dropdown list -->
                            <div x-show="dropdownMenu" class="z-50 absolute top-5 left-[-10rem] py-2 mt-2 bg-white rounded-md shadow-xl w-[10rem] space-y-2" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                                x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">


                                <button wire:click="openModal({{ $proposal->id }})"  class="hover:bg-gray-200 w-full focus:bg-red-200 py-2 text-xs px-3  text-left">Project Details</button>

                                <a href={{ url('download', $proposal->id) }}
                                    class="block text-xs px-3 py-2  text-left hover:text-gray-700 hover:bg-gray-200 focus:bg-green-200"
                                    x-data="{ dropdownMenu: false }">Download to zip
                                </a>

                                {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="hover:bg-gray-200 w-full focus:bg-red-200 py-2 text-xs px-3  text-left" type="button">
                                    Trash this Project
                                </button> --}}

                                <button wire:click="openModalForDeletion({{ $proposal->id }})"  class="hover:bg-gray-200 w-full focus:bg-red-200 py-2 text-xs px-3  text-left">Trash this Project</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr colspan="12">
                        <td class="text-lg">
                            <div class="h-[45vh] 2xl:h-[52vh] flex flex-col items-center justify-center space-y-2">
                                <img class="w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
                                <h1 class="text-md text-gray-500">Not Found!</h1>
                            </div>
                        </td>

                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
    <div class="px-4 text-xs"  wire:key="paginate-all-proposals">{{ $allProposal->links() }}</div>

    <!-- Modal -->
    @if($modalOpen)
    <div class="fixed inset-0 z-50 flex justify-center items-center bg-gray-900 bg-opacity-50" wire:click="closeModal" wire:keydown.escape="closeModal">
        <div class="modal-content shadow-lg " wire:click.stop>
            <div class="modal-header flex justify-center items-center p-2 bg-gray-700 text-white rounded-tl-lg rounded-tr-lg">
                <h5 class="modal-title text-sm text-center">{{ $selectedItem->project_title }}</h5>
                {{-- <button type="button" class="close" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body p-6 pt-7 bg-white rounded-bl-lg rounded-br-lg">
                <!-- content -->
                <div class="flex gap-4">
                <div class="space-y-2">
                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Project ID:</label>
                        <h1 class="text-xs">{{ $selectedItem->uuid }}</h1>
                    </div>
                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Created:</label>
                        <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($selectedItem->created_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                    </div>

                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Modified:</label>
                        <h1 class="text-xs tracking-wider">{{ \Carbon\Carbon::parse($selectedItem->updated_at)->format('l,  F d, Y,  g:i:s A')}}</h1>
                    </div>

                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Uploader:</label>
                        <h1 class="text-xs">{{ $selectedItem->user->name }}</h1>
                    </div>

                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Program name:</label>
                        <h1 class="text-xs">{{ $selectedItem->programs->program_name }}</h1>
                    </div>

                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Status:</label>
                        <h1 class="text-xs">{{ $selectedItem->authorize }}</h1>
                    </div>
                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Started date:</label>
                        <h1 class="text-xs tracking-wider">{{ $selectedItem->started_date == null ? 'No date' :  $selectedItem->started_date->format('M. d, Y') }}</h1>
                    </div>
                    <div>
                        <label class="text-xs text-gray-700 font-semibold tracking-wider">Finished date:</label>
                        <h1 class="text-xs tracking-wider">{{ $selectedItem->finished_date == null ? 'No date' :  $selectedItem->finished_date->format('M. d, Y') }}</h1>
                    </div>
                </div>
                <div class="space-y-2 px-4 overflow-y-auto h-[60vh] ">
                    <label class="text-xs font-medium">Proposal Member:</label>
                    @foreach ($selectedItem->proposal_members as $members  )
                        <h1 class="text-xs">{{ $members->user->name }}</h1>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer flex justify-end ">
                <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
            </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal -->
    @if($modalOpenForDeletion)
    <div class="fixed inset-0 z-50 flex justify-center items-center bg-gray-900 bg-opacity-50" wire:click="closeModal" wire:keydown.escape="closeModal">
        <div class="modal-content shadow-lg " wire:click.stop>
            <div class="modal-body p-6 pt-7 bg-gray-800  rounded-lg">
                <!-- content -->
                <div class="flex gap-4">
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to Trash this project?</h3>

                        <div class="flex space-x-4 items-center justify-center">
                            <form action={{ route('admin.inventory.delete-project-proposal', $selectedItemForDeletion->id) }} method="POST">
                                @csrf @method('DELETE')
                                <button wire:click="closeModalForDeletion" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    Yes, Im sure
                                </button>
                            </form>
                            <button wire:click="closeModalForDeletion" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif



</div>


