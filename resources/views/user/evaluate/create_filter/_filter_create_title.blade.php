<div class="flex flex-col items-center">
    <div class="flex space-x-2">
        <img class="block" src="{{ asset('img/logo.png') }}" width="50" alt="lnu-logo">
        <img class="block" src="{{ asset('img/lnu.png') }}" width="50" alt="lnu-logo">
    </div>

    <h1 class="text-sm sm:text-xl text-center  pt-4  tracking-wider font-bold "> CES FACULTY PERFORMANCE EVALUATION FORM</h1>
    <div class="pb-4 text-center  font-normal">
        <h1 class="text-xs xl:text-sm 2xl:text-normal">Service to University and The Larger Community (maximum of 100 point)</h1>
    </div>
</div>


<div class="pt-2 flex justify-center space-x-12 ">
    <div>
        <h1 class="text-xs xl:text-sm">Name of Faculty: </h1>
        <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="faculty_id" type="text" readOnly value="{{ $user->faculty->name }}" required>
    </div>

    <div>
        <h1 class="text-xs xl:text-sm">Period of Evaluation: SY: </h1>
        <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight text-sm" name="period_of_evaluation" readOnly value="{{ $startYear }} - {{ $endYear }}" type="text" required>
    </div>
</div>
