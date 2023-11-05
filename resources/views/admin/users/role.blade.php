    <style>
        .background-animate {
        background-size: 400%;

        -webkit-animation: AnimationName 30s ease infinite;
        -moz-animation: AnimationName 30s ease infinite;
        animation: AnimationName 30s ease infinite;
        }

        @keyframes AnimationName {
        0%,
        100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        }
    </style>

<x-admin-layout>

    <div class="bg-white rounded-lg shadow mt-5 m-8 h-[87vh] relative">

        <div class="p-4 px-6 pl-8 text-gray-900 flex  justify-between">
            <h1 class="text-gray-600 xl:text-sm 2xl:text-xl tracking-wider font-semibold">Account details</h1>
            <a class=" px-1 py-1 rounded text-red-500 text-2xl font-bold hover:bg-gray-200 focus:bg-red-200 " href={{ route('admin.users.main') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
        <hr>

        <div class=" min-h-[12vh] bg-gradient-to-r
        from-slate-400
        via-slate-300
        to-slate-200

        background-animate ">
        </div>

        <div class="w-40 absolute top-28 left-12 z-20">
            <img class="rounded-full border-8 border-white bg-white" id="showImage"
            src="{{ !empty($user->avatar) ? url('upload/image-folder/profile-image/' . $user->avatar) : url('upload/profile.png') }}">

        </div>
        <div class=" min-h-[12vh] flex justify-end relative">
            <div class="left-[14rem]  top-4 absolute ">
                <div class="flex space-x-1  items-center">
                    <h1 class="text-lg font-medium tracking-wider">{{ $user->name }} </h1>
                    @if ($user->email_verified_at == '')
                        <h1 class="text-xs text-red-400">email unverified</h1>
                    @else
                    <svg class="fill-green-500" xmlns="http://www.w3.org/2000/svg" height="22"
                    viewBox="0 96 960 960" width="24">
                    <path
                        d="m344 996-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm94-278 226-226-56-58-170 170-86-84-56 56 142 142Z" />
                </svg>

                    @endif

                </div>

                 <span class="text-sm">
                 @if ($user->roles)
                    @foreach ($user->roles as $user_role)
                    {{ $user_role->name }}
                    @endforeach
                @endif
                • {{  $user->faculty == null ? '' : $user->faculty->name }}</span>

            </div>

            <div class="p-5 pr-10 flex flex-col space-y-2 items-end">
                <label class="toggle-switch">
                    <input
                        class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                        type="checkbox" data-id="{{ $toggle->id }}"
                        {{ $toggle->authorize === 'checked' ? 'checked' : '' }} id="toggle" />
                    <span class="toggle-slider"></span>
                </label>
                <h1 class="text-lg flex justify-between font-medium xl:text-sm ">
                    @if ($user->authorize == 'pending')
                        <span class="text-red-500 text-lg xl:text-sm">Pending</span>
                    @elseif ($user->authorize == 'checked')
                        <span class="text-green-500 xl:text-sm">Approved</span>
                    @else
                        <span class="text-red-600 xl:text-sm">Declined</span>
                    @endif
                </h1>
            </div>
        </div>

        <div class=" min-h-[55vh] flex space-x-8 p-7 pt-0 ">
            <div class="shadow-md bg-gray-100 rounded-lg w-[30rem] p-5">

                <div class="bg-white min-h-[20vh] rounded p-4 space-y-3">
                    <div class="flex justify-between items-center">
                        <h1 class="tracking-wider">Basic Information</h1>
                      <h1 class="text-[.7rem] tracking-wider"> Joined: {{ $user->created_at->diffForHumans() }}</h1>
                    </div>

                    <hr>
                    <h1 class="text-[.8rem] tracking-wider"> Email: {{ $user->email }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> First name:   {{ $user->first_name == null ? 'N/A' : $user->first_name }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Middle name:   {{ $user->middle_name == null ? 'N/A' : $user->middle_name }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Last name:  {{ $user->last_name == null ? 'N/A' : $user->last_name }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Suffix:    {{ $user->suffix == null ? 'N/A' : $user->suffix }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Gender:    {{ $user->gender == null ? 'N/A' : $user->gender }}</h1>

                </div>

                <div class="bg-white mt-5 min-h-[20vh] rounded p-4 space-y-2">
                    <h1 class="tracking-wider">Contact Information</h1>
                    <hr>
                    <h1 class="text-[.8rem] tracking-wider"> Contact no.:  {{ $user->contact_number == null ? 'N/A' : $user->contact_number }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Province:   {{ $user->province == null ? 'N/A' : $user->province }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> City:   {{ $user->city == null ? 'N/A' : $user->city }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Barangay:  {{ $user->barangay == null ? 'N/A' : $user->barangay }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Address:    {{ $user->address == null ? 'N/A' : $user->address }}</h1>
                    <h1 class="text-[.8rem] tracking-wider"> Zipcode:    {{ $user->zipcode == null ? 'N/A' : $user->zipcode }}</h1>

                </div>
            </div>


            <div class="shadow-md bg-gray-100 rounded-lg flex-auto w-64 p-5">
                @foreach ($customs as $custom )
                    @if ($custom->number == '1')
                    <div class="bg-white rounded min-h-[50vh] p-4">
                        <div class="flex justify-between items-center mb-1">
                           <h1 class="tracking-wider">Proposal Overview</h1>
                           <div>
                               <input type="text" id="searchInput" class="text-xs border-gray-400 rounded-md w-[20rem]" placeholder="Search proposal title...">
                               <select  class="text-xs border-gray-400 rounded-md" id="Years">
                                   <option value="">Select All Year</option>
                                   @foreach ($years as $year )
                                       <option value="{{ $year }}" @if ($year == date('Y')) selected="selected" @endif>{{ $year }}</option>
                                   @endforeach
                               </select>
                               <select  class="text-xs border-gray-400 rounded-md" id="Status">
                                   <option value="">Select Status</option>
                                   <option value="pending">Pending</option>
                                   <option value="ongoing">Ongoing</option>
                                   <option value="finished">Finished</option>
                               </select>

                               <select  class="text-xs border-gray-400 rounded-md" id="Customize">
                                @foreach ($customs as $custom )
                                <option value="1" {{ old('1', $custom->number) == '1' ? 'selected' : '' }}>Proposal</option>
                                <option value="2" {{ old('2', $custom->number) == '2' ? 'selected' : '' }}>Evaluation</option>
                                @endforeach
                               </select>
                           </div>
                       </div>
                       <hr>

                       <div id="filtered-data">
                           @include('admin.users.role-filter._dashboard-proposal-filter')
                       </div>
                   </div>
                   @elseif ($custom->number == '2')

                   <div class="bg-white rounded min-h-[50vh] p-4">
                    <div class="flex justify-between items-center mb-1">
                       <h1 class="tracking-wider">Evaluation Overview</h1>
                       <div>
                            <select  class="text-xs border-gray-400 rounded-md" id="EvaluationYears">
                               <option value="">Select All Year</option>
                               @foreach ($years as $year )
                                   <option value="{{ $year }}" >{{ $year }}</option>
                               @endforeach
                            </select>
                            <select  class="text-xs border-gray-400 rounded-md" id="EvaluationStatus">
                               <option value="">Select Status</option>
                               <option value="pending">Pending</option>
                               <option value="evaluated">Validated</option>
                            </select>

                           <select  class="text-xs border-gray-400 rounded-md" id="Customize">
                            @foreach ($customs as $custom )
                            <option value="1" {{ old('1', $custom->number) == '1' ? 'selected' : '' }}>Proposal</option>
                            <option value="2" {{ old('2', $custom->number) == '2' ? 'selected' : '' }}>Evaluation</option>
                            @endforeach
                           </select>
                       </div>
                   </div>
                   <hr>

                   <div id="filtered-data">
                       @include('admin.users.role-filter._dashboard-evaluation-filter')
                   </div>
               </div>
                    @endif
                @endforeach

            </div>
        </div>

    </div>

    <script>
        // Wait for the DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            var toggleSwitch = document.getElementById('toggle');

            toggleSwitch.addEventListener('change', function() {
                var toggleState = this.checked;
                var recordId = this.getAttribute('data-id');

                // Send an AJAX request to the Laravel API endpoint
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/api/toggle-update/user/' + recordId, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Handle the success response
                            window.location.reload();
                            console.log('Toggle state updated successfully!');
                        }
                    }
                };

                xhr.send(JSON.stringify({
                    state: toggleState
                }));
            });
        });


        $(document).ready(function () {
            let timer;

            $('#searchInput').on('input', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var years =  $('#Years').val();
                var status =  $('#Status').val();

                timer = setTimeout(function () {

                    $.ajax({
                        url: "{{ route('admin.users.search-proposal', $user->id ) }}",
                        method: 'GET',
                        data: { query: query, years: years, status : status },
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
            $('#Years').on('change', function () {
                var years = $(this).val();
                var query =  $('#searchInput').val();
                var status =  $('#Status').val();
                $.ajax({
                    url: "{{ route('admin.users.search-proposal', $user->id ) }}",
                    type: 'GET',
                    data: { years: years, query: query, status : status },
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
            $('#Status').on('change', function () {
                var status = $(this).val();
                var query =  $('#searchInput').val();
                var years =  $('#Years').val();
                $.ajax({
                    url: "{{ route('admin.users.search-proposal', $user->id ) }}",
                    type: 'GET',
                    data: { status: status, query: query, years : years },
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
            $('#EvaluationYears').on('change', function () {
                var years = $(this).val();
                var status =  $('#EvaluationStatus').val();
                $.ajax({
                    url: "{{ route('admin.users.filter-evaluation-year', $user->id ) }}",
                    type: 'GET',
                    data: { years : years, status: status,  },
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
            $('#EvaluationStatus').on('change', function () {
                var status = $(this).val();
                var years =  $('#EvaluationYears').val();
                $.ajax({
                    url: "{{ route('admin.users.filter-evaluation-status', $user->id ) }}",
                    type: 'GET',
                    data: { status: status, years : years },
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
            $('#Customize').on('change', function () {
                var customize = $(this).val();

                $.ajax({
                    url: "{{ route('admin.users.filter-customize', 1 ) }}",
                    method: 'POST',
                    data: {
                        customize: customize,
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



    </script>


</x-admin-layout>
