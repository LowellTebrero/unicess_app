
<x-app-layout>

    <section class="mt-4 2x:mt-5 m-8 rounded-lg 2xl:h-[87vh] h-[82vh] relative bg-white">
        <header class="p-4 flex justify-between">
            <h1 class="font-semibold text-gray-600 tracking-wider text-lg 2xl:text-2xl">My Projects</h1>
            <a href={{ route('User-dashboard.index') }} class="focus:bg-red-100 rounded-md px-2 py-1 hover:bg-gray-200 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <div class="flex justify-end absolute top-[4.5rem] 2xl:top-[5rem] right-4">
            <div>
                <input type="text" class="text-xs rounded border-gray-400 text-gray-700" placeholder="Search Project title..." id="searchInput">
                <select class="text-xs rounded text-gray-500 border-gray-400" id="Year">
                    @foreach ($years as $year )
                        <option value="{{$year}}" @if ($year == date('Y')) selected="selected" @endif >{{ $year }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="rounded m-8 mt-0 2xl:mt-4 ">

            <div class="flex space-x-10  items-center ">

                <div class="h-[40vh] 2xl:h-full w-[15rem] 2xl:w-[25rem] flex items-center justify-center">
                    <canvas id="myChartDoughnut"></canvas>
                </div>

                <div class=" h-[40vh] 2xl:h-full  w-[35rem] 2xl:w-[48rem] mt-5 2xl:mt-0">
                    <canvas id="myChartBar"></canvas>

                </div>
            </div>



            <div id="filtered-data">
                @include('user.dashboard.MyProposal._filter-dashboard')
            </div>
        </div>
    </section>

    <script>

        $(document).ready(function () {
            let timer;
            $('#searchInput').on('input', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var selected_value =  $('#Year').val();

                timer = setTimeout(function () {

                    $.ajax({
                        url: "{{ route('User-dashboard.my-proposal-search', Auth()->user()->id ) }}",
                        method: 'GET',
                        data: { query: query, selected_value: selected_value },
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
            $('#Year').on('change', function () {
                var selected_value = $(this).val();
                var query =  $('#searchInput').val();

                $.ajax({
                    url: "{{ route('User-dashboard.my-proposal-filter-year', Auth()->user()->id ) }}",
                    type: 'GET',
                    data: { selected_value: selected_value, query: query },
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

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var labels =  {{ Js::from($labels) }};
            var users =  {{ Js::from($data) }};

            const ctx = document.getElementById('myChartDoughnut');
            const myChart = new Chart(ctx, {
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
                    maintainAspectRation: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            align: 'start',
                        }
                    }
                }
            });
        }, true);
    </script>

     <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
       
            var labels =  {{ Js::from($DateCountlabels) }};
            var users =  {{ Js::from($DateCountdata) }};

            const ctx = document.getElementById('myChartBar');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Count of Project by Month',
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
                    maintainAspectRation: false,
                }
            });
        }, true);
    </script>




</x-app-layout>


