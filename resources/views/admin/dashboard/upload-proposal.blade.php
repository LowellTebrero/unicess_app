<x-admin-layout>
    <style>
        [x-cloak] {
            display: none
        }

        form button:disabled,
        form button[disabled] {
            border: 1px solid #999999;
            background-color: #cccccc;
            color: #666666;
        }

        .active {
            background-color: rgb(8, 207, 124);
        }


        /* Hide the actual file input */
        input[type="file"]::-webkit-file-upload-button {
            font-size: .7rem;
            padding: .6rem;
        }

    </style>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <?php flash()->addError($error); ?>
        @endforeach
    @endif

    <section class="mt-4 2xl:mt-5 m-8 rounded-xl 2xl:h-[87vh] h-[82vh] overflow-x-auto bg-white text-gray-700">

        <header class="flex justify-between items-center p-4 xl:py-3 2xl:py-4 sticky top-0 bg-white z-10">
            <h1 class="2xl:text-2xl xl:text-lg text-[.9rem] font-semibold text-slate-600">Upload Project <span
                    class="text-red-500 text-xs tracking-wide font-light"> (*) required fields</span></h1>
            <a href="{{ route('admin.dashboard.index') }}" class="text-red-500 text-xl hover:bg-gray-200 rounded-md  focus:bg-gray-300 focus:rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>

        <hr>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <?php flash()->addError($error); ?>
            @endforeach
        @endif

        <form class="pt-2 px-5 2xl:px-10 xl:mt-2 2xl:mt-5 " id="FormSubmit"
            action="{{ route('admin.dashboard.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-4 grid gap-6 grid-cols 2xl:grid-cols-2 relative rounded-md ">

                <div class="space-y-6 h-[100%]">
                    <!-- Project details -->
                    <div class=" w-full border border-gray-400 rounded-md p-5">
                        <h1 class="text-lg mb-5 tracking-wide font-semibold text-gray-600">Project Details</h1>
                        <div class="gap-2 grid-cols-2 grid w-full">
                            <div class="w-full">
                                <label class="text-xs block text-slate-600  mb-2 2xl:text-sm"
                                    for="program_id">Program Name <span class="text-red-500">*</span></label>
                                <select id="program_id" class="rounded-md text-xs w-full border-zinc-300  py-2 px-3"
                                    name="program_id" value="{{ old('program_id') }}" required>
                                    @foreach ($programs as $id => $program_name)
                                        <option value="{{ $id }}"
                                            @if ($id == old('program_id')) selected="selected" @endif>{{ $program_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                    <span class="text-red-500  text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full">
                                <label class="text-xs block text-slate-600   mb-2 2xl:text-sm"
                                    for="project_title">Project Title <span class="text-red-500">*</span></label>
                                <input
                                    class="border-zinc-300 text-xs  appearance-none border rounded w-full  py-2 px-3 text-slate-600 leading-tight focus:outline-none"
                                    name="project_title" id="project_title" type="text" value="{{ old('project_title') }}"
                                    placeholder="Input your project title" required>
                                @error('project_title')
                                    <span class="text-red-500  text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full">
                                <label class="text-xs block text-slate-600   2xl:text-sm">Start Date (optional)</label>
                                <input class="border-zinc-300 text-xs  appearance-none border  rounded w-full py-2 mt-2 px-3 text-slate-600  leading-tight focus:outline-none"
                                    value="{{ old('started_date') }}" name="started_date" id="started_date" type="date">
                                @error('started_date')
                                    <span class="text-red-500  text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full">
                                <label class="text-xs block text-slate-600   2xl:text-sm">Ended Date (optional)</label>
                                <input class="border-zinc-300 text-xs appearance-none border  rounded w-full py-2 mt-2 px-3 text-slate-600  leading-tight focus:outline-none"
                                    value="{{ old('finished_date') }}" name="finished_date" id="finished_date" type="date">
                                @error('finished_date')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Project member -->
                    <div class="border border-gray-400 rounded-md p-5">
                        <h1 class="text-lg mb-5 tracking-wide font-semibold text-gray-600">Project Member</h1>
                        <div class="flex flex-col space-y-4 2xl:flex-row 2xl:space-y-0 2xl:space-x-4 mt-4 ">

                            <div class="pt-0 2xl:pt-2 flex space-x-2 items-center w-full 2xl:h-[17vh]">
                                <div class="flex flex-col space-y-2  w-full">
                                    <h1 class="xl:text-sm text-xs text-slate-600 ">Search and tag a name of Faculty/Personnel <span class="text-xs">(optional)</span></h1>
                                    <select name="tags[]" id="tags" class="tags w-full text-xs" multiple="multiple"></select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Project documents -->
                <div class="border border-gray-400 rounded-md p-5">
                    <h1 class="text-lg mb-5 tracking-wide font-semibold text-gray-600">Project Documents</h1>
                    <h1 id="filemessagerror" class="text-xs tracking-wider mt-4 mb-2">
                     Please upload at least one file among Proposal PDF, Special Order PDF, MOA PDF, Office Order PDF, Travel Order PDF, Other File(s). <span class="text-red-500">*</span>
                    </h1>

                    <div class="grid grid-cols-3 2xl:grid-cols-2 gap-2 mt-4">
                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Project Proposal (PDF)</label>
                            <input class="custom-file bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="proposal_pdf" id="proposal_pdf" type="file" accept="application/pdf">

                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">MOA (PDF)</label>
                            <input class="custom-file bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="moa_pdf" id="moa_pdf" type="file" accept="application/pdf">

                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Office Order (PDF) <span class="text-xs">(Multiple files)</span></label>
                            <input class="custom-file bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="office_order_pdf[]" multiple id="office_order_pdf" type="file" accept="application/pdf" onchange="displayOfficeFileNames(this)">
                            <div id="file-office-container" class="text-xs mt-1 font-thin"></div>
                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Travel Order (PDF) <span class="text-xs">(Multiple files)</span></label>
                            <input class="custom-file bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="travel_order_pdf[]" multiple id="travel_order_pdf" type="file" accept="application/pdf" onchange="displayTravelFileNames(this)">
                            <div id="file-travel-container" class="text-xs mt-1 font-thin"></div>
                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Special Order (PDF) <span class="text-xs">(Multiple files)</span></label>
                            <input class="bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="special_order_pdf[]" multiple id="special_order_pdf" type="file" accept="application/pdf" onchange="displaySpecialFileNames(this)">
                            <div id="file-special-container" class="text-xs mt-1 font-thin"></div>
                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Attendance <span class="text-xs">(Multiple files)</span></label>
                            <input class="bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="attendance[]" multiple id="attendance" type="file" onchange="displayAttendanceFileNames(this)">
                            <div id="file-attendance-container" class="text-xs mt-1 font-thin"></div>
                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Attendance Monitoring <span class="text-xs">(Multiple files)</span></label>
                            <input class="bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="attendancem[]" multiple id="attendancem" type="file" onchange="displayAttendanceMFileNames(this)">
                            <div id="file-attendancem-container" class="text-xs mt-1 font-thin"></div>
                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Special Order (PDF)</label>
                            <input class="bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="special_order_pdf[]" multiple id="special_order_pdf" type="file" accept="application/pdf" onchange="displaySpecialFileNames(this)">
                            <div id="file-special-container" class="text-xs mt-1 font-thin"></div>
                        </div>

                        <div class="w-full">
                            <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Other Files <span class="text-xs">(Multiple files)</span></label>
                            <input class="bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                            name="other_files[]" multiple id="other_files" type="file" onchange="displayOtherFileNames(this)">
                            <div id="file-othernames-container" class="text-xs mt-1"></div>
                        </div>
                    </div>
                </div>


                <!-- Submit button -->
                <div class="bottom-2 left-0 xl:bottom-7">

                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                        Submit Project
                    </button>

                    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to submit?</h3>
                                    <div class="space-x-2">
                                    <button data-modal-hide="popup-modal"  type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800  rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                        Yes, Im sure
                                    </button>
                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm  px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </section>


</x-admin-layout>


    <script>
        function displayFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-names-container');

            // Clear the container before adding new file names
            container.innerHTML = '';

            // Display file names
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;

                // Create a paragraph element for each file name
                var p = document.createElement('p');
                p.textContent = fileName;

                // Append the paragraph to the container
                container.appendChild(p);
            }
        }
        function displayTravelFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-travel-container');

            // Clear the container before adding new file names
            container.innerHTML = '';

            // Display file names
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;

                // Create a paragraph element for each file name
                var p = document.createElement('p');
                p.textContent = fileName;

                // Append the paragraph to the container
                container.appendChild(p);
            }
        }
        function displaySpecialFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-special-container');

            // Clear the container before adding new file names
            container.innerHTML = '';

            // Display file names
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;

                // Create a paragraph element for each file name
                var p = document.createElement('p');
                p.textContent = fileName;

                // Append the paragraph to the container
                container.appendChild(p);
            }
        }
        function displayAttendanceFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-attendance-container');

            // Clear the container before adding new file names
            container.innerHTML = '';

            // Display file names
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;

                // Create a paragraph element for each file name
                var p = document.createElement('p');
                p.textContent = fileName;

                // Append the paragraph to the container
                container.appendChild(p);
            }
        }
        function displayAttendanceMFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-attendancem-container');

            // Clear the container before adding new file names
            container.innerHTML = '';

            // Display file names
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;

                // Create a paragraph element for each file name
                var p = document.createElement('p');
                p.textContent = fileName;

                // Append the paragraph to the container
                container.appendChild(p);
            }
        }
        function displayOfficeFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-office-container');

            // Clear the container before adding new file names
            container.innerHTML = '';

            // Display file names
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;

                // Create a paragraph element for each file name
                var p = document.createElement('p');
                p.textContent = fileName;

                // Append the paragraph to the container
                container.appendChild(p);
            }
        }
        function displayOtherFileNames(input) {
            // Get the selected files
            var files = input.files;

            // Get the container where you want to display file names
            var container = document.getElementById('file-othernames-container');

            // Clear the container before adding new file names
            container.innerHTML = '';

            // Display file names
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;

                // Create a paragraph element for each file name
                var p = document.createElement('p');
                p.textContent = fileName;

                // Append the paragraph to the container
                container.appendChild(p);
            }
        }
    </script>

