
<div class="rounded-lg border border-gray-200 shadow-sm m-5 overflow-x-auto h-[70vh]">
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 xl:text-xs 2xl:text-sm">
        <thead class="bg-gray-50">
            <tr class="sticky top-0 bg-gray-200 z-20">
                <th scope="col" class="px-6 py-4 font-medium ">Project Title</th>
                <th scope="col" class="px-6 py-4 font-medium ">Members</th>
                <th scope="col" class="px-6 py-4 font-medium ">Status</th>
                <th scope="col" class="px-6 py-4 font-medium w-[15rem]">Uploaded</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 border-t border-gray-100" id="searchResults">
            @foreach ($proposals as $proposal )

        <tr class="hover:bg-gray-50">

            <td class="px-6 py-4">

                <a href={{ route('allProposal.show', $proposal->id) }} class="inline-flex items-center gap-1 rounded-full py-1 text-xs  text-gray-700">
                    {{ $proposal->project_title }}
                </a>
                    {{--  @foreach ($proposal->medias as $mediaLibrary)
                    @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'proposalPdf'))
                        <div data-tooltip-target="tooltip-proposal" type="button"
                            class="relative">

                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <span class="text-[.7rem] 2xl:text-xs font-medium text-gray-700 tracking-wider">
                                        {{ Str::limit($proposal->project_title, 70) }}
                                    </span>
                                </x-slot>

                                <x-slot name="title">
                                    <span class="">{{ Str::limit($mediaLibrary->file_name) }}</span>
                                </x-slot>

                                <div class="w-[50rem]">
                                    <iframe class="2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]"
                                        src="{{ $proposal->getFirstMediaUrl('proposalPdf') }}"
                                    ></iframe>
                                </div>
                            </x-alpine-modal>
                        </div>


                    @endif
                @endforeach  --}}

            </td>

            <td class="px-4 py-4 text-sm whitespace-nowrap ">
                <div class="flex items-center">
                    @foreach ($proposal->proposal_members as $props )
                        <img class="object-cover w-6 h-6 -mx-1 border-2 border-white bg-white rounded-full  shrink-0" src="{{ (!empty($props->user->avatar))? url('upload/image-folder/profile-image/'. $props->user->avatar): url('upload/profile.png') }}" alt="">
                    @endforeach
                    {{--  <p class="flex items-center justify-center w-6 h-6 -mx-1 text-xs text-blue-600 bg-blue-100 border-2 border-white rounded-full">+4</p>  --}}
                </div>
            </td>

            <td class="px-6 py-4">
                <span class="inline-flex items-center gap-1 rounded-full py-1 text-xs  text-gray-700">
                    {{ $proposal->authorize }}
                </span>
            </td>

            <td class="px-6 py-4 flex space-x-1 justify-between">

                <span class="inline-flex items-center gap-1 rounded-full py-1 text-[.7rem] 2xl:text-xs  text-gray-700">
                    {{ \Carbon\Carbon::parse($proposal->created_at)->format("M d, Y: H:i:s")}}
                </span>

                {{--  <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false">

                    <!-- Modal -->
                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                        <!-- Modal inner -->
                        <div class="w-1/4 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                            x-transition:enter="motion-safe:ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                            <!-- Title / Close-->
                            <div class="flex items-center justify-between px-4 py-1">
                                <h5 class="mr-3 text-black max-w-none text-xs">REQUEST TO JOIN ON THIS PROPOSAL</h5>
                                <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModal = false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <hr>

                            <!-- content -->
                            <div>
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
                            </div>
                        </div>
                    </div>


                    <div x-cloak x-data="{dropdownMenu: false}" class="relative">
                        <!-- Dropdown toggle button -->
                        <button @click="dropdownMenu = ! dropdownMenu" class="tooltipButton  flex items-center p-2 rounded-md" style="display: block">
                            <svg class=" hover:fill-blue-500  fill-slate-700" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 896q-33 0-56.5-23.5T400 816q0-33 23.5-56.5T480 736q33 0 56.5 23.5T560 816q0 33-23.5 56.5T480 896Zm0-240q-33 0-56.5-23.5T400 576q0-33 23.5-56.5T480 496q33 0 56.5 23.5T560 576q0 33-23.5 56.5T480 656Zm0-240q-33 0-56.5-23.5T400 336q0-33 23.5-56.5T480 256q33 0 56.5 23.5T560 336q0 33-23.5 56.5T480 416Z"/></svg>
                        </button>
                        <!-- Dropdown list -->
                        <div x-show="dropdownMenu" class="z-50 absolute right-[0rem] top-3 py-2 mt-2 bg-white rounded-md shadow-xl w-[11.5rem] border" x-on:keydown.escape.window="dropdownMenu = false"  @click.away="dropdownMenu = false" @click="dropdownMenu = ! dropdownMenu"
                            x-transition:enter="motion-safe:ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">


                            @if ($proposalMembers->isEmpty() && $proposalRequest->isEmpty() )
                            <button type="button" @click="showModal = true">Join as member </button>
                            @endif




                        </div>
                    </div>
                </div>  --}}
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
</div>

    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

   <script>



        function showDiv(showId, hideId) {
            document.getElementById(showId).style.display = 'flex';
            document.getElementById(hideId).style.display = 'none';
        }



        function validateSelect(proposalId) {
            var leaderSelect = document.getElementById('leader_member_type_' + proposalId);
            var memberSelect = document.getElementById('member_type_' + proposalId);
            var fileInput = document.getElementById('file_input_' + proposalId);


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



            function resetSelect(divId, proposalId) {

                var selectField = document.querySelector('#' + divId + ' select');
                var locationSelect = document.getElementById('location_id_' + proposalId);


                selectField.selectedIndex = 0; // Reset the select field
                locationSelect.selectedIndex = 0;
            }

            // Your JavaScript code here





    </script>  --}}


