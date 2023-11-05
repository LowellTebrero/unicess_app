<x-admin-layout>
    <div class="py-12 w-full ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <!-- component -->
                <!-- This is an example component -->
                <div class="max-w-full mx-auto p-10">
                    <div class="p-6 text-gray-900 flex  justify-between">
                        {{ __("Admin Permissions") }}
                       <a class="bg-blue-500 p-2 rounded-lg text-white hover:bg-blue-700" href={{ route('admin.permissions.create') }}>Create Permission</a>
                    </div>

                    <div class="flex flex-col">
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">
                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Product Name
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Options
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        @foreach ($permissions as $permission )

                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $permission->name }}</td>
                                            <td class="flex space-x-3 items-center py-5 ">
                                                <a class="text-blue-500" href={{ route('admin.permissions.edit', $permission->id) }}>Edit</a>

                                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500" href="">Delete</button>
                                                </form>

                                            </td>
                                        </tr>

                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <x-messages/>

                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
