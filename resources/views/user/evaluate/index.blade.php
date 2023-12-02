<x-app-layout>
@if (Auth::user()->authorize == 'checked')
@hasanyrole('Faculty extensionist|Extension coordinator')

    <section class="m-8  rounded-lg text-slate-700 relative mt-5 min-h-[85vh] bg-white 2xl:min-h-[87vh]">

        <div class=" flex justify-between p-8 flex-col sm:flex-row">
            <h1 class="xl:text-2xl sm:text-lg text-[.9rem] font-semibold tracking-wider">Evaluation overview <button data-tooltip-target="tooltip-right3" data-tooltip-placement="bottom" class="inline-block" type="button"><img src="{{ asset('img/i.png') }}" width="18" alt=""></button></h1>

            <select name="Years" id="Years" class="sm:text-sm text-xs  border-slate-500 rounded-lg">
                @foreach ($years as $year )
                <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <hr>

         <header>
            <div id="tooltip-right3" role="tooltip" class="space-y-1 absolute z-10 invisible inline-block px-3 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                <h1 class="tracking-wider pt-2">Project Leader</h1>
                <div class="flex">
                    <div class="w-full border">
                        <h1 class="pl-2">1. Resource Speaker/Trainer</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 10pts. per Training )</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">International (15pts. per Training )</h1>
                    </div>

                    <div class="w-full border-t border-b border-r">
                        <h1 class="pl-2">2. Facilitator/Moderator</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 7pts. per Training )</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">International ( 10pts. per Training )</h1>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full border">
                        <h1 class="pl-2 pt-2">3.  Reactor/Penl member</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 3pts. per Training )</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">International ( 7pts. per Training )</h1>
                    </div>

                    <div class="w-full border-t border-b border-r">
                        <h1 class="pl-2 pt-2">4. Techinical Assistance/Consultancy</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 2pts. per Training )</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">International ( 5pts. per Training )</h1>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full border">
                        <h1 class="pl-2 pt-2">5. Judge</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">( 3pts.)</h1>
                    </div>

                    <div class="w-full border-t border-b border-r">
                        <h1 class="pl-2 pt-2">6. Commencement/Guest Speaker</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">( 4pts )</h1>
                    </div>
                </div>
                <h1 class="py-2 tracking-wider">Participation in the extension and training per day:</h1>
                <div class="flex">
                    <div class="w-ful border">
                        <h1 class="pl-2">1. Coordinator/Organizer/consultants</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 10pts. per day )</h1>
                    </div>

                    <div class="w-full border-t border-b border-r">
                        <h1 class="pl-2">2. Resource person/lecturer</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 8pts. per day )</h1>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-full border">
                        <h1 class="pl-2 pt-2">3. Facilitator</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 6pts. per day )</h1>
                    </div>

                    <div class="w-full border-t border-b border-r">
                        <h1 class="pl-2 pt-2">4. Member</h1>
                        <h1 class="pl-4 font-thin text-[.7rem]">Local/National ( 4pts. per day )</h1>
                    </div>
                </div>
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </header>

        <div id="filtered-data" class="p-8">
            @include('user.evaluate.index_filter._filter_index')
        </div>

    </section>

    @endrole

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
            $('#Years').on('change', function () {
                var years = $(this).val();

                $.ajax({
                    url: '/api/user-filter-evaluation/{{ Auth()->user()->id }}',
                    type: 'GET',
                    data: { years: years },
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
