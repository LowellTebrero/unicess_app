
<x-app-layout>
    @section('title', 'All Projects | ' . config('app.name', 'UniCESS'))
    @if (Auth::user()->authorize == 'checked')
        @unlessrole('admin|New User')

            <section class="h-full rounded-xl relative bg-white text-gray-700">
                <div class="flex justify-between p-2 sm:py-2 md:py-4 sm:p-4 items-center ">
                    <div>
                        <h1 class="font-semibold tracking-wider text-xs md:text-lg sm:text-sm xl:text-2xl">List of Program/Projects</h1>
                    </div>

                    <div class="sm:space-x-2 space-y-2 md:space-y-0 lg:flex-row text-xs">
                        <input type="text" id="searchInput" class="rounded  text-xs border-gray-300 w-[8rem]   sm:w-[10rem]" placeholder="Search Project Title...">

                        <select name="MyAllDropdown" id="MyAllDropdown" class="text-xs border-gray-300 rounded  w-[3rem] sm:w-[5rem]">
                                @foreach ($years as $year )
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>

                <div id="filtered-data">
                    @include('user.allProposal._filtered_data')
                </div>

            </section>

        @endunlessrole

    @elseif (Auth::user()->authorize == 'close')

        <div class="flex items-center justify-center h-[80vh]">
            <div class="mt-14">
            <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
            </div>
            <h1 class="text-2xl text-slate-700 font-bold">
                <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                Your account have been declined for some reason, <br> the admin is reviewing your account details
                <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
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


    <script>
        $(document).ready(function () {
            $('#MyAllDropdown').on('change', function () {
                var selectedValue = $(this).val();
                var selectedValue2 =  $('#searchInput').val();

                $.ajax({
                    url: '/api/filter-proposal' ,
                    type: 'GET',
                    data: { selectedValue: selectedValue, selectedValue2: selectedValue2 },
                    success: function(data) {
                // Update the filtered data container with the response
                $('#filtered-data').html(data);
                }
                });
            });
        });

        $(document).ready(function () {
            $('#myProposalDropdown').on('change', function () {
                var mydropdown = $(this).val();
                var selectedValue2 =  $('#searchMyInput').val();

                $.ajax({
                    url: '/api/filter-user-proposal/{{ Auth()->user()->id }}' ,
                    type: 'GET',
                    data: { mydropdown: mydropdown, selectedValue2: selectedValue2 },
                    success: function(data) {
                // Update the filtered data container with the response
                $('#filtered-data').html(data);

                }
                });
            });
        });


        $(document).ready(function () {
            $('#Proposal').on('change', function () {
                var selectedValue = $(this).val();
                var selectedValue1 =  $('#MyAllDropdown').val();

                $.ajax({
                    url: '/api/update-customize-user-all-proposal/1' ,
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
                  //  console.error(data.error);
                }
            })
            .catch(error => {
               // console.error('Error:', error);
            });
        });



        $(document).ready(function () {
            let timer;

            $('#searchInput').on('input change', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var selectedValue =  $('#MyAllDropdown').val();



                timer = setTimeout(function () {


                    $.ajax({
                        url: "{{ route('proposal.search') }}",
                        method: 'GET',
                        data: { query: query, selectedValue: selectedValue },
                        success: function (data) {
                            let resultsTable = $('#searchResults');
                            resultsTable.empty();

                            $('#filtered-data').html(data);
                        }
                    });

                }, 300);
             // Adjust the delay as needed
            });

        });

        $(document).ready(function () {
            let timer;

            $('#searchMyInput').on('input change', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var selectedValue =  $('#myProposalDropdown').val();



                timer = setTimeout(function () {
                    $.ajax({
                        url: 'api/proposal/search-my-proposal/{{ Auth()->user()->id }}',
                        method: 'GET',
                        data: { query: query, selectedValue: selectedValue },
                        success: function (data) {
                            let resultsTable = $('#searchResults');
                            resultsTable.empty();

                            $('#filtered-data').html(data);
                        }
                    });

                }, 300);
             // Adjust the delay as needed
            });

        });
    </script>



</x-app-layout>

