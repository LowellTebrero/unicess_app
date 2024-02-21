    <style>
        [x-cloak] {
            display: none
        }
    </style>

<x-admin-layout>

    @section('title', 'Inventory | ' . config('app.name', 'UniCESS'))

    <section class="rounded-xl m-8 mt-4 2xl:mt-5 bg-white h-[82vh] 2xl:min-h-[87vh]">

        <header class="p-4 py-2 flex justify-between">
            <div class="flex space-x-1 items-center">
                <h1 class="2xl:text-2xl font-semibold text-gray-700 tracking-wider text-lg">Inventory Section</h1>
                <h1>
                    @foreach ($inventory as $invent )
                    @if ($invent->number == '1' )
                    (Program)
                    @elseif ($invent->number == '3')
                    (Files)
                    @elseif ($invent->number == '4')
                   (Project)
                    @endif
                    @endforeach
                </h1>
            </div>

            <div class="flex space-x-4 items-center">
                <div>



                @if ($medias && $medias->isNotEmpty())
                <button data-modal-target="popup-modal-backup" data-modal-toggle="popup-modal-backup" class="text-xs bg-blue-500 hover:bg-blue-600 text-white  rounded-xl px-3 p-2 flex space-x-4 items-center" type="button">
                    Back up Projects
                    <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 2v8m4-4l-4 4l-4-4"/><rect width="20" height="8" x="2" y="14" rx="2"/><path d="M6 18h.01M10 18h.01"/></g></svg>
                </button>
                @endif


                <div id="popup-modal-backup" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative  rounded-lg shadow bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-backup">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-sm font-normal text-gray-300">Are you sure you want to backup projects, these may contains {{ $totalFileSize }}?</h3>
                                <div class="flex space-x-4 justify-center">
                                    <a href={{ route('admin.inventory.backup-project') }}  class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Yes, I’m sure
                                    </a>
                                    <button data-modal-hide="popup-modal-backup" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
                <select id="myDropdown" class="xl:text-xs border-slate-500 rounded-lg">
                    @foreach ($inventory as $invent )
                    <option value="1" {{ old('1', $invent->number) == '1' ? 'selected' : '' }}>By Program</option>
                    <option value="3" {{ old('3', $invent->number) == '3' ? 'selected' : '' }}>By Files</option>
                    <option value="4" {{ old('4', $invent->number) == '4' ? 'selected' : '' }}>By Project</option>
                    @endforeach
                </select>

            </div>

        </header>

        <hr class="my-2">

       @foreach ($inventory as $invent )
            @if ($invent->number == 1)

            @if ($proposal->isEmpty())
                <div class="h-[45vh] 2xl:h-[50vh] flex flex-col items-center justify-center space-y-2">
                    <img class="w-[12rem]" src="{{ asset('img/Empty.jpg') }}">
                    <h1 class="text-md text-gray-500">It’s empty here</h1>
            </div>
            @else
            <div class="grid 2xl:grid-cols-4 gap-3 p-4 pt-7">
                @foreach ($program as $name)
                @foreach ($proposal as $proposals )
                    @if ($name->id === $proposals->program_id)

                <a href={{route('admin.inventory.proposal-show', $name->id)}} class="font-bold drop-shadow-md bg-white p-4  text-blue-900 rounded-xl w-full  hover:bg-slate-200 duration-100  relative">
                    <p class="absolute left-14 text-white px-2 text-xs py-1 rounded-full  bg-yellow-400"> {{ $proposals->qty }}</p>
                    <span class="absolute w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-2 top-0 left-0 rounded-tl-xl rounded-tr-xl"></span>
                    <span class="absolute w-full bg-white hover:bg-slate-100 h-2 bottom-0 left-0 rounded-bl-xl rounded-br-xl"></span>
                    <svg class="fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M7.05 40q-1.2 0-2.1-.925-.9-.925-.9-2.075V11q0-1.15.9-2.075Q5.85 8 7.05 8h14l3 3h17q1.15 0 2.075.925.925.925.925 2.075v23q0 1.15-.925 2.075Q42.2 40 41.05 40Z"/></svg>
                <span class="xl:text-xs 2xl:text-xs">{{ $name->program_name}}</span>
                </a>

                @endif
                @endforeach
                @endforeach
            </div>
            @endif

            @elseif ($invent->number == 3)

            @if ($medias->isEmpty())
                <div class="h-[45vh] 2xl:h-[50vh] flex flex-col items-center justify-center space-y-2">
                    <img class="w-[12rem]" src="{{ asset('img/Empty.jpg') }}">
                    <h1 class="text-md text-gray-500">It’s empty here</h1>
            </div>
            @else
            <div class="px-5 flex justify-between space-x-2">
                <div>
                    <select class="text-xs border-slate-500 rounded-lg" id="MySort">
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                    </select>
                </div>
                <div>
                    <input type="text"  class="text-xs border-slate-500 rounded-lg w-[20rem]" placeholder="Search Filename..." id="searchInput">
                    <select class="text-xs border-slate-500 rounded-lg" id="MyYear">
                        @foreach ($years as $year )
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>

                    <select id="myFiles" class="text-xs border-slate-500 rounded-lg">
                        <option value="">Select File</option>
                        <option value="proposalPdf">Proposal</option>
                        <option value="moaPdf">MOA</option>
                        <option value="specialOrderPdf">Special Order</option>
                        <option value="travelOrderPdf">Travel Order</option>
                        <option value="officeOrderPdf">Office Order</option>
                        <option value="otherFile">Others</option>
                        <option value="TemplateFile">Template</option>
                        <option value="NarrativeFile">Narrative</option>
                        <option value="TerminalFile">Terminal</option>
                        <option value="Attendance">Attendance</option>
                        <option value="AttendanceMonitoring">Attendance Monitor</option>
                    </select>
                </div>
            </div>


            <div id="filtered-data">
                @include('admin.inventory.index-filter._all-files-medias')
            </div>
            @endif


            @elseif ($invent->number == 4)

                @if ($proposals->isEmpty())
                    <div class="h-[45vh] 2xl:h-[50vh] flex flex-col items-center justify-center space-y-2">
                        <img class="w-[12rem]" src="{{ asset('img/Empty.jpg') }}">
                        <h1 class="text-md text-gray-500">It’s empty here</h1>
                </div>
                @else
                    <div class="px-5 flex justify-between space-x-2">

                    </div>
                    <div id="filtered-data">
                        @include('admin.inventory.index-filter._proposal-medias')
                    </div>
                @endif
            @endif
        @endforeach
    </section>


    <script>

        $(document).ready(function () {
            $('#myDropdown').on('change', function () {
                var selectedValue = $(this).val();

                $.ajax({
                    url: '/api/update-customize/1' ,
                    method: 'POST',
                    data: {
                        selected_value: selectedValue,
                        _token: '{{ csrf_token() }}' // Add CSRF token for security
                    },

                    success: function (response) {

                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        $(document).ready(function () {
            let timer;

            $('#searchInput').on('input', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var selected_value =  $('#MyYear').val();
                var files =  $('#myFiles').val();


                timer = setTimeout(function () {

                    $.ajax({
                        url: "{{ route('admin.inventory.admin-search') }}",
                        method: 'GET',
                        data: { query: query , selected_value: selected_value, files: files },
                        success: function (data) {
                            let resultsTable = $('#filtered-data');
                            resultsTable.empty();
                            $('#filtered-data').append(data);
                        }
                    });

                }, 300);
             // Adjust the delay as needed
            });

        });

        $(document).ready(function () {
            $('#MyYear').on('change', function () {
                var year = $(this).val();
                var query =  $('#searchInput').val();
                var files =  $('#myFiles').val();

                $.ajax({
                    url: "{{ route('admin.inventory.admin-filter') }}",
                    type: 'GET',
                    data: { year: year, query: query , files : files},
                    success: function(data) {
                        let resultsTable = $('#filtered-data');
                        resultsTable.empty();
                        $('#filtered-data').html(data);

                    }
                });
            });
        });

        $(document).ready(function () {
            $('#MySort').on('change', function () {
                var selectedValue = $(this).val();
                var year =  $('#MyYear').val();
                var files =  $('#myFiles').val();
                var query =  $('#searchInput').val();


                $.ajax({
                    url: "{{ route('admin.inventory.admin-sort') }}",
                    type: 'GET',
                    data: { selected_value: selectedValue, year: year, files: files, query: query  },
                    success: function(data) {
                        let resultsTable = $('#filtered-data');
                            resultsTable.empty();

                        $('#filtered-data').html(data);
                    }
                });
            });
        });

        $(document).ready(function () {
            $('#myFiles').on('change', function () {
                var selectedValue = $(this).val();
                var query =  $('#searchInput').val();
                var year =  $('#MyYear').val();

                $.ajax({
                    url: "{{ route('admin.inventory.admin-sort-file') }}",
                    type: 'GET',
                    data: { selected_value: selectedValue, query: query, year: year},
                    success: function(data) {
                        let resultsTable = $('#filtered-data');
                        resultsTable.empty();
                        $('#filtered-data').html(data);

                        $('#showModalButton').on('click', function() {
                            $('#default-modal').modal('show');
                        });
                            }
                });
            });
        });

    </script>

</x-admin-layout>


