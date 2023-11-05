<div>

    <style>
        [x-cloak] { display: none }
    </style>
<section class="antialiased  text-gray-600 pt-10 px-4 w-full overflow-hidden mt-16">
<div class="flex flex-col justify-center">


    <!-- Table -->
    <div class="w-full  mx-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <header class="px-5 py-4 border-b border-gray-100 flex justify-between">
            <h2 class="font-semibold text-gray-800">Faculty User</h2>
            <a href={{ route('admin.faculty.manage-faculty') }} class="bg-blue-500 xl:text-sm text-white px-2 py-2 rounded-lg">+ Manage Faculty</a>

        </header>
        <div class="p-3 w-full">

            <form>
                <div class="flex flex-row bg- justify-end space-x-2 py-2">
                <div class="">
                    <div class ="flex justify-center items-center relative overflow-hidden  border">
                        <input type="text" name="search" wire:model.debounce.500ms="search" id="search" class="xl:text-sm border-slate-500 rounded" placeholder="Search...">


                        <select name="" id="" class="border-slate-200 xl:text-sm rounded" wire:model="selectedFaculty">
                            @foreach ($faculties as $id => $name )
                                <option value="{{ $id }}" >{{ $name }} </option>
                            @endforeach
                        </select>

                    </div>

                </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">First Name</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Middle Name</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Last Name</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Email</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Faculty</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Role</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse ($users as $user )
                        <tr>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">

                                    <div class="font-medium text-gray-800">{{ $user->first_name }} </div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">

                                    <div class="font-medium text-gray-800"> {{ $user->middle_name }}</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex items-center">

                                    <div class="font-medium text-gray-800">{{ $user->last_name }}</div>
                                </div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left">{{ $user->email }}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="text-left font-medium text-green-500">{{ $user->faculty->name }}</div>
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class=" text-center">
                                    @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $role )
                                    <span class="block my-2   p-1 rounded-lg ">{{ $role }}</span>
                                    @endforeach
                                    @endif
                            </div>
                            </td>
                            @empty
                            <td class="text-red-500">No record found</td>
                        </tr>

                        @endforelse


                    </tbody>
                </table>
            </div>
            <div class="p-2">{{ $users->links() }}</div>
        </div>
    </div>
</div>
</section>

<x-messages/>





</div>
