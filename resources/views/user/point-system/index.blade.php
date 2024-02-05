<x-app-layout>
    @section('title', 'My Points | ' . config('app.name', 'UniCESS'))
@if (Auth::user()->authorize == 'checked')
@unlessrole('admin|New User')
    <style>
        [x-cloak] { display: none }

        form button:disabled,
        form button[disabled]{
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }

    </style>

    <section class="m-8 text-slate-700 relative mt-4 2xl:mt-5 bg-white rounded-lg h-[82vh] 2xl:h-[87vh]">
        <div class="flex justify-between sticky  left-0 items-center p-5 py-3">
            <div>
                <h1 class="2xl:text-2xl text-lg font-semibold tracking-wider">Evaluation Points Overview <button data-tooltip-target="tooltip-right3" data-tooltip-placement="bottom" class="inline-block" type="button"><img src="{{ asset('img/i.png') }}" width="18" alt=""></button></h1>
            </div>
            <select name="myDropdown" id="myDropdown" class="xl:text-sm border-slate-500 rounded-lg">
                @foreach ($years as $year )
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

        </div>
        <hr>

        @include('user.point-system._header')

        @if ($latestYearPoints == null && $evaluations->isEmpty() )
        <div class="h-[45vh] 2xl:h-[52vh] flex flex-col items-center justify-center space-y-2">

            <img class="w-[15rem]" src="{{ asset('img/Empty.jpg') }}">
            <h1 class="text-md text-gray-500">It’s empty here</h1>


           </div>
            @else
            <div id="filtered-data" class="p-8">
                @include('user.point-system._filter_points')
            </div>
        @endif


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
