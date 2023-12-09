<x-admin-layout>

    @section('title', 'Points | ' . config('app.name', 'UniCESS'))

<section class="rounded-xl shadow m-8 mt-5 text-slate-700 bg-white min-h-[85vh] 2xl:min-h-[87vh]">
    <div class="flex justify-between px-5 py-4">
        <div>
            <h1 class="font-semibold xl:text-lg 2xl:text-2xl tracking-wider">Evaluation Points Overview </h1>
        </div>
        <div>
            <input type="text" placeholder="Search name and email..." class="text-xs  border-slate-400 rounded-lg" id="searchInput">
            <select name="myDropdown" id="myDropdown" class="text-xs border-slate-400 rounded-lg">
              @foreach ($years as $year )
                  <option value="{{ $year }}" @if ($year == date('Y')) selected="selected" @endif>{{ $year }}</option>
              @endforeach
            </select>
        </div>
    </div>
    <hr>


    <div id="filtered-data">
        @include('admin.points._filter_points')
    </div>

</section>


    <script>
        $(document).ready(function () {
            $('#myDropdown').on('change', function () {
                var selected_value = $(this).val();

                $.ajax({
                    url: '/api/filter-points' ,
                    type: 'GET',
                    data: { selected_value: selected_value },
                    success: function(data) {
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
                        url: "/api/filter-search-points",
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

</x-admin-layout>
