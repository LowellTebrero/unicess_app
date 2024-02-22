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

        .switch {
            /* switch */
            --switch-width: 46px;
            --switch-height: 24px;
            --switch-bg: rgb(131, 131, 131);
            --switch-checked-bg: rgb(0, 218, 80);
            --switch-offset: calc((var(--switch-height) - var(--circle-diameter)) / 2);
            --switch-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
            /* circle */
            --circle-diameter: 18px;
            --circle-bg: #fff;
            --circle-shadow: 1px 1px 2px rgba(146, 146, 146, 0.45);
            --circle-checked-shadow: -1px 1px 2px rgba(163, 163, 163, 0.45);
            --circle-transition: var(--switch-transition);
            /* icon */
            --icon-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
            --icon-cross-color: var(--switch-bg);
            --icon-cross-size: 6px;
            --icon-checkmark-color: var(--switch-checked-bg);
            --icon-checkmark-size: 10px;
            /* effect line */
            --effect-width: calc(var(--circle-diameter) / 2);
            --effect-height: calc(var(--effect-width) / 2 - 1px);
            --effect-bg: var(--circle-bg);
            --effect-border-radius: 1px;
            --effect-transition: all .2s ease-in-out;
          }

          .switch input {
            display: none;
          }

          .switch {
            display: inline-block;
          }

          .switch svg {
            -webkit-transition: var(--icon-transition);
            -o-transition: var(--icon-transition);
            transition: var(--icon-transition);
            position: absolute;
            height: auto;
          }

          .switch .checkmark {
            width: var(--icon-checkmark-size);
            color: var(--icon-checkmark-color);
            -webkit-transform: scale(0);
            -ms-transform: scale(0);
            transform: scale(0);
          }

          .switch .cross {
            width: var(--icon-cross-size);
            color: var(--icon-cross-color);
          }

          .slider {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            width: var(--switch-width);
            height: var(--switch-height);
            background: var(--switch-bg);
            border-radius: 999px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            position: relative;
            -webkit-transition: var(--switch-transition);
            -o-transition: var(--switch-transition);
            transition: var(--switch-transition);
            cursor: pointer;
          }

          .circle {
            width: var(--circle-diameter);
            height: var(--circle-diameter);
            background: var(--circle-bg);
            border-radius: inherit;
            -webkit-box-shadow: var(--circle-shadow);
            box-shadow: var(--circle-shadow);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-transition: var(--circle-transition);
            -o-transition: var(--circle-transition);
            transition: var(--circle-transition);
            z-index: 1;
            position: absolute;
            left: var(--switch-offset);
          }

          .slider::before {
            content: "";
            position: absolute;
            width: var(--effect-width);
            height: var(--effect-height);
            left: calc(var(--switch-offset) + (var(--effect-width) / 2));
            background: var(--effect-bg);
            border-radius: var(--effect-border-radius);
            -webkit-transition: var(--effect-transition);
            -o-transition: var(--effect-transition);
            transition: var(--effect-transition);
          }

          /* actions */

          .switch input:checked+.slider {
            background: var(--switch-checked-bg);
          }

          .switch input:checked+.slider .checkmark {
            -webkit-transform: scale(1);
            -ms-transform: scale(1);
            transform: scale(1);
          }

          .switch input:checked+.slider .cross {
            -webkit-transform: scale(0);
            -ms-transform: scale(0);
            transform: scale(0);
          }

          .switch input:checked+.slider::before {
            left: calc(100% - var(--effect-width) - (var(--effect-width) / 2) - var(--switch-offset));
          }

          .switch input:checked+.slider .circle {
            left: calc(100% - var(--circle-diameter) - var(--switch-offset));
            -webkit-box-shadow: var(--circle-checked-shadow);
            box-shadow: var(--circle-checked-shadow);
          }
    </style>



<x-admin-layout>

    <section class="bg-white rounded-lg shadow h-full relative text-gray-700 overflow-hidden">

        <header class="p-4 px-6 pl-8 text-gray-900 flex  justify-between">
            <h1 class="text-gray-600 xl:text-lg 2xl:text-xl tracking-wider font-semibold">Account details</h1>
            <a class=" px-1 py-1 rounded text-red-500 text-2xl font-bold hover:bg-gray-200 focus:bg-red-200 " href={{ route('admin.users.main') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <div class="h-[12vh]  bg-gradient-to-r
         from-slate-400 via-slate-300 to-slate-200 background-animate">
        </div>

        <div class="w-12 2xl:w-40  md:w-28 sm:w-24 absolute top-20 xl:top-[17vh]  sm:top-28  left-2 md:left-5  2xl:left-8 2xl:top-[8rem] z-20 ">
            <img class="rounded-full border-8 border-white bg-white" id="showImage"
            src="{{ !empty($user->avatar) ? url('upload/image-folder/profile-image/' . $user->avatar) : url('upload/profile.png') }}">
        </div>


        <div class="h-[14vh]  2xl:h-[12vh] flex justify-end relative">
            <div class="sm:left-[7rem] md:left-[9rem] 2xl:left-[14rem] top-3 md:top-4 absolute ">
                <div class="flex space-x-1 items-center">
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

            <div class="p-5 pr-5 md:pr-10 flex flex-col space-y-2 items-end">
                <div class="flex flex-row space-x-2 justify-center ">
                    <div>
                        <label class="switch ">
                            <input type="checkbox" data-id="{{ $toggle->id }}" {{ $toggle->authorize === 'checked' ? 'checked' : '' }} id="toggle">
                            <div class="slider">
                                <div class="circle">
                                    <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" y="0" x="0" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                        </g>
                                    </svg>
                                    <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" y="0" x="0" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </label>

                        <h1 class="text-xs flex text-center justify-between font-medium">
                            @if ($user->authorize == 'pending')
                                <span class="text-red-500 text-lg">Pending</span>
                            @elseif ($user->authorize == 'checked')
                                <span class="text-green-500">Approved</span>
                            @else
                                <span class="text-red-600">Declined</span>
                            @endif
                        </h1>
                    </div>

                    <div>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><g fill="none" stroke="#ff8a8a" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                        </button>
                    </div>
                </div>
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

            <div id="information-content" class="tab-content flex h-[38vh] 2xl:h-[45vh] mt-2 2xl:mt-5 " style="display: none;">

                <div class="2xl:space-y-4 2xl:space-x-0 flex 2xl:flex-col flex-row space-y-0 space-x-4">
                    <div class="flex flex-col space-y-2 2xl:space-y-4 w-full">
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
                                <h1 class="text-[.6rem] xl:text-[.67rem] 2xl:text-xs tracking-wider"> Address:   {{ $user->last_logged_in_address == null ? 'N/A' : $user->last_logged_in_address }}  </h1>
                            </div>
                        </div>

                    </div>

                    <div class="border rounded  w-full">
                        <div class="px-2 py-1">
                            <h1 class="tracking-wider 2xl:text-lg text-sm">Address Information</h1>
                        </div>

                        <hr>
                        <div class="p-2">
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

            <div id="project-content" class="tab-content bg-white rounded border p-4 mt-2 2xl:mt-5 h-[38vh] 2xl:h-[45vh]" style="display: none;">
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

           <div id="evaluation-content"  class="tab-content bg-white rounded border p-4 mt-2 2xl:mt-5 h-[38vh] 2xl:h-[45vh]" style="display: none;">
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
