
    <style>
        [x-cloak] { display: none}

            .active-tab {
        /* Add your active styles here */
        background-color: #ffbb00;
        color: #ffffff;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        }

    </style>
<x-admin-layout>


    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <?php flash()->addError($error); ?>
    @endforeach
    @endif


    <section class="mt-4 2xl:mt-5 m-8 h-[82vh] 2xl:h-[87vh] bg-white rounded-lg overflow-x-auto text-gray-600">

        <header class="bg-white sticky top-0 z-20">
            <h1 class="text-2xl font-semibold p-4">Calendar Section</h1>
            <hr>
        </header>

        <div class="p-5 sticky top-[4rem] z-10 bg-white">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
                <li class="me-2"  id="tab-calendar-data">
                    <a href="#" onclick="showTab('calendar-data')" aria-current="page"  class="inline-block p-4 rounded-t-lg">Calendar Data</a>
                </li>

                <li class="me-2"  id="tab-calendar">
                    <a href="#"  onclick="showTab('calendar')" class="inline-block p-4 rounded-t-lg">Calendar</a>
                </li>
            </ul>
        </div>


             <div class="tab-content" id="calendar-content" style="display: none;">
                <div id="calendars" class="bg-white shadow rounded-lg  p-10 w-auto"></div>
            </div>

            <div class="tab-content bg-white w-auto 2xl:h-[40vh]  rounded-lg mb-5 2xl:mb-0 p-5" id="calendar-data-content" style="display: none;">
                <header class="flex justify-between">
                    <h1 class="text-lg font-medium text-gray-600">Calendar Data</h1>
                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        + Add Data
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add Calendar Data
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
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
                                            <label class="text-sm 2xl:text-base leading-relaxed text-gray-200">Title</label>
                                            <input type="text" class="text-sm 2xl:text-base leading-relaxed text-gray-600 rounded" name="title">
                                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-sm 2xl:text-base leading-relaxed text-gray-200">Description</label>
                                            <textarea name="description" class="text-sm 2xl:text-base leading-relaxed text-gray-600 rounded h-[15vh] 2xl:h-[20vh]" cols="30" rows="10"></textarea>
                                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                                        <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
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
                                                                    <label class="text-base leading-relaxed text-gray-200">Description</label>
                                                                    <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10">{{$calendar->description}}</textarea>
                                                                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
                                                                <button data-modal-hide="default-modal-edit-calendar{{ $calendar->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
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



    </section>

    <style>
    /* Custom styles for FullCalendar events */
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


    @push('scripts')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>

        <script>
            // Wrap your script inside a document ready function
                /* $(document).ready(function() {
                $('#calendar').fullCalendar({
                    events: {!! json_encode($events) !!},
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    eventRender: function (event, element) {
                        element.find('.fc-title').html('<strong>' + event.title + '</strong><br/>' + event.description);
                    }
                });
                });
            */
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
                        element.html('<strong>' + event.title + '</strong><br>' + event.description);

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


        </script>
    @endpush
</x-admin-layout>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('selectedCalendarTab');
            if (storedTab) {
                // Show the stored tab content
                document.getElementById(storedTab + '-content').style.display = 'block';

                // Add 'active' class to the stored tab (if needed)
                document.querySelector('[onclick="showTab(\'' + storedTab + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-' + storedTab).classList.add('active-tab');
            } else {
                // If no stored tab, show the 'narrative-content' by default
                document.getElementById('calendar-data-content').style.display = 'block';

                // Add 'active' class to the 'narrative' tab (if needed)
                document.querySelector('[onclick="showTab(\'calendar-data\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-calendar-data').classList.add('active-tab');
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
            localStorage.setItem('selectedCalendarTab', tabId);
        }
    </script>
