<div class=" sticky top-0">

    <a href={{route('admin.evaluation.index')}} class="absolute right-0">
   <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M249.38 336L170 256l79.38-80m-68.35 80H342"/><path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192s192-86 192-192Z"/></svg>
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
