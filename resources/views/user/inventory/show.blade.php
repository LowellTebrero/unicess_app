<x-app-layout>
@hasanyrole('Faculty extensionist|Extension coordinator')
    <style>
        [x-cloak] { display: none }
        .upload-form button:disabled,
        .upload-form button[disabled]
        {
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }
    </style>

    @if ($errors->any())
    @foreach ($errors->all() as $error)
      <?php flash()->addError($error); ?>
    @endforeach
    @endif
        <section class="bg-white shadow rounded-xl min-h-[87vh] overflow-hidden m-8 mt-5 relative">

            <div class="bg-blue-200 bg-opacity-40 h-full absolute  z-10" id="mySidebar">
                <div class="w-[0rem] bg-gray-600 h-full transition-all" id="subSidebar">
                    <div class="p-4 w-full h-full transition-all" style="display: none" id="sidebar-title">
                        <div class="flex justify-between text-white">
                            <h1 class="tracking-wider">Options</h1>
                            <a href="javascript:void(0)" class="closebtn text-2xl hover:bg-gray-700 px-2 rounded" onclick="closeNav()">×</a>
                        </div>

                        <div class="py-2 space-y-2 mt-5 flex flex-col transition-all ">
                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = true">

                                <!-- Trigger for Modal -->
                                <button class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" type="button" @click="showModal = true">
                                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17"
                                    height="17" viewBox="0 0 16 16">
                                    <g fill="currentColor">
                                        <path
                                            d="m5.369 7.92l2.14-2.14v5.752h1v-5.68l2.066 2.067l.707-.707l-2.957-2.956h-.707L4.662 7.212l.707.707Z" />
                                        <path
                                            d="M14 8A6 6 0 1 1 2 8a6 6 0 0 1 12 0Zm-1 0A5 5 0 1 0 3 8a5 5 0 0 0 10 0Z" />
                                    </g>
                                    </svg>
                                     Upload Files
                                </button>

                                <!-- Modal -->
                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40" x-show="showModal" >

                                    <!-- Modal inner -->
                                    <div class="w-1/4  text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                        x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-end px-4 rounded-tl rounded-tr py-4 pb-2">

                                            <h1 class="tracking-wider text-sm">Upload file</h1>

                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="showModal = false">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                            </button>

                                        </div>
                                        <hr>


                                        <!-- content -->
                                        <div class="p-5 space-y-4">
                                            <h1 class="text-center tracking-wider text-sm">Note: Choose what is applicable</h1>
                                            <form action="{{ route('inventroy-update-user-proposal', $proposals->id) }}" method="POST" enctype="multipart/form-data" class="upload-form" >
                                                @csrf @method('PUT')
                                                <div class="py-1 flex flex-col w-full">

                                                    <div class="flex flex-col mb-4">
                                                        <label class="text-sm font-light  mb-1">Proposal PDF</label>
                                                        <input type="file" name="proposal_pdf" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
                                                        @error('proposal_pdf') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="flex flex-col mb-4">
                                                        <label class="text-sm font-light  mb-1">Memorandum of Agreement PDF</label>
                                                        <input type="file" name="moa" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
                                                        @error('moa') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="flex flex-col mb-4">
                                                        <label class="text-sm font-light  mb-1">Other Files </label>
                                                        <input type="file" multiple name="other_files[]" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
                                                        @error('other_files') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                    </div>

                                                    <div class="mb-2 mt-12">
                                                        <button class="bg-blue-500 w-full text-white rounded-md p-2" type="submit" id="upload-file" disabled>Upload File</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = true">

                                <!-- Trigger for Modal -->
                                <button class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" type="button" @click="showModal = true">
                                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M4 7h3m13 0h-9m9 10h-3M4 17h9m-9-5h16"/></svg>
                                     Edit Proposal details
                                </button>

                                <!-- Modal -->
                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40" x-show="showModal" >

                                    <!-- Modal inner -->
                                    <div class="w-1/2  text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                        x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-between px-4 rounded-tl rounded-tr bg-white py-4 ">
                                            <h3 class="text-base font-semibold  text-gray-500">
                                                Proposal Details
                                            </h3>
                                            <button type="button" class=" bg-transparent text-gray-500 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="showModal = false">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>


                                        </div>
                                        <hr>

                                        <!-- content -->
                                        <div class="p-6 space-y-4">

                                                <form action={{ route('inventory.update-project-details', $proposals->id ) }} method="POST">
                                                    @csrf @method('PUT')
                                                <!-- Modal header -->

                                                <!-- Modal body -->
                                                <div class="p-6 space-y-6">

                                                    <div class="flex space-y-4 flex-col">
                                                        <div class="w-full">
                                                            <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs" for="program_id">Program Name <span class="text-red-500">*</span></label>
                                                            <select id="program_id" class="rounded-md xl:text-xs w-full border-zinc-400  py-2 px-3" name="program_id" value="{{ old('program_id') }}" required>
                                                                @foreach ($program as $id => $program_name ) <option value="{{ $id }}" @if ($id == $proposals->program_id) selected="selected" @endif >{{ $program_name }}</option> @endforeach
                                                            </select>
                                                            @error('program_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="w-full">
                                                            <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs" for="project_title">Proposal Title <span class="text-red-500">*</span></label>
                                                            <input class="border-zinc-400 xl:text-xs shadow appearance-none border rounded w-full  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="project_title" id="project_title" type="text" value="{{ $proposals->project_title }}" placeholder="project title" required>
                                                            @error('project_title') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>

                                                    <div class="flex space-y-2 flex-col mt-3">

                                                        <div class="flex space-x-4 w-full" >
                                                            <div class="w-full">
                                                                <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Started Date  <span class="text-red-500">*</span></label>
                                                                <input required class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposals->started_date }}" name="started_date" id="started_date" type="date">
                                                                @error('started_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="w-full">
                                                                <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs"> Ended Date  <span class="text-red-500">*</span></label>
                                                                <input required class="border-zinc-400 xl:text-xs shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{ $proposals->finished_date }}" name="finished_date" id="finished_date" type="date">
                                                                @error('finished_date') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="flex space-x-4 w-full">

                                                            <div class="w-full">
                                                                <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Project leader <span class="text-red-500">*</span></label>
                                                                <select name="leader_id" class="rounded-md xl:text-xs w-full  border-zinc-400" value="{{ old('leader') }}" id="leader" onchange="RequiredGet(this)">
                                                                    <option value="">Select Username</option>
                                                                    @foreach ($members as $id => $name )
                                                                        <option value="{{ $id }}"
                                                                        @foreach ($proposals->proposal_members as $proposal_mem)
                                                                        @if ($proposal_mem->leader_member_type != null ? $proposal_mem->user_id == $id : '')
                                                                        selected="selected"
                                                                        @endif
                                                                        @endforeach
                                                                    >{{ $name }}</option>

                                                                    @endforeach
                                                                </select>
                                                                @error('project_leader') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="w-full">
                                                                <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Role of Project Leader <span class="text-red-500">*</span></label>
                                                                <select onchange="yesnoCheck(this)" id="leader_member_type" name="leader_member_type" value="{{ old('leader_member_type') }}" class="rounded-md xl:text-xs w-full border-zinc-400">
                                                                    @foreach ($ceso_roles as $id => $role_name )

                                                                    <option value="{{ $id }}"
                                                                    @foreach ($proposals->proposal_members as $proposal_mem)
                                                                    @if ($id == $proposal_mem->leader_member_type)
                                                                    selected="selected"
                                                                    @endif
                                                                    @endforeach
                                                                    >{{ $role_name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('role_name') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="w-full">
                                                                <label class="xl:text-xs block text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs">Location <span class="text-red-500">*</span></label>
                                                                <select id="location_id" type="text"  class="rounded-md xl:text-xs w-full border-zinc-400 " name="location_id" value="{{ old('location_id') }}">
                                                                    @foreach ($locations as $id => $name )
                                                                    <option value="{{ $id }}"
                                                                    @foreach ($proposals->proposal_members as $proposal_mem)
                                                                    @if ($id == $proposal_mem->location_id)
                                                                        selected="selected"
                                                                    @endif
                                                                    @endforeach
                                                                    >{{ $name }}</option>
                                                                @endforeach
                                                                </select>
                                                                @error('location_name') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="pt-4 w-full">

                                                            <div>
                                                                <button name="add" id="add" type="button" class="bg-slate-500 rounded text-white px-2 py-1  text-sm xl:text-xs border-zinc-400">Add Member</button>
                                                            </div>

                                                            <table id="table" class="w-full">
                                                                <thead>
                                                                <tr class="text-sm text-gray-500">
                                                                    <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Member Name</th>
                                                                    <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Member Type</th>
                                                                    <th class="xl:text-xs  text-gray-700 text-sm font-medium mb-2 tracking-wider 2xl:text-xs text-left">Action</th>
                                                                </tr>
                                                                </thead>

                                                                <tbody>

                                                                    @php($count=0)
                                                                    @foreach ($proposals->proposal_members as $proposal_mem)
                                                                    @if ($proposal_mem->member_type !== null)
                                                                    @php($count++)


                                                                    <tr>
                                                                    <td class="pr-4 pt-2">
                                                                        <select name="member[{{ $count }}][id]" class="rounded-md xl:text-xs w-full border-zinc-400" id="member" required>
                                                                            @foreach ($members as $id => $participation_name )
                                                                                <option value="{{ $id }}"
                                                                                    @if ($proposal_mem->member_type != null ? $proposal_mem->user_id == $id : '')
                                                                                    selected="selected"
                                                                                    @endif>
                                                                                    {{ $participation_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>

                                                                    <td class="pr-4 pt-2">

                                                                        <select name="member[{{ $count }}][type]" class="rounded-md xl:text-xs w-full border-zinc-400">
                                                                            @foreach ($parts_names as $id => $name ) <option value="{{ $name }}"

                                                                                @if ($proposal_mem->member_type != null ? $proposal_mem->member_type == $name : '')
                                                                                selected="selected"
                                                                                @endif
                                                                                >
                                                                                {{ $name }}
                                                                            @endforeach
                                                                        </option>
                                                                    </select>
                                                                    </td>

                                                                    <td>
                                                                        <button type="button" class="bg-red-500 remove-table-row text-xs text-white px-2 py-1 rounded">Remove</button>
                                                                    </td>
                                                                </tr>
                                                                    @endif
                                                                    @endforeach

                                                            </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-6 space-x-2 border-gray-200 rounded-b dark:border-gray-600">
                                                    <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                                                    <button @click="showModal = false"  type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" href={{ url('download', $proposals->id) }}>
                                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256"><path fill="currentColor" d="M82.34 117.66A8 8 0 0 1 88 104h32V40a8 8 0 0 1 16 0v64h32a8 8 0 0 1 5.66 13.66l-40 40a8 8 0 0 1-11.32 0ZM216 144a8 8 0 0 0-8 8v56H48v-56a8 8 0 0 0-16 0v56a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16v-56a8 8 0 0 0-8-8Z"/></svg>
                                Download to zip
                            </a>

                        </div>
                    </div>
                </div>
            </div>

                <div class="flex justify-between p-4">
                    <h1 class="tracking-wider text-sm"> {{ $proposals->project_title }} </h1>
                    <a class="text-red-500 text-xl font-bold hover:bg-gray-200 focus:bg-red-200 rounded" href={{ route('inventory.index') }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <hr>



                <div class="w-full flex flex-col p-4 ">

                    <div class="flex justify-between px-5 space-x-4 text-lg">
                        <button class="openbtn" onclick="openNav()">☰</button>
                        <select id="myDropdown" class="rounded text-xs">
                            @foreach ($inventory as $invent )
                            <option value="1" {{ old('1', $invent->number) == '1' ? 'selected' : '' }}>Tiles</option>
                            <option value="2" {{ old('2', $invent->number) == '2' ? 'selected' : '' }}>Medium Icon</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="px-10">
                        @include('user.inventory.show._show-media')
                    </div>

                </div>

        </section>


        <script>


            $('input[type=file]').change(function(){
            if($('input[type=files]').val()==''){
                $('#upload-file').attr('disabled',true)
            }
            else{
            $('#upload-file').attr('disabled',false);
            }})

            function openNav() {
                document.getElementById("mySidebar").style.width = "100%";
                document.getElementById("subSidebar").style.width = "15rem";
                document.getElementById("sidebar-title").style.display= "inline-block";
              }

            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("subSidebar").style.width = "0";
                document.getElementById("sidebar-title").style.display= "none";
              }


            $(document).ready(function () {
                $('#myDropdown').on('change', function () {
                    var selectedValue = $(this).val();

                    $.ajax({
                        url: '/api/update-customize-user-show/2' ,
                        method: 'POST',
                        data: {
                            selected_value: selectedValue,
                            _token: '{{ csrf_token() }}' // Add CSRF token for security
                        },

                        success: function (response) {

                            window.location.reload();
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });



            var count = {{ $count }};


            $(document).on('click', '.remove-table-row', function(){
                count--;
                $(this).parents('tr').remove();

            });


            $('#add').click(function(){
                count++;
                addDivAndSetSelectName(count);
            });


            function addDivAndSetSelectName(index){

                $('#table').append(
                    `<tr>
                        <td class="pr-4 pt-2">
                            <select name="member[`+index+`][id]" class="rounded-md xl:text-xs w-full border-zinc-400" id="member" required >
                                @foreach ($members as $id => $name )
                                <option value="{{ $id }}"
                                >{{ $name }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td class="pr-4 pt-2">
                            <select  name="member[`+index+`][type]" class="rounded-md xl:text-xs w-full border-zinc-400" required >
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
                            <button type="button" class="bg-red-500 remove-table-row text-xs text-white px-2 py-1 rounded">Remove</button>
                        </td>
                    </tr>`
                );
            }



        </script>

    @else

        <h1>404 Error</h1>

    @endrole
</x-app-layout>
