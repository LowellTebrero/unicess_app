<x-app-layout>

    <section class="m-8  rounded-lg  relative mt-5 xl:min-h-[85vh] 2xl:min-h-[87vh]  bg-white text-gray-700">
        <header class="p-5 py-4 flex justify-between items-center">
            <h1 class="text-2xl tracking-wider font-semibold">Send Request Proposal</h1>
            <a href={{ route('allProposal.request-proposal-index') }} class="hover:bg-gray-200 px-1 rounded focus:bg-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </header>
        <hr>

        <div class="p-5">

            <form action={{ route('allProposal.post') }} method="POST" enctype="multipart/form-data" onsubmit="return validateSelect()" >
                @csrf
                <div class="space-y-4">
                    <div class="flex flex-col">
                        <label>Project Title:</label>
                        <select name="proposal_id" id="proposal_id" class="text-sm rounded border-zinc-400" required>
                            <option value="">Select Project title</option>
                            @foreach ($proposals as $proposal )
                                <option value="{{ $proposal->id }}"  @if ($proposal->id == old('proposal_id')) selected="selected" @endif >{{ $proposal->project_title }}</option>
                            @endforeach
                        </select>
                        @error('proposal_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-4">
                        <h1 class="tracking-wider text-xs text-gray-600 font-medium">
                            Select your type Member (choose what is applicable)
                        </h1>

                        <div class="flex space-x-4">
                            <button class="bg-green-400 text-white rounded px-2 py-1 text-xs tracking-wider focus:bg-green-600 focus:ring active:bg-green-600" type="button" onclick="showDiv('Leader_id', 'Member_id'); resetSelect('Member_id');">Leader</button>
                            <button class="bg-blue-400 text-white rounded px-2 py-1 text-xs tracking-wider focus:bg-blue-600" type="button" onclick="showDiv('Member_id', 'Leader_id'); resetSelect('Leader_id');">Member</button>
                        </div>
                        @error('leader_member_type') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                        @error('location_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror

                        <div class="flex flex-col" id="Leader_id" style="display: none">
                            <label class="tracking-wider text-xs text-green-600">Leader </label>
                            <div class="flex space-x-3">
                                <select name="leader_member_type" class="text-xs rounded-md w-full border-zinc-300" id="leader_member_type">
                                    <option value="">Select</option>
                                    @foreach ($leader_member as $id => $role_name )
                                    <option value="{{ $id }}"  @if ($id == old('leader_member_type')) selected="selected"@endif>{{ $role_name }}</option>@endforeach
                                </select>

                                <select id="location_id" type="text"  class="rounded-md text-xs w-full border-zinc-300 " name="location_id" value="{{ old('location_id') }}">
                                    @foreach ($locations as $id => $location_name ) <option value="{{ $id }}"@if ($id == old('location_id')) selected="selected" @endif>{{ $location_name }}</option>@endforeach
                                </select>

                            </div>
                        </div>

                        <div class="flex flex-col" id="Member_id" style="display: none">
                            <label class="tracking-wider text-xs  text-blue-600">Member</label>

                            <select name="member_type" class="rounded-md text-xs border-zinc-300" id="member_type">
                                <option value="">Select</option>
                                @foreach ($participation_member as $name) <option value="{{ $name }}">{{ $name }}</option> @endforeach
                            </select>
                            @error('member_type') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-5">
                            <label class="text-gray-600 tracking-wider text-xs">Upload files for reference </label>
                            <input type="file" name="files[]"  multiple class="w-full rounded-md border-zinc-300 text-xs border-z-500 border mt-2" id="file_input">
                            @error('files') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex space-x-4 pt-5">
                            <button type="submit" class="p-2 bg-blue-400 hover:bg-blue-600 rounded text-white">Upload</button>
                            <button type="button" class="cursor-pointer p-2 text-white hover:bg-red-600 rounded bg-red-400">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            {{--  <div>
                <form action={{ route('allProposal.post') }} method="POST" enctype="multipart/form-data" onsubmit="return validateSelect({{ $proposal->id }})" >
                    @csrf

                    <div class="flex flex-col space-y-5 pt-5 px-5">

                        <input type="text" name="proposal_id" value="{{$proposal->id}}" hidden>
                        <div class="">
                            <label class="text-gray-700 tracking-wider text-xs">Project Title:</label>
                            <input type="text" name="proposal_title" value="{{ $proposal->project_title }}" class="text-xs w-full rounded border-zinc-300" readOnly>
                        </div>

                        <div class="">
                            <h1 class="tracking-wider text-xs text-gray-600 font-medium">
                                Select your type Member (choose what is applicable)
                            </h1>
                        </div>

                        <div class="flex items-center justify-center space-x-4">
                            <button class="bg-green-400 text-white rounded px-2 py-1 text-xs tracking-wider focus:bg-green-600 focus:ring active:bg-green-600" type="button" onclick="showDiv('Leader_{{ $proposal->id }}', 'Member_{{ $proposal->id }}'); resetSelect('Member_{{ $proposal->id }}', '{{ $proposal->id }}');">Leader</button>
                            <button class="bg-blue-400 text-white rounded px-2 py-1 text-xs tracking-wider focus:bg-blue-600" type="button" onclick="showDiv('Member_{{ $proposal->id }}', 'Leader_{{ $proposal->id }}'); resetSelect('Leader_{{ $proposal->id }}', '{{ $proposal->id }}');">Member</button>
                        </div>

                        <div class="flex flex-col" id="Leader_{{ $proposal->id }}" style="display: none">
                            <label class="tracking-wider text-xs text-green-600">Leader </label>
                            <div class="flex space-x-3">
                                <select name="leader_member_type" class="text-xs rounded-md w-full border-zinc-300" id="leader_member_type_{{ $proposal->id }}">
                                    <option value="">Select</option>
                                    @foreach ($leader_member as $id => $role_name )
                                    <option value="{{ $id }}"  @if ($id == old('leader_member_type')) selected="selected"@endif>{{ $role_name }}</option>@endforeach
                                </select>
                                @error('leader_member_type') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror

                                <select id="location_id_{{ $proposal->id }}" type="text"  class="rounded-md text-xs w-full border-zinc-300 " name="location_id" value="{{ old('location_id') }}">
                                    @foreach ($locations as $id => $location_name ) <option value="{{ $id }}"@if ($id == old('location_id')) selected="selected" @endif>{{ $location_name }}</option>@endforeach
                                </select>
                                @error('location_id') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex flex-col" id="Member_{{ $proposal->id }}" style="display: none">
                            <label class="tracking-wider text-xs  text-blue-600">Member</label>

                            <select name="member_type" class="rounded-md text-xs border-zinc-300" id="member_type_{{ $proposal->id }}">
                                <option value="">Select</option>
                                @foreach ($participation_member as $name) <option value="{{ $name }}">{{ $name }}</option> @endforeach
                            </select>
                            @error('member_type') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-5">
                            <label class="text-gray-600 tracking-wider text-xs">Upload files for reference </label>
                            <input type="file" name="files[]"  multiple class="w-full rounded-md border-zinc-300 text-xs border-z-500 border mt-2" id="file_input_{{ $proposal->id }}">
                            @error('files') <span class="text-red-500  text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex space-x-4 pt-5">
                            <button type="submit" class="p-2 bg-blue-400 hover:bg-blue-600 rounded text-white">Upload</button>
                            <button type="button" class="cursor-pointer p-2 text-white hover:bg-red-600 rounded bg-red-400" @click="showModal = false">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>  --}}

        </div>

    </section>



</x-app-layout>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>


        function showDiv(showId, hideId) {
            document.getElementById(showId).style.display = 'flex';
            document.getElementById(hideId).style.display = 'none';
        }



        function validateSelect() {
            var leaderSelect = document.getElementById('leader_member_type');
            var memberSelect = document.getElementById('member_type');
            var fileInput = document.getElementById('file_input');


            if (leaderSelect.value === '' && memberSelect.value === '') {
                toastr.warning('Please select either Leader or Member.');
                return false;
            }

            if (fileInput.files.length === 0) {
                toastr.warning('Please upload your file for reference.');
                return false;
            }

            return true;
        }



            function resetSelect(divId) {

                var selectField = document.querySelector('#' + divId + ' select');
                var locationSelect = document.getElementById('location_id');


                selectField.selectedIndex = 0; // Reset the select field
                locationSelect.selectedIndex = 0;
            }

            // Your JavaScript code here





    </script>

