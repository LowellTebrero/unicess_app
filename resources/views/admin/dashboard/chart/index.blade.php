<x-admin-layout>

    <section class="mt-8 m-5 rounded-lg bg-white  min-h-[85vh] 2xl:min-h-[87vh]">

        <header class="p-4 py-2 flex justify-between items-center">
            <h1 class="text-lg font-medium tracking-wider text-slate-700">Proposal Overview</h1>
            <a href={{ route('admin.dashboard.index') }} class="hover:bg-gray-200 focus:bg-red-200 rounded px-2 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>
            @foreach ($customizes as $customize )
                @if ($customize->number == 1)

                <div class="flex justify-end space-x-4 p-4 py-2">
                    <select name="" id="CustomizeFilter" class="text-xs rounded">
                            <option value="1" {{ old('1', $customize->number) == '1' ? 'selected' : '' }}>View Statistics</option>
                            <option value="2" {{ old('2', $customize->number) == '2' ? 'selected' : '' }}>View Proposal</option>
                    </select>
                </div>


                <div class="flex xl:flex-row flex-col space-x-1  m-5 mt-5 rounded-lg  xl:w-11/12 2xl:w-auto ">
                    <div class="xl:w-1/2">
                        <h1 class="text-sm tracking-wider pl-5">Count of Uploaded Proposal By Month</h1>
                        <div class="p-5">
                            <canvas id="myChart" width="500" height="200"></canvas>
                        </div>

                    </div>

                    <div class="xl:w-1/2 pl-5">
                        <h1 class="text-sm tracking-wider">Count of Used Program</h1>
                        <div class="p-5">
                            <canvas id="myCharts" width="500" height="200"></canvas>
                        </div>
                        {{--  {!! $chart->container() !!}
                        {!! $chart->script() !!}  --}}
                    </div>
                </div>


            @elseif ($customize->number == 2 )

                <div class="flex 2xl:flex-col flex-col pt-0  m-5 mt-0 rounded-lg ">

                    <div class="flex justify-between  py-2  ">


                        <div id="wrapper" class="flex items-center transition-all px-2 py-1 rounded border ">
                            <button class="flex items-center space-x-2 text-xs text-gray-700" id="YesDelete">
                                Delete proposal
                                <svg class="fill-gray-500" xmlns="http://www.w3.org/2000/svg" height="15"
                                viewBox="0 96 960 960" width="15">
                                <path d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z" />
                                </svg>
                            </button>
                        </div>

                        <div>
                            <input id="searchInput"  class=" text-xs rounded border border-gray-300 2xl:w-[20rem] sm:w-[15rem] w-full text-gray-700" type="text" placeholder="Search Proposal Title...">
                            <select class="text-xs rounded border border-gray-300 text-gray-700" id="MyYear">
                                <option {{ '' == request('year') ? 'selected ' : '' }} value="">Select Year</option>
                                @foreach ($years as $year )
                                <option value="{{ $year }}"  @if ($year == date('Y')) selected="selected" @endif >{{ $year }}</option>
                                @endforeach
                            </select>


                            <select class="text-xs rounded border border-gray-300 text-gray-700" id="Status">
                                <option {{ '' == request('status') ? 'selected ' : '' }} value="">Select Status</option>
                                <option {{ 'pending' == request('authorize_name') ? 'selected ' : '' }} value="pending">Pending</option>
                                <option {{ 'ongoing' == request('authorize_name') ? 'selected ' : '' }} value="ongoing">Ongoing</option>
                                <option {{ 'finished' == request('authorize_name') ? 'selected ' : '' }} value="finished">Finished</option>
                            </select>


                            <select id="CustomizeFilter" class="text-xs rounded border border-gray-300 text-gray-700">
                                    <option value="1" {{ old('1', $customize->number) == '1' ? 'selected' : '' }}>View Statistics</option>
                                    <option value="2" {{ old('2', $customize->number) == '2' ? 'selected' : '' }}>View Proposal</option>
                            </select>

                        </div>

                    </div>
                    <hr>
                    <div id="filtered-data">
                        @include('admin.dashboard.chart.filter_index._index-dashboard')
                    </div>
                </div>
                @endif
            @endforeach
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', function () {

                var labels =  {{ Js::from($labels) }};
                var users =  {{ Js::from($data) }};

                const ctx = document.getElementById('myChart');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Month of Uploaded of Proposal',
                            data: users,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1,

                        }]
                    },
                    options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                });
            }, true);

            document.addEventListener('DOMContentLoaded', function () {
                var labels =  {{ Js::from($programLabel) }};
                var users =  {{ Js::from($programData) }};

                const ctxx = document.getElementById('myCharts');
                const myCharts = new Chart(ctxx, {
                    type: 'horizontalBar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Count of Program',
                            data: users,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1,

                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    color: 'black'
                                }
                            },
                            title: {
                                display: true,
                                text: 'User Registration Count per Month',
                                color: 'black'
                            }
                        }
                    }
                });
            }, true);

           /* var labels =  {{ Js::from($labels) }};
            var users =  {{ Js::from($data) }};

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Month of Uploaded of Proposal',
                    backgroundColor: [
                  "#DEB887","#A9A9A9","#DC143C","#F4A460","#2E8B57","#1D7A46","#CDA776",
                ],
                borderColor: [
                    "#CDA776","#989898","#CB252B","#E39371","#1D7A46","#F4A460", "#CDA776",
                  ],
                borderWidth: [1, 1, 1, 1, 1, 1, 1],
                    data: users,
                }]
            };


            const config = {
                type: 'bar',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('Chart'),
                config
            );

            */
    </script>


    <script>

        $(document).ready(function () {
            $('#CustomizeFilter').on('change', function () {
                var selectedValue = $(this).val();

                $.ajax({
                    url: '/api/dashboard-customize/1' ,
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

            $('#Status').on('change', function () {
                var status = $(this).val();
                var query =  $('#searchInput').val();
                var year =  $('#MyYear').val();

                $.ajax({
                    url: "{{ route('admin.dashboard.filter-status') }}",
                    type: 'GET',
                    data: { status: status,  year: year , query: query,},
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

            $('#MyYear').on('change', function () {
                var year = $(this).val();
                var query =  $('#searchInput').val();
                var status =  $('#Status').val();

                $.ajax({
                    url: "{{ route('admin.dashboard.filter-year') }}",
                    type: 'GET',
                    data: { year: year, query: query, status: status  },
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
            let timer;

            $('#searchInput').on('input', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var status =  $('#myDropdown').val();
                var year =  $('#MyYear').val();

                timer = setTimeout(function () {

                    $.ajax({
                        url: "{{ route('admin.dashboard.search-data') }}",
                        method: 'GET',
                        data: { query: query, year:year, status: status  },
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

    </script>




    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the toggle all button
            var toggleAllButton = document.getElementById('selectAll');

            var deleteSelectedButton = document.getElementById('YesDelete');

            // Get all checkboxes inside the foreach loop
            var checkboxes = document.querySelectorAll('.checkbox_ids');

            // Add click event listener to the toggle all button
            toggleAllButton.addEventListener('click', function () {
                // Check if all checkboxes are checked

                var allChecked = Array.from(checkboxes).every(function (checkbox) {
                    return checkbox.checked;
                });

                // If all checkboxes are checked, reset all checkboxes; otherwise, check all checkboxes
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = !allChecked;
                });
            });


            deleteSelectedButton.addEventListener('click', function () {
                // Filter out the checked checkboxes
                var checkedCheckboxes = Array.from(document.querySelectorAll('.checkbox_ids:checked'));

                // Create an array to store the IDs of checked checkboxes
                var all_ids = checkedCheckboxes.map(function (checkbox) {
                    return checkbox.value;
                });


                if (all_ids.length > 0 ) {
                    // Perform deletion logic for the checked checkboxes
                    if (confirm('Are you sure you want to delete?')) {

                        $.ajax({
                            url: "{{ route('admin.proposal.delete-folder-proposal') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                checkedCheckboxes.forEach(function (checkbox) {
                                    // Replace 'proposal_id' with the appropriate ID prefix
                                    $('#proposal_id' + checkbox.value).remove();
                                });
                                if (response.success) {
                                    toastr.success(response.success);
                                    // Additional logic if needed
                                } else if (response.error) {
                                    toastr.error(response.error);
                                    // Additional error handling logic
                                }
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error('Error in AJAX request');
                            }
                        });
                    };


                } else {
                    toastr.warning('No checkboxes are selected for deletion.');
                }

            });


        });

    </script>





</x-admin-layout>
