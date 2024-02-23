<x-app-layout>
    @section('title', 'My Evaluations | ' . config('app.name', 'UniCESS'))
@if (Auth::user()->authorize == 'checked')
@unlessrole('admin|New User')

    <section class="h-full rounded-xl text-slate-600 relative  bg-white">

        <header class="flex justify-between p-5 py-2 sm:py-4 items-center">
            <h1 class="xl:text-2xl sm:text-lg text-[.8rem] font-semibold tracking-wider text-slate-700">Evaluation overview <button data-tooltip-target="tooltip-right3" data-tooltip-placement="bottom" class="inline-block" type="button"><img src="{{ asset('img/i.png') }}" width="18" alt=""></button></h1>
            <select name="Years" id="Years" class="sm:text-sm text-xs  border-slate-500 rounded-lg w-[5rem] sm:w-[10rem]">
                @foreach ($years as $year )
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </header>
        <hr>

        @include('user.evaluate.index_filter._header_index')


        <div id="filtered-data">
            @include('user.evaluate.index_filter._filter_new_index')
        </div>




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

        function applyHideShowLogic() {
            var divContainers = document.querySelectorAll('.animated-div-container');

            // Show containers initially
            divContainers.forEach(function (container) {
                container.classList.add('animated-div');

                // Set a timeout to hide the container after 5 seconds
                setTimeout(function () {
                    container.classList.remove('animated-div');
                    container.style.display = 'none'; // Hide the container
                    var hiddenDivContainer = container.nextElementSibling;
                    if (hiddenDivContainer) {
                        hiddenDivContainer.classList.remove('hidden-div');
                    }
                }, 5000);
            });

        }

        applyHideShowLogic();

        $(document).ready(function () {
            $('#Years').on('change', function () {
                var years = $(this).val();

                $.ajax({
                    url: '/api/user-filter-evaluation/{{ Auth()->user()->id }}',
                    type: 'GET',
                    data: { years: years },
                    success: function(data) {
                // Update the filtered data container with the response
                $('#filtered-data').html(data);


                applyHideShowLogic();

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
                //    console.log(data.message);
                } else {
                 //   console.error(data.error);
                }
            })
            .catch(error => {
               // console.error('Error:', error);
            });
          });


    </script>

</x-app-layout>
