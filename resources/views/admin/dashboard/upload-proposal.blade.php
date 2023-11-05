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

    <section class="bg-white mt-5 p-5 m-8 rounded-xl min-h-[87vh]">

        <div class="flex justify-between items-center px-4  mb-10">
            <h1 class="">&nbsp;</h1>
            <a href="{{ route('admin.dashboard.index') }}" class="text-red-500  rounded-lg focus:bg-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <form class=" pb-8 w-1/2 mx-auto bg-slate-100 rounded-lg p-7" action="{{ route('admin.dashboard.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <h1 class="text-2xl font-semibold text-gray-600 mb-8">Upload Proposal</h1>

            <div class="flex space-y-4 flex-col">
                <div class="w-full">
                    <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm" for="program_id">Program Name <span class="text-red-500">*</span></label>
                    <select id="program_id" class="rounded-md xl:text-xs w-full border-zinc-400  py-2 px-3" name="program_id" value="{{ old('program_id') }}" required>
                        @foreach ($programs as $id => $program_name ) <option value="{{ $id }}" @if ($id == old('program_id')) selected="selected" @endif >{{ $program_name }}</option> @endforeach
                    </select>
                    @error('program_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                </div>

                <div class=" w-full">
                    <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm" for="project_title">Proposal Title <span class="text-red-500">*</span></label>
                    <input class="border-zinc-400 xl:text-xs shadow appearance-none border rounded w-full  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="project_title" id="project_title" type="text" value="{{ old('project_title') }}" placeholder="project title" required>
                    @error('project_title') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                </div>
            </div>



            <div class="flex space-y-2 flex-col mt-3">

                <div class="flex space-x-4 w-full" >
                    <div class="w-full">
                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm">Started Date  <span class="text-red-500">*</span></label>
                        <input required class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('started_date') }}" name="started_date" id="started_date" type="date">
                        @error('started_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="w-full">
                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm"> Ended Date  <span class="text-red-500">*</span></label>
                        <input required class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('finished_date') }}" name="finished_date" id="finished_date" type="date">
                        @error('finished_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex space-x-4 w-full">

                    <div class="w-full">
                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm">Project leader <span class="text-red-500">*</span></label>
                        <select name="leader[0][id]" class="rounded-md xl:text-xs w-full  border-zinc-400" value="{{ old('leader[0][id]') }}" id="leader" onchange="RequiredGet(this)">
                            @foreach ($members as $id => $name )
                                <option value="{{ $id }}" @if ($id == old('member_id')) selected="selected"@endif >{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('project_leader') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="w-full">
                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm">Role of Project Leader <span class="text-red-500">*</span></label>
                        <select onchange="yesnoCheck(this)" id="leader_member_type" name="leader_member_type" value="{{ old('leader_member_type') }}" class="rounded-md xl:text-xs w-full border-zinc-400">
                            @foreach ($ceso_roles as $id => $role_name )
                            <option value="{{ $id }}"  @if ($id == old('role_id'))
                                selected="selected"
                            @endif
                            >{{ $role_name }}</option>
                            @endforeach
                        </select>
                        @error('role_name') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="w-full">
                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm">Location <span class="text-red-500">*</span></label>
                        <select id="location_id" type="text"  class="rounded-md xl:text-xs w-full border-zinc-400 " name="location_id" value="{{ old('location_id') }}">
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
            </div>




            <div class="flex space-y-4 flex-col">
                <div class="pt-4 w-full ">

                    <table id="table" class="w-full">
                        <thead>
                        <tr class="text-sm text-gray-500">
                            <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm text-left">Member Name</th>
                            <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm text-left">Member Type</th>
                            <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-sm text-left">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="pr-4">
                                <select name="member[0][id]" class="rounded-md xl:text-xs w-full border-zinc-400" id="member" required>
                                    @foreach ($members as $id => $name ) <option value="{{ $id }}" @if ($id == old('member_id')) selected="selected" @endif >{{ $name }}</option> @endforeach
                                </select>
                            </td>

                            <td class="pr-4">
                                <select name="member[0][type]" class=" rounded-md xl:text-xs w-full border-zinc-400">
                                <option disabled selected>Select Type</option>
                                    @foreach ($parts_names as $id => $name ) <option value="{{ $name }}" @if ($id == old('parts_names_id')) selected="selected" @endif >{{ $name }}</option> @endforeach
                                </select>
                            </td>

                            <td class="">
                                <button name="add" id="add" type="button" class="w-full bg-slate-500 rounded text-white px-2 py-1  text-sm xl:text-xs  border-zinc-400">Add more</button>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>


                <div class="xl:flex xl:justify-between mt-4 space-x-4 w-full">
                    <div class="mb-4 w-full">
                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider">PROJECT PROPOSAL PDF <span class="text-red-500">*</span></label>
                        <input onchange="checkInputs()"  class="bg-white border-zinc-400 xl:text-[.7rem] appearance-none border  rounded w-full px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="proposal_pdf" id="proposal_pdf" type="file" required>
                        @error('proposal_pdf') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4 w-full">
                        <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider">SPECIAL ORDER PDF <span class="text-red-500">*</span></label>
                        <input onchange="checkInputs()" class="bg-white border-zinc-400 xl:text-[.7rem] appearance-none border  rounded w-full px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="special_order_pdf" id="special_order_pdf" type="file" required>
                        @error('special_order_pdf') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="">
                <button  class="bg-blue-500 rounded-lg hover:bg-blue-600 text-white 2xl:text-base xl:text-sm font-medium py-2 px-4 mt-4 focus:outline-none focus:shadow-outline" type="submit">
                Submit Proposal
                </button>
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
                        <select name="member[`+i+`][id]" class="rounded-md xl:text-xs w-full border-zinc-400 " required >
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
                        <select name="member[`+i+`][type]" class="rounded-md xl:text-xs w-full border-zinc-400 " required >
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
