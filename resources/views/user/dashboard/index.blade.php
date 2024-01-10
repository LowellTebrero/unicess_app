<x-app-layout>
    @section('title', 'Dashboard | ' . config('app.name', 'UniCESS'))
    <style>
        [x-cloak] { display: none }
        form button:disabled,
        form button[disabled]{
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }
    </style>

    @if (Auth::user()->authorize == 'checked')

        @hasanyrole('Faculty extensionist|Extension coordinator')

            <section class="mx-5 xl:mx-10 md:space-x-2 lg:space-x-7  xl:space-x-10 flex xl:flex-row flex-col sm:flex-row sm:space-x-2 justify-between 2xl:h-48 xl:h-36 lg:h-[20vh] text-gray-700 mt-4 2xl:mt-5">

                <a href={{ route('User-dashboard.profile') }} class="w-full rounded-lg hover:border hover:border-teal-400 hover:from-cyan-300 hover:to-sky-200 bg-gradient-to-tl from-cyan-400 to-sky-300 md:p-2 xl:px-5 2xl:px-10 2xl:py-9 xl:py-5 flex flex-col xl:flex-row lg:pt-3 xl:p-0 items-center">
                    @if($user->gender == 'Female')
                    <img src="{{ asset('/img/female.svg') }}" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20 w-12">
                    @elseif($user->gender == 'Male')
                    <img src="{{ asset('/img/male.svg') }}" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20 w-12 lg:w-[4rem]">
                    @else
                    <img src="{{ asset('/upload/profile.png') }}" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-12 2xl:h-20 w-16 lg:w-[4rem]">
                    @endif
                    <h1 class="font-thick text-gray-700 tracking-wide xl:text-xs 2xl:text-base lg:text-center text-xs md:text-center">Your Role
                        <span class="block font-semibold xl:text-sm 2xl:text-lg lg:text-sm text-xs">
                            @foreach (Auth()->user()->roles as $role )
                                {{ $role->name }}
                            @endforeach
                        </span>
                    </h1>

                </a>

                <div class="w-full rounded-lg bg-gradient-to-tl from-violet-400 to-sky-500 xl:px-5 xl:py-5 2xl:px-10 2xl:py-5 flex lg:p-2 relative">
                    <div class="flex-1 text-gray-800 flex  md:flex-col  pl-5 justify-center">
                        <span class=" font-medium text-5xl 2xl:text-6xl">{{$counts}}</span>
                        <h1 class="font-thick  tracking-wide text-xs 2xl:text-sm">Completed Proposal</h1>
                    </div>

                    <div class="flex xl:items-center justify-center lg:items-start lg:pt-4 xl:pt-0 lg:right-6 right-2 top-4 xl:right-0 xl:top-0 absolute xl:relative">
                        <img src="{{ asset('/img/approved.png') }}" class="2xl:w-[5rem] xlw-[3rem] lg:w-[3rem] w-[2.5rem]">
                    </div>
                </div>



                <a href={{route('User-dashboard.my-proposal')}} class="relative w-full rounded-lg  hover:from-red-400 hover:to-pink-500  bg-gradient-to-tl from-red-500 to-pink-400 xl:px-5  xl:py-5 2xl:px-10 2xl:py-5 flex">

                    <div class="flex-1 text-gray-800 flex  md:flex-col  pl-5 justify-center">
                        <span  class=" font-medium text-5xl 2xl:text-6xl">{{$second}}</span>
                        <h1 class="font-thick  tracking-wide text-xs 2xl:text-sm">Total Proposal</h1>
                    </div>

                    <div class="flex xl:items-center justify-center lg:items-start lg:pt-4 xl:pt-0 lg:right-6 right-2 top-4 xl:right-0 xl:top-0  absolute xl:relative">
                        <img src="{{ asset('/img/proposal-paper.png') }}" class="2xl:w-[5rem] xlw-[3rem] lg:w-[3rem] w-[2.5rem]">
                    </div>
                </a>



                <a href={{ route('points-system.index') }} class="relative text-gray-800 w-full rounded-lg hover:from-sky-600 hover:to-sky-500  bg-gradient-to-tl from-sky-500 to-sky-400 xl:px-5  xl:py-5 2xl:px-10 2xl:py-5 flex ">
                    <div class="flex-1 text-gray-800 flex  md:flex-col  pl-5 justify-center">
                        <span  class=" font-medium text-5xl 2xl:text-6xl"> @if ($latestYearPoints == null) 0 @else {{ $latestYearPoints->total_points }} @endif</span>
                        <h1 class="font-thick  tracking-wide text-xs 2xl:text-sm">Total Points</h1>
                    </div>

                    <div class="flex xl:items-center justify-center lg:items-start lg:pt-4 xl:pt-0 lg:right-6 right-2 top-4 xl:right-0 xl:top-0 absolute xl:relative">
                        <img src="{{ asset('/img/points.png') }}" class="2xl:w-[5rem] xlw-[3rem] lg:w-[3rem] w-[2.5rem]">
                    </div>
                </a>

            </section>

            <section class="mx-5 xl:mx-10 my-5 xl:space-y-4 text-gray-700">

                <div class="relative overflow-x-auto rounded-lg shadow bg-white">

                    <div class="flex justify-between items-center py-5 bg-white px-4">

                        <div class="flex space-x-2  items-center">
                            <h1 class="tracking-wider xl:text-xs 2xl:text-base text-xs">Extension Project Dashboard</h1>
                            <select class="text-xs rounded border border-gray-300" id="myDropdown" name="authorize_name">
                                <option {{ '' == request('authorize_name') ? 'selected ' : '' }} value="">Select Status</option>
                                <option {{ 'pending' == request('authorize_name') ? 'selected ' : '' }} value="pending">Pending</option>
                                <option {{ 'ongoing' == request('authorize_name') ? 'selected ' : '' }} value="ongoing">Ongoing</option>
                                <option {{ 'finished' == request('authorize_name') ? 'selected ' : '' }} value="finished">Finished</option>
                            </select>

                            <input id="searchInput"  class="text-xs rounded border border-gray-300 w-[20rem]" type="text" placeholder="Search Proposal Title...">

                        </div>

                        <x-alpine-modal>

                            <x-slot name="scripts">
                                <div class="bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-base xl:text-xs flex text-xs">+ Upload Projects</div>
                            </x-slot>

                            <x-slot name="title">Upload Project</x-slot>

                            <!-- content -->
                            <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                <a class="flex bg-blue-600 w-full rounded-xl p-2 items-center hover:bg-blue-700" href="User-dashboard/create">
                                    <svg class="fill-white mr-3" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 96 960 960" width="40"><path d="M455.949 830.306h50.255V636.408l82.668 82.923 35.383-35.588L480 541.385 336.822 684.82l35.332 35.127 83.795-83.539v193.898ZM242.565 955.999q-25.788 0-44.176-18.388t-18.388-44.176v-634.87q0-25.788 18.388-44.176t44.176-18.388h337.59l199.844 199.844v497.59q0 25.788-18.388 44.176t-44.176 18.388h-474.87Zm312.462-536.513v-173.23H242.565q-4.616 0-8.462 3.847-3.847 3.846-3.847 8.462v634.87q0 4.616 3.847 8.462 3.846 3.847 8.462 3.847h474.87q4.616 0 8.462-3.847 3.847-3.846 3.847-8.462V419.486H555.027Zm-324.771-173.23v173.23-173.23V905.744 246.256Z"/></svg>
                                    <h1 class="text-md text-white">Upload Project</h1>
                                </a>

                                <!-- Modal toggle -->
                                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="flex space-x-2 items-center justify-between text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    <svg class="fill-white mr-3" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 96 960 960" width="40"><path d="M490.001 925.999v-64.383l210.82-210.821 64.384 64.384-210.821 210.82h-64.383Zm-360-204.872v-50.254h289.743v50.254H130.001Zm670.64-41.384-64.384-64.384 29-29q6.948-6.948 17.564-6.948 10.615 0 17.82 6.948l29 29q6.948 7.205 6.948 17.82 0 10.616-6.948 17.564l-29 29Zm-670.64-121.18v-50.255h454.615v50.255H130.001Zm0-162.307v-50.255h454.615v50.255H130.001Z"/></svg>
                                    CESO Template
                                </button>

                                <!-- Main modal -->
                                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Download CESO Templates
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4">

                                                @foreach ($templates as  $template)
                                                    @foreach ($template->medias as $media )
                                                    <div class="flex space-y-2">
                                                        <a href={{ url('download-media', $media->id) }} class="text-white px-2 py-1 text-sm hover:bg-blue-500 rounded transition-all">{{ $media->file_name }}</a>
                                                    </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </x-alpine-modal>
                    </div>


                    <div id="filtered-data">
                        @include('user.dashboard.user-dashboard._dashboard')
                    </div>

                </div>
                <x-messages/>
            </section>
        @endhasanyrole

    @elseif (Auth::user()->authorize == 'close')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span><img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem]" width="200"></span>
                Your account have been declined for some reason, <br> the admin is reviewing your account details
                <span class="block text-lg mt-3 font-medium tracking-wider">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3 tracking-wider"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3 tracking-wider"><li>Fill out your Profile Information</li></span>
            </h1>
        </div>

    @elseif (Auth::user()->authorize == 'pending')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                You are not authorize yet, <br> Please fill-out your Profile Information
                <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
            </h1>
        </div>

    @endif

    @section('scripts')

    <script>
        window.addEventListener("load", (event) => {

            fetch('/delete-uploaded-file/{{ Auth()->user()->id }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    // console.log(data.message);
                } else {
                   // console.error(data.error);
                }
            })
            .catch(error => {
               // console.error('Error:', error);
            });
        });


        $(document).ready(function () {
            $('#myDropdown').on('change', function () {
                var selectedValue = $(this).val();
                var query =  $('#searchInput').val();

                $.ajax({
                    url: "{{ route('proposal.user-dashboard-filter', Auth()->user()->id ) }}",
                    type: 'GET',
                    data: { selected_value: selectedValue, query: query },
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
                var selected_value =  $('#myDropdown').val();

                timer = setTimeout(function () {

                    $.ajax({
                        url: "{{ route('proposal.user-dashboard-search', Auth()->user()->id ) }}",
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
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        function updateDynamicTime() {
            $.ajax({
                url: '/get-current-time',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    try {
                        // Get the current local time on the client
                        var clientTime = moment();

                        // Extract the server time (hours and minutes) from the response
                        var serverTime = moment(response.time, 'h:mm A');

                        // Set the client time's hours and minutes to match the server time
                        clientTime.hours(serverTime.hours());
                        clientTime.minutes(serverTime.minutes());

                        // Display the adjusted time
                        var adjustedTime = clientTime.format('h:mm A');
                        $('#dynamic-time').text(adjustedTime);
                    } catch (e) {
                        console.error('Error updating time:', e);
                    }
                },
                error: function (error) {
                    console.error('Error fetching time:', error);
                }
            });
        }

        function updateGreeting() {
            var currentTime = moment();
            var greeting = getGreeting(currentTime, '{{ Auth()->user()->name }}');
            $('#greeting').text(greeting);
        }

        function getGreeting(time, userName) {
            var hour = time.hours();

            if (hour >= 5 && hour < 12) {
                return 'Good morning, ' + userName + '!';
            } else if (hour >= 12 && hour < 18) {
                return 'Good afternoon, ' + userName + '!';
            } else {
                return 'Good evening, ' + userName + '!';
            }
        }

        // Update time every minute (60,000 milliseconds)
        setInterval(updateDynamicTime, 60000);

        // Update greeting every minute (60,000 milliseconds)
        setInterval(updateGreeting, 60000);

        // Initial updates
        updateDynamicTime();
        updateGreeting();
    </script>






    @endsection
</x-app-layout>
