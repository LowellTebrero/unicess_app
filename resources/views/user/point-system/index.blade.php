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

    <section class="m-8 text-slate-700 relative mt-5 bg-white rounded-lg  min-h-[87vh]">
        <div class="flex justify-between sticky  left-0 items-center p-8">
            <div>
                <h1 class="text-2xl font-semibold tracking-wider">Evaluation Points Overview <button data-tooltip-target="tooltip-right3" data-tooltip-placement="bottom" class="inline-block" type="button"><img src="{{ asset('img/i.png') }}" width="18" alt=""></button></h1>

            </div>

            <select name="myDropdown" id="myDropdown" class="xl:text-sm border-slate-500 rounded-lg">
                @foreach ($years as $year )
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

        </div>
        <hr>

        @include('user.point-system._header')


        <div id="filtered-data" class="p-8">
            @include('user.point-system._filter_points')
        </div>

    </section>

    <script>
        $(document).ready(function () {
            $('#myDropdown').on('change', function () {
                var selectedValue = $(this).val();

                $.ajax({
                    url: '/api/user-filter-points/{{ Auth()->user()->id}}',
                    type: 'GET',
                    data: { selected_value: selectedValue },
                    success: function(data) {
                // Update the filtered data container with the response
                $('#filtered-data').html(data);

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
                    console.log(data.message);
                } else {
                    console.error(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
          });

          console.log('It has been load');
    </script>

</x-app-layout>
