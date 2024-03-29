<x-app-layout>
    @section('title', 'My Inventory | ' . config('app.name', 'UniCESS'))
    @if (Auth::user()->authorize == 'checked')
        @unlessrole('admin|New User')
            <style>[x-cloak] {display: none}</style>

            <section class="h-full bg-white rounded-xl text-gray-600">

                <div class="p-4 flex justify-between items-center">
                    <h1 class="font-semibold tracking-wider text-sm sm:text-base xl:text-2xl text-slate-700">My Inventory</h1>

                    <div class="sm:space-x-2 space-y-2">
                        <input id="searchInput"  class="text-xs rounded border border-slate-400 sm:w-[12rem] xl:w-[20rem] w-[7rem]" type="text" placeholder="Search Project Title...">
                        <select name="Years" id="Years" class="md:text-xs text-xs  border-slate-400 rounded w-[3rem] sm:w-[5rem]">
                            @foreach ($years as $year )
                            <option value="{{ $year }}" @if ($year == date('Y')) selected="selected" @endif >{{ $year }}</option>
                            @endforeach
                        </select>

                        <select id="myDropdown" class="rounded text-xs w-[2rem] sm:w-[4rem] border-slate-400">
                            @foreach ($inventory as $invent )
                            <option value="1" {{ old('1', $invent->number) == '1' ? 'selected' : '' }}>Tiles</option>
                            <option value="2" {{ old('2', $invent->number) == '2' ? 'selected' : '' }}>Medium Icon</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>
                @if ($proposalmember->isEmpty())
                <div class="h-[45vh] 2xl:h-[60vh] flex flex-col items-center justify-center space-y-2">
                    <img class="w-[10rem] sm:w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
                    <h1 class="text-md text-gray-500">It’s empty here</h1>
                </div>
                @else
                <div id="filtered-data">
                    @include('user.inventory.index._filter_index')
                </div>
                @endif


            </section>
        @else

        <div class="w-full h-[50vh] items-center justify-center">
            <h1>No Proposal </h1>
        </div>

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
