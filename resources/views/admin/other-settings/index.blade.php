<x-admin-layout>

    <style>
        [x-cloak] { display: none}

            .active-tab {
        /* Add your active styles here */
        background-color: #ffbb00;
        color: #ffffff;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        }
            .active-cad {
        /* Add your active styles here */
        background-color: #cecece;
        color: #ffffff;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        }

        .fc-event {
            padding: 10px;
            margin-bottom: 10px;
            font-size: 14px; /* Adjust the font size as needed */
            background-color: #e0e0e0; /* Background color for events */
            border-radius: 5px;
            cursor: pointer;
        }

        .fc-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .fc-description {
            color: #333; /* Text color for description */
        }



    </style>

    @section('title', 'Other | ' . config('app.name', 'UniCESS'))

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <?php flash()->addError($error); ?>
        @endforeach
    @endif

    <section class="rounded-xl shadow  text-slate-700 bg-white h-full">

        <div class="p-5 py-4">
            <h1 class=" font-semibold  text-lg 2xl:text-2xl tracking-wider">Settings Overview</h1>
        </div>
        <hr>

        <div class="p-5">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
                <li class="me-2"  id="tab-template">
                    <a href="#" onclick="showTab('template')" aria-current="page"  class="inline-block p-4 rounded-t-lg ">Template</a>
                </li>
                <li class="me-2"  id="tab-department">
                    <a href="#"  onclick="showTab('department')" class="inline-block p-4 rounded-t-lg">Department</a>
                </li>
                <li class="me-2"  id="tab-calendar">
                    <a href="#"  onclick="showTab('calendar')" class="inline-block p-4 rounded-t-lg">Calendar</a>
                </li>

            </ul>
        </div>


        <div class="bg-white border border-gray-300 shadow-sm  rounded-lg text-gray-700 m-5 p-2 tab-content" id="template-content" style="display: none;">
            <div class="p-5 flex justify-between items-center">
                <div>
                    <h1 class="tracking-wider font-medium text-gray-600 text-xs 2xl:text-base">CESO TEMPLATE HERE</h1>
                </div>

                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    @if ($templates->isEmpty())
                    Upload File
                    @else
                    Add File(s)
                    @endif
                </button>

                <!-- Main modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Upload Template File(s)
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form action={{ route('admin.templatepost.upload') }} method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="p-4 space-y-4 flex flex-col">
                                    <label class="text-sm 2xl:text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        Upload template file here...
                                    </label>
                                    <input type="file" multiple name="template_file[]"  class="text-sm 2xl:text-base border leading-relaxed text-white">
                                    @error('template_file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="Submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                    <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if ($templates->isEmpty())
            <div class="h-[30vh] 2xl:h-[52vh] flex flex-col items-center justify-center space-y-2">
                <img class="w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
                <h1 class="text-md text-gray-500">It’s empty here</h1>
               </div>
            @else
                <div class="p-4">
                    @foreach ($templates as $template )
                        @foreach ($template->medias as $media )
                            <div class="flex justify-between space-y-2">
                                <h1 class="text-xs 2xl:text-sm">{{ $media->file_name }}</h1>
                                <div class="flex space-x-2 ">
                                    <a href={{ url('download-media', $media->id) }} class="text-white bg-green-400 rounded-lg px-2 py-1 text-xs">Download</a>
                                    <form action={{ route('admin.template.delete', ['id' => $media->id, 'templateId' => $template->id]) }} method="POST" onsubmit="return confirm ('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button class="text-white bg-red-400 rounded-lg px-2 py-1 text-xs" type="submit">Delete</button>
                                    </form>

                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif


        </div>

        <div class="flex m-5 tab-content border border-gray-300 rounded-lg p-5" id="department-content"  style="display: none;">
            <div class="flex py-2  flex-col w-full">

                <div class="space-y-2">
                    <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

                        <!-- Trigger for Modal -->
                        <div class="flex justify-between items-center pb-4">
                            <h1 class="tracking-wider text-gray-600 font-medium">DEPARTMENT NAME</h1>
                            <button class="bg-blue-600 hover:bg-blue-500 p-2 rounded-lg text-white text-sm" type="button" @click="showModal = true">+ Add Department</button>
                        </div>


                        <!-- Modal -->
                        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal" id="add_post_modal"  >

                            <!-- Modal inner -->
                            <div class="w-1/4 px-6 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                                x-show="showModal"
                                x-transition:enter="motion-safe:ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                @click.away="showModal = false">

                                <!-- Title / Close-->
                                <div class="flex items-center justify-between mb-10 ">
                                    <h5 class="mr-3 text-black max-w-none">Add Department</h5>

                                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>


                                <!-- content -->
                                <div class="w-full">

                                    <form x-on:company-added.window="showModal = false"  class="w-full" method="POST" action="{{ route('admin.facultypost.upload') }}" >
                                        @csrf
                                        <div class="mb-3 w-full">
                                            <label class="text-gray-500" for="name">Faculty name:</label>
                                            <input type="text" wire:model="name" name="name" class="w-full rounded-md outline-none outline-0">
                                            @error('name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="w-full">
                                            <button class="bg-blue-500 text-white p-2 rounded-md w-full"  type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto h-[40vh] 2xl:h-[50vh] bg-white border rounded-lg">
                    <table class="table-auto w-full border-collapse">
                        <thead class="text-xs font-semibold uppercase text-gray-400">
                            <tr class="sticky top-0 w-full bg-gray-50">

                                <th class="p-2">
                                    <div class="text-left font-semibold">Faculty Name</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Created</div>
                                </th>


                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-sm ">

                            @foreach ($faculties as $faculty)
                            <tr>
                                <td class="p-2">
                                    <div class="text-gray-600 text-xs 2xl:text-md">{{ $faculty->name }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left text-gray-600 text-xs 2xl:text-md">{{ $faculty->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="flex m-5 tab-content overflow-x-auto h-[50vh] 2xl:h-[60vh] border border-gray-300 rounded-lg" id="calendar-content"  style="display: none;">

            <div class="p-5 sticky top-[0rem] z-20 bg-white">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
                    <li class="me-2"  id="cad-calendar-data">
                        <a href="#" onclick="showCad('calendar-data')" aria-current="page"  class="inline-block p-4 rounded-t-lg">Calendar Data</a>
                    </li>

                    <li class="me-2"  id="cad-calendar-date">
                        <a href="#"  onclick="showCad('calendar-date')" class="inline-block p-4 rounded-t-lg">Calendar Date</a>
                    </li>
                </ul>
            </div>

            <div class="cad-content" id="calendar-date-content" style="display: none;">
                <div id="calendars" class="bg-white shadow rounded-lg  p-10 w-auto"></div>
            </div>

            <div class="cad-content bg-white w-auto border m-5  rounded-lg p-5" id="calendar-data-content" style="display: none;">
                <header class="flex justify-between mb-2">
                    <h1 class="text-lg font-medium text-gray-600">Calendar Data</h1>
                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal-calendar-add" data-modal-toggle="default-modal-calendar-add" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        + Add Data
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal-calendar-add" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add Calendar Data
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-calendar-add">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action={{ route('admin.calendar.store') }} method="POST">
                                    @csrf
                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="flex flex-col">
                                            <label class="text-sm 2xl:text-base leading-relaxed text-gray-200">Description</label>
                                            <input type="text" class="text-sm 2xl:text-base leading-relaxed text-gray-600 rounded" name="title">
                                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-sm 2xl:text-base leading-relaxed text-gray-200">Start Date</label>
                                            <input type="date" class="text-sm 2xl:text-base leading-relaxed text-gray-600 rounded" name="start_time">
                                            @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-sm 2xl:text-base leading-relaxed text-gray-200">End Date</label>
                                            <input type="date" class="text-sm 2xl:text-base leading-relaxed text-gray-600 rounded" name="end_time">
                                            @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>


                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                        <button data-modal-hide="default-modal-calendar-add" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="h-[30vh] overflow-x-auto">
                    <table class="table-auto w-full relative">
                        <thead class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Created</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Title</div>
                                </th>

                                <th class="p-2 whitespace-nowrap w-[10rem]">
                                    <div class="font-semibold text-center">
                                        Option
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-xs divide-y divide-gray-100 ">
                            @foreach ($appointments as $calendar)
                            <tr class="hover:bg-gray-100">
                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700 xl:text-[.7rem]">
                                        {{ \Carbon\Carbon::parse($calendar->created_at)->format('M d, Y,  g:i:s A')}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left text-gray-700  xl:text-[.7rem]">
                                       {{Str::limit($calendar->title, 20)}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap text-center w-[10rem]">
                                    <div class="text-left text-gray-700 space-x-2 flex items-center justify-center">
                                            <!-- Modal toggle -->
                                            <button data-modal-target="default-modal-edit-calendar{{ $calendar->id }}" data-modal-toggle="default-modal-edit-calendar{{ $calendar->id }}" class="block text-white bg-green-400 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-3 py-1 text-center" type="button">
                                                Edit
                                            </button>

                                            <!-- Main modal -->
                                            <div id="default-modal-edit-calendar{{ $calendar->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Edit calendar Details
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-edit-calendar{{ $calendar->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form action={{ route('admin.calendar.update', $calendar->id ) }} method="POST">
                                                            @csrf @method('PATCH')
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Title</label>
                                                                    <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title" value="{{$calendar->title}}">
                                                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Start Date</label>
                                                                    <input type="datetime-local" class="text-base leading-relaxed text-gray-600 rounded" name="start_time" value="{{$calendar->start_time }}">
                                                                    @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">End Date</label>
                                                                    <input type="datetime-local" class="text-base leading-relaxed text-gray-600 rounded" name="end_time" value="{{$calendar->end_time}}">
                                                                    @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>


                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Calendar Data</button>
                                                                <button data-modal-hide="default-modal-edit-calendar{{ $calendar->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <form action="{{ route('admin.calendar.delete', $calendar->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit flex jusify-center items-center">
                                                {{--  <svg class="fill-red-400" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="30"><path d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z"/></svg>  --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>

    <x-messages/>

</x-admin-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>


    <script>

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('selectedOtherSettingsTab');
            if (storedTab) {
                // Show the stored tab content
                document.getElementById(storedTab + '-content').style.display = 'block';

                // Add 'active' class to the stored tab (if needed)
                document.querySelector('[onclick="showTab(\'' + storedTab + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-' + storedTab).classList.add('active-tab');
            } else {
                // If no stored tab, show the 'narrative-content' by default
                document.getElementById('template-content').style.display = 'block';

                // Add 'active' class to the 'narrative' tab (if needed)
                document.querySelector('[onclick="showTab(\'template\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-template').classList.add('active-tab');
            }
        });

        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Remove 'active' class from all tabs (if needed)
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Remove 'active-tab' class from all <li> elements (if needed)
            document.querySelectorAll('li').forEach(function (li) {
                li.classList.remove('active-tab');
            });

            // Show the selected tab content
            document.getElementById(tabId + '-content').style.display = 'block';

            // Add 'active' class to the clicked tab (if needed)
            document.querySelector('[onclick="showTab(\'' + tabId + '\')"]').classList.add('active');

            // Add 'active-tab' class to the corresponding <li>
            document.getElementById('tab-' + tabId).classList.add('active-tab');

            // Store the selected tab in localStorage
            localStorage.setItem('selectedOtherSettingsTab', tabId);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#calendars').fullCalendar({
                events: {!! json_encode($events) !!},
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                eventRender: function (event, element) {
                    // Set the HTML content of the event element
                    element.html('<strong>' + event.title + '</strong>');

                    element.css({
                        padding: '10px', // Adjust the padding value as needed
                        border: '1px solid #ccc', // Optional: Add a border for better visibility
                        borderRadius: '5px', // Optional: Add border-radius for rounded corners
                        backgroundColor: '#3080ff', // Optional: Add a background color
                        cursor: 'pointer',
                    });
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Hide all cad contents
            document.querySelectorAll('.cad-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored cad in localStorage
            var storedCad = localStorage.getItem('selectedCalendarCad');
            if (storedCad) {
                // Show the stored cad content
                document.getElementById(storedCad + '-content').style.display = 'block';

                // Add 'active' class to the stored cad (if needed)
                document.querySelector('[onclick="showCad(\'' + storedCad + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('cad-' + storedCad).classList.add('active-cad');
            } else {
                // If no stored cad, show the 'narrative-content' by default
                document.getElementById('calendar-data-content').style.display = 'block';

                // Add 'active' class to the 'narrative' cad (if needed)
                document.querySelector('[onclick="showCad(\'calendar-data\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('cad-calendar-data').classList.add('active-cad');
            }
        });

        function showCad(cadId) {
            // Hide all cad contents
            document.querySelectorAll('.cad-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Remove 'active' class from all cads (if needed)
            document.querySelectorAll('.cad').forEach(function (cad) {
                cad.classList.remove('active');
            });

            // Remove 'active-cad' class from all <li> elements (if needed)
            document.querySelectorAll('li').forEach(function (li) {
                li.classList.remove('active-cad');
            });

            // Show the selected cad content
            document.getElementById(cadId + '-content').style.display = 'block';

            // Add 'active' class to the clicked cad (if needed)
            document.querySelector('[onclick="showCad(\'' + cadId + '\')"]').classList.add('active');

            // Add 'active-cad' class to the corresponding <li>
            document.getElementById('cad-' + cadId).classList.add('active-cad');

            // Store the selected cad in localStorage
            localStorage.setItem('selectedCalendarCad', cadId);
        }
    </script>




