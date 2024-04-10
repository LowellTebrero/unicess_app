


<x-admin-layout>

    <style>
        /* Add your CSS styles here */
        /* Styles for the slider toggle */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px; /* Adjust the width of the switch */
            height: 18px; /* Adjust the height of the switch */
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px; /* Rounded corners for the slider */
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px; /* Adjust the height of the slider button */
            width: 14px; /* Adjust the width of the slider button */
            left: 2px; /* Adjust the left position of the slider button */
            bottom: 2px; /* Adjust the bottom position of the slider button */
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%; /* Make the slider button circular */
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(21px); /* Adjust the distance the slider button moves */
            -ms-transform: translateX(21px);
            transform: translateX(21px);
        }
    </style>


    @section('title', 'Evaluation | ' . config('app.name', 'UniCESS'))

    <section class="text-gray-700 h-[100%] bg-white rounded-xl shadow">

        <header class="flex justify-between px-3  sm:px-5 py-4">
            <div>
                <h1 class="tracking-wider 2xl:text-2xl font-semibold text-sm md:text-lg">Evaluation Overview </h1>


            </div>
            <div id="toggle-container" class="mt-2 flex items-center gap-2">
                <div id="navbar-controls" class="flex flex-col">
                    <label class="switch">
                        <input type="checkbox" data-id="{{ $toggle->id }}" {{ $toggle->status === 'checked' ? 'checked' : '' }}
                        id="toggle" onclick="return confirm ('Are you sure?')">
                        <span class="slider round"></span>
                    </label>
                </div>

                <button data-tooltip-target="tooltip-left" data-tooltip-placement="left" type="button">
                    <svg class="fill-gray-600" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 256 256"><path  d="M142 176a6 6 0 0 1-6 6a14 14 0 0 1-14-14v-40a2 2 0 0 0-2-2a6 6 0 0 1 0-12a14 14 0 0 1 14 14v40a2 2 0 0 0 2 2a6 6 0 0 1 6 6m-18-82a10 10 0 1 0-10-10a10 10 0 0 0 10 10m106 34A102 102 0 1 1 128 26a102.12 102.12 0 0 1 102 102m-12 0a90 90 0 1 0-90 90a90.1 90.1 0 0 0 90-90"/></svg>
                </button>
                <div id="tooltip-left" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    <label class="toggle-switch 2xl:text-sm text-[.5rem] md:text-xs"> <span class="hidden sm:block">Switch here to Open/Close Evaluation</span></label>

                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>


        </header>
        <hr>

        <livewire:admin-evaluation>



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
    </script>

</x-admin-layout>
