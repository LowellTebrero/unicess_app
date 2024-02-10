<x-app-layout>

    @php($count=0)
    <style> [x-cloak] { display: none}</style>
    <section class="m-8 h-[82vh] 2xl:h-[87vh] bg-white mt-4 2xl:mt-5  rounded-lg shadow text-slate-700 ">

        @if ($proposals == null)
            <div class="flex justify-between p-5 py-3">
                <h1 class="text-lg tracking-wide">404 Error: Not Found</h1>
                <a href={{ route('User-dashboard.index') }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
            <hr>
            <div class="flex items-center justify-center h-[100%]">
                <h1 class="text-2xl tracking-wide text-gray-700">404 Error:<span class="text-red-500"> Not Found</span> </h1>
            </div>

        @elseif ($proposals->proposal_members->isEmpty())
        <div class="flex justify-between p-5 py-3">
            <h1 class="text-lg tracking-wide">404 Error: Not Found</h1>
            <a href={{ route('User-dashboard.index') }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
        <hr>
        <div class="flex flex-col space-y-4 items-center justify-center h-[100%]">
            <img class="w-[12rem]" src="{{ asset('img/not-found.svg') }}" alt="">
            <h1 class="tracking-wide text-gray-700">404 Error:<span class="text-red-500"> Not Found</span> </h1>
        </div>
        @else

                @foreach ($proposals->proposal_members as $member )

                    @if ($member->user_id === Auth::user()->id)
                        <div class="flex justify-between p-5 py-3">

                            <h1 class="text-sm  tracking-wide">{{ $proposals->project_title }}</h1>
                            <a href={{ URL::previous() }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>

                        <hr>

                        <div class="p-4">
                                <div class="flex w-full justify-between p-5 py-0">
                                    <div>
                                        <img src="{{ asset('img/track.svg') }}" width="300">

                                        <div class=" text-xs flex flex-row justify-between pt-2 text-gray-600">
                                            <div class="flex flex-col">
                                                <h1>Uploaded at</h1>
                                                <h1>{{ $proposal->created_at->format('M. d, Y') }}</h1>
                                            </div>
                                            <div class="flex flex-col">
                                                <h1>Started date</h1>
                                                <h1>{{ $proposal->started_date == null ? 'No date' : $proposal->started_date->format('M. d, Y') }}</h1>
                                            </div>
                                            <div class="flex flex-col">
                                                <h1>Ended date</h1>
                                                <h1>{{ $proposal->finished_date == null ? 'No date' :  $proposal->finished_date->format('M. d, Y') }}</h1>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex space-y-2 text-xs tracking-wider text-gray-600 flex-col  items-end ">
                                        <h1>Project ID: {{ $proposal->id }}</h1>
                                        <h1>Status: {{ strtoupper($proposal->authorize) }}</h1>
                                        @include('user.dashboard.show-user._see-details-show-user-proposal')
                                        <a href={{ route('inventory.show', ['id' => $proposal->id, 'notification' => $proposal->id ]) }} class="bg-blue-500 px-2 py-2 rounded text-white hover:bg-blue-600">Go to Inventory</a>
                                    </div>
                                </div>



                                <div class="m-5 overflow-x-auto h-[40vh] 2xl:h-[50vh] bg-gray-200 space-y-2 text-sm tracking-wider rounded">

                                    <div class="flex justify-between py-2 px-4  tracking-wide bg-gray-600 text-white sticky top-0">
                                        <h1>Date</h1>
                                        <h1>Information</h1>
                                    </div>

                                    <div class="px-4 space-y-1">
                                        <div class="flex justify-between w-full text-[.7rem] 2xl:text-[.8rem]">
                                            <h1>{{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, y g:i:s A') }}</h1>

                                            <h1> Proposal uploaded</h1>
                                        </div>

                                        @foreach ($proposal->medias as $mediaLibrary)
                                        <div class="flex justify-between w-full text-[.7rem] 2xl:text-[.8rem] ">
                                              <h1>{{ \Carbon\Carbon::parse($mediaLibrary->created_at)->format('M d, y g:i:s A') }}</h1>
                                            <h1>{{ Str::limit($mediaLibrary->file_name, 90) }} file uploaded</h1>
                                        </div>
                                        @endforeach


                                    </div>


                                </div>
                        </div>

                    @endif
                @endforeach

        @endif

    </section>




</x-app-layout>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    /* $(document).ready(function(){
            $('#tags').select2({
                placeholder: 'Select Option',
                allowClear: true,
                tags: true // Enable tagging
            });
        });
        */

        $(document).ready(function(){
            $('.tags').select2({
                placeholder: 'Select Option',
                allowClear: true,
                tags: true,
                width: '100%',
            });

            $('#tags').select2({
                ajax: {
                    url: "{{ route('proposal.getusername') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: function(params){
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(data){
                        return {
                            results: $.map(data, function(user){
                                return {
                                    id: user.id,
                                    text: user.name
                                }
                            })
                        };
                    },
                },
                placeholder: "Start typing to search name",
                width: '100%'
            });
        });

    </script>







