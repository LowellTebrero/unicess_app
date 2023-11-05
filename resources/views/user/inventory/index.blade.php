<x-app-layout>
    @hasanyrole('Faculty extensionist|Extension coordinator')
        <style>[x-cloak] {display: none}</style>

        <section class="mt-5 m-8 bg-white rounded-lg  xl:min-h-[87vh] ">

            <div class="p-4 flex justify-between">
                <h1 class="font-semibold tracking-wider text-xl text-slate-700">My Inventory</h1>

                <div class="space-x-4">
                    <input id="searchInput"  class="text-xs rounded border border-slate-500 w-[20rem]" type="text" placeholder="Search Proposal Title...">
                    <select name="Years" id="Years" class="xl:text-xs border-slate-500 rounded">
                        <option value="">All Year</option>
                        @foreach ($years as $year )
                        <option value="{{ $year }}" @if ($year == date('Y')) selected="selected" @endif >{{ $year }}</option>
                        @endforeach
                    </select>

                    <select id="myDropdown" class="rounded text-xs">
                        @foreach ($inventory as $invent )
                        <option value="1" {{ old('1', $invent->number) == '1' ? 'selected' : '' }}>Tiles</option>
                        <option value="2" {{ old('2', $invent->number) == '2' ? 'selected' : '' }}>Medium Icon</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            <div id="filtered-data">
                @include('user.inventory.index._filter_index')
            </div>

        </section>
    @else

        <div class="w-full min-h-[50vh] items-center justify-center">
            <h1>No Proposal </h1>
        </div>

    @endrole

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
                        //console.log(data.message);
                    } else {
                       // console.error(data.error);
                    }
                })
                .catch(error => {
                   // console.error('Error:', error);
                });
        });

        console.log('It has been load');


       /* window.addEventListener('contextmenu', (event) => {
            console.log("🖱 right click detected!")
        }) */


        $(document).ready(function () {
            let timer;

            $('#searchInput').on('input', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var selected_value =  $('#Years').val();

                timer = setTimeout(function () {

                    $.ajax({
                        url: "{{ route('search.proposal-name', Auth()->user()->id ) }}",
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
            $('#myDropdown').on('change', function () {
                var selectedValue = $(this).val();

                $.ajax({
                    url: '/api/update-customize-user/1' ,
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


        $(document).ready(function () {
            $('#Years').on('change', function () {
                var mydropdown = $(this).val();
                var query =  $('#searchInput').val();
                $.ajax({
                    url: '/api/update-year-user/{{ Auth()->user()->id }}',
                    type: 'GET',
                    data: { mydropdown: mydropdown, query: query },
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
