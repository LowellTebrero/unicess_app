<x-admin-layout>
    <style>
        [x-cloak] { display: none }
        form button:disabled,
        form button[disabled]{
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }
    </style>

    <section class="bg-white mt-5 m-8 rounded-xl 2xl:min-h-[87vh] h-[85vh] text-gray-600">

        <div class="flex justify-between items-center p-4 ">
            <h1 class="2xl:text-2xl text-lg font-semibold text-slate-700">Upload Proposal <span class="text-red-500 text-xs tracking-wide font-light"> * required fields</span></h1>
            <a href={{ route('admin.dashboard.index') }} class="text-red-500 text-xl font-medium focus:bg-gray-300 focus:rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <hr>


        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <?php flash()->addError($error); ?>
            @endforeach
        @endif


        <form class="pb-8 pt-2  p-7 xl:mt-2 2xl:mt-12" action="{{ route('admin.dashboard.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="w-full mx-auto xl:w-3/4 rounded-lg">
            <div class="flex space-y-5 flex-col  w-full">
                <div class="w-full">
                    <label class="xl:text-xs block text-slate-700 text-sm font-medium mb-2 2xl:text-sm" for="program_id">Program Name <span class="text-red-500">*</span></label>
                    <select id="program_id" class="rounded-md xl:text-xs w-full border-zinc-300  py-2 px-3" name="program_id" value="{{ old('program_id') }}" required>
                        @foreach ($programs as $id => $program_name ) <option value="{{ $id }}" @if ($id == old('program_id')) selected="selected" @endif >{{ $program_name }}</option> @endforeach
                    </select>
                    @error('program_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                </div>

                <div class=" w-full">
                    <label class="xl:text-xs block text-slate-700 text-sm font-medium mb-2 2xl:text-sm" for="project_title">Proposal Title <span class="text-red-500">*</span></label>
                    <input class="border-zinc-300 xl:text-xs  appearance-none border rounded w-full  py-2 px-3 text-slate-700 leading-tight focus:outline-none" name="project_title" id="project_title" type="text" value="{{ old('project_title') }}" placeholder="project title" required>
                    @error('project_title') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="xl:flex xl:justify-between mt-4 space-x-4 w-full">
                    <div class="mb-4 w-full">
                        <label class="xl:text-xs block text-slate-700 text-sm font-medium mb-2">PROJECT PROPOSAL (PDF) <span class="text-red-500">*</span></label>
                        <input onchange="checkInputs()"  class="bg-white border-zinc-300 xl:text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-700 leading-tight focus:outline-none" name="proposal_pdf" id="proposal_pdf" type="file" required>
                        @error('proposal_pdf') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4 w-full">
                        <label class="xl:text-xs block text-slate-700 text-sm font-medium mb-2">SPECIAL ORDER (PDF) <span class="text-red-500">*</span></label>
                        <input onchange="checkInputs()" class="bg-white border-zinc-300 xl:text-[.7rem] appearance-none border  rounded w-full px-3 text-slate-700 leading-tight focus:outline-none" name="special_order_pdf" id="special_order_pdf" type="file" required>
                        @error('special_order_pdf') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="flex space-y-4 flex-col  w-full">

                <div class="flex space-x-5 w-full">
                    <div class="w-full">
                        <label class="xl:text-xs block text-slate-700 text-sm font-medium 2xl:text-sm">Started Date  <span class="text-red-500">*</span></label>
                        <input required class="border-zinc-300 xl:text-xs  appearance-none border  rounded w-full py-2 px-3 text-slate-700 mb-3 leading-tight focus:outline-none" value="{{ old('started_date') }}" name="started_date" id="started_date" type="date">
                        @error('started_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="w-full">
                        <label class="xl:text-xs block text-slate-700 text-sm font-medium 2xl:text-sm"> Ended Date  <span class="text-red-500">*</span></label>
                        <input required class="border-zinc-300 xl:text-xs  appearance-none border  rounded w-full py-2 px-3 text-slate-700 mb-3 leading-tight focus:outline-none" value="{{ old('finished_date') }}" name="finished_date" id="finished_date" type="date">
                        @error('finished_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex space-x-4 w-full ">

                    <div class="w-full">
                        <label class="xl:text-xs block text-slate-700 text-sm font-medium mb-2 2xl:text-sm">Project leader</label>
                        <select name="leader_id" class="rounded-md xl:text-xs w-full  border-zinc-300" value="{{ old('leader_id') }}" id="leader" onchange="RequiredGet(this)">
                            @foreach ($members as $id => $name ) <option value="{{ $id }}">{{ $name }}</option>@endforeach
                        </select>
                        @error('project_leader') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="w-full">
                        <label class="xl:text-xs block text-slate-700 text-sm font-medium mb-2 2xl:text-sm">Role of Leader</label>
                        <select onchange="yesnoCheck(this)" id="leader_member_type" name="leader_member_type" value="{{ old('leader_member_type') }}" class="rounded-md xl:text-xs w-full border-zinc-300">
                            @foreach ($ceso_roles as $id => $role_name )
                            <option value="{{ $id }}"  @if ($id == old('leader_member_type'))
                                selected="selected"
                            @endif
                            >{{ $role_name }}</option>
                            @endforeach
                        </select>
                        @error('role_name') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="w-full">
                        <label class="xl:text-xs block text-slate-700 text-sm font-medium mb-2 2xl:text-sm">Location</label>
                        <select id="location_id" type="text"  class="rounded-md xl:text-xs w-full border-zinc-300 " name="location_id" value="{{ old('location_id') }}">
                            @foreach ($locations as $id => $location_name )
                            <option value="{{ $id }}"
                            @if ($id == old('location_id'))
                                selected="selected"
                            @endif
                            >{{ $location_name }}</option>
                        @endforeach
                        </select>
                        @error('location_name') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="w-full overflow-x-auto h-[15vh]">

                    <table id="table" class="w-full">
                        <thead>
                        <tr class="text-sm text-gray-500">
                            <th class="xl:text-xs  text-slate-700 text-sm font-medium mb-2 2xl:text-sm text-left">Member Name</th>
                            <th class="xl:text-xs  text-slate-700 text-sm font-medium mb-2 2xl:text-sm text-left">Member Type</th>
                            <th class="xl:text-xs  text-slate-700 text-sm font-medium mb-2 2xl:text-sm text-left">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="pr-4">
                                <select name="member[0][id]" class="rounded-md xl:text-xs w-full border-zinc-300" id="member" required>
                                    @foreach ($members as $id => $name ) <option value="{{ $id }}" @if ($id == old('member_id[0][id]')) selected="selected" @endif >{{ $name }}</option> @endforeach
                                </select>
                            </td>

                            <td class="pr-4">
                                <select name="member[0][type]" class="rounded-md xl:text-xs w-full border-zinc-300">
                                    @foreach ($parts_names as $id => $name ) <option value="{{ $name }}" @if ($id == old('member[0][type]')) selected="selected" @endif >{{ $name }}</option> @endforeach
                                </select>
                            </td>

                            <td>
                                <button name="add" id="add" type="button" class="w-full bg-slate-500 rounded text-white px-2 py-1  text-sm xl:text-xs  border-zinc-300">Add more</button>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5">
                <button class="bg-blue-500 rounded-lg text-white 2xl:text-base xl:text-sm font-medium py-2 px-4 mt-4 focus:outline-none" type="submit">
                    Submit Proposal
                </button>
            </div>
           </div>


        </form>

        <x-messages/>


    </section>

    @section('scripts')
        <script>
            var i = 0;
            $('#add').click(function(){
                ++i;
            $('#table').append(
                `<tr>
                    <td class="pr-4 pt-2">
                        <select name="member[`+i+`][id]" class="rounded-md xl:text-xs w-full border-zinc-300" required >
                            @foreach ($members as $id => $name )
                            <option value="{{ $id }}"
                            @if ($id == old('member_id'))
                                selected="selected"
                            @endif
                            >{{ $name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="pr-4 pt-2">
                        <select name="member[`+i+`][type]" class="rounded-md xl:text-xs w-full border-zinc-300" required >
                            @foreach ($parts_names as $id => $name )
                            <option value="{{ $name }}"
                            @if ($id == old('parts_names_id'))
                                selected="selected"
                            @endif
                            >{{ $name }}</option>
                            @endforeach
                        </select>
                    </td>



                    <td class="pr-2">
                        <button type="button" class="bg-red-500 remove-table-row text-sm text-white px-2 py-1 rounded">Remove</button>
                    </td>
                </tr>`
            );
            });

            $(document).on('click', '.remove-table-row', function(){
                $(this).parents('tr').remove();
            });
        </script>



        <script type="text/javascript">


            function RequiredGet(answer){

                console.log(answer.value)
                if(answer.value == '' ){
                    document.getElementById('member').required = true;
                    console.log(document.getElementById('member'));


                }else{
                   document.getElementById('member').required = false;
                    console.log(document.getElementById('member'));
              }
            }


            function yesnoCheck(answer){

                console.log(answer.value)
                if(answer.value == 5 ){
                    document.getElementById('location_id').disabled = true;
                    document.getElementById('points').disabled = false;
                    document.getElementById('points').readOnly = false;
                    document.getElementById('points').value = '';
                    document.getElementById('label_points').innerHTML = '<label>Number of Projects <span class="text-red-500">*</span></label>';

                }else if(answer.value == 6 ){
                    document.getElementById('location_id').disabled = true;
                    document.getElementById('points').readOnly = true;
                    document.getElementById('points').value = '3';
                    document.getElementById('points').innerHTML = '<input value="3"/>';
                    document.getElementById('label_points').innerHTML = '<label>Points <span class="text-red-500">*</span></label>';

                }else if(answer.value == 7){
                    document.getElementById('location_id').disabled = true;
                    document.getElementById('points').readOnly = true;
                    document.getElementById('points').value = "4";
                    document.getElementById('label_points').innerHTML = '<label>Points <span class="text-red-500">*</span></label>';

                }else if (answer.value == 1,2,3,4,5){
                    document.getElementById('location_id').disabled = false;
                    document.getElementById('points').disabled = false;
                    document.getElementById('points').value = '';
                    document.getElementById('points').readOnly = false;
                    document.getElementById('label_points').innerHTML = '<label>Number of Training <span class="text-red-500">*</span></label>';
                }
            }
        </script>

    @endsection

</x-admin-layout>
