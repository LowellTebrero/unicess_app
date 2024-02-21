<x-admin-layout>

    @section('title', 'Dashboard | ' . config('app.name', 'UniCESS'))

    <section class="flex mt-4 2xl:mt-5 m-4 sm:m-8 h-[82vh] 2xl:h-[87vh] xl:justify-between  overflow-hidden">

        <div class="xl:pr-4 2xl:pr-8 flex w-full flex-col">

            <!-- 4 Button Modal -->
            @include('admin.dashboard._button-modal')

            <div class="block xl:hidden">
                @include('admin.dashboard._proposal-monitoring-small-width')
            </div>

            <!-- Proposal Dashboard -->
            <section  class="w-full flex-col h-full flex mt-10 md:mt-5 bg-white 2xl:shadow rounded-xl text-white sm:w-full xl:shadow-none">

                <div class="flex justify-between items-center xl:p-4 p-2">
                    <h2 class="hidden xl:block font-semibold text-gray-600 2xl:text-sm xl:text-xs xl:mr-2 text-xs">Project Dashboard</h2>
                    <div class="block xl:hidden">
                        <header class="space-x-2 sm:px-2 xl:pb-4  flex justify-between">
                            <div class="flex flex-col sm:flex-row  md:flex-row sm:justify-between space-y-2 sm:space-y-0 space-x-0  w-full">
                                <div class="flex sm:space-x-2 space-x-0  items-center">

                                    <select class="text-[.6rem] sm:text-[.7rem] xl:text-xs rounded border border-gray-300 text-gray-700" id="myDropdown"
                                        name="authorize_name">
                                        <option {{ '' == request('authorize_name') ? 'selected ' : '' }} value="">
                                            Select Status</option>
                                        <option {{ 'pending' == request('authorize_name') ? 'selected ' : '' }}
                                            value="pending">Pending</option>
                                        <option {{ 'ongoing' == request('authorize_name') ? 'selected ' : '' }}
                                            value="ongoing">Ongoing</option>
                                        <option {{ 'finished' == request('authorize_name') ? 'selected ' : '' }}
                                            value="finished">Finished</option>
                                    </select>
                                    <input id="searchInput"
                                        class="text-[.6rem] sm:text-[.7rem] xl:text-xs  rounded border border-gray-300 2xl:w-[20rem] sm:w-[15rem] w-full text-gray-700"
                                        type="text" placeholder="Search Project Title...">
                                </div>
                            </div>
                        </header>
                    </div>

                    <!-- Create Proposal -->
                    <a href={{ route('admin.dashboard.create') }}
                    class="text-white bg-blue-500 hover:bg-blue-600 rounded-lg text-[.6rem] sm:text-xs xl:text-xs px-1 sm:px-3 py-2 2xl:text-sm">
                    +Upload Projects
                    </a>
                </div>

                <div class="flex flex-col justify-center h-full w-full rounded-xl">
                    <hr>
                    <div class="w-full mx-auto bg-white p-2 pt-0  2xl:rounded-md  border-gray-200 h-full rounded-xl">
                        <div class="hidden xl:block">
                            <header class="px-5 sm:px-2 pb-2 xl:pb-4 py-2 border-b border-gray-100 flex justify-between">
                                <div
                                    class="flex flex-col sm:flex-row  md:flex-row sm:justify-between space-y-2 sm:space-y-0 space-x-0  w-full">
                                    <div class="flex sm:space-x-2 space-x-0  items-center">

                                        <select class="text-[.7rem] xl:text-xs rounded border border-gray-300 text-gray-700" id="myDropdown"
                                            name="authorize_name">
                                            <option {{ '' == request('authorize_name') ? 'selected ' : '' }} value="">
                                                Select Status</option>
                                            <option {{ 'pending' == request('authorize_name') ? 'selected ' : '' }}
                                                value="pending">Pending</option>
                                            <option {{ 'ongoing' == request('authorize_name') ? 'selected ' : '' }}
                                                value="ongoing">Ongoing</option>
                                            <option {{ 'finished' == request('authorize_name') ? 'selected ' : '' }}
                                                value="finished">Finished</option>
                                        </select>
                                        <input id="searchInput"
                                            class=" text-[.7rem] xl:text-xs  rounded border border-gray-300 2xl:w-[20rem] sm:w-[15rem] w-full text-gray-700"
                                            type="text" placeholder="Search Project Title...">
                                    </div>
                                </div>
                            </header>
                        </div>


                        <div id="filtered-data">
                            @include('admin.dashboard._proposal-dashboard')
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





