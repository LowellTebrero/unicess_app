


<div class="relative">

    <button id="toggleButton" type="button"  onclick="toggleVisibility()" class="hover:bg-blue-500 bg-blue-400 px-2 py-1 text-xs rounded text-white transition-all">Show User Detail</button>
    <div type="button" class="transition-all hover:bg-blue-500 fixed z-20 top-[12vh] left-[2rem] lg:top-[13vh] lg:left-[3rem]  xl:top-[13vh] xl:left-[13rem] 2xl:top-[12vh] 2xl:left-[18rem] bg-white rounded border hover:shadow-2xl shadow-xl hover:border-gray-700 border-neutral-800 p-2"  onclick="toggleVisibility()" id="userDetailDiv" style="display: none;">
        <div class="transition-all flex flex-col text-sm space-y-1 hover:text-white ">
            <h1 class="font-medium tracking-wider bg-yellow-400">Profile Information</h1>
            <h1>Username: {{ $evaluation->users ? $evaluation->users->name : '' }}</h1>
            <h1>Email: {{  $evaluation->email ? $evaluation->email->name : '' }}</h1>
            <h1>Role:
            @foreach ($evaluation->users->roles as $role )
                {{ $role->name ? $role->name : ''}}
            @endforeach
            </h1>
            <h1>Faculty: {{ $evaluation->users->faculty ? $evaluation->users->faculty->name : '' }}</h1>
        </div>
    </div>


    <a href={{route('admin.evaluation.index')}} class="absolute top-0 right-0 hover:bg-gray-200 focus:bg-red-100 px-2 py-1 rounded-md" >
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
   </a>

   <div class="flex items-center flex-col">
       <div class="flex space-x-2">
           <img class="block" src="{{ asset('img/logo.png') }}" width="50" alt="lnu-logo">
           <img class="block" src="{{ asset('img/lnu.png') }}" width="50" alt="lnu-logo">
       </div>
       <h1 class="text-xl text-center pt-2 tracking-wider font-bold">CES FACULTY PERFORMANCE EVALUATION FORM</h1>
   </div>

   <div class="py-4 flex justify-center space-x-12 ">
       <div>
           <h1 class="text-sm tracking-wider font-medium">Name of Faculty: </h1>
           <input  class=" border-zinc-500 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" name="faculty_id" type="text" value="{{ $evaluation->faculty_id }}">
       </div>

       <div>
           <h1 class="text-sm tracking-wider font-medium">Period of Evaluation: SY: </h1>
           <input  class=" border-zinc-500 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" name="period_of_evaluation" value="{{ $evaluation->period_of_evaluation }}" type="text" >
       </div>
   </div>

   <div class="py-4 text-center  font-semibold">
       <h1>Service to University and The Larger Community (maximum of 100 point)
       </h1>
   </div>

    <div class="p-5 border border-zinc-500 bg-slate-50">
           <p class="font-bold text-md tracking-wide">
               A. SERVICE TO THE UNIVERSITY -- 30 points (Ceiling Points)
               (Should show proof of involvement e.g., T.O/S.O, Certificate of Appearance/Activity Attendance
               Monitoring Form)

           </p>
   </div>
</div>
