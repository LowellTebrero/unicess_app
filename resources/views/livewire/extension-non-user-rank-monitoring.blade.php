
<div class="">

    <div class="p-3 relative">
        <div class="text-gray-700 flex w-full gap-2 ">

            <input type="text" name="search" wire:model.debounce.500ms="search" id="search" class="w-[9rem] sm:w-[10rem] text-xs  rounded border-slate-400" placeholder="Search...">

            <select class="text-xs  rounded border-slate-400 w-[8rem]" wire:model="collegesStatus">
                <option  value="">Colleges</option>
                <option  value="BSED">BSED</option>
                <option  value="CME">CME</option>
                <option  value="COE">COE</option>
                <option  value="CAS">CAS</option>
                <option  value="Graduate School">Graduate School</option>
            </select>

            <select wire:model="facultyName" name="facultyName" id="facultyName" class="w-[11rem] text-xs rounded  border-slate-400">
                @foreach ($departments as $id => $name ) <option value="{{ $id }}">{{ $name }}</option> @endforeach
            </select>


            <select wire:model="yearStatus" name="yearStatus" id="yearStatus" class="w-[6rem] text-xs rounded  border-slate-400">
                @foreach ($years as $year )
                <option value="{{ $year }}" @if ($yearStatus == date('Y')) selected="selected" @endif>{{ $year }}</option>
                @endforeach
            </select>

            <select wire:model="paginateUsers" name="paginateUsers" id="paginateUsers" class="w-[5rem] text-xs rounded  border-slate-400">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="70">70</option>
            </select>


        </div>
    </div>

    <div class="overflow-x-auto p-2 pt-0 h-[52vh] 2xl:h-[70vh] ">
        <table class="table-auto w-full border-collapse">
            <thead class="text-[.7rem] text-gray-700 uppercase sticky top-0 bg-gray-200 w-full">
                @if ($users->isNotEmpty())
                <tr>
                    <th>
                        <div><span>&nbsp;</span></div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Username</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">First Name</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Last Name</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Email</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Department</div>
                    </th>
                </tr>
                @endif

            </thead>
            <tbody>

                @php
                    $count = ($users->currentPage() - 1) * $users->perPage();
                @endphp

                @forelse ($users as $proposal )

                <tr class="hover:bg-gray-100 border ">

                    <td class="text-xs pl-2">{{ ++$count }}</td>
                    <td class="p-3 whitespace-nowrap">
                        {{-- <a href={{ route('admin.dashboard.edit-proposal',  $proposal->id) }}> --}}
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-2 sm:mr-3"><img
                                    class="rounded-full"
                                    src="{{ !empty($proposal->avatar) ? url('upload/image-folder/profile-image/' . $proposal->avatar) : url('upload/profile.png') }}"
                                    width="30" height="30">
                            </div>
                            <div class="font-medium text-gray-600 text-[.7rem]">
                                {{ $proposal->name }}
                            </div>
                        </div>
                    {{-- </a> --}}
                    </td>


                    <td class="p-3 whitespace-nowrap text-left">
                        {{-- <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}> --}}

                            <div class=" text-gray-600 text-[.6rem] xl:text-xs">
                                {{ $proposal->first_name }}
                            </div>
                        {{-- </a> --}}
                    </td>
                    <td class="p-3 whitespace-nowrap text-left">
                        {{-- <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}> --}}

                            <div class=" text-gray-600 text-[.6rem] xl:text-xs">
                                {{ $proposal->last_name }}
                            </div>
                        {{-- </a> --}}
                    </td>
                    <td class="p-3 whitespace-nowrap text-left">
                        {{-- <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}> --}}

                            <div class=" text-gray-600 text-[.6rem] xl:text-xs">
                                {{ $proposal->email }}
                            </div>
                        {{-- </a> --}}
                    </td>
                    <td class="p-3 whitespace-nowrap text-left">
                        {{-- <a href={{ route('admin.dashboard.edit-proposal', $proposal->id) }}> --}}

                            <div class=" text-gray-600 text-[.6rem] xl:text-xs">
                                {{ $proposal->faculty->name }}
                            </div>
                        {{-- </a> --}}
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
    <div class="px-4 text-xs" wire:key="paginate-users">{{ $users->links() }}</div>
</div>