<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {


        // Function to toggle the visibility of a div
        function toggleVisibility(div) {
            div.style.display = div.style.display === "none" ? "block" : "none";
        }

        // Function to update required attribute on inputs based on visibility
        function updateRequiredInputs(div) {
            var inputs = div.querySelectorAll('select, input'); // Add more types if needed

            // Set or remove the 'required' attribute based on div visibility
            inputs.forEach(function(input) {
                input.required = div.style.display !== "none";
            });
        }

        // Function to update button style based on div visibility
        function updateButtonStyle(button, div) {
            // Add or remove a class to change the background color based on div visibility
            button.classList.toggle("active", div.style.display !== "none");
        }

        // Function to reset form inputs within a div
        function resetFormInputs(div) {
            var inputs = div.querySelectorAll('select, input'); // Add more types if needed

            // Reset only the inputs within the specific div
            inputs.forEach(function(input) {
                input.value = "";
            });
        }

        // Add a submit event listener to the form
        var form = document.getElementById("FormSubmit"); // Replace with your actual form ID
        var errormessage = document.getElementById("error-message");
        var fileerror = document.getElementById("filemessagerror");
        var errorMessageDisplayed = false;
        var fileInputs = document.querySelectorAll('input[type="file"]');
        var intervalId;

        document.getElementById('FormSubmit').addEventListener('submit', function (event) {
            var fileInputs = document.querySelectorAll('input[type="file"]');
            var fileSelected = false;

            fileInputs.forEach(function (fileInput) {
                if (fileInput.files.length > 0) {
                    fileSelected = true;
                }
            });

            if (!fileSelected) {
                alert('Please upload at least one file.');
                blinkError();
                event.preventDefault(); // Prevent form submission
            }
        });

        function blinkError() {
            var count = 0;
            intervalId = setInterval(function () {
                if (count % 2 === 0) {
                    fileerror.style.color = 'red';
                    fileerror.style.textShadow = '4px 4px 4px rgba(255, 161, 176)';
                } else {
                    fileerror.style.color = '#780000';
                    fileerror.style.textShadow = '3px 3px 4px rgba(255, 161, 176)';
                }

                count++;

                if (count >= 6) {  // Adjust the number of blinks as needed
                    clearInterval(intervalId);
                    fileerror.style.color = '';  // Reset the color
                    fileerror.style.textShadow = '';
                }
            }, 700);  // Adjust the interval (milliseconds) as needed
        }

    });
</script>

<script>
    function displayFileNames(input) {
        // Get the selected files
        var files = input.files;

        // Get the container where you want to display file names
        var container = document.getElementById('file-names-container');

        // Clear the container before adding new file names
        container.innerHTML = '';

        // Display file names
        for (var i = 0; i < files.length; i++) {
            var fileName = files[i].name;

            // Create a paragraph element for each file name
            var p = document.createElement('p');
            p.textContent = fileName;

            // Append the paragraph to the container
            container.appendChild(p);
        }
    }

    $(document).ready(function(){
        $('.tags').select2({
            placeholder: 'Select Option',
            allowClear: true,
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
        });
    });
</script>

