<x-app-layout>

    <section class="mt-5 m-8 rounded-lg 2xl:min-h-[87vh] h-[82vh] relative bg-white">
        <header class="p-4 flex justify-between">
            <h1 class="font-semibold text-gray-600 tracking-wider text-lg 2xl:text-2xl">My Proposal</h1>
            <a href={{ route('User-dashboard.index') }} class="focus:bg-red-100 rounded-md px-2 py-1 hover:bg-gray-200 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <div class="rounded m-8">
            <div class="flex justify-end">

                <div>
                    <input type="text" class="text-xs rounded border-gray-400 text-gray-700" placeholder="Search Project title..." id="searchInput">
                    <select class="text-xs rounded text-gray-500 border-gray-400" id="Year" >
                         <option value="">All Year</option>
                        @foreach ($years as $year )
                            <option value="{{$year}}" @if ($year == date('Y')) selected="selected" @endif >{{ $year }}</option>
                        @endforeach
                    </select>
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
</x-app-layout>
