
<div class="border rounded h-[59vh] 2xl:h-[62vh] overflow-x-auto 2xl:w-[70rem] text-gray-600 relative">
    <div class=" sticky top-0 z-10 bg-white py-2 border-b">
        <h1 class="text-center w-full">CES FACULTY PERFORMANCE EVALUATION FORM {{ $currentYear  }}</h1>
    </div>

       <h1 class="text-xs text-left ml-5 mt-5">A. SERVICE TO THE UNIVERSITY</h1>

        @if ($Evaluation->chairmanship_university || $Evaluation->chairmanship_college ||
        $Evaluation->membership_university || $Evaluation->membership_college ||
        $Evaluation->advisorship || $Evaluation->oic || $Evaluation->judge)
        <h1 class="text-xs font-medium pl-4 mt-4"> I. Administrative Work</h1>
        @endif

        <div class="text-xs  px-4 mt-3 flex space-x-5">
            @if ($Evaluation->chairmanship_university !== NULL || $Evaluation->chairmanship_college !== NULL )
            <div class="w-full">
                <h1 class="mt-2">1. Chairmanship of Working Committees </h1>
                <div class="flex space-x-4 mt-2">
                    @if ($Evaluation->chairmanship_university)
                        <div>
                            <h1>University Wide </h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->chairmanship_university }} points.</h1>
                        </div>
                    @endif

                    @if ($Evaluation->chairmanship_college)
                        <div>
                            <h1>College/Unit</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->chairmanship_college }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            @if ($Evaluation->membership_university !== NULL || $Evaluation->membership_college !== NULL )
            <div class="w-full">
                <h1 class="mt-2"> 2. Membership in Working Committee </h1>
                <div class="flex space-x-4 mt-2">
                    @if ($Evaluation->membership_university)
                        <div>
                            <h1>University Wide </h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->membership_university }} points.</h1>
                        </div>
                    @endif

                    @if ($Evaluation->membership_college)
                        <div>
                            <h1>College/Unit</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->membership_college }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        @if ($Evaluation->advisorship || $Evaluation->advisorship)
        <div class="flex text-xs px-4 space-x-5 mt-3">
            <div class="w-full">

                <div class="flex space-x-4 mt-2">
                    @if ($Evaluation->advisorship)
                        <div>
                            <h1 class="mt-2">3. Advisorship of student organization/special assignment as trainer/coach</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->advisorship }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>

            <div class=" w-full">
                <div class="flex space-x-4 mt-2">
                    @if ($Evaluation->oic)
                        <div>
                            <h1 class="mt-2">4. OIC Function (depends on the length of time and what level)</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->oic }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if ($Evaluation->judge)
        <div class="text-xs px-4 mt-3">

                <div class="pt-2">
                    <h1>5.Judge</h1>
                    <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->judge }} points.</h1>
                </div>
        </div>
        @endif

        @if ($Evaluation->resource || $Evaluation->chairmanship_membership ||
        $Evaluation->facilication_on_going || $Evaluation->facilication_regional ||
        $Evaluation->facilication_national || $Evaluation->facilication_international)
        <h1 class="text-xs font-medium pl-4 mt-7">II. Institution Building</h1>
        @endif

        @if ($Evaluation->resource || $Evaluation->chairmanship_membership)
        <div class="text-xs px-4 mt-4">
            @if ($Evaluation->resource)
                <div>
                    <h1 class="mt-2">1. Resource generation (eg. endowment, scholarships professional chair, acquisition of assorted books, and/or substantial library collection, equipment, etc)</h1>
                    <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->resource }} points.</h1>
                </div>
            @endif


            @if ($Evaluation->chairmanship_membership)
                <div>
                    <h1 class="mt-2">2. Chairmanship/membership in local, regional, national,international committee etc., representing the University or within the University (eg, policy paper, curriculum development, etc)</h1>
                    <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->chairmanship_membership }} points.</h1>
                </div>
            @endif
        </div>
        @endif


        <div class="mt-2 text-xs px-4 flex space-x-5 pb-8">
            <div class="w-full">
                <h1 class="mt-2"> @if ($Evaluation->facilication_on_going !== NULL || $Evaluation->facilication_regional !== NULL ||
                     $Evaluation->facilication_national !== NULL || $Evaluation->facilication_international !== NULL ) 3. Facilitation of Linkages  @endif</h1>
                <div class="flex space-x-4 mt-2">
                    @if ($Evaluation->facilication_on_going)
                        <div>
                            <h1>On-going</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->facilication_on_going }} points.</h1>
                        </div>
                    @endif

                    @if ($Evaluation->facilication_regional)
                        <div>
                            <h1>Regional</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->facilication_regional }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full">
                <h1 class="mt-2">&nbsp;</h1>
                <div class="flex space-x-4 mt-2">
                    @if ($Evaluation->facilication_national)
                        <div>
                            <h1>National</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->facilication_national }} points.</h1>
                        </div>
                    @endif

                    @if ($Evaluation->facilication_international)
                        <div>
                            <h1>International</h1>
                            <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->facilication_international }} points.</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <h1 class="text-xs text-left mt-12 ml-5">B. COMMUNITY OUTREACH</h1>

        <div class="px-4 pb-8 mt-5 text-xs  gap-2 grid grid-cols-3 ">

            @if ($Evaluation->training_director_local)
            <div class="text-xs">
                <h1 class="mt-2">Training Director/Coordinator - Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->training_director_local }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->training_director_international)
            <div>
                <h1 class="mt-2">Training Director/Coordinator - International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->training_director_international }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->resource_speaker_local)
            <div>
                <h1 class="mt-2">Resource Speaker/Trainer - Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->resource_speaker_local }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->resource_speaker_international)
            <div>
                <h1 class="mt-2">Resource Speaker/Trainer - International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->resource_speaker_international }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->facilitator_moderator_local)
            <div>
                <h1 class="mt-2">Facilitator moderator - Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->facilitator_moderator_local }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->facilitator_moderator_international)
            <div>
                <h1 class="mt-2">Facilitator moderator - International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->facilitator_moderator_international }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->reactor_panel_member_local)
            <div>
                <h1 class="mt-2">Reactor panel member- Local/National</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->reactor_panel_member_local }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->reactor_panel_member_international)
            <div>
                <h1 class="mt-2">Reactor panel member- International</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->reactor_panel_member_international }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->technical_assistance)
            <div>
                <h1 class="mt-2">Technical Assistance/Consultancy </h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->technical_assistance }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->judge_community)
            <div>
                <h1 class="mt-2">Judge</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->judge_community }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->commencement_guest_speaker)
            <div>
                <h1 class="mt-2">Commencement/Guest Speaker </h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->commencement_guest_speaker }} points.</h1>
            </div>
            @endif
        </div>

        <hr>
        <h1 class="text-xs text-left mt-12 pl-4">C. Service to the Adopted Barangay/institutions</h1>

        @if ($Evaluation->coordinator_organizer_consultants || $Evaluation->resource_person_lecturer || $Evaluation->facilitator || $Evaluation->member )
        <h1 class="text-xs font-medium pl-4 mt-7">I. Participation in the extension and training per day:</h1>
        @endif

        <div class="px-4 pb-8 mt-5 text-xs  gap-2 grid grid-cols-4 ">

            @if ($Evaluation->coordinator_organizer_consultants)
            <div class="text-xs">
                <h1 class="mt-2">Coordinator/Organizer/consultants</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->coordinator_organizer_consultants }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->resource_person_lecturer)
            <div class="text-xs">
                <h1 class="mt-2">Resource person/lecturer</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->resource_person_lecturer }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->facilitator)
            <div class="text-xs">
                <h1 class="mt-2">Facilitator</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->facilitator }} points.</h1>
            </div>
            @endif

            @if ($Evaluation->member)
            <div class="text-xs">
                <h1 class="mt-2">Member</h1>
                <h1 class="border w-[10rem] px-2 py-1 rounded">{{ $Evaluation->member }} points.</h1>
            </div>
            @endif
        </div>



</div>
