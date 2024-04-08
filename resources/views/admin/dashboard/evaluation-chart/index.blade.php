<x-admin-layout>

    <style>
        .progress {
            width: 100%;
            background-color: #f1f1f1;
            margin-bottom: 10px;
            border-radius: 10px;

        }
        .progress-bar {
            height: 20px;
            border-radius: 10px;
            background-image: linear-gradient(to right, #77efff, #00a2ff);
            text-align: center;
            line-height: 20px;
            color: white;
            width: 0; /* Initially set to 0 */
            /* Animation */
            animation: progressBarAnimation 4s ease-in-out forwards; /* Set duration to 4 seconds */
        }

        @keyframes progressBarAnimation {
            from {
                width: 0;
            }
            to {
                width: var(--percentage); /* Use CSS variable to specify the width */
            }
        }
    </style>

    @section('title', 'Evaluation Chart | ' . config('app.name', 'UniCESS'))
    <section class="text-gray-700 h-full  bg-white rounded-xl shadow">

        <header class="flex justify-between p-5 py-4">
            <div>
                <h1 class="tracking-wider 2xl:text-2xl font-semibold text-lg">Evaluation Statistics</h1>
            </div>
            <a href={{ route('admin.dashboard.index') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        @if ($evaluations->isEmpty())
        <div class="h-[45vh] 2xl:h-[52vh] flex flex-col items-center justify-center space-y-2">
            <img class="w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
            <h1 class="text-md text-gray-500">It’s empty here</h1>
           </div>
        @else

        <main class="p-5 2xl:p-10   h-[80vh] flex space-x-4">

            <div class="flex space-y-4 flex-col w-full border border-gray-400 rounded-xl h-[67vh] 2xl:h-full">

                <div class=" p-5 h-[35vh] 2xl:h-[40vh] w-[40rem] 2xl:w-[60rem]">
                    <canvas id="myChartBar"></canvas>
                </div>

                <div class="space-x-5 flex items-center justify-center p-5 h-[20vh] 2xl:h-[40vh]">
                    <div class="2xl:w-[20rem] w-[10rem] h-[35vh]">
                        <canvas id="myChartDoughnut"></canvas>

                    </div>

                    <div class="2xl:w-[20rem] w-[10rem] h-[35vh]">
                        <canvas id="myChartDoughnut2"></canvas>
                    </div>

                    <div class="2xl:w-[20rem] w-[10rem] h-[35vh]">
                        <canvas id="myChartPie"></canvas>
                    </div>

                </div>
            </div>

            <div class="w-1/2">
                <div class="border border-gray-400 rounded-xl overflow-y-auto h-[67vh] 2xl:h-full p-5">

                    @foreach($progressPoints as $progressPoint)
                    <div class="flex space-x-4">
                        <div class="w-full mb-2">
                            <div class="progress border border-gray-200">
                                @php
                                    // Calculate the percentage
                                    $percentage = ($progressPoint->total_points / $maximumPoints) * 100;
                                @endphp
                                <div class="progress-bar text-xs " data-total-points="{{ $progressPoint->total_points }}">{{ $percentage }}%</div>
                            </div>
                            <h1 class="text-xs text-gray-400"><i>{{ $progressPoint->total_points }}/ 100</i></h1>
                        </div>

                        <div class="w-1/4">
                            <h1 class="text-xs">{{ $progressPoint->first_name }}</h1>
                        </div>



                    </div>

                @endforeach

                </div>
            </div>




        </main>
        @endif

    </section>
</x-admin-layout>

    <script>
        // Apply animation to progress bars
        document.addEventListener("DOMContentLoaded", function(event) {
            var progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(function(progressBar) {
                var totalPoints = parseFloat(progressBar.getAttribute('data-total-points'));
                var percentage = (totalPoints / {{ $maximumPoints }}) * 100;
                progressBar.style.setProperty('--percentage', percentage + '%'); // Set CSS variable
            });
        });
    </script>


    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function () {

            var labels =  {{ Js::from($userNames) }};
            var users =  {{ Js::from($totalPoints) }};

            const ctx = document.getElementById('myChartBar');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Count of total points',
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
            var labels =  {{ Js::from($StatusNames) }};
            var users =  {{ Js::from($StatusCount) }};

            const ctx = document.getElementById('myChartDoughnut');
            const myChartDough = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Count of evaluation status',
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
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                            position: 'right',
                            align: 'center',
                        }
                    }
                }
            });
        }, true);

        document.addEventListener('DOMContentLoaded', function () {
            var labels =  {{ Js::from($RoleNames) }};
            var users =  {{ Js::from($RoleCount) }};

            const ctx = document.getElementById('myChartDoughnut2');
            const myChartDough2 = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Status Count User Roles',
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
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                            position: 'right',
                            align: 'center',
                        }
                    }
                }
            });
        }, true);

        document.addEventListener('DOMContentLoaded', function () {
            var labels =  {{ Js::from($facultyNames) }};
            var users =  {{ Js::from($facultyCount) }};

            const ctxx = document.getElementById('myChartPie');
            const myChartPies = new Chart(ctxx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Count of used Faculty',
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
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,

                        }
                    }
                }
            });
        }, true);

    </script>
