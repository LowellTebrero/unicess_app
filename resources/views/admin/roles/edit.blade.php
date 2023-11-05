<x-admin-layout>
    <div class="py-12 w-full ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">





                <!-- component -->
                <!-- This is an example component -->
                <div class="max-w-full mx-auto p-10">
                    <div class="p-6 text-gray-900 flex  justify-between">
                        {{ __("Edit Role") }}
                       <a class="bg-green-400 px-2 py-1 rounded-lg text-white hover:bg-green-700" href={{ route('admin.roles.index') }}>Back</a>
                    </div>

                    <div class="flex flex-col">
                    <div class="overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">


                    <div class="p-10  w-1/2 m-auto">
                    <form action="{{ route('admin.roles.update', $roles->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-6">



                        <label for="name" class="form-label inline-block mb-2 text-gray-700">Name</label>
                        <input type="name" name="name" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                            transition ease-in-ou m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            value="{{ $roles->name }}"
                            placeholder="Enter name">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>


                        <div class="form-group mb-6">
                        <button type="submit" class=" w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs
                        leading-tight
                        uppercase
                        rounded
                        shadow-md
                        hover:bg-blue-700 hover:shadow-lg
                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg
                        transition
                        duration-150
                        ease-in-out">Update</button>

                    </form>
                </div>



                {{--  Role and Permission Start --}}
                <div class="mt-20 pt-2">
                    <h2 class="text-3xl font-bold">Role Permissions</h2>
                </div>

                <div class="mt-10">
                    <h1 class="font-semibold mb-5">This Role has permission to:</h1>
                @if ($roles->permissions)
                    @foreach ($roles->permissions as $role_permission )

                        <form action="{{ route('admin.roles.permissions.revoke', [$roles->id, $role_permission->id]) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                            @csrf
                            @method('DELETE')
                        <div>
                            <button type="submit" class="text-red-500" href="">{{ $role_permission->name }}</button>
                        </div>
                            </form>

                    @endforeach
                @endif
                </div>
                {{--  Role and Permission End --}}



                <form action="{{ route('admin.roles.permissions', $roles->id) }}" method="POST">
                    @csrf
                    <div class="form-group mb-6 mt-5">
                    <label for="permission" class="form-label inline-block mb-2 text-gray-700"> Permission</label>
                    <select id="permission" name="permission" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded
                        transition ease-in-ou m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">@error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <option disabled selected value="disabled">Select permission</option>
                        @foreach ($permissions as $permission )
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                        @endforeach
                     </select>
                    </div>


                    <div class="form-group mb-6">
                    <button type="submit" class=" w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs
                    leading-tight
                    uppercase
                    rounded
                    shadow-md
                    hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out">Assign Permission</button>

                </form>


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
