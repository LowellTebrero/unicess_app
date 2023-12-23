<x-admin-layout>

    @section('title', 'Role | ' . config('app.name', 'UniCESS'))

    <section class="mt-5 m-8  2xl:min-h-[87vh] bg-white rounded-lg h-[82vh]">

                    <div class="p-5 py-4 text-gray-700 text-2xl tracking-wider font-semibold flex justify-between">
                        {{ __("Name of Roles") }}
                        {{--  <a class="bg-blue-500 p-2 rounded-lg text-white hover:bg-blue-700" href={{ route('admin.roles.create') }}>Create Role</a>  --}}
                    </div>
                    <hr>
                    <div class="flex flex-col p-5 px-10">
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">
                                <table class="min-w-full divide-y divide-gray-200 table-fixed ">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                                Role Name
                                            </th>
                                            <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                                Options
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 ">
                                        @foreach ($roles as $role )

                                        <tr class="hover:bg-gray-100 ">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-700 whitespace-nowrap tracking-wider">{{ $role->name }}</td>
                                            <td class="text-left py-3 px-6">
                                                <a class=" text-blue-500 text-sm" href={{ route('admin.roles.edit', $role->id) }}>Edit Role</a>

                                                {{--  <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500" href="">Delete</button>
                                                </form>  --}}

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
</section>
<x-messages/>
</x-admin-layout>
