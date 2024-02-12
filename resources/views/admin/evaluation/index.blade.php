
<x-admin-layout>

    @section('title', 'Evaluation | ' . config('app.name', 'UniCESS'))

    <section class="text-gray-700 h-[82vh] 2xl:h-[87vh] m-8 mt-4 2xl:mt-5  bg-white rounded-xl shadow">

        <div class="flex justify-between p-5 py-4">
            <div>
                <h1 class="tracking-wider 2xl:text-2xl font-semibold text-lg">Evaluation Overview </h1>

                <div id="toggle-container" class="mt-2">

                    <input
                    class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                    type="checkbox" data-id="{{ $toggle->id }}" {{ $toggle->status === 'checked' ? 'checked' : '' }}
                    id="toggle" onclick="return confirm ('Are you sure?')" />
                    <label class="toggle-switch 2xl:text-sm text-xs">Switch here to Open/Close Evaluation</label>
                </div>
            </div>

            <div>
                <input type="text" placeholder="Search name or email..." class="xl:text-xs border-slate-400 rounded-lg text-sm" id="searchInput">


                <select name="semester" id="semester" class="xl:text-xs border-slate-400 rounded-lg text-sm">
                    <option value="first_sem">1st Sem</option>
                    <option value="second_sem">2nd Sem</option>
                </select>

                <select name="myDropdown" id="myDropdown" class="xl:text-xs border-slate-400 rounded-lg text-sm">
                    @foreach ($years as $year )
                        <option value="{{ $year }}" @if ($year == date('Y')) selected="selected" @endif>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>

        <div id="filtered-data">
            {{--  @if ($latestData->isEmpty())
                <div class="h-[45vh] 2xl:h-[50vh] flex flex-col items-center justify-center space-y-2">
                    <img class="w-[12rem]" src="{{ asset('img/Empty.jpg') }}">
                    <h1 class="text-md text-gray-500">It’s empty here</h1>
                </div>
            @else  --}}
                @include('admin.evaluation._filter_evaluation')
            {{--  @endif  --}}
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
                xhr.open('POST', '/api/toggle-update/' + recordId, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Handle the success response
                            console.log('Toggle state updated successfully!');
                        }
                    }
                };

                xhr.send(JSON.stringify({
                    state: toggleState
                }));
            });
        });

       /* function centerModal() {
            // Assuming your modal has an ID like 'popup-modal'
            var modal = $(this).data('evaluation-id');

            // Assuming your modal content is directly inside the modal
            var modalContent = modal.find('.modal-content');

            // Calculate the top and left positions to center the modal
            var topPosition = ($(window).height() - modalContent.outerHeight()) / 2;
            var leftPosition = ($(window).width() - modalContent.outerWidth()) / 2;

            // Apply the calculated positions
            modal.css({
                'top': topPosition + 'px',
                'left': leftPosition + 'px',
            });
        }
        */

        $(document).ready(function() {
           $(document).on('click', '.delete-button', function() {
                // Get the evaluation ID from the data attribute
                var button = $(this);
                var evaluationId = $(this).data('evaluation-id');

                // Make an AJAX request to delete the evaluation
                $.ajax({
                    url: '/admin/evaluation-trash/' + evaluationId,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        // Handle the success response as needed
                        console.log('Trash successful', response);
                        button.closest('tr').remove();

                        // Optionally, update the UI or perform additional actions
                        if (response.success) {
                            toastr.success(response.success);
                            // Additional logic if needed
                        } else if (response.error) {
                            toastr.error(response.error);
                            // Additional error handling logic
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors, e.g., show an error message
                        console.error('Trash error', error);

                        // Optionally, update the UI or perform additional error handling
                    }
                });

            });
        });



        $(document).on('click', '[data-modal-toggle]', function() {
            // Retrieve the evaluation ID from the data attribute
            var evaluationId = $(this).data('modal-toggle').replace('popup-modal', '');

            // Form the ID of the corresponding modal
            var modalId = 'popup-modal' + evaluationId;
            console.log(modalId);
            // Code to show the modal
            $('#' + modalId).removeClass('hidden');
            $('#' + modalId).addClass('flex items-center justify-center');

        });

        $(document).on('click', '[data-modal-hide]', function() {
            // Retrieve the evaluation ID from the data attribute
            var evaluationId = $(this).data('modal-hide').replace('popup-modal', '');

            // Form the ID of the corresponding modal
            var modalId = 'popup-modal' + evaluationId;
            console.log(modalId);
            // Code to show the modal
            $('#' + modalId).addClass('hidden');
        });


        $(document).ready(function() {
            // Define the timer variable
            let timer;

            // Function to show active tab content
            function showActiveTabContent(tabId) {
                // Hide all tab contents
                $('.tab-content').hide();
                // Show the selected tab content
                $('#' + tabId + '-content').show();
            }

            // Function to handle select change
            $('#myDropdown').on('change', function() {
                var selectedValue = $(this).val();
                // Filter evaluation based on selected year
                filterEvaluation(selectedValue);
            });

            // Function to filter evaluation
            function filterEvaluation(selectedValue, query = '') {
                $.ajax({
                    url: '/api/filter-evaluation',
                    type: 'GET',
                    data: {
                        selected_value: selectedValue,
                        query: query // Pass the search query
                    },
                    success: function(data) {
                        console.log('AJAX success', data);
                        // Update the content of filtered-data div
                        $('#filtered-data').html(data);
                        // Show active tab content based on stored tab
                        var storedTab = localStorage.getItem('selectedAdminEvaluation');
                        showActiveTabContent(storedTab);
                        // Set display property to "block" for the filtered data
                        $('#filtered-data').css('display', 'block');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            }

            // Function to handle search input
            $('#searchInput').on('input', function() {
                clearTimeout(timer);
                var query = $(this).val();
                var selectedValue = $('#myDropdown').val(); // Get the selected dropdown value

                // Set a timer to delay the search
                timer = setTimeout(function() {
                    // Filter evaluation based on selected year and search query
                    filterEvaluation(selectedValue, query);
                }, 300); // 300 milliseconds delay
            });

            // Handle select change event
            $('#semester').on('change', function() {
                var selectedTab = $(this).val();
                // Hide all tab contents
                $('.tab-content').hide();
                // Show the selected tab content
                $('#' + selectedTab + '-content').show();
                // Store the selected tab in localStorage
                localStorage.setItem('selectedAdminEvaluation', selectedTab);
            });

            // Check if there's a stored tab in localStorage
            var storedTab = localStorage.getItem('selectedAdminEvaluation');
            console.log("Stored tab:", storedTab);
            if (storedTab) {
                // Show the stored tab content
                showActiveTabContent(storedTab);
                // Select the corresponding option in the dropdown
                $('#semester').val(storedTab);
            } else {
                // If no stored tab, show the first tab content by default
                showActiveTabContent('first_sem');
                console.log("No stored tab, showing first_sem-content");
                // Add 'active' class to the corresponding option in the dropdown
                $('#semester option[value="first_sem"]').prop('selected', true); // Updated selector to match the select option
            }
        });



    </script>







</x-admin-layout>
