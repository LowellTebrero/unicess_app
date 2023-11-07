<x-app-layout>

    <style>
        [x-cloak] {display: none}
    </style>

    <section class="m-8 rounded-lg text-slate-700 relative mt-5 xl:min-h-[85vh] 2xl:min-h-[87vh] min-h-[100vh] bg-white">


        @foreach ($allproposal as $proposal )

            @if ($proposal->number == 1)

                <div class="flex justify-between p-4 flex-col space-y-2 lg:space-y-0  lg:flex-row">
                    <div>
                        <h1 class="xl:text-xl font-semibold tracking-wider md:text-lg text-base">List of Project Proposal </h1>
                    </div>

                    <div class="sm:space-x-2 space-y-2 md:space-y-0 lg:flex-row text-xs">
                        <input type="text" id="searchInput" class="rounded xl:text-sm text-xs w-full  sm:w-[15rem] md:w-[20rem]" placeholder="Search Proposal Title...">

                        <select name="MyAllDropdown" id="MyAllDropdown" class="xl:text-sm text-xs border-slate-500 rounded w-full sm:w-[8rem]">
                            <option value="">Select Year</option>
                                @foreach ($years as $year )
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>

                        <select name="Proposal" id="Proposal" class="xl:text-sm text-xs border-slate-500 rounded w-full sm:w-[8rem]">
                        @foreach ($allproposal as $proposal )
                        <option value="1" {{ old('1', $proposal->number) == '1' ? 'selected' : '' }}>All Proposal</option>
                        <option value="2" {{ old('2', $proposal->number) == '2' ? 'selected' : '' }}>My Proposal</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <hr>

                <div id="filtered-data">
                    @include('user.allProposal._filtered_data')
                </div>


            @elseif ($proposal->number == 2)

                <div class="flex justify-between p-4">
                    <div>
                        <h1 class="xl:text-xl font-semibold tracking-wider text-lg">List of project proposal </h1>
                    </div>

                    <div class="space-x-2">
                        <input type="text" id="searchMyInput" class="rounded xl:text-sm text-xs" placeholder="Search Proposal Title...">

                        <select name="myProposalDropdown" id="myProposalDropdown" class="xl:text-sm text-xs border-slate-500 rounded">
                            <option value="">Select Year</option>
                            @foreach ($years as $year )
                                    <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                    </select>

                        <select name="Proposal" id="Proposal" class="xl:text-sm text-xs border-slate-500 rounded">
                        @foreach ($allproposal as $proposal )
                        <option value="1" {{ old('1', $proposal->number) == '1' ? 'selected' : '' }}>All Proposal</option>
                        <option value="2" {{ old('2', $proposal->number) == '2' ? 'selected' : '' }}>My Proposal</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <hr>

                <div id="filtered-data">
                   @include('user.allProposal._filtered-my-proposal')
                </div>


            @endif
        @endforeach




    </section>


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

