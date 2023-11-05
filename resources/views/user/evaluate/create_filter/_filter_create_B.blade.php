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

    <h1>Training Director/Coordinator - Local/National </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="training_director_local"  type="text" id="inputfield1" onkeypress="return isNumber(event)" required>
    @endif

    @if ($row->leader_member_type == '1' && $row->location_id == '2')

    <h1>Training Director/Coordinator - International </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="training_director_international" type="text" id="inputfield2" onkeypress="return isNumber(event)" required>
    @endif

    @if ($row->leader_member_type == '2' && $row->location_id == '1')

    <h1>Resource Speaker/Trainer - Local/National </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_speaker_local" type="text" onkeypress="return isNumber(event)" required>
    @endif

    @if ($row->leader_member_type == '2' && $row->location_id == '2')

    <h1>Resource Speaker/Trainer - International </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="resource_speaker_international" type="text" onkeypress="return isNumber(event)" required>
    @endif


    @if ($row->leader_member_type == '3' && $row->location_id == '1')

    <h1>Facilitator moderator - local  </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilitator_moderator_local" type="text" onkeypress="return isNumber(event)" required>
    @endif

    @if ($row->leader_member_type == '3' && $row->location_id == '2')

    <h1>Facilitator moderator - International </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="facilitator_moderator_international" type="text" onkeypress="return isNumber(event)" required>
    @endif


    @if ($row->leader_member_type == '4' && $row->location_id == '1')

    <h1>Reactor panel member - local </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="reactor_panel_member_local" type="text" onkeypress="return isNumber(event)" required>
    @endif

    @if ($row->leader_member_type == '4' && $row->location_id == '2')

    <h1>Reactor panel member - International </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="reactor_panel_member_international" type="text" onkeypress="return isNumber(event)" required>
    @endif


    @if ($row->leader_member_type == '5' && empty($row->location_id))

    <h1>Technical Assistance/Consultancy </h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="technical_assistance"  type="text" onkeypress="return isNumber(event)" required>
    @endif

    @if ($row->leader_member_type == '6' && empty($row->location_id))

    <h1>Judge:</h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="judge_community"  type="text" onkeypress="return isNumber(event)" required>
    @endif

    @if ($row->leader_member_type == '7' && empty($row->location_id))

    <h1>Commencement/Guest Speaker: 4 Points:</h1>
    <input class="input border-zinc-400 shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="commencement_guest_speaker" type="text" onkeypress="return isNumber(event)" required>
    @endif
    {{--  @endif  --}}
    @endforeach


</div>


