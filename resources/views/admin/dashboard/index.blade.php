<x-admin-layout>
    <style>
        [x-cloak] {
            display: none
        }

        form button:disabled,
        form button[disabled] {
            border: 1px solid #999999;
            background-color: #cccccc;
            color: #666666;
        }
    </style>

    <section class="flex min-h-full justify-between overflow-hidden w-full">

        <div class="xl:px-8 flex 2xl:w-full xl:w-[56rem] flex-col mt-5">

            <div class="p-4 px-5 flex  bg-white rounded-xl min-h-[12vh] shadow">
                <div>
                    <h1 class="tracking-wider 2xl:text-2xl font-semibold text-slate-700">Welcome,
                        {{ Auth()->user()->name }} </h1>
                    <span class="tracking-wider text-sm">{{  date('D M d, Y') }} </span>
                </div>
            </div>

            {{--  4 Button Modal  --}}
            @include('admin.dashboard._button-modal')

            {{--  Proposal Dashboard  --}}

            <section class="w-full flex-col h-full mb-6 space-y-4 flex 2xl:p-8 lg:flex-row xl:px-0 xl:flex-row lg:space-x-6 lg:space-y-0 xl:space-x-8 mt-7 bg-white 2xl:shadow rounded-xl text-white sm:flex-col md:flex-col md:space-x-0 md:space-y-4 sm:space-y-4 sm:w-full xl:shadow-none">

                <div class="flex flex-col justify-center h-full w-full ">
                    <!-- Table -->
                    <div class="w-full  mx-auto bg-white  rounded-md border border-gray-200 h-full">
                        <header class="px-5 py-4 border-b border-gray-100 flex justify-between">
                            <div class="flex xl:space-x-2 items-center">
                                <h2 class="font-semibold text-gray-600 2xl:text-sm xl:text-xs xl:mr-2">Proposal Dashboard</h2>
                                <select class="text-xs rounded border border-gray-300 text-gray-700" id="myDropdown" name="authorize_name">
                                    <option {{ '' == request('authorize_name') ? 'selected ' : '' }} value="">Select Status</option>
                                    <option {{ 'pending' == request('authorize_name') ? 'selected ' : '' }} value="pending">Pending</option>
                                    <option {{ 'ongoing' == request('authorize_name') ? 'selected ' : '' }} value="ongoing">Ongoing</option>
                                    <option {{ 'finished' == request('authorize_name') ? 'selected ' : '' }} value="finished">Finished</option>
                                </select>
                                <input id="searchInput"  class="text-xs rounded border border-gray-300 2xl:w-[20rem] xl:w-[15rem] text-gray-700" type="text" placeholder="Search Proposal Title...">
                            </div>

                            {{--  Create Proposal   --}}
                            <div class="space-x-2 flex">
                                <a href={{ route('admin.dashboard.create') }} class="text-white bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:text-[.8rem] transition-all rounded-lg xl:text-xs px-3 py-2 2xl:text-sm">+ Upload Proposal</a>
                                <div id="wrapper" class="flex items-center transition-all">
                                    <a href="" type="submit" class="" id="deleteAllSelected" style="display: none" onclick="return confirm('Are you sure?')">
                                        <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" height="30"
                                        viewBox="0 96 960 960" width="30">
                                        <path d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </header>

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

        $(document).ready(function () {
            $('#myDropdown').on('change', function () {
                var selectedValue = $(this).val();
                var query =  $('#searchInput').val();

                $.ajax({
                    url: "{{ route('admin.proposal.admin-dashboard-filter') }}",
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
                        url: "{{ route('admin.proposal.admin-dashboard-search') }}",
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

        $(function(e){
            $("#select_all_ids").click(function(){
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            })
        });

        $('#deleteAllSelected').click(function(e){
            e.preventDefault();
            var all_ids = [];

            $('input:checkbox[name=ids]:checked').each(function(){
                all_ids.push($(this).val());
            });

            if (confirm('Are you sure?')) {
            $.ajax({
                url: "{{ route('admin.dashboard.delete-project-proposal') }}",
                type: "DELETE",
                data: {
                    ids:all_ids,
                    _token:'{{ csrf_token() }}'
                },
                success:function(response){
                    $.each(all_ids,function(key,val){
                        $('#proposal_id'+ val).remove();
                    })
                }
            });
        };
        });


          $(document).ready(function() {

            $("#checkbox_ids, #select_all_ids ").on("change", function() {

              if ($(this).is(":checked") || $("#select_all_ids").is(":checked") ) {
                // Checkbox is checked, perform your action here
                $("#wrapper").css("display", "block");
                $("#deleteAllSelected").css("display", "block");
                // You can do other things here, like making an AJAX request
              } else {
                // Checkbox is unchecked

                $("#wrapper").css("display", "none");
                $("#deleteAllSelected").css("display", "none");
                $("#deleteAllSelected").css("margin-top", "4%");
                // You can do other things here as well
              }
            });
          });


    </script>
