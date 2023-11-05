<div>
      <div class="flex flex-col w-full bg-white drop-shadow-md rounded-md p-5">

        <div class="bg-white p-10 w-full flex justify-between">
           <h1>{{ $programID->program_name }}</h1>
            <select name="" id="">
                <option value="">Select</option>
            </select>
        </div>

    <div class="flex flex-row space-x-5">
    @foreach ($proposalID as $proposal )
    @if ($programID->id == $proposal->program_id)
         <div class="p-10  xl:w-1/4 bg-slate-100 drop-shadow rounded">
             <h1 class="font-bold"> Faculty:<span>{{ $proposal->users->faculty->name }}</span> </h1>
             <h1> Program:   {{ $proposal->programs->program_name }} </h1>
             <h1> Project Title:   {{ $proposal->project_title }} </h1>
             <h1> Faculty extensionist: {{ $proposal->users->first_name }} </h1>
        </div>
        @endif
        @endforeach
    </div>
    </div>

</div>
