
    <div class="flex-col space-y-4 sm:space-y-0 sm:flex-row flex sm:justify-between">

            <div class="space-y-2 2xl:text-base xl:text-xs">
                @foreach ($evaluations as $evaluation )
                <h1 class="text-md 2xl:text-base xl:text-sm tracking-wider">Created: {{ \Carbon\Carbon::parse($evaluation->created_at)->format('M d, y g:i:s A')}}</h1>

                @if ($evaluation->chairmanship_university !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Chairmanship University: ({{ $evaluation->chairmanship_university }} points)</h1>
                @endif
                @if ($evaluation->chairmanship_college !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Chairmanship College: ({{ $evaluation->chairmanship_college }} points)</h1>
                @endif
                @if ($evaluation->membership_university !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Membership University: ({{ $evaluation->membership_university }} points)</h1>
                @endif
                @if ($evaluation->membership_college !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Chairmanship College: ({{ $evaluation->membership_college }} points)</h1>
                @endif
                @if ($evaluation->advisorship !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Advisorship: ({{ $evaluation->advisorship }} points)</h1>
                @endif
                @if ($evaluation->oic !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">O I C: ({{ $evaluation->oic }} points)</h1>
                @endif
                @if ($evaluation->judge !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Judge: ({{ $evaluation->judge }} points)</h1>
                @endif
                @if ($evaluation->resource !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Resource:( {{ $evaluation->resource }} point)s</h1>
                @endif
                @if ($evaluation->chairmanship_membership !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Chairmanship Membership: ({{ $evaluation->chairmanship_membership }} points)</h1>
                @endif
                @if ($evaluation->facilication_on_going !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Facilitator ongoing: ({{ $evaluation->facilication_on_going }} points)</h1>
                @endif
                @if ($evaluation->facilication_regional !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Facilitator regional: ({{ $evaluation->facilication_regional }} points)</h1>
                @endif
                @if ($evaluation->facilication_national !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Facilitator national: ({{ $evaluation->facilication_national }} points)</h1>
                @endif
                @if ($evaluation->facilication_international !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Facilitator international: ({{ $evaluation->facilication_international }} points)</h1>
                @endif
                @if ($evaluation->training_director_local !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Training Director Local: ({{ $evaluation->training_director_local }} points)</h1>
                @endif
                @if ($evaluation->training_director_international !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Training Director International: ({{ $evaluation->training_director_international }} points)</h1>
                @endif
                @if ($evaluation->resource_speaker_local !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Resource Speaker Local: ({{ $evaluation->resource_speaker_local }} points)</h1>
                @endif
                @if ($evaluation->resource_speaker_international !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Resource Speaker International: ({{ $evaluation->resource_speaker_international }} points)</h1>
                @endif
                @if ($evaluation->facilitator_moderator_local !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Facilitator moderator Local: ({{ $evaluation->facilitator_moderator_local }} points)</h1>
                @endif
                @if ($evaluation->facilitator_moderator_international !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Facilitator moderator International: ({{ $evaluation->facilitator_moderator_international }} points)</h1>
                @endif
                @if ($evaluation->reactor_panel_member_local !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Reactor panel member local:( {{ $evaluation->reactor_panel_member_local }} points)</h1>
                @endif
                @if ($evaluation->reactor_panel_member_international !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Reactor panel member International:( {{ $evaluation->reactor_panel_member_international }} points)</h1>
                @endif
                @if ($evaluation->technical_assistance !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Technical Assistance: ({{ $evaluation->technical_assistance }} points)</h1>
                @endif
                @if ($evaluation->judge_community !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Judge Community:( {{ $evaluation->judge_community }} points)</h1>
                @endif
                @if ($evaluation->commencement_guest_speaker !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Commencement guest speaker: ({{ $evaluation->commencement_guest_speaker }} points)</h1>
                @endif
                @if ($evaluation->coordinator_organizer_consultants !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Coordinator organizer consultants:( {{ $evaluation->coordinator_organizer_consultants }} points)</h1>
                @endif
                @if ($evaluation->resource_person_lecturer !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Resource person lecturer:( {{ $evaluation->resource_person_lecturer }} points)</h1>
                @endif
                @if ($evaluation->facilitator !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Facilitator: ({{ $evaluation->facilitator }} points)</h1>
                @endif
                @if ($evaluation->member !== null)
                <h1 class="text-xs xl:text-sm tracking-wider">Member: ({{ $evaluation->member }} points)</h1>
                @endif
                @endforeach
            </div>

            <div class="text-center pr-20">
                <h1>Total Points: </h1>
                <h3 class="mt-7 2xl:text-7xl text-4xl">@if ($latestYearPoints == null) 0 @else {{ $latestYearPoints->total_points }} @endif</h3>
            </div>

</div>
