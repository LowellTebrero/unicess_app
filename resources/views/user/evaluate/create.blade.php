<x-app-layout>
    @if (Auth::user()->authorize == 'checked')
    @unlessrole('admin|New User')

    <style>
        form button:disabled,
        form button[disabled]{
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }


        input,
        input::placeholder {
            font: .8rem/3 sans-serif;
            text-indent: 1%;
            letter-spacing: 1px;
        }

        input:invalid {
            border: 1px solid rgb(255, 97, 97);
          }

    </style>

    <section class="p-4 sm:p-8 rounded-lg bg-white mt-5 m-8 w-[95%] mx-auto text-gray-700 relative">

            <a class="hover:bg-gray-200 focus:bg-red-200 px-2 py-1 rounded absolute top-2 right-5" href={{ route('evaluate.index') }}>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

        <form action={{ route('evaluate.post') }} method="POST" enctype="multipart/form-data" id="FormSubmit" class="form">
            @csrf

            <div>
                @include('user.evaluate.create_filter._filter_create_title')
            </div>

            <div class="p-5 mt-5 border border-gray-400 bg-slate-100">
                @include('user.evaluate.create_filter._filter_create_note')
            </div>

            <div class="flex flex-col 2xl:flex-row  border-x border-b border-gray-400">

                <div class="w-full border-r border-gray-400 p-10">
                    <h1 class=" text-md font-semibold tracking-wider ">I. Administrative Work</h1>
                    <div class="mt-8">
                    <h1 class="py-4  text-sm font-medium ">1. Chairmanship of Working Committees</h1>
                    <div class="mb-4 xl:flex-row flex-col flex xl:space-x-12">
                        <div class="w-full">
                            <label class="block text-sm font mb-2" for="username">
                            University Wide <span class="text-xs xl:inline-block"> (7 pts. per committee)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  text-sm leading-tight" id="chairmanship_university" name="chairmanship_university"
                            type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" name="chairmanship_wide[]" class="filepond my-1 text-xs  rounded file:rounded"  multiple credits="false" data-filepond="chairmanship_university">
                        </div>

                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                                College/Unit  <span class="text-xs xl:inline-block"> (4 pts. per committee) </span>
                            </label>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="chairmanship_college" name="chairmanship_college" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                        <input type="file" name="chairmanship_unit[]" class="filepond my-1 text-xs rounded file:rounded" multiple credits="false" data-filepond="chairmanship_college">
                        </div>
                    </div>
                    </div>

                    <div class="mt-6">
                    <h1 class="py-4  text-sm font-medium">2. Membership in Working Committee</h1>
                    <div class="mb-4 xl:flex-row flex-col flex xl:space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                            University Wide <span class="text-xs xl:inline-block"> (5 pts. per committee)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="membership_university" name="membership_university" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="membership_wide[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="membership_university">
                        </div>

                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">
                                College/Unit  <span class="text-xs xl:inline-block"> (3 pts. per committee) </span>
                            </label>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="membership_college" name="membership_college" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                        <input type="file" multiple credits="false" name="membership_unit[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="membership_college">
                    </div>
                    </div>
                    </div>

                    <div class="mt-6 ">
                    <h1 class="py-4  text-sm font-medium">3. Advisorship of student organization/special assignment as trainer/coach   <span class="text-xs xl:inline-block"> (5 pts. per assignment)</span></h1>
                    <div class="mb-4">
                        <div>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="advisorship"  name="advisorship" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="advisorships[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="advisorship">
                        </div>

                    </div>
                    </div>

                    <div class="mt-6 ">
                     <h1 class="py-4  text-sm font-medium">4. OIC Function depends on the length of time and what level <span class="text-xs xl:block 2xl:inline-block"> (1 pt. fore every 2 cumulative days)</span> </h1>
                    <div class="mb-4">
                        <div>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="oic" name="oic" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="oics[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="oic">
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
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="judge" name="judge" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="judges[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="judge">
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
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  text-sm leading-tight" id="resource" name="resource" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="resource_generation[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="resource">
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
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="chairmanship_membership" name="chairmanship_membership" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="chairmanship[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="chairmanship_membership">
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
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="facilication_on_going" name="facilication_on_going" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="facilitation_ongoing[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="facilication_on_going">
                        </div>
                        <div class="mb-4">
                            <label class="block  text-sm font mb-2" for="username">
                            Regional <span class="text-xs">  (3 pts per linkage) </span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="facilication_regional" name="facilication_regional" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="facilitation_regional[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="facilication_regional">
                        </div>
                        <div class="mb-4">
                            <label class="block  text-sm font mb-2" for="username">
                                National  <span class="text-xs"> (6 pts per linkage)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm"  id="facilication_national" name="facilication_national" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="facilitation_national[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="facilication_national">
                        </div>
                        <div>
                            <label class="block  text-sm font mb-2" for="username">
                                International <span class="text-xs"> (11 pts per linkage)</span>
                            </label>
                            <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" id="facilication_international" name="facilication_international" type="text" onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                            <input type="file" multiple credits="false" name="facilitation_international[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="facilication_international">
                        </div>

                    </div>
                    </div>
                </div>
            </div>

            <div class=" p-5 mt-12 border border-gray-400 bg-slate-100">
                <p class="font-semibold  text-xs sm:text-sm 2xl:text-[1.1rem] ">
                    B. COMMUNITY OUTREACH -- 20 pts. (Ceiling Points)
                    (Should show proof of involvement e.g., TOUS.O, Certificate of Appearance/Activity Attendance
                    Monitoring Form)
                </p>

                <p class="text-xs pt-4  2xl:text-sm text-justify font-medium">
                    Note: In case of multiple roles in training, the one with highest points will prevail or will be given credit.
                    <span class=" font-semibold">Training Programs/Symposia/For a</span>
                </p>
            </div>


            <div class="p-8  border-x border-b border-gray-400 grid grid-cols-1 2xl:grid-cols-2 gap-4">


                <div>
                <h1 class="text-sm">Training Director/Coordinator - Local/National  <span class="text-xs sm:text-sm">(10 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="training_director_local"  type="text" id="training_director_local"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="training_director_locals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="training_director_local">
                </div>

                <div>
                <h1 class="text-sm">Training Director/Coordinator - International   <span class="text-xs sm:text-sm">(15 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="training_director_international" type="text" id="training_director_international"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="training_director_internationals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="training_director_international">
                </div>

                <div>
                <h1 class="text-sm">Resource Speaker/Trainer - Local/National  <span class="text-xs sm:text-sm">(7 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_speaker_local" id="resource_speaker_local" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="resource_speaker_locals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="resource_speaker_local">
                </div>

                <div>
                <h1 class="text-sm" >Resource Speaker/Trainer - International   <span class="text-xs sm:text-sm">(10 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_speaker_international" id="resource_speaker_international" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="resource_speaker_internationals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="resource_speaker_international">
                </div>

                <div>
                <h1 class="text-sm">Facilitator moderator - local   <span class="text-xs sm:text-sm">(3 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilitator_moderator_local" id="facilitator_moderator_local" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="facilitator_moderator_locals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="facilitator_moderator_local">
                </div>

                <div>
                <h1 class="text-sm">Facilitator moderator - International  <span class="text-xs sm:text-sm">(7 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilitator_moderator_international" id="facilitator_moderator_international" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="facilitator_moderator_internationals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="facilitator_moderator_international">
                </div>

                <div>
                <h1 class="text-sm">Reactor panel member - local  <span class="text-xs sm:text-sm">(2 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="reactor_panel_member_local" id="reactor_panel_member_local" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="reactor_panel_member_locals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="reactor_panel_member_local">
                </div>

                <div>
                <h1 class="text-sm">Reactor panel member - International  <span class="text-xs sm:text-sm">(5 pts. per Training)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="reactor_panel_member_international" id="reactor_panel_member_international" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="reactor_panel_member_internationals[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="reactor_panel_member_international">
                </div>

                <div>
                <h1 class="text-sm">Technical Assistance/Consultancy  <span class="text-xs sm:text-sm">(7 pts. per project)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="technical_assistance" id="technical_assistance" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="technical_assistances[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="technical_assistance">
                </div>

                <div>
                <h1 class="text-sm">Judge  <span class="text-xs">(3 pts.) Note: Only extra-curricular activities where are academic in nature (e.g., debates, orations, quiz shows)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="judge_community" id="judge_community" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="judge_communitys[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="judge_community">
                </div>

                <div>
                <h1 class="text-sm">Commencement/Guest Speaker: <span class="text-xs sm:text-sm">(4 pts.)</span></h1>
                <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="commencement_guest_speaker" id="commencement_guest_speaker" type="text"  onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                <input type="file" multiple credits="false" name="commencement_guest_speakers[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="commencement_guest_speaker">
                </div>


            </div>

            <div class="mt-12">
                <div class="p-5 border border-gray-400 bg-slate-100">
                    <p class="font-semibold  xl:text-sm 2xl:text-lg text-xs">
                        C. Service to the Adopted Barangay/institutions -- 50 pts. (Ceiling Points)
                        (Should show proof of involvement e.g., T.O/S.O, Activity Attendance Monitoring Form)
                    </p>
                </div>

                <div class="w-full border-x border-b p-8 border-gray-400">
                    <h1 class="text-md font-medium ">I. Participation in the extension and training per day:</h1>

                    <div class="my-4 grid 2xl:grid-cols-2 gap-4 grid-cols-1">

                        <div class="w-full">
                        <h1 class="text-xs sm:text-sm">Coordinator/Organizer/consultants (10 pts. per day) </h1>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm"  name="coordinator_organizer_consultants" id="coordinator_organizer_consultants"  type="text"  required onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                        <input type="file" multiple credits="false" name="coordinator_organizer_consultantses[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="coordinator_organizer_consultants">
                        </div>

                        <div class="w-full">
                        <h1 class="text-xs sm:text-sm">Facilitator (6 pts. per day) </h1>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilitator" id="facilitator"  type="text"  required onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                        <input type="file" multiple credits="false" name="facilitators[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="facilitator">
                        </div>

                        <div class="w-full">
                        <h1 class="text-xs sm:text-sm">Member (4 pts. per day) </h1>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm"  id="member"  name="member" type="text"  required onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                        <input type="file" multiple credits="false" name="members[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="member">
                        </div>

                        <div class="w-full">
                        <h1 class="text-xs sm:text-sm">Resource person/lecturer (8 pts. per day) </h1>
                        <input class="border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_person_lecturer" id="resource_person_lecturer"  type="text"  required onkeypress="return isNumber(event)" readOnly placeholder="Upload your file first">
                        <input type="file" multiple credits="false" name="resource_person_lecturers[]" class="filepond my-1 text-xs rounded file:rounded" data-filepond="resource_person_lecturer">
                        </div>

                    </div>
                </div>
            </div>


            <div class="py-12">
                <button id="confirmSubmitBtn" disabled data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="btn w-full lg:w-[15rem] button block text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-blue-800 disabled:hover:bg-slate-400  transition-all">
                    Submit here
                </button>


                <div id="popup-modal" tabindex="-1" class="top-0 left-0 right-0 md:inset-0 m-0  fixed z-50 bg-black hidden bg-opacity-30 overflow-x-hidden overflow-y-auto max-h-full">

                    <div class="relative w-full max-w-md max-h-full ">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">Are you sure you want to submit?</h3>

                                <div class="flex space-x-4 items-center justify-center">

                                        <button data-modal-hide="popup-modal" type="submit"  class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                            Yes, Im sure
                                        </button>


                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </form>
    </section>

    @endunlessrole

    @elseif (Auth::user()->authorize == 'close')

    <div class="flex items-center justify-center h-[80vh]">
        <div class="mt-14">
        <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
        </div>
        <h1 class="text-2xl text-slate-700 font-bold">
            <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
            Your account have been declined for some reason, <br> the admin is reviewing your account details
            <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
            <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
            <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
        </h1>
    </div>
@endif


    <script>
        const inputElement = document.getElementById('chairmanship_university');

        inputElement.addEventListener('input', function () {
            const inputValue = inputElement.value;
            console.log('Input Value:', inputValue);
        });

        document.addEventListener('FilePond:loaded', () => {
    const fileInputs = document.querySelectorAll('input.filepond');
    const formButton = document.getElementById('confirmSubmitBtn');

    // Initialize an array to keep track of the state of each FilePond input
    const filePondStates = Array.from(fileInputs).map(() => false);

    fileInputs.forEach((fileInput, index) => {
        const filepond = FilePond.create(fileInput);
        const relatedTextInputId = fileInput.getAttribute('data-filepond');
        const textInput = document.getElementById(relatedTextInputId);

        filepond.on('processfile', (error, file) => {
            const files = filepond.getFiles();
            const hasFiles = files.length > 0;

            if (hasFiles) {
                const uploadedFile = files[0];
                console.log('FilePond Value:', uploadedFile.file);
                textInput.required = true;
                textInput.readOnly = false;
                textInput.placeholder = 'Points required';
            }

            // Update the state of the FilePond input
            filePondStates[index] = hasFiles;

            // Update the disabled status of the form button
            updateFormButtonStatus();
        });

        filepond.on('removefile', (error, file) => {
            const files = filepond.getFiles();
            const hasFiles = files.length > 0;

            if (!hasFiles) {
                textInput.placeholder = 'Upload your file first';
                textInput.readOnly = true;
                textInput.value = '';
            }

            // Update the state of the FilePond input
            filePondStates[index] = hasFiles;

            // Update the disabled status of the form button
            updateFormButtonStatus();
        });
    });

    // Function to update the disabled status of the form button
    function updateFormButtonStatus() {
        const allFilePondInputsEmpty = filePondStates.every(state => !state);
        formButton.disabled = allFilePondInputsEmpty;
    }

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

          // console.log('It has been load');


    </script>


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



