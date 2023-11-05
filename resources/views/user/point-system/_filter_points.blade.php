
    <div class=" flex justify-between ">
    <div>
        <h1 class="text-md">Proposal Information</h1>

        <div class="space-y-4 mt-5 text-sm">
            <div class="space-y-4">

                @foreach ($proposals as $proposal )
                    <div class="flex flex-col">

                    <div class="flex flex-col">
                        <div class="flex space-x-2">
                            <h1>Proposal ID: {{ $proposal->proposal_id }}</h1>
                            <h1>Title: {{ $proposal->proposal->project_title }}</h1>
                        </div>



                        <div class="">
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
        </div>
    </div>

    <div class="text-center pr-20">
        <h1>Total Points: </h1>
        <h3 class="mt-7 text-7xl">@if ($latestYearPoints == null) 0 @else {{ $latestYearPoints->total_points }} @endif</h3>
    </div>

</div>
