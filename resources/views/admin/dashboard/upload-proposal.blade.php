<x-admin-layout>
    <style>
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

        <header class="flex justify-between items-center p-4 xl:py-3 2xl:py-4 sticky top-0 z-10 bg-white">
            <h1 class="2xl:text-2xl xl:text-lg text-[.9rem] font-semibold text-slate-600">Upload Project <span
                    class="text-red-500 text-xs tracking-wide font-light"> * required fields</span></h1>
            <a href="/admin" class="text-red-500 text-xl font-medium focus:bg-gray-300 focus:rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>

        <hr>

        <form class="pt-2 px-5 2xl:px-10 xl:mt-2 2xl:mt-5 h-[75vh] 2xl:h-[78vh]" id="FormSubmit"
            action="{{ route('admin.dashboard.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="w-4/4 2xl:w-3/4 mx-auto 2xl:py-4 py-2 p-4 border relative rounded-md">
                <div class="flex space-x-2 flex-row  w-full">
                    <div class="w-1/2">
                        <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm"
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
                        <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm"
                            for="project_title">Project Title <span class="text-red-500">*</span></label>
                        <input
                            class="border-zinc-300 text-xs  appearance-none border rounded w-full  py-2 px-3 text-slate-600 leading-tight focus:outline-none"
                            name="project_title" id="project_title" type="text" value="{{ old('project_title') }}"
                            placeholder="project title" required>
                        @error('project_title')
                            <span class="text-red-500  text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div id="filemessagerror" class="text-xs text-red-500 tracking-wider mt-4 mb-2">
                    Please upload at least one file among Proposal PDF, Special Order PDF, MOA PDF, Office Order PDF, Travel Order PDF, Other File(s).
                </div>
                <div class="grid grid-cols-3 2xl:grid-cols-2 gap-2">
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
                        <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Office Order (PDF)</label>
                        <input class="custom-file bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                        name="office_order_pdf[]" multiple id="office_order_pdf" type="file" accept="application/pdf" onchange="displayOfficeFileNames(this)">
                        <div id="file-office-container" class="text-xs mt-1 font-thin"></div>
                    </div>

                    <div class="w-full">
                        <label class="text-xs block text-slate-600  font-medium mb-2 2xl:text-sm">Travel Order (PDF)</label>
                        <input class="custom-file bg-white border-zinc-300 text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-600 leading-tight focus:outline-none"
                        name="travel_order_pdf[]" multiple id="travel_order_pdf" type="file" accept="application/pdf" onchange="displayTravelFileNames(this)">
                        <div id="file-travel-container" class="text-xs mt-1 font-thin"></div>
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

                <div>
                    @error('proposal_pdf')
                    <span class="text-red-500  text-xs">{{ $message }}</span>
                    @enderror
                </div>



                <div class="flex space-x-4 items-center">
                    <div class="w-1/2">
                        <label class="text-xs block text-slate-600  font-medium 2xl:text-sm">Started Date (optional)</label>
                        <input class="border-zinc-300 text-xs  appearance-none border  rounded w-full py-2 mt-2 px-3 text-slate-600  leading-tight focus:outline-none"
                            value="{{ old('started_date') }}" name="started_date" id="started_date" type="date">
                        @error('started_date')
                            <span class="text-red-500  text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-1/2">
                        <label class="text-xs block text-slate-600  font-medium 2xl:text-sm">Ended Date (optional)</label>
                        <input class="border-zinc-300 text-xs appearance-none border  rounded w-full py-2 mt-2 px-3 text-slate-600  leading-tight focus:outline-none"
                            value="{{ old('finished_date') }}" name="finished_date" id="finished_date" type="date">
                        @error('finished_date')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="pt-2 flex space-x-2 items-center w-full">
                        <div class="flex flex-col space-y-2">
                            <div class="flex flex-col space-y-2  w-full">
                                <div class="flex space-x-2">
                                    <h1 class="xl:text-sm text-xs">Select Role Type<span class="text-red-500">*</span></h1>
                                    <h4 class="text-xs">Note: (Choose what is applicable)</h4>
                                </div>
                                <div>

                                <button class="px-3 py-1 2xl:text-sm text-xs bg-blue-400 text-white rounded-lg" type="button"
                                    id="MemberButton">Member Type
                                </button>
                                </div>

                            </div>
                            <div id="error-message" class="text-xs text-red-500 tracking-wider "></div>
                        </div>
                    </div>
                </div>



                    <div class="w-full overflow-x-auto h-[26vh] xl:h-[20vh] 2xl:h-[20vh]  mt-2"
                        style="display: none" id="memberDiv">

                        <table id="table" class="w-full">
                            <thead>
                                <tr class="text-sm text-gray-500 sticky top-0 bg-white">
                                    <th class="text-xs  text-slate-600 font-medium mb-2 2xl:text-sm text-left">Member
                                        Name</th>
                                    <th
                                        class="text-xs  text-slate-600 font-medium mb-2 2xl:text-sm text-left w-[11rem] 2xl:w-[10rem]">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="pr-4 xl:w-[21rem] 2xl:w-[30rem]">
                                        <select name="member[0][id]" class="rounded-md text-xs w-full border-zinc-300"
                                            id="member">
                                            @foreach ($members as $id => $name)
                                                <option value="{{ $id }}"
                                                    @if ($id == old('member_id[0][id]')) selected="selected" @endif>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button name="add" id="add" type="button"
                                            class="w-full bg-slate-500 rounded-md text-white px-2 py-2  text-xs  border-zinc-300">Add
                                            more user</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                <div class="bottom-2 left-0 xl:bottom-7 mt-2">
                    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
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
                                    <button data-modal-hide="popup-modal"  type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                        Yes, I'm sure
                                    </button>
                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>


    </section>

    @section('scripts')
        <script>
            var i = 0;
            $('#add').click(function() {
                ++i;
                $('#table').append(
                    `<tr>
                    <td class="pr-4 pt-2">
                        <select name="member[` + i + `][id]" class="rounded-md text-xs w-full border-zinc-300" required>
                            @foreach ($members as $id => $name)
                            <option value="{{ $id }}"
                            @if ($id == old('member_id')) selected="selected" @endif
                            >{{ $name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="pr-2">
                        <button type="button" class="bg-red-500 remove-table-row text-xs text-white px-2 py-1 rounded">Remove</button>
                    </td>
                </tr>`
                );
            });

            $(document).on('click', '.remove-table-row', function() {
                $(this).parents('tr').remove();
            });
        </script>


    @endsection

</x-admin-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the buttons and corresponding divs

        var memberButton = document.getElementById("MemberButton"); // Corrected ID
        var leaderDiv = document.getElementById("leaderDiv");
        var memberDiv = document.getElementById("memberDiv");


        memberButton.addEventListener("click", function() {
            toggleVisibility(memberDiv);
            updateRequiredInputs(memberDiv);
            updateButtonStyle(memberButton, memberDiv);
            resetFormInputs(memberDiv);
        });

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



        form.addEventListener("submit", function(event) {

            // Check if both buttons are not clicked
            if (memberDiv.style.display === "none") {
                alert("You must select at least one of the member");
                errormessage.innerHTML = 'You must select at least one of the member ';
                errorMessageDisplayed = true;
                event.preventDefault(); // Prevent form submission
            }
        });

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
</script>

    <script>
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

