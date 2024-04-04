
<x-admin-layout>

    @section('title', 'Evaluation | ' . config('app.name', 'UniCESS'))

    <section class="text-gray-700 h-[100%] bg-white rounded-xl shadow">

        <header class="flex justify-between px-3  sm:px-5 py-4">
            <div>
                <h1 class="tracking-wider 2xl:text-2xl font-semibold text-sm md:text-lg">Evaluation Overview </h1>


            </div>
            <div id="toggle-container" class="mt-2 flex items-center">
                <input
                class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                type="checkbox" data-id="{{ $toggle->id }}" {{ $toggle->status === 'checked' ? 'checked' : '' }}
                id="toggle" onclick="return confirm ('Are you sure?')" />
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
