
    <div class=" flex justify-between ">
    <div class="">
        <h1 class="text-md 2xl:text-base xl:text-sm">Proposal Information</h1>

        <div class="space-y-4 mt-5 text-sm">
            <div class="space-y-4">

                @foreach ($proposals as $proposal )
                    <div class="flex flex-col">

                    <div class="flex flex-col 2xl:text-base xl:text-xs">
                        <div class="flex space-x-2">
                            <h1>Proposal ID: {{ $proposal->proposal_id }}</h1>
                            <h1>Title: {{ $proposal->proposal->project_title }}</h1>
                        </div>

                        <div>
                            @if ($proposal->leader_member_type !== null)
                                <h1>Project Leader : {{ $proposal->ceso_role->role_name }}</h1>
                            @elseif ($proposal->member_type !== null)
                                <h1>Member Type : {{ $proposal->member_type }}</h1>
                            @endif
                        </div>
                    </div>
                    </div>
                @endforeach

            </div>
            <div class="space-y-2 2xl:text-base xl:text-xs">
                @foreach ($evaluations as $evaluation )
                @if ($evaluation->chairmanship_university !== null)
                <h1>Chairmanship University: {{ $evaluation->chairmanship_university }} points</h1>
                @endif
                @if ($evaluation->chairmanship_college !== null)
                <h1>Chairmanship College: {{ $evaluation->chairmanship_college }} points</h1>
                @endif
                @if ($evaluation->membership_university !== null)
                <h1>Membership University: {{ $evaluation->membership_university }} points</h1>
                @endif
                @if ($evaluation->membership_college !== null)
                <h1>Chairmanship College: {{ $evaluation->membership_college }} points</h1>
                @endif
                @if ($evaluation->advisorship !== null)
                <h1>Advisorship: {{ $evaluation->advisorship }} points</h1>
                @endif
                @if ($evaluation->oic !== null)
                <h1>O I C: {{ $evaluation->oic }} points</h1>
                @endif
                @if ($evaluation->judge !== null)
                <h1>Judge: {{ $evaluation->judge }} points</h1>
                @endif
                @if ($evaluation->resource !== null)
                <h1>Resource: {{ $evaluation->resource }} points</h1>
                @endif
                @if ($evaluation->chairmanship_membership !== null)
                <h1>Chairmanship Membership: {{ $evaluation->chairmanship_membership }} points</h1>
                @endif
                @if ($evaluation->facilication_on_going !== null)
                <h1>Facilitator ongoing: {{ $evaluation->facilication_on_going }} points</h1>
                @endif
                @if ($evaluation->facilication_regional !== null)
                <h1>Facilitator regional: {{ $evaluation->facilication_regional }} points</h1>
                @endif
                @if ($evaluation->facilication_national !== null)
                <h1>Facilitator national: {{ $evaluation->facilication_national }} points</h1>
                @endif
                @if ($evaluation->facilication_international !== null)
                <h1>Facilitator international: {{ $evaluation->facilication_international }} points</h1>
                @endif
                @if ($evaluation->training_director_local !== null)
                <h1>Training Director Local: {{ $evaluation->training_director_local }} points</h1>
                @endif
                @if ($evaluation->training_director_international !== null)
                <h1>Training Director International: {{ $evaluation->training_director_international }} points</h1>
                @endif
                @if ($evaluation->resource_speaker_local !== null)
                <h1>Resource Speaker Local: {{ $evaluation->resource_speaker_local }} points</h1>
                @endif
                @if ($evaluation->resource_speaker_international !== null)
                <h1>Resource Speaker International: {{ $evaluation->resource_speaker_international }} points</h1>
                @endif
                @if ($evaluation->facilitator_moderator_local !== null)
                <h1>Facilitator moderator Local: {{ $evaluation->facilitator_moderator_local }} points</h1>
                @endif
                @if ($evaluation->facilitator_moderator_international !== null)
                <h1>Facilitator moderator International: {{ $evaluation->facilitator_moderator_international }} points</h1>
                @endif
                @if ($evaluation->reactor_panel_member_local !== null)
                <h1>Reactor panel member local: {{ $evaluation->reactor_panel_member_local }} points</h1>
                @endif
                @if ($evaluation->reactor_panel_member_international !== null)
                <h1>Reactor panel member International: {{ $evaluation->reactor_panel_member_international }} points</h1>
                @endif
                @if ($evaluation->technical_assistance !== null)
                <h1>Technical Assistance: {{ $evaluation->technical_assistance }} points</h1>
                @endif
                @if ($evaluation->judge_community !== null)
                <h1>Judge Community: {{ $evaluation->judge_community }} points</h1>
                @endif
                @if ($evaluation->commencement_guest_speaker !== null)
                <h1>Commencement guest speaker: {{ $evaluation->commencement_guest_speaker }} points</h1>
                @endif
                @if ($evaluation->coordinator_organizer_consultants !== null)
                <h1>Coordinator organizer consultants: {{ $evaluation->coordinator_organizer_consultants }} points</h1>
                @endif
                @if ($evaluation->resource_person_lecturer !== null)
                <h1>Resource person lecturer: {{ $evaluation->resource_person_lecturer }} points</h1>
                @endif
                @if ($evaluation->facilitator !== null)
                <h1>Facilitator: {{ $evaluation->facilitator }} points</h1>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="text-center pr-20">
        <h1>Total Points: </h1>
        <h3 class="mt-7 2xl:text-7xl xl:text-4xl">@if ($latestYearPoints == null) 0 @else {{ $latestYearPoints->total_points }} @endif</h3>
    </div>

</div>
