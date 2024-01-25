<x-admin-layout>

    <section class="rounded-lg shadow bg-white  mt-5  m-8 text-slate-700 xl:min-h-[84vh] 2xl:min-h-[87vh]">

        <div class="flex justify-between p-5 py-3">
            <h1 class="tracking-wider font-semibold 2xl:text-2xl text-lg"> User Evaluation Points Overview </h1>
            <a href={{ route('admin.points.index') }} class=" text-red-500 px-2 py-1 rounded-lg font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
        <hr>

        <div class="flex p-4 pt-0">

            <div class="w-1/4 border-r pt-5 px-4">

                <h1 class="tracking-wider 2xl:text-lg text-sm font-medium">Profile Information</h1>


                    <div class="w-32 mt-5">
                        <img class="rounded-full border-black border"  id="showImage" src="{{ (!empty($filteredUsers->avatar))? url('upload/image-folder/profile-image/'. $filteredUsers->avatar): url('upload/profile.png') }}">
                    </div>



                <div class="space-y-1 mt-4 text-xs">
                    <div class="flex flex-col">
                        <h1>Name:</h1>
                        <h1>{{ $filteredUsers ? $filteredUsers->name : '' }}</h1>
                    </div>

                    <div class="flex flex-col">
                        <h1>Faculty Name:</h1>
                        <h1>{{  $evaluation->faculty->name ?? 'N/A' }}</h1>
                    </div>
                    <div class="flex flex-col">
                        <h1>Role:</h1>
                        @if (!empty($filteredUsers) && !empty($filteredUsers->getRoleNames()))
                        @foreach ($filteredUsers->getRoleNames() as $role)
                            <h1>{{ $role ?? 'N/A' }}</h1>
                        @endforeach
                        @else
                            <h1>N/A</h1>
                        @endif
                    </div>




                </div>
            </div>

            <div class="w-full pt-5 ">
                <div class="px-5 ">
                    <h1 class="tracking-wider 2xl:text-lg text-sm font-medium">Project Title </h1>
                    <div class="flex justify-between mt-5 space-y-1 flex-col text-sm">
                        @foreach ($proposals as $proposal )
                        @foreach ($proposal->proposal_members as $prop )
                            @if ($proposal->id == $prop->proposal_id)
                                <a href={{route('admin.inventory.show-inventory', $proposal->id)}} target="__blank" class="text-xs hover:bg-gray-200">
                                    {{ Str::limit($proposal->project_title, 110)}}
                                </a>
                            @endif
                            @endforeach
                        @endforeach


                    </div>
                </div>
                <hr>
                <div class="px-5 pt-4">
                     <h1 class="tracking-wider 2xl:text-lg text-sm font-medium">Points Information</h1>
                    <div class="space-y-2 2xl:text-sm xl:text-xs">
                        @if (!empty($evaluations))
                        @foreach ($evaluations as $evaluation )
                        <h1> Created: {{ \Carbon\Carbon::parse($evaluation->created_at)->format('M d, Y,  g:i:s A')}}</h1>
                        @if ($evaluation->chairmanship_university !== null)
                        <h1>Chairmanship University: ({{ $evaluation->chairmanship_university }} points)</h1>
                        @endif
                        @if ($evaluation->chairmanship_college !== null)
                        <h1>Chairmanship College:( {{ $evaluation->chairmanship_college }} points)</h1>
                        @endif
                        @if ($evaluation->membership_university !== null)
                        <h1>Membership University: ({{ $evaluation->membership_university }} points)</h1>
                        @endif
                        @if ($evaluation->membership_college !== null)
                        <h1>Chairmanship College: ({{ $evaluation->membership_college }} points)</h1>
                        @endif
                        @if ($evaluation->advisorship !== null)
                        <h1>Advisorship:( {{ $evaluation->advisorship }} points)</h1>
                        @endif
                        @if ($evaluation->oic !== null)
                        <h1>O I C:( {{ $evaluation->oic }} points)</h1>
                        @endif
                        @if ($evaluation->judge !== null)
                        <h1>Judge:( {{ $evaluation->judge }} points)</h1>
                        @endif
                        @if ($evaluation->resource !== null)
                        <h1>Resource: ({{ $evaluation->resource }} points)</h1>
                        @endif
                        @if ($evaluation->chairmanship_membership !== null)
                        <h1>Chairmanship Membership:( {{ $evaluation->chairmanship_membership }} points)</h1>
                        @endif
                        @if ($evaluation->facilication_on_going !== null)
                        <h1>Facilitator ongoing:( {{ $evaluation->facilication_on_going }} points)</h1>
                        @endif
                        @if ($evaluation->facilication_regional !== null)
                        <h1>Facilitator regional:( {{ $evaluation->facilication_regional }} points)</h1>
                        @endif
                        @if ($evaluation->facilication_national !== null)
                        <h1>Facilitator national:( {{ $evaluation->facilication_national }} points)</h1>
                        @endif
                        @if ($evaluation->facilication_international !== null)
                        <h1>Facilitator international:( {{ $evaluation->facilication_international }} points)</h1>
                        @endif
                        @if ($evaluation->training_director_local !== null)
                        <h1>Training Director Local: ({{ $evaluation->training_director_local }} points)</h1>
                        @endif
                        @if ($evaluation->training_director_international !== null)
                        <h1>Training Director International:( {{ $evaluation->training_director_international }} points)</h1>
                        @endif
                        @if ($evaluation->resource_speaker_local !== null)
                        <h1>Resource Speaker Local: ({{ $evaluation->resource_speaker_local }} points)</h1>
                        @endif
                        @if ($evaluation->resource_speaker_international !== null)
                        <h1>Resource Speaker International:( {{ $evaluation->resource_speaker_international }} points)</h1>
                        @endif
                        @if ($evaluation->facilitator_moderator_local !== null)
                        <h1>Facilitator moderator Local: ({{ $evaluation->facilitator_moderator_local }} points)</h1>
                        @endif
                        @if ($evaluation->facilitator_moderator_international !== null)
                        <h1>Facilitator moderator International:( {{ $evaluation->facilitator_moderator_international }} points)</h1>
                        @endif
                        @if ($evaluation->reactor_panel_member_local !== null)
                        <h1>Reactor panel member local:( {{ $evaluation->reactor_panel_member_local }} points)</h1>
                        @endif
                        @if ($evaluation->reactor_panel_member_international !== null)
                        <h1>Reactor panel member International:( {{ $evaluation->reactor_panel_member_international }} points)</h1>
                        @endif
                        @if ($evaluation->technical_assistance !== null)
                        <h1>Technical Assistance: ({{ $evaluation->technical_assistance }} points)</h1>
                        @endif
                        @if ($evaluation->judge_community !== null)
                        <h1>Judge Community: ({{ $evaluation->judge_community }} points)</h1>
                        @endif
                        @if ($evaluation->commencement_guest_speaker !== null)
                        <h1>Commencement guest speaker: ({{ $evaluation->commencement_guest_speaker }} points)</h1>
                        @endif
                        @if ($evaluation->coordinator_organizer_consultants !== null)
                        <h1>Coordinator organizer consultants: ({{ $evaluation->coordinator_organizer_consultants }} points)</h1>
                        @endif
                        @if ($evaluation->resource_person_lecturer !== null)
                        <h1>Resource person lecturer:( {{ $evaluation->resource_person_lecturer }} points)</h1>
                        @endif
                        @if ($evaluation->facilitator !== null)
                        <h1>Facilitator: ({{ $evaluation->facilitator }} points)</h1>
                        @endif
                        @if ($evaluation->member !== null)
                        <h1>Member: ({{ $evaluation->member }} points)</h1>
                        @endif
                        @endforeach
                        @else
                            <h1>N/A</h1>
                        @endif
                    </div>
                    </div>
                </div>


                <div class="w-1/4 border-l px-2 flex items-center flex-col space-y-10 pt-5">

                    <h1 class="tracking-wider 2xl:text-lg text-sm font-medium">Total Points</h1>

                    @foreach ($filteredUsers->evaluation ?? [] as $eval)
                        <h1 class="text-5xl">{{ $eval->total_points ?? 'N/A' }}</h1>
                    @endforeach

                </div>
            </div>


        </div>
    </section>
</x-admin-layout>
