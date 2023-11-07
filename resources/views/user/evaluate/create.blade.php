<x-app-layout>

    <style>
        form button:disabled,
        form button[disabled]{
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }

        .myClass {
            display: none;
        }

    </style>

    <section class="p-8 rounded-lg bg-white mt-5 m-8 w-[95%] mx-auto text-gray-700">

        <div class="flex justify-end">
            <a class="hover:bg-gray-200 focus:bg-red-200 px-2 py-1 rounded" href={{ route('evaluate.index') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>



        <form action="{{ route('evaluate.post') }}" method="POST" enctype="multipart/form-data" id="form" class="form">
            @csrf

            <div>
                @include('user.evaluate.create_filter._filter_create_title')
            </div>

            <div class="p-5 mt-5 border border-gray-400 bg-slate-100">
                @include('user.evaluate.create_filter._filter_create_note')
            </div>

            <div class="flex xl:flex-col 2xl:flex-row  border-x border-b border-gray-400">

                <div class="w-full border-r border-gray-400 p-10">
                    <h1 class=" text-md font-semibold tracking-wider ">I. Administrative Work</h1>
                    <div class="mt-8">
                    <h1 class="py-4  text-sm font-medium ">1. Chairmanship of Working Committees</h1>
                    <div class="mb-4 flex space-x-12">
                        <div class="w-full">
                            <label class="block text-sm font mb-2" for="username">
                            University Wide <span class="text-xs xl:inline-block"> (7 pts. per committee)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  text-sm leading-tight" id="chairmanship_university" name="chairmanship_university" value="" type="text" onkeypress="return isNumber(event)">
                            <div class="type_file" id="type_file">
                            <input type="file" name="chairmanship_wide[]" class="filepond my-1 text-xs  rounded file:rounded"  multiple credits="false" value="" data-filepond>
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                                College/Unit  <span class="text-xs xl:inline-block"> (4 pts. per committee) </span>
                            </label>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="chairmanship_college" type="text" onkeypress="return isNumber(event)">
                        <input type="file" name="chairmanship_unit[]" class="filepond my-1 text-xs rounded file:rounded" multiple credits="false">
                        </div>
                    </div>
                    </div>

                    <div class="mt-6">
                    <h1 class="py-4  text-sm font-medium">2. Membership in Working Committee</h1>
                    <div class="mb-4 flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                            University Wide <span class="text-xs xl:inline-block"> (5 pts. per committee)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="membership_university" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="membership_wide[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>

                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                                College/Unit  <span class="text-xs xl:inline-block"> (3 pts. per committee) </span>
                            </label>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="membership_college" type="text" onkeypress="return isNumber(event)">
                        <input type="file" multiple credits="false" name="membership_unit[]" class="filepond my-1 text-xs rounded file:rounded">
                    </div>
                    </div>
                    </div>

                    <div class="mt-6 ">
                    <h1 class="py-4  text-sm font-medium">3. Advisorship of student organization/special assignment as trainer/coach   <span class="text-xs xl:inline-block"> (5 pts. per assignment)</span></h1>
                    <div class="mb-4">
                        <div>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="advisorship" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="advisorships[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>

                    </div>
                    </div>

                    <div class="mt-6 ">
                    {{--  <h1 class="py-4  text-sm font-medium">4. OIC Function (depends on the length of time and what level)   <span class="text-xs xl:block 2xl:inline-block"> (1 pt. fore every 2 cumulative days)</span> </h1>  --}}
                    <div class="mb-4">
                        <div>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="oic" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="oics[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>

                    </div>
                    </div>

                    <div class="mt-6 ">
                    <h1 class="py-4  text-sm font-medium">5. Judge  </h1>
                    <div class="mb-4 ">
                        <div>
                            <label class="block  text-sm font mb-2" for="username">
                                Note: Only-extra-curricular activities which are academic in nature (e.g., debates, orations, quiz shows)
                             <span class="text-xs"> (3 pts.)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="judge" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="judges[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>

                    </div>
                    </div>
                </div>

                <div class="w-full p-10 ">
                    <h1 class="text-md font-semibold tracking-wider">II. Institution Building</h1>

                    <div class="mt-8 ">
                    <h1 class="py-4  text-sm font-medium">1. Resource generation (eg. endowment, scholarships
                        professional chair, acquisition of assorted books, and/or
                        substantial library collection, equipment, etc)</h1>
                    <div class="mb-4 ">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                             <span class="text-xs"> (1 point for every Php 10,000.00 worth of resource generated)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  text-sm leading-tight" name="resource" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="resource_generation[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>


                    </div>
                    </div>

                    <div class="mt-6 ">
                    <h1 class="py-4  text-sm font-medium">2.  Chairmanship/membership in local, regional, national,
                        international committee etc., representing the
                        University or within the University
                        (eg, policy paper, curriculum development, etc)
                    </h1>
                    <div class="mb-4">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                            <span class="text-xs"> (5 pts. per committee)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="chairmanship_membership" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="chairmanship[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>
                    </div>
                    </div>

                    <div class="mt-6 ">
                    <h1 class="py-4 text-sm font-medium">3. Facilitation of Linkages  </h1>
                    <div class="mb-4">
                        <div class="mb-4">
                            <label class="block  text-sm font mb-2" for="username">
                             On-going <span class="text-xs"> (1 pl. per linkage)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_on_going" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="facilitation_ongoing[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block  text-sm font mb-2" for="username">
                            Regional <span class="text-xs">  (3 pts per linkage) </span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_regional" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="facilitation_regional[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block  text-sm font mb-2" for="username">
                                National  <span class="text-xs"> (6 pts per linkage)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_national" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="facilitation_national[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>
                        <div>
                            <label class="block  text-sm font mb-2" for="username">
                                International <span class="text-xs"> (11 pts per linkage)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilication_international" type="text" onkeypress="return isNumber(event)">
                            <input type="file" multiple credits="false" name="facilitation_international[]" class="filepond my-1 text-xs rounded file:rounded">
                        </div>

                    </div>
                    </div>
                </div>
            </div>





            <div class=" p-5 mt-12 border border-gray-400 bg-slate-100">
                <p class="font-semibold  xl:text-sm 2xl:text-[1.1rem] ">
                    B. COMMUNITY OUTREACH -- 20 pts. (Ceiling Points)
                    (Should show proof of involvement e.g., TOUS.O, Certificate of Appearance/Activity Attendance
                    Monitoring Form)
                </p>

                <p class=" pt-4 xl:text-xs 2xl:text-sm text-justify font-medium">
                    Note: In case of multiple roles in training, the one with highest points will prevail or will be given credit.
                    <span class=" font-semibold">Training Programs/Symposia/For a</span>
                </p>
            </div>




            <div class="p-8  border-x border-b border-gray-400 input-group">


                @foreach ($result2 as $row )

                {{--  @if ($row->leader_member_type <= 0)
                <h1 class="text-red-500">No Points</h1>
                @else  --}}

                @if ($row->leader_member_type == '1' && $row->location_id == '1')

                <h1>Training Director/Coordinator - Local/National  <span class="text-sm">(10 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="training_director_local"  type="text" id="inputfield1" onkeypress="return isNumber(event)" required>
                @endif

                @if ($row->leader_member_type == '1' && $row->location_id == '2')

                <h1>Training Director/Coordinator - International   <span class="text-sm">(15 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="training_director_international" type="text" id="inputfield2" onkeypress="return isNumber(event)" required>
                @endif

                @if ($row->leader_member_type == '2' && $row->location_id == '1')

                <h1>Resource Speaker/Trainer - Local/National  <span class="text-sm">(7 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_speaker_local" type="text" onkeypress="return isNumber(event)" required>
                @endif

                @if ($row->leader_member_type == '2' && $row->location_id == '2')

                <h1>Resource Speaker/Trainer - International   <span class="text-sm">(10 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_speaker_international" type="text" onkeypress="return isNumber(event)" required>
                @endif


                @if ($row->leader_member_type == '3' && $row->location_id == '1')

                <h1>Facilitator moderator - local   <span class="text-sm">(3 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilitator_moderator_local" type="text" onkeypress="return isNumber(event)" required>
                @endif

                @if ($row->leader_member_type == '3' && $row->location_id == '2')

                <h1>Facilitator moderator - International  <span class="text-sm">(7 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilitator_moderator_international" type="text" onkeypress="return isNumber(event)" required>
                @endif


                @if ($row->leader_member_type == '4' && $row->location_id == '1')

                <h1>Reactor panel member - local  <span class="text-sm">(2 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="reactor_panel_member_local" type="text" onkeypress="return isNumber(event)" required>
                @endif

                @if ($row->leader_member_type == '4' && $row->location_id == '2')

                <h1>Reactor panel member - International  <span class="text-sm">(5 pts. per Training)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="reactor_panel_member_international" type="text" onkeypress="return isNumber(event)" required>
                @endif


                @if ($row->leader_member_type == '5' && empty($row->location_id))

                <h1>Technical Assistance/Consultancy  <span class="text-sm">(7 pts. per project)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="technical_assistance"  type="text" onkeypress="return isNumber(event)" required>
                @endif

                @if ($row->leader_member_type == '6' && empty($row->location_id))

                <h1>Judge  <span class="text-sm">(3 pts.) Note: Only extra-curricular activities where are academic in nature (e.g., debates, orations, quiz shows)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="judge_community"  type="text" onkeypress="return isNumber(event)" required>
                @endif

                @if ($row->leader_member_type == '7' && empty($row->location_id))

                <h1>Commencement/Guest Speaker: <span class="text-sm">(4 pts.)</span></h1>
                <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="commencement_guest_speaker" type="text" onkeypress="return isNumber(event)" required>
                @endif
                {{--  @endif  --}}
                @endforeach


            </div>




            <div class="mt-12">
                <div class="p-5 border border-gray-400 bg-slate-100">
                    <p class="font-semibold  xl:text-sm 2xl:text-lg">
                        C. Service to the Adopted Barangay/institutions -- 50 pts. (Ceiling Points)
                        (Should show proof of involvement e.g., T.O/S.O, Activity Attendance Monitoring Form)
                    </p>
                </div>

                <div class="w-full border-x border-b p-8 border-gray-400">
                    <h1 class=" text-md font-medium xl:text-xs 2xl:text-sm">I. Participation in the extension and training per day:</h1>

                    <div class="my-4 flex space-x-12 input-group">

                        @foreach ($result2 as $rows )

                        @if ($rows->member_type == 'Coordinator/Organizer/consultants' )
                        <div class="w-full">
                        <h1>Coordinator/Organizer/consultants (10 pts. per day) </h1>
                        <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm"  name="coordinator_organizer_consultants"  type="text" required onkeypress="return isNumber(event)">
                        </div>
                        @endif

                        @if ($rows->member_type == 'Facilitator' )
                        <div class="w-full">
                        <h1>Facilitator (6 pts. per day) </h1>
                        <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm"   name="facilitator"   type="text" required onkeypress="return isNumber(event)">
                        </div>
                        @endif

                        @if ($rows->member_type == 'Member' )
                        <div class="w-full">
                        <h1>Member (4 pts. per day) </h1>
                        <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm"   name="member" type="text" required onkeypress="return isNumber(event)">
                        </div>
                        @endif

                        @if ($rows->member_type == 'Resource person/lecturer' )
                        <div class="w-full">
                        <h1>Resource person/lecturer (8 pts. per day) </h1>
                        <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_person_lecturer"  type="text" required onkeypress="return isNumber(event)">
                        </div>

                        @endif
                        @endforeach

                    </div>
                </div>
            </div>


            <div class="py-12 submit-btn">
                <button type="submit"  class="btn  button block text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-800 disabled:hover:bg-slate-400  transition-all" onclick="myFunction()">
                    Submit here
                </button>
            </div>

        </form>
    </section>



    <script>

        function myFunction() {
            confirm("Are you sure you want to submit? ");
          }


        document.addEventListener('FilePond:loaded',(e) => {

            const inputElements = document.querySelectorAll('input.filepond');

            Array.from(inputElements).forEach(inputElement => {
                const filepond = FilePond.create(inputElement);
            })

            FilePond.setOptions({
                credits: false,
                server: {
                    process: '/api/evaluationfilepond/{{ Auth()->user()->id }}',
                    revert: '/api/deletevaluationfilepond',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },

                    onerror: (response) => response.data,
                    ondata: (formData) => {
                        return formData;
            }

            }
            });
        });

       let formSubmitted = false;
        document.querySelector("form.form").addEventListener('submit', function () {
            formSubmitted = true; // Set the flag to true when the form is submitted
          });

          window.addEventListener('beforeunload', function (e) {
            if (formSubmitted) {
              // Don't show the confirmation message when a form is being submitted
              return;
            }

            // Prompt the user with a message
            const confirmationMessage = 'You have unsaved data. Are you sure you want to leave this page?';

            // Set the confirmation message
            (e || window.event).returnValue = confirmationMessage;
          });


          window.addEventListener("load", (event) => {

            fetch('/delete-uploaded-file/{{ Auth()->user()->id }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    console.log(data.message);
                } else {
                    console.error(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
          });

          console.log('It has been load');


    </script>



        {{--  <script>

        $(document).ready(function() {
        $('.input-group input').on('keyup', function() {
        var is_empty = false;

        $('.input-group input').each(function() {
        is_empty = $(this).val().length == 0;
        });

        is_empty ? $('.submit-btn button').attr('disabled', 'disabled')
        :
        $('.submit-btn button').attr('disabled', false);
        });
        });

        </script>  --}}



    {{--  Number Javascript  --}}
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>




</x-app-layout>



