<x-app-layout>

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

            <div class="mx-10 mt-5  text-slate-700">
                <h1 class="tracking-wider 2xl:text-2xl font-medium">Hi, {{ Auth()->user()->name }}</h1>
                <div class="flex ">
                    <span class="tracking-wider text-sm">{{  date('D M d, Y') }} </span>
                </div>
            </div>

            <section class="mx-5 flex xl:flex-row flex-col md:flex-row justify-between 2xl:h-48 xl:h-36 lg:h-[25vh] text-gray-700">

                <a href={{ route('User-dashboard.profile') }} class="w-full m-5 rounded-lg hover:border hover:border-teal-400 hover:from-cyan-300 hover:to-sky-200 bg-gradient-to-tl from-cyan-400 to-sky-300 md:p-2 xl:px-5 2xl:px-10 2xl:py-9 xl:py-5 flex flex-col xl:flex-row lg:pt-3 xl:p-0 items-center">
                    @if($user->gender == 'Female')
                    <img src="{{ asset('/img/female.svg') }}" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20 w-16">
                    @elseif($user->gender == 'Male')
                    <img src="{{ asset('/img/male.svg') }}" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20 w-16 lg:w-[4rem]">
                    @else
                    <img src="{{ asset('/upload/profile.png') }}" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-12 2xl:h-20 w-16 lg:w-[4rem]">
                    @endif
                    <h1 class="font-thick text-gray-700 tracking-wide xl:text-xs 2xl:text-base lg:text-center md:text-xs md:text-center">Your Role
                        <span class="block text-lg font-semibold xl:text-sm 2xl:text-lg lg:text-sm md:text-xs">
                            @foreach (Auth()->user()->roles as $role )
                                {{ $role->name }}
                            @endforeach
                        </span>
                    </h1>

                </a>

                <div class="w-full m-5 rounded-lg bg-gradient-to-tl from-violet-400 to-sky-500 xl:px-5 xl:py-5 2xl:px-10 2xl:py-5 flex lg:p-2">
                    <div class="flex-1 text-gray-800 ">
                        <span class="block text-2xl font-medium xl:text-4xl 2xl:text-6xl  flex-1 lg:text-5xl">{{$counts}}</span>
                        <h1 class="font-thick  tracking-wide xl:text-xs 2xl:text-sm lg:text-xs">Completed Proposal</h1>
                    </div>

                    <div class="flex xl:items-center justify-center lg:items-start lg:pt-4 xl:pt-0">
                        <img src="{{ asset('/img/approved.png') }}" class="2xl:w-[5rem] xl:w-16 xl:h-14 2xl:h-[5rem] lg:w-[3rem]">
                    </div>
                </div>



                <a href={{route('User-dashboard.my-proposal')}} class="w-full m-5 rounded-lg  hover:from-red-400 hover:to-pink-500  bg-gradient-to-tl from-red-500 to-pink-400 xl:px-5  xl:py-5 2xl:px-10 2xl:py-5 flex">

                    <div class="flex-1 text-gray-800">

                        <span class="block text-2xl font-medium xl:text-4xl 2xl:text-6xl  flex-1">{{$second}}</span>
                        <h1 class="font-thick  tracking-wide xl:text-xs 2xl:text-sm">Total Proposal</h1>
                    </div>

                    <div class="flex items-center justify-center">
                        <img src="{{ asset('/img/proposal-paper.png') }}" class="2xl:w-[5rem] xl:w-16 xl:h-14 2xl:h-[5rem]">
                    </div>
                </a>

                <a href={{ route('points-system.index') }} class="text-gray-800 w-full m-5 rounded-lg hover:from-sky-600 hover:to-sky-500  bg-gradient-to-tl from-sky-500 to-sky-400 xl:px-5  xl:py-5 2xl:px-10 2xl:py-5 flex ">
                    <div class="flex-1">
                        <span class="block text-2xl font-medium xl:text-4xl 2xl:text-6xl  flex-1"> @if ($latestYearPoints == null) 0 @else {{ $latestYearPoints->total_points }} @endif</span>
                        <h1 class="font-thick  tracking-wide xl:text-xs 2xl:text-sm">Total Points</h1>
                    </div>

                    <div class="flex">
                        <img src="{{ asset('/img/points.png') }}" class=" 2xl:w-[5rem] xl:w-16 xl:h-14 2xl:h-[5rem]">
                    </div>
                </a>

            </section>

            <section class="mx-10 my-5 xl:space-y-4 text-gray-700">

                <div class="relative overflow-x-auto rounded-lg shadow bg-white">

                    <div class="flex justify-between items-center py-5 bg-white px-4">

                        <div class="flex space-x-2  items-center">
                            <h1 class="tracking-wider xl:text-xs 2xl:text-base text-xs">Proposal Dashboard</h1>
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
                                <div class="bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-base xl:text-xs flex text-xs">+ Upload Proposal</div>
                            </x-slot>

                            <x-slot name="title">Upload Proposal</x-slot>

                            <!-- content -->
                            <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                <a class="flex bg-blue-600 w-full rounded-xl p-2 items-center hover:bg-blue-700" href="User-dashboard/create">
                                    <svg class="fill-white mr-3" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 96 960 960" width="40"><path d="M455.949 830.306h50.255V636.408l82.668 82.923 35.383-35.588L480 541.385 336.822 684.82l35.332 35.127 83.795-83.539v193.898ZM242.565 955.999q-25.788 0-44.176-18.388t-18.388-44.176v-634.87q0-25.788 18.388-44.176t44.176-18.388h337.59l199.844 199.844v497.59q0 25.788-18.388 44.176t-44.176 18.388h-474.87Zm312.462-536.513v-173.23H242.565q-4.616 0-8.462 3.847-3.847 3.846-3.847 8.462v634.87q0 4.616 3.847 8.462 3.846 3.847 8.462 3.847h474.87q4.616 0 8.462-3.847 3.847-3.846 3.847-8.462V419.486H555.027Zm-324.771-173.23v173.23-173.23V905.744 246.256Z"/></svg>
                                    <h1 class="text-md text-white">Upload Proposal</h1>
                                </a>

                                <a href={{ route('download.template') }} class="flex bg-blue-600 hover:bg-blue-700 text-sm rounded-xl text-white p-2 items-center">
                                    <svg class="fill-white mr-3" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 96 960 960" width="40"><path d="M490.001 925.999v-64.383l210.82-210.821 64.384 64.384-210.821 210.82h-64.383Zm-360-204.872v-50.254h289.743v50.254H130.001Zm670.64-41.384-64.384-64.384 29-29q6.948-6.948 17.564-6.948 10.615 0 17.82 6.948l29 29q6.948 7.205 6.948 17.82 0 10.616-6.948 17.564l-29 29Zm-670.64-121.18v-50.255h454.615v50.255H130.001Zm0-162.307v-50.255h454.615v50.255H130.001Z"/></svg>
                                    <h1>UNICESS Proposal Template</h1>
                                </a>
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
    @else

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                You are not authorize yet, <br> the admin is reviewing your account details
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


          /*  $(document).ready(function() {

                $('#myDropdown').on('change', function(){
                    let companyId = this.value || this.options[this.selectedIndex].value
                    window.location.href = window.location.href.split('?')[0] + '?authorize_name=' + companyId
                });
            });
            */

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
    @endsection
</x-app-layout>
