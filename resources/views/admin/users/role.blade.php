    <style>
        .background-animate {
        background-size: 400%;

        -webkit-animation: AnimationName 30s ease infinite;
        -moz-animation: AnimationName 30s ease infinite;
        animation: AnimationName 30s ease infinite;
        }
        .active-tab {
            /* Add your active styles here */
            background-color: #cacaca;
            color: #ffffff;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
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

    <section class="bg-white rounded-lg shadow mt-4 2xl:mt-5  m-8  h-[82vh] 2xl:h-[87vh] relative text-gray-700 overflow-hidden">

        <header class="p-4 px-6 pl-8 text-gray-900 flex  justify-between">
            <h1 class="text-gray-600 xl:text-lg 2xl:text-xl tracking-wider font-semibold">Account details</h1>
            <a class=" px-1 py-1 rounded text-red-500 text-2xl font-bold hover:bg-gray-200 focus:bg-red-200 " href={{ route('admin.users.main') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <div class="hidden 2xl:block h-[7vh] xl:h-[9vh] 2xl:h-[12vh] bg-gradient-to-r
        from-slate-400 via-slate-300 to-slate-200 background-animate">
        </div>

        <div class="w-32 2xl:w-40 xl:w-20 lg:w-28 absolute top-20 xl:top-[11vh] 2xl:top-28  left-12 z-20 ">
            <img class="rounded-full border-8 border-white bg-white" id="showImage"
            src="{{ !empty($user->avatar) ? url('upload/image-folder/profile-image/' . $user->avatar) : url('upload/profile.png') }}">
        </div>


        <div class="xl:h-[14vh] h-[7vh]  2xl:h-[12vh] flex justify-end relative">
            <div class="left-[12rem] xl:left-[9rem] 2xl:left-[14rem] top-4 absolute ">
                <div class="flex space-x-1  items-center">
                    <h1 class="text-sm xl:text-base 2xl:text-lg font-medium tracking-wider">{{ $user->name }} </h1>
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

                <span class="text-xs lg:text-sm">
                @if ($user->roles) @foreach ($user->roles as $user_role) {{ $user_role->name }} @endforeach @endif• {{  $user->faculty == null ? '' : $user->faculty->name }}
                </span>
            </div>

            <div class="p-5 pr-10 flex flex-col space-y-2 items-end">
                <label class="toggle-switch">
                    <input
                        class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                        type="checkbox" data-id="{{ $toggle->id }}"
                        {{ $toggle->authorize === 'checked' ? 'checked' : '' }} id="toggle" />
                    <span class="toggle-slider"></span>
                </label>
                <h1 class="text-xs flex justify-between font-medium xl:text-sm">
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


        <div class=" px-5">

            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-300">
                <li class="me-2"  id="tab-information">
                    <a href="#" onclick="showTab('information')" aria-current="page"  class="inline-block p-2 2xl:p-4 rounded-t-lg ">Information</a>
                </li>
                <li class="me-2"  id="tab-project">
                    <a href="#" onclick="showTab('project')"  class="inline-block p-2 2xl:p-4 rounded-t-lg">Project</a>
                </li>
                <li class="me-2"  id="tab-evaluation">
                    <a href="#" onclick="showTab('evaluation')"  class="inline-block p-2 2xl:p-4 rounded-t-lg">Evaluation</a>
                </li>

            </ul>

            <div id="information-content" class="tab-content flex h-full mt-5" style="display: none;">

                <div class="2xl:space-y-4 2xl:space-x-0 flex 2xl:flex-col flex-row space-y-0 space-x-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="border full rounded">
                            <div class="flex justify-between items-center px-2 py-1">
                                <h1 class="tracking-wider 2xl:text-lg text-sm">Basic Information</h1>
                                <h1 class="2xl:text-[.7rem] text-[.6rem] tracking-wider"> Joined: {{ $user->created_at->diffForHumans() }}</h1>
                            </div>

                            <hr>
                            <div class="p-2">
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Email: {{ $user->email }}</h1>
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> First name: {{ $user->first_name == null ? 'N/A' : $user->first_name }}</h1>
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Middle name: {{ $user->middle_name == null ? 'N/A' : $user->middle_name }}</h1>
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Last name:  {{ $user->last_name == null ? 'N/A' : $user->last_name }}</h1>
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Suffix:    {{ $user->suffix == null ? 'N/A' : $user->suffix }}</h1>
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Gender:    {{ $user->gender == null ? 'N/A' : $user->gender }}</h1>
                            </div>
                        </div>

                        <div class=" border rounded w-full">
                            <h1 class="tracking-wider 2xl:text-lg text-sm px-2 py-1">LOGS Information</h1>
                            <hr>
                            <div class="p-2">
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Last Logged in:  {{ $user->last_logged_in == null ? 'N/A' : \Carbon\Carbon::parse($user->last_logged_in)->format('M d, y g:i:s A') }}</h1>
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> IP address:   {{ $user->ip_address == null ? 'N/A' : $user->ip_address }}  </h1>
                            </div>
                        </div>

                    </div>

                    <div class="border rounded px-2 py-1 w-full">
                        <h1 class="tracking-wider 2xl:text-lg text-sm">Address Information</h1>
                        <hr>
                        <div class="">
                            <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Contact no.:  {{ $user->contact_number == null ? 'N/A' : $user->contact_number }}</h1>
                            <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Province:   {{ $user->province == null ? 'N/A' : $user->province }}</h1>
                            <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> City:   {{ $user->city == null ? 'N/A' : $user->city }}</h1>
                            <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider">Barangay: {{ $user->barangay == null ? 'N/A' : $user->barangay }}</h1>
                            <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Address: {{ $user->address == null ? 'N/A' : $user->address }}</h1>
                            <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Zipcode: {{ $user->zipcode == null ? 'N/A' : $user->zipcode }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div id="project-content" class="tab-content bg-white rounded border p-4 mt-5 h-[45vh]" style="display: none;">
                <div class="flex justify-between items-center mb-1">
                   <h1 class="tracking-wider text-[.7rem] 2xl:text-base">Projects</h1>
                   <div>
                       <input type="text" id="searchInput" class="text-xs border-gray-200 rounded-md  xl:w-[12rem] 2xl:w-auto" placeholder="Search Project title...">
                       <select  class="text-xs border-gray-200 rounded-md text-gray-700" id="Years">
                           <option value="">All Year</option>
                           @foreach ($years as $year )
                               <option value="{{ $year }}" @if ($year == date('Y')) selected="selected" @endif>{{ $year }}</option>
                           @endforeach
                       </select>
                       <select  class="text-xs border-gray-200 rounded-md text-gray-700" id="Status">
                           <option value=""> Status</option>
                           <option value="pending">Pending</option>
                           <option value="ongoing">Ongoing</option>
                           <option value="finished">Finished</option>
                       </select>
                   </div>
               </div>
               <hr>

               <div id="filtered-data">
                   @include('admin.users.role-filter._dashboard-proposal-filter')
               </div>
           </div>

           <div id="evaluation-content"  class="tab-content bg-white rounded border p-4 mt-5 h-[45vh]" style="display: none;">
                <div class="flex justify-between items-center mb-1">
                <h1 class="tracking-wider text-xs 2xl:text-sm">Evaluation Overview</h1>
                <div>
                        <select  class="text-xs border-gray-400 rounded-md" id="EvaluationYears">
                        @foreach ($years as $year )
                            <option value="{{ $year }}" >{{ $year }}</option>
                        @endforeach
                        </select>
                        <select  class="text-xs border-gray-400 rounded-md" id="EvaluationStatus">
                        <option value="">Status</option>
                        <option value="pending">Pending</option>
                        <option value="evaluated">Validated</option>
                        </select>

                </div>
                </div>
                <hr>

                <div id="filtered-data">
                    @include('admin.users.role-filter._dashboard-evaluation-filter')
                </div>

            </div>
        </div>

    </section>

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('selectedProfileInformationTab');
            if (storedTab) {
                // Show the stored tab content
                document.getElementById(storedTab + '-content').style.display = 'block';

                // Add 'active' class to the stored tab (if needed)
                document.querySelector('[onclick="showTab(\'' + storedTab + '\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-' + storedTab).classList.add('active-tab');
            } else {
                // If no stored tab, show the 'narrative-content' by default
                document.getElementById('information-content').style.display = 'block';

                // Add 'active' class to the 'narrative' tab (if needed)
                document.querySelector('[onclick="showTab(\'information\')"]').classList.add('active');

                // Add 'active' class to the corresponding <li>
                document.getElementById('tab-information').classList.add('active-tab');
            }
        });

        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });

            // Remove 'active' class from all tabs (if needed)
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.classList.remove('active');
            });

            // Remove 'active-tab' class from all <li> elements (if needed)
            document.querySelectorAll('li').forEach(function (li) {
                li.classList.remove('active-tab');
            });

            // Show the selected tab content
            document.getElementById(tabId + '-content').style.display = 'block';

            // Add 'active' class to the clicked tab (if needed)
            document.querySelector('[onclick="showTab(\'' + tabId + '\')"]').classList.add('active');

            // Add 'active-tab' class to the corresponding <li>
            document.getElementById('tab-' + tabId).classList.add('active-tab');

            // Store the selected tab in localStorage
            localStorage.setItem('selectedProfileInformationTab', tabId);
        }
    </script>


</x-admin-layout>
