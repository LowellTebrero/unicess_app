<x-admin-layout>

<section class="rounded-xl shadow m-8 mt-5 p-5 text-slate-700 bg-white min-h-[87vh]">
    <div class="flex justify-between px-5">
        <div>
            <h1 class="font-semibold text-2xl tracking-wider">Evaluation Points Overview </h1>
        </div>
        <div>
            <select name="myDropdown" id="myDropdown" class="xl:text-sm border-slate-500 rounded-lg">
                <option value="2023-2024">2023-2024</option>
                <option value="2022-2023">2022-2023</option>
                <option value="2021-2022">2021-2022</option>
                <option value="2020-2021">2020-2021</option>
                <option value="2019-2020">2019-2020</option>
                <option value="2018-2019">2018-2019</option>
            </select>
        </div>
    </div>

    <div id="filtered-data">
        @include('admin.points._filter_points')
    </div>
</section>


    <script>
        $(document).ready(function () {
            $('#myDropdown').on('change', function () {
                var selectedValue = $(this).val();

                $.ajax({
                    url: '/api/filter-points' ,
                    type: 'GET',
                    data: { selected_value: selectedValue },
                    success: function(data) {
                // Update the filtered data container with the response
                $('#filtered-data').html(data);

            }
                });
            });
        });
    </script>

</x-admin-layout>
