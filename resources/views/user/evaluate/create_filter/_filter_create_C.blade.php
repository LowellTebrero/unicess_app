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


            {{--  @if ($rows->member_type <= 0)
            <h1 class="text-red-500">No Points</h1>
            @else  --}}

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
            {{--  @endif  --}}
            @endif
            @endforeach


        </div>
    </div>
</div>
