    <style>
        [x-cloak] {
            display: none
        }
    </style>

<x-admin-layout>

    @section('title', 'Inventory | ' . config('app.name', 'UniCESS'))

    <div class="rounded-xl m-8 mt-5 bg-white h-[82vh] 2xl:min-h-[87vh]">

        <div class="p-4 py-2 flex justify-between">
            <div class="flex space-x-1 items-center">
                <h1 class="2xl:text-2xl font-semibold text-gray-700 tracking-wider text-lg">Inventory Section</h1>
                <h1>
                    @foreach ($inventory as $invent )
                    @if ($invent->number == '1' ||$invent->number == '2' )
                    (Program)
                    @elseif ($invent->number == '3')
                    (Files)
                    @elseif ($invent->number == '4')
                   (Poposals)
                    @endif
                    @endforeach
                </h1>

            </div>

            <select id="myDropdown" class="xl:text-xs border-slate-500 rounded-lg">
                @foreach ($inventory as $invent )
                <option value="1" {{ old('1', $invent->number) == '1' ? 'selected' : '' }}>Program Icon</option>
                <option value="2" {{ old('2', $invent->number) == '2' ? 'selected' : '' }}>Program Tiles</option>
                <option value="3" {{ old('3', $invent->number) == '3' ? 'selected' : '' }}>Files</option>
                {{--  <option value="4" {{ old('4', $invent->number) == '4' ? 'selected' : '' }}>Proposals</option>  --}}
                @endforeach
            </select>

        </div>

        <hr class="my-2">

       @foreach ($inventory as $invent )

        @if ($invent->number == 1)
        <div class="flex justify-evenly 2xl:space-x-5 xl:space-x-2 p-5 xl:text-xs">
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

        @elseif ($invent->number == 2)
        <div class="flex flex-col space-y-4 p-5 xl:text-xs">
            @foreach ($program as $name)
            @foreach ($proposal as $proposals )
                   @if ($name->id === $proposals->program_id)

             <a href={{route('admin.inventory.proposal-show', $name->id)}} class="flex items-center font-bold drop-shadow-md bg-white p-4 space-x-4 text-blue-900 rounded-xl  hover:bg-slate-200 duration-100  relative">

                <div>
                    <p class="absolute left-14 text-white px-2 text-xs py-1 rounded-full  bg-yellow-400"> {{ $proposals->qty }}</p>
                    <span class="absolute w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-2 top-0 left-0 rounded-tl-xl rounded-tr-xl"></span>
                    <span class=" w-full bg-white hover:bg-slate-100 h-2 bottom-0 left-0 rounded-bl-xl rounded-br-xl"></span>
                    <svg class="fill-blue-600" xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M7.05 40q-1.2 0-2.1-.925-.9-.925-.9-2.075V11q0-1.15.9-2.075Q5.85 8 7.05 8h14l3 3h17q1.15 0 2.075.925.925.925.925 2.075v23q0 1.15-.925 2.075Q42.2 40 41.05 40Z"/></svg>
                </div>
                <div>
                <span class="xl:text-xs 2xl:text-xs">{{ $name->program_name}}</span>
                </div>
            </a>

            @endif
            @endforeach
            @endforeach
        </div>

        @elseif ($invent->number == 3)

        <div class="px-5 flex justify-between space-x-2">
            <div>
                <select class="text-xs border-slate-500 rounded-lg" id="MySort">
                   <option value="asc">A-Z</option>
                   <option value="desc">Z-A</option>
                </select>
            </div>
            <div>
            <input type="text"  class="text-xs border-slate-500 rounded-lg w-[20rem]" placeholder="Search name..." id="searchInput">
            <select class="text-xs border-slate-500 rounded-lg" id="MyYear">
                <option {{ '' == request('selected_value') ? 'selected ' : '' }} value="">Select Year</option>
                @foreach ($years as $year )
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

            <select id="myFiles" class="text-xs border-slate-500 rounded-lg">
                <option value="">Select File</option>
                <option value="proposalPdf">Proposal</option>
                <option value="MoaPDF">MOA</option>
                <option value="specialOrderPdf">Special Order</option>
                <option value="travelOrder">Travel Order</option>
                <option value="officeOrder">Office Order</option>
                <option value="otherFile">Others</option>
            </select>
        </div>
        </div>


            <div id="filtered-data">
                @include('admin.inventory.index-filter._all-files-medias')
            </div>


        @elseif ($invent->number == 4)

        <div class="px-5 flex justify-between space-x-2">
            <div>
                <select class="xl:text-xs border-slate-500 rounded-lg" id="MySort">
                   <option value="asc">A-Z</option>
                   <option value="desc">Z-A</option>
                </select>
            </div>
            <div>
            <input type="text"  class="xl:text-xs border-slate-500 rounded-lg w-[20rem]" placeholder="Search name..." id="searchInput">
            <select class="xl:text-xs border-slate-500 rounded-lg" id="MyYear">
                <option {{ '' == request('selected_value') ? 'selected ' : '' }} value="">Select Year</option>
                @foreach ($years as $year )
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        </div>


            <div id="filtered-data">
                @include('admin.inventory.index-filter._proposal-medias')
            </div>

        @endif
        @endforeach
    </div>


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

                // Update the filtered data container with the response
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

                // Update the filtered data container with the response
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

                // Update the filtered data container with the response
                $('#filtered-data').html(data);

                }
                });
            });
        });

    </script>

</x-admin-layout>


