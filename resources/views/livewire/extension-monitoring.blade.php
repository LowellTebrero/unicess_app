

<div class="rounded-lg h-full text-gray-700 relative overflow-hidden">

    <div class="p-3 relative">

        <div class="navoption2 text-gray-700 flex w-full gap-2 ">

            <input type="text" name="search" wire:model.debounce.500ms="search" id="search" class="w-[9rem] sm:w-[10rem] text-xs  rounded border-slate-400" placeholder="Search...">

            <select class="text-xs  rounded border-slate-400 w-[8rem]" wire:model="collegesStatus">
                <option  value="">Colleges</option>
                <option  value="BSED">BSED</option>
                <option  value="CME">CME</option>
                <option  value="COE">COE</option>
                <option  value="CAS">CAS</option>
                <option  value="Graduate School">Graduate School</option>
            </select>

            <select class="text-xs  rounded border-slate-400 w-[8rem]" wire:model="status">
                <option  value="">Status</option>
                <option  value="pending">Pending</option>
                <option  value="ongoing">Ongoing</option>
                <option  value="finished">Finished</option>
            </select>



            <select class="text-xs  rounded border-slate-400 w-[6rem]" wire:model="activationStatus">
                <option  value="">Activation Status</option>
                <option  value="active">Active</option>
                <option  value="inactive">Inactive</option>
            </select>



            <select wire:model="semester" name="semester" id="semester" class="w-[7rem] text-xs rounded  border-slate-400">
                <option  value="">Semester</option>
                <option value="1">1st Semester</option>
                <option value="2">2nd Semester</option>
            </select>

            <select wire:model="yearStatus" name="yearStatus" id="yearStatus" class="w-[6rem] text-xs rounded  border-slate-400">
                @foreach ($years as $year )
                <option value="{{ $year }}" @if ($yearStatus == date('Y')) selected="selected" @endif>{{ $year }}</option>
                @endforeach
            </select>

            <select wire:model="date" name="date" id="date" class="w-[7rem] text-xs rounded border-slate-400">
                <option value="">Anytime</option>
                <option value="week">Older than a week</option>
                <option value="month">Older than a month</option>
                <option value="six_months">Older than six months</option>
                <option value="year">Older than a year</option>
            </select>


            <select wire:model="paginate" name="paginate" id="paginate" class="w-[5rem] text-xs rounded  border-slate-400">
                <option value="12">12</option>
                <option value="50">50</option>
                <option value="70">70</option>
            </select>


        </div>

    </div>


    <div class="overflow-x-auto p-2 pt-0 h-[62vh] 2xl:h-[75vh] ">
        <table class="table-auto w-full border-collapse">
            <thead class="text-[.7rem] text-gray-700 uppercase sticky top-0 bg-gray-200 w-full">
                @if ($allProposal->isNotEmpty())
                 <tr>
                    <th>
                        <div><span>&nbsp;</span></div>

                    </th>

                    <th class="p-2 whitespace-nowrap hidden 2xl:block">
                        <div class="font-semibold text-left ">Uploader</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Extension Program of Projects</div>
                    </th>

                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">Colleges</div>
                    </th>
                    <th class="p-2 whitespace-nowrap hidden sm:block">
                        <div class="font-semibold text-left">Uploaded</div>
                    </th>
                    <th class="py-2 whitespace-nowrap w-[1rem]">
                        <div class="font-semibold text-center"></div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Status</div>
                    </th>
                </tr>
                @endif

            </thead>
            <tbody>

                @php
                    $count = ($allProposal->currentPage() - 1) * $allProposal->perPage();
                @endphp

                @forelse ($allProposal as $index => $proposal )

                <tr class="hover:bg-gray-100 border ">

                    <td class="text-xs pl-2">{{ ++$count }}</td>
                    <td class="p-3 whitespace-nowrap hidden 2xl:block">
                        <a href={{ route('admin.dashboard.edit-proposal',  $proposal->id) }}>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                    class="rounded-full"
                                    src="{{ !empty($proposal->user->avatar) ? url('upload/image-folder/profile-image/' . $proposal->user->avatar) : url('upload/profile.png') }}"
                                    width="30" height="30">
                            </div>
                            <div class="font-medium text-gray-600 text-[.7rem]">
                                {{ $proposal->user->first_name }}
                            </div>
                        </div>
                    </a>
                    </td>
                    <td class="p-3 whitespace-nowrap">
                        <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>

                            <div class="text-left text-gray-600 text-[.6rem] xl:text-xs">
                                {{ Str::limit($proposal->project_title, 70) }}
                            </div>
                        </a>
                    </td>

                    <td class="p-3 whitespace-nowrap text-center">
                        <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>

                            <div class=" text-gray-600 text-[.6rem] xl:text-xs">
                                {{ $proposal->colleges_name }}
                            </div>
                        </a>
                    </td>

                    <td class="p-3 whitespace-nowrap  hidden sm:block">
                        <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>
                        {{--  <div class="text-left text-gray-600  text-[.6rem] xl:text-[.7rem]">
                            {{ \Carbon\Carbon::parse($proposal->created_at)->format('M d, Y,  g:i:s A')}}
                        </div>  --}}
                        <div class="text-left text-gray-600  text-[.6rem] xl:text-[.7rem]">
                            {{ $proposal->created_at->diffForHumans()}}
                        </div>
                        </a>
                    </td>


                    <td class="py-3 whitespace-nowrap w-[1rem]">
                        <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>
                        @if ($proposal->status == 'inactive')
                            <div
                                class="text-md text-center text-red-700 text-[.6rem] xl:text-xs flex items-center justify-start space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path fill="#ff5757" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2"/></svg>

                            </div>


                        @elseif ($proposal->status == 'active')
                        <div
                        class="text-md text-center text-green-700 text-[.6rem] xl:text-xs flex items-center justify-start  space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path fill="#04dc3a" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2"/></svg>

                    </div>
                        @endif
                        </a>
                    </td>
                    <td class="p-3 pl-0 whitespace-nowrap">
                        <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}>
                        @if ($proposal->authorize == 'pending')
                            <div
                                class="text-md text-center  text-[.6rem] xl:text-xs ">
                                {{ $proposal->authorize }}</div>
                        @elseif ($proposal->authorize == 'ongoing')
                            <div
                                class="text-md text-center  text-[.6rem] xl:text-xs ">
                                {{ $proposal->authorize }}</div>
                        @elseif ($proposal->authorize == 'finished')
                            <div
                                class="text-md text-center text-[.6rem] xl:text-xs ">
                                {{ $proposal->authorize }}</div>
                        @endif
                        </a>
                    </td>

                </tr>
                @empty
                    <tr colspan="12">
                        <td class="text-lg">
                            <div class="h-[45vh] 2xl:h-[52vh] flex flex-col items-center justify-center space-y-2">
                                <img class="w-[13rem]" src="{{ asset('img/Empty.jpg') }}">
                                <h1 class="text-md text-gray-500">Not Found!</h1>
                            </div>
                        </td>

                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    <div class="px-4 text-xs">{{ $allProposal->links() }}</div>
</div>


    <script>

        function openNav() {

            document.getElementById("nav").style.width = "10rem";

        }
        function closeNav() {

            document.getElementById("nav").style.width = "0";
        }
    </script>
