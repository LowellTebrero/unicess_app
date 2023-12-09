
<x-admin-layout>

    @section('title', 'Evaluation | ' . config('app.name', 'UniCESS'))

    <section class="text-gray-700 min-h-[85vh] 2xl:min-h-[87vh] m-8 mt-5  bg-white rounded-xl shadow">

        <div class="flex justify-between p-5 py-4">
            <div>
                <h1 class="tracking-wider 2xl:text-2xl font-semibold text-lg">Evaluation Overview </h1>

                <div id="toggle-container" class="mt-2">

                    <input
                        class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                        type="checkbox" data-id="{{ $toggle->id }}" {{ $toggle->status === 'checked' ? 'checked' : '' }}
                        id="toggle"/>
                        <label class="toggle-switch 2xl:text-sm text-xs">Switch here to Open/Close Evaluation</label>
                </div>
            </div>

            <div>
                <input type="text" placeholder="Search name and email..." class="xl:text-xs border-slate-400 rounded-lg text-sm" id="searchInput">
                <select name="myDropdown" id="myDropdown" class="xl:text-xs border-slate-400 rounded-lg text-sm">
                    @foreach ($years as $year )
                        <option value="{{ $year }}" @if ($year == date('Y')) selected="selected" @endif>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>

        <div id="filtered-data">
            @include('admin.evaluation._filter_evaluation')
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

        function centerModal() {
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

        $(document).ready(function() {
           $(document).on('click', '.delete-button', function() {
                // Get the evaluation ID from the data attribute
                var button = $(this);
                var evaluationId = $(this).data('evaluation-id');

                // Make an AJAX request to delete the evaluation
                $.ajax({
                    url: '/admin/evaluation-delete/' + evaluationId,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        // Handle the success response as needed
                        console.log('Delete successful', response);
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
                        console.error('Delete error', error);

                        // Optionally, update the UI or perform additional error handling
                    }
                });

            });
        });




        $(document).ready(function() {
            $('#myDropdown').on('change', function() {
                var selectedValue = $(this).val();

                $.ajax({
                    url: '/api/filter-evaluation',
                    type: 'GET',
                    data: {
                        selected_value: selectedValue
                    },
                    success: function(data) {
                        console.log('AJAX success', data);
                        $('#filtered-data').html(data);

                        centerModal();

                        $(document).off('click', '.delete-button');
                        $(document).on('click', '.delete-button', function() {
                            // Get the evaluation ID from the data attribute
                            var button = $(this);
                            var evaluationId = $(this).data('evaluation-id');

                                // Make an AJAX request to delete the evaluation
                                $.ajax({
                                    url: '/admin/evaluation-delete/' + evaluationId,
                                    type: "DELETE",
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    },
                                    success: function(response) {
                                        // Handle the success response as needed
                                        console.log('Delete successful', response);
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
                                        console.error('Delete error', error);

                                        // Optionally, update the UI or perform additional error handling
                                    }
                                });

                        });
                    },

                    error: function(xhr, status, error) {
                        console.error('AJAX error', error);
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



        $(document).ready(function () {
            let timer;

            $('#searchInput').on('input', function () {
                clearTimeout(timer);

                let query = $(this).val();
                var selected_value =  $('#myDropdown').val();

                timer = setTimeout(function () {

                    $.ajax({
                        url: "/api/search-evaluation",
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

    </script>



</x-admin-layout>
