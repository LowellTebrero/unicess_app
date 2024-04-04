<x-admin-layout>

    @section('title', 'Dashboard | ' . config('app.name', 'UniCESS'))

    <section class="flex h-full xl:justify-between  overflow-hidden">

        <div class="xl:pr-4 2xl:pr-8 flex w-full flex-col">

            <!-- 4 Button Modal -->
            @include('admin.dashboard._button-modal')

            <div class="block xl:hidden">
                @include('admin.dashboard._proposal-monitoring-small-width')
            </div>

            <!-- Proposal Dashboard -->
            <section  class="w-full flex-col h-full flex mt-10 lg:mt-5 bg-white 2xl:shadow rounded-xl text-white sm:w-full xl:shadow-none">

                <div class="flex justify-between items-center xl:p-4 p-2">
                    <h2 class="hidden xl:block font-semibold text-gray-600 2xl:text-sm xl:text-xs xl:mr-2 text-xs">Extension Statistics</h2>

                    <!-- Create Proposal -->
                    <a href={{ route('admin.dashboard.create') }}
                    class="text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-[.6rem] sm:text-xs xl:text-xs px-2 sm:px-3 py-2 2xl:text-sm">
                    +Upload Projects
                    </a>
                </div>

                <div class="flex flex-col justify-center h-full w-full rounded-xl">
                    <hr>
                    <div class="w-full mx-auto bg-white p-2 pt-0  2xl:rounded-md  border-gray-200 h-full rounded-xl">

                        <div class="h-[57vh] 2xl:h-[60vh]  2xl:w-full flex">

                            <div class="w-[100%]">
                                <div class="pt-6 p-8 2xl:p-12 h-[50vh] 2xl:h-full ">
                                    <canvas id="myChartBar"></canvas>
                                </div>
                            </div>

                            <div class="flex flex-col items-center justify-center h-[50vh] w-[50%] pt-8">

                                <div class="pt-8 w-[10rem] 2xl:w-[15rem]">
                                    {{--  <h1 class="text-sm tracking-wide text-gray-700">Count of Used Program</h1>  --}}
                                    <canvas id="myChartDoughnut" class="h-[20vh]"></canvas>
                                </div>
                                <div class="pt-8 w-[10rem] 2xl:w-[15rem]">
                                    {{--  <h1 class="text-sm tracking-wide text-gray-700">Count of Used Program</h1>  --}}
                                    <canvas id="myChartPie" class="h-[20vh]"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </section>
        </div>

        @include('admin.dashboard._proposal-monitoring')

    </section>

    <x-messages/>
</x-admin-layout>


    <script>
        $('input[type=file]').change(function() {
            if ($('input[type=files]').val() == '') {
                $('button').attr('disabled', true)

            } else {
                $('button').attr('disabled', false);

            }
        })

        $(document).ready(function() {

            $('#myDropdown').on('change', function() {
                var selectedValue = $(this).val();
                var query = $('#searchInput').val();

                $.ajax({
                    url: "{{ route('admin.proposal.admin-dashboard-filter') }}",
                    type: 'GET',
                    data: {
                        selected_value: selectedValue,
                        query: query
                    },
                    success: function(data) {
                        let resultsTable = $('#filtered-data');
                        resultsTable.empty();

                        // Update the filtered data container with the response
                        $('#filtered-data').html(data);

                    }
                });
            });
        });


        $(document).ready(function() {
            let timer;

            $('#searchInput').on('input', function() {
                clearTimeout(timer);

                let query = $(this).val();
                var selected_value = $('#myDropdown').val();

                timer = setTimeout(function() {

                    $.ajax({
                        url: "{{ route('admin.proposal.admin-dashboard-search') }}",
                        method: 'GET',
                        data: {
                            query: query,
                            selected_value: selected_value
                        },
                        success: function(data) {
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


    <script type="text/javascript">


        document.addEventListener('DOMContentLoaded', function () {

            var labels =  {{ Js::from($labels) }};
            var users =  {{ Js::from($data) }};

            const ctx = document.getElementById('myChartBar');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Count of Uploaded of Projects by Month',
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
                        fill: true,
                        cubicInterpolationMode: 'monotone',

                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                        beginAtZero: true
                        }
                    }
                    }
            });
        }, true);


        document.addEventListener('DOMContentLoaded', function () {
            var labels =  {{ Js::from($CountStatuslabels) }};
            var users =  {{ Js::from($CountStatusdata) }};

            const ctx = document.getElementById('myChartDoughnut');
            const myChartDough = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Status Count of Project',
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

                    plugins: {

                        legend: {
                            display: false,
                            position: 'top',
                            align: 'center',
                        }
                    }
                }
            });
        }, true);

        document.addEventListener('DOMContentLoaded', function () {
            var labels =  {{ Js::from($programLabel) }};
            var users =  {{ Js::from($programData) }};

            const ctxx = document.getElementById('myChartPie');
            const myChartPies = new Chart(ctxx, {
                type: 'pie',
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

                    plugins: {
                        legend: {
                            display: false,

                        }
                    }
                }
            });
        }, true);



    </script>






