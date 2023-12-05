{{--  <div class="flex space-x-2 text-green-500 text-lg font-medium items-center">
    <img src="{{ asset('img/submit-successfully.png') }}" width="50" class="submitted-image w-[2rem] h-[3vh]">
    <div>
        <h1 class="text-lg submitted-text">Evaluation form submitted </h1>
        <p class="text-gray-500 tracking-wider submitted-description text-xs">Please wait for the admin to verify your evaluation form. </p>
    </div>
</div>  --}}

<div class="border rounded h-[62vh] overflow-x-auto 2xl:w-[70rem] text-gray-600">
    <h1 class="text-center my-2">CES FACULTY PERFORMANCE EVALUATION FORM {{ $currentYear  }}</h1>
   @foreach ( $evaluation as $evaluate )
       {{--  <h1 class="text-xs"> Status: {{ $evaluate->status }}</h1>  --}}
       <h1 class="text-xs text-center">A. SERVICE TO THE UNIVERSITY -- 30 points (Ceiling Points) (Should show proof of involvement e.g., T.O/S.O, Certificate of Appearance/Activity Attendance Monitoring Form)</h1>
        <h1 class="text-xs font-medium pl-4 mt-4">I. Administrative Work</h1>
        <div class="text-xs  px-4 mt-3 flex space-x-5">
            <div class="w-full">
                <h1 class="mt-2"> @if ($evaluate->chairmanship_university !== NULL || $evaluate->chairmanship_college !== NULL ) Chairmanship of Working Committees @endif </h1>
                <div class="flex space-x-4 mt-2">
                    @if ($evaluate->chairmanship_university)
                        <div>
                            <h1>University Wide </h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->chairmanship_university }} points.</h1>
                        </div>
                    @endif

                    @if ($evaluate->chairmanship_college)
                        <div>
                            <h1>College/Unit</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->chairmanship_college }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full">
                <h1 class="mt-2"> @if ($evaluate->membership_university !== NULL || $evaluate->membership_college !== NULL ) 2. Membership in Working Committee @endif </h1>
                <div class="flex space-x-4 mt-2">
                    @if ($evaluate->membership_university)
                        <div>
                            <h1>University Wide </h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->membership_university }} points.</h1>
                        </div>
                    @endif

                    @if ($evaluate->membership_college)
                        <div>
                            <h1>College/Unit</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->membership_college }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex text-xs px-4 space-x-5 mt-3">
            <div class="w-full">

                <div class="flex space-x-4 mt-2">
                    @if ($evaluate->advisorship)
                        <div>
                            <h1 class="mt-2">3. Advisorship of student organization/special assignment as trainer/coach</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->advisorship }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>

            <div class=" w-full">
                <div class="flex space-x-4 mt-2">
                    @if ($evaluate->oic)
                        <div>
                            <h1 class="mt-2">4. OIC Function (depends on the length of time and what level)</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->oic }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="text-xs px-4 mt-3">
            @if ($evaluate->judge)
                <div class="pt-2">
                    <h1>5.Judge</h1>
                    <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->judge }} points.</h1>
                </div>
            @endif
        </div>


        <h1 class="text-xs font-medium pl-4 mt-7">II. Institution Building</h1>

        <div class="text-xs px-4 mt-4">
            @if ($evaluate->resource)
                <div>
                    <h1 class="mt-2">1. Resource generation (eg. endowment, scholarships professional chair, acquisition of assorted books, and/or substantial library collection, equipment, etc)</h1>
                    <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->resource }} points.</h1>
                </div>
            @endif


            @if ($evaluate->chairmanship_membership)
                <div>
                    <h1 class="mt-2">2. Chairmanship/membership in local, regional, national,international committee etc., representing the University or within the University (eg, policy paper, curriculum development, etc)</h1>
                    <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->chairmanship_membership }} points.</h1>
                </div>
            @endif
        </div>


        <div class="mt-2 text-xs px-4 flex space-x-5 pb-8">
            <div class="w-full">
                <h1 class="mt-2"> @if ($evaluate->facilication_on_going !== NULL || $evaluate->facilication_regional !== NULL ||
                     $evaluate->facilication_national !== NULL || $evaluate->facilication_international !== NULL ) 3. Facilitation of Linkages  @endif</h1>
                <div class="flex space-x-4 mt-2">
                    @if ($evaluate->facilication_on_going)
                        <div>
                            <h1>On-going</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->facilication_on_going }} points.</h1>
                        </div>
                    @endif

                    @if ($evaluate->facilication_regional)
                        <div>
                            <h1>Regional</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->facilication_regional }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full">
                <h1 class="mt-2">&nbsp;</h1>
                <div class="flex space-x-4 mt-2">
                    @if ($evaluate->facilication_national)
                        <div>
                            <h1>National</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->facilication_national }} points.</h1>
                        </div>
                    @endif

                    @if ($evaluate->facilication_international)
                        <div>
                            <h1>International</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->facilication_international }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <h1 class="text-xs text-center mt-12">B. COMMUNITY OUTREACH ---20 pts. (Ceiling Points) (Should show proof of involvement e.g., TOUS.O, Certificate of Appearance/Activity Attendance Monitoring Form)</h1>

        <div class="px-4 pb-8 mt-5 text-xs  gap-2 grid grid-cols-3 ">

            @if ($evaluate->training_director_local)
            <div class="text-xs">
                <h1 class="mt-2">Training Director/Coordinator - Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->training_director_local }} points.</h1>
            </div>
            @endif

            @if ($evaluate->training_director_international)
            <div>
                <h1 class="mt-2">Training Director/Coordinator - International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->training_director_international }} points.</h1>
            </div>
            @endif

            @if ($evaluate->resource_speaker_local)
            <div>
                <h1 class="mt-2">Resource Speaker/Trainer - Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->resource_speaker_local }} points.</h1>
            </div>
            @endif

            @if ($evaluate->resource_speaker_international)
            <div>
                <h1 class="mt-2">Resource Speaker/Trainer - International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->resource_speaker_international }} points.</h1>
            </div>
            @endif

            @if ($evaluate->facilitator_moderator_local)
            <div>
                <h1 class="mt-2">Facilitator moderator - Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->facilitator_moderator_local }} points.</h1>
            </div>
            @endif

            @if ($evaluate->facilitator_moderator_international)
            <div>
                <h1 class="mt-2">Facilitator moderator - International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->facilitator_moderator_international }} points.</h1>
            </div>
            @endif

            @if ($evaluate->reactor_panel_member_local)
            <div>
                <h1 class="mt-2">Reactor panel member- Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->reactor_panel_member_local }} points.</h1>
            </div>
            @endif

            @if ($evaluate->reactor_panel_member_international)
            <div>
                <h1 class="mt-2">Reactor panel member- International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->reactor_panel_member_international }} points.</h1>
            </div>
            @endif

            @if ($evaluate->technical_assistance)
            <div>
                <h1 class="mt-2">Technical Assistance/Consultancy </h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->technical_assistance }} points.</h1>
            </div>
            @endif

            @if ($evaluate->judge_community)
            <div>
                <h1 class="mt-2">Judge</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->judge_community }} points.</h1>
            </div>
            @endif

            @if ($evaluate->commencement_guest_speaker)
            <div>
                <h1 class="mt-2">Commencement/Guest Speaker </h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->commencement_guest_speaker }} points.</h1>
            </div>
            @endif
        </div>

        <hr>
        <h1 class="text-xs text-center mt-12">C. Service to the Adopted Barangay/institutions ----50 pts. (Ceiling Points) (Should show proof of involvement e.g., T.O/S.O, Activity Attendance Monitoring Form)</h1>

        <h1 class="text-xs font-medium pl-4 mt-7">I. Participation in the extension and training per day:</h1>
        <div class="px-4 pb-8 mt-5 text-xs  gap-2 grid grid-cols-4 ">

            @if ($evaluate->coordinator_organizer_consultants)
            <div class="text-xs">
                <h1 class="mt-2">Coordinator/Organizer/consultants</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->coordinator_organizer_consultants }} points.</h1>
            </div>
            @endif

            @if ($evaluate->resource_person_lecturer)
            <div class="text-xs">
                <h1 class="mt-2">Resource person/lecturer</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->resource_person_lecturer }} points.</h1>
            </div>
            @endif

            @if ($evaluate->facilitator)
            <div class="text-xs">
                <h1 class="mt-2">Facilitator</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->facilitator }} points.</h1>
            </div>
            @endif

            @if ($evaluate->member)
            <div class="text-xs">
                <h1 class="mt-2">Member</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $evaluate->member }} points.</h1>
            </div>
            @endif
        </div>


    @endforeach
</div>
