    <style>
        [x-cloak] { display: none }
    </style>

<x-admin-layout>

    <section class="text-gray-700 p-5 rounded-lg 2xl:min-h-[80vh] m-8 mt-5 bg-white">

        <section class=" mt-4 w-[95%] mx-auto text-gray-700">

            <form action="{{ route('admin.evaluation.update', $evaluation->id) }}" method="POST">
                @csrf @method("PATCH")

                @include('admin.evaluation.show._filter_header_show')

                <div class="flex xl:flex-col 2xl:flex-row border-x border-b border-zinc-500 bg-slate-50">
                    <div class="w-full border-r border-zinc-500  p-5">
                        <h1 class=" text-md font-semibold tracking-wider">I. Administrative Work</h1>
                        @include('admin.evaluation.show._filter_chairmanship')
                        @include('admin.evaluation.show._filter_membership')
                        @include('admin.evaluation.show._filter_advisorship')
                        @include('admin.evaluation.show._filter_oics')
                        @include('admin.evaluation.show._filter_judge')
                    </div>

                    <div class="w-full p-5 ">
                        <h1 class=" text-md font-semibold tracking-wider">II. Institution Building</h1>
                        @include('admin.evaluation.show._filter_resource')
                        @include('admin.evaluation.show._filter_chairmanship_membership')
                        @include('admin.evaluation.show._filter_facilitation')
                    </div>
                </div>

                <div class="pt-12 ">
                    <div class="p-5 border-x border-t border-zinc-500 bg-slate-50">
                        <p class="font-bold">
                            B. COMMUNITY OUTREACH ---20 pts. (Ceiling Points)
                            (Should show proof of involvement e.g., TOUS.O, Certificate of Appearance/Activity Attendance
                            Monitoring Form)
                        </p>


                    </div>
                </div>

                <div class=" space-y-4 border p-6 border-zinc-500 bg-slate-50">

                    <div class="py-2">
                        <x-alpine-modal>

                            <x-slot name="scripts">
                                <div class="bg-blue-600 px-2 py-2 rounded-md text-white xl:text-xs flex">Proof of Points</div>
                            </x-slot>

                            <x-slot name="title">Proof of points as Project Leader</x-slot>

                            <!-- content -->
                            <div class="px-5 py-1 flex flex-col w-[60rem]">

                                <table  class="my-2">
                                    <thead class="">
                                        <tr>
                                            <th class="text-left text-xs font-semibold text-slate-700">Uploaded</th>
                                            <th class="text-left text-xs pl-2 font-semibold text-slate-700">Title</th>
                                            <th class="text-left text-xs pl-2 font-semibold text-slate-700">Leader Type</th>
                                            <th class="text-left text-xs font-semibold text-slate-700">Action</th>
                                          </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($evaluation->users->proposals as $props)
                                        @if ($props->leader_member_type != null)
                                        <tr class="mt-5">
                                            <td class="text-[.6rem]">{{ $props->proposal->created_at->diffForHumans() }}</td>
                                            <td class="text-xs pl-2">{{ $props->proposal->project_title }}</td>
                                            <td class="text-[.7rem] pl-2">{{ $props->ceso_role->role_name }}</td>
                                            <td class="text-[.7rem]">
                                                <a href="">
                                                <svg class="fill-gray-600" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3c1.641 0 3-1.358 3-3c0-1.641-1.359-3-3-3z"/><path fill="currentColor" d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316l-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5c-.504 1.158-2.578 5-7.926 5z"/></svg>
                                            </a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </x-alpine-modal>
                    </div>


                    <div class="flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Training Director/Coordinator - Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->training_director_local }}" name="training_director_local" type="text">
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Training Director/Coordinator - International <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->training_director_international }}" name="training_director_international" type="text">
                        </div>
                    </div>

                    <div class="flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Resource Speaker/Trainer - Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->resource_speaker_local }}" name="resource_speaker_local" type="text">
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Resource Speaker/Trainer - International <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->resource_speaker_international }}" name="resource_speaker_international" type="text">
                        </div>
                    </div>

                    <div class="flex space-x-12">
                        <div class="w-full">
                        <label class="block  text-sm font mb-2" for="username">Facilitator moderator - Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                        <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->facilitator_moderator_local }}" name="facilitator_moderator_local" type="text">
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Facilitator moderator - International <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->facilitator_moderator_international }}" name="facilitator_moderator_international" type="text">
                        </div>
                    </div>

                    <div class="flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Reactor panel member- Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->reactor_panel_member_local }}" name="reactor_panel_member_local" type="text">
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Reactor panel member- International  <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->reactor_panel_member_international }}" name="reactor_panel_member_international" type="text">
                        </div>
                    </div>

                    <div>
                        <label class="block  text-sm font mb-2" for="username">Technical Assistance/Consultancy  <span class="text-xs ">  (10 pts. per Training) </span></label>
                        <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->technical_assistance }}" name="technical_assistance"  type="text">
                    </div>

                    <div>
                        <label class="block  text-sm font mb-2" for="username">Judge  <span class="text-xs ">  (10 pts. per Training) </span></label>
                        <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->judge_community }}" name="judge_community"  type="text">
                    </div>

                    <div>
                        <label class="block  text-sm font mb-2" for="username">Commencement/Guest Speaker  <span class="text-xs ">  (10 pts. per Training) </span></label>
                        <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->commencement_guest_speaker }}" name="commencement_guest_speaker" type="text">
                    </div>
                </div>


                <div class="pt-12 pb-12 ">
                    <div class="p-8 border-t border-zinc-600 border-x bg-slate-50">
                        <p class="font-bold">
                            C. Service to the Adopted Barangay/institutions ----50 pts. (Ceiling Points)
                            (Should show proof of involvement e.g., T.O/S.O, Activity Attendance Monitoring Form)
                        </p>
                    </div>

                    <div class="w-full border border-zinc-600 p-8 bg-slate-50">

                        <div class="py-2">
                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <div class="bg-blue-600 px-2 py-2 rounded-md text-white xl:text-xs flex">Proof of Points</div>
                                </x-slot>

                                <x-slot name="title">Proof of points as Project Member</x-slot>

                                <!-- content -->
                                <div class="px-5 py-1 flex flex-col w-[60rem]">


                                    <table  class="my-2">
                                        <thead class="">
                                            <tr>
                                                <th class="text-left text-xs  font-semibold text-slate-700">Uploaded</th>
                                                <th  class="text-left text-xs pl-2  font-semibold text-slate-700">Title</th>
                                                <th  class="text-left text-xs pl-2  font-semibold text-slate-700">Member Type</th>
                                                <th  class="text-left text-xs  font-semibold text-slate-700">Action</th>
                                              </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($evaluation->users->proposals as $props)
                                            @if ($props->member_type != null)
                                            <tr class="mt-5">
                                                <td class="text-[.6rem]">{{ $props->proposal->created_at->diffForHumans() }}</td>
                                                <td class="text-xs pl-2">{{ $props->proposal->project_title }}</td>
                                                <td class="text-[.7rem] pl-2">{{ $props->member_type }}</td>
                                                <td class="text-[.7rem]">
                                                    <a href="">
                                                    <svg class="fill-gray-600" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path d="M12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3c1.641 0 3-1.358 3-3c0-1.641-1.359-3-3-3z"/><path fill="currentColor" d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316l-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5c-.504 1.158-2.578 5-7.926 5z"/></svg>
                                                </a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </x-alpine-modal>
                        </div>


                        <h1 class="text-md font-semibold mt-4">I. Participation in the extension and training per day:</h1>

                        <div class="my-4 flex flex-col space-y-4">

                            <div class="w-full">
                                <h1 class="text-sm">Coordinator/Organizer/consultants <span class="text-xs">(10 pts. per day) </span> </h1>
                                <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->coordinator_organizer_consultants }}"  name="coordinator_organizer_consultants"  type="text">
                            </div>

                            <div class="w-full">
                                <label class="block  text-sm font mb-2" for="username">Resource person/lecturer <span class="text-xs"> (8 pts. per day)  </span></label>
                                <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->resource_person_lecturer }}"  name="resource_person_lecturer"  type="text">
                            </div>


                            <div class="w-full">
                                <label class="block  text-sm font mb-2" for="username">Facilitator <span class="text-xs"> (6 pts. per day)  </span></label>
                                <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->facilitator }}"   name="facilitator" type="text">
                            </div>


                            <div class="w-full">
                                <label class="block  text-sm font mb-2" for="username">Member <span class="text-xs"> (4 pts. per day)  </span></label>
                                <input class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->member }}"  name="member"  type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <input type="text" name="status" value="evaluated" hidden="true">
                <div class="py-12">
                    <button type="submit" class="bg-blue-500 text-white px-3 w-full py-2 rounded-lg text-xl">Validate</button>
                </div>
            </form>
        </section>
    </section>
</x-admin-layout>
