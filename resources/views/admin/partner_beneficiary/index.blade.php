<x-admin-layout>

    <section class="bg-white mt-5 m-8 h-[87vh] rounded-lg text-gray-700">
        <header class="p-4 py-2">
            <h1 class="2xl:text-2xl tracking-wider font-semibold text-gray-600">Partners/Beneficiary Section</h1>
        </header>
        <hr>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <?php flash()->addError($error); ?>
            @endforeach
        @endif

        <main class="flex flex-col m-10 space-y-12 mt-12">
            <div class="bg-white shadow p-2 rounded-lg border">
                <div class="flex justify-between mb-2">
                    <h1 class="tracking-wider">Partner Overview</h1>

                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        + Add Partner Post
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add Partner Post
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action={{ route('admin.partner.store') }} method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Title</label>
                                            <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title">
                                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Description</label>
                                            <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10"></textarea>
                                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Image</label>
                                            <input type="file" class="text-base leading-relaxed text-gray-600" name="image">
                                            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                        <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-[25vh] overflow-x-auto">
                    <table class="table-auto w-full relative">
                        <thead class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Created</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Title</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">
                                        Image
                                    </div>
                                </th>

                                <th class="p-2 whitespace-nowrap w-[10rem]">
                                    <div class="font-semibold text-center">
                                        Option
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-xs divide-y divide-gray-100 ">
                            @foreach ($partners as $partner)
                            <tr class="hover:bg-gray-100">
                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700 xl:text-[.7rem]">
                                        {{ \Carbon\Carbon::parse($partner->created_at)->format('M d, Y,  g:i:s A')}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left text-gray-700  xl:text-[.7rem]">
                                       {{Str::limit($partner->title, 100)}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700">
                                        <img class="rounded-lg" id="showImage"  src="{{ (!empty($partner->image))? url('upload/image-folder/partner-folder/'. $partner->image): url('upload/no-image.png') }}">
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap text-center w-[10rem]">
                                    <div class="text-left text-gray-700 space-x-2 flex items-center justify-center">
                                            <!-- Modal toggle -->
                                            <button data-modal-target="default-modal{{ $partner->id }}" data-modal-toggle="default-modal{{ $partner->id }}" class="block text-white bg-green-400 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-3 py-1 text-center" type="button">
                                                Edit
                                            </button>

                                            <!-- Main modal -->
                                            <div id="default-modal{{ $partner->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Edit Partner Details
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal{{ $partner->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form action={{ route('admin.partner.update', $partner->id ) }} method="POST" enctype="multipart/form-data">
                                                            @csrf @method('PATCH')
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Title</label>
                                                                    <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title" value="{{$partner->title}}">
                                                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Description</label>
                                                                    <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10">{{$partner->description}}</textarea>
                                                                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Image</label>
                                                                    <input type="file" class="text-base leading-relaxed text-gray-600" name="image">
                                                                    @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Partner</button>
                                                                <button data-modal-hide="default-modal{{ $partner->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <form action="{{ route('admin.partner.delete', $partner->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit flex jusify-center items-center">
                                                {{--  <svg class="fill-red-400" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="30"><path d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z"/></svg>  --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white shadow p-2 rounded-lg border">
                <div class="flex justify-between mb-2">
                    <h1 class="tracking-wider">Beneficiary Overview</h1>

                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal-beneficiary" data-modal-toggle="default-modal-beneficiary" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        + Add Beneficiary Post
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal-beneficiary" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add Beneficiary Post
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-beneficiary">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action={{ route('admin.beneficiary.store') }} method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Title</label>
                                            <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title">
                                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Description</label>
                                            <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10"></textarea>
                                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Image</label>
                                            <input type="file" class="text-base leading-relaxed text-gray-600" name="image">
                                            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                        <button data-modal-hide="default-modal-beneficiary" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <table class="table-auto w-full relative">
                        <thead class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Created</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Title</div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">
                                        Image
                                    </div>
                                </th>

                                <th class="p-2 whitespace-nowrap w-[10rem]">
                                    <div class="font-semibold text-center">
                                        Option
                                    </div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-xs divide-y divide-gray-100 ">
                            @foreach ($beneficiaries as $beneficiary)
                            <tr class="hover:bg-gray-100">
                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700 xl:text-[.7rem]">
                                        {{ \Carbon\Carbon::parse($beneficiary->created_at)->format('M d, Y,  g:i:s A')}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left text-gray-700  xl:text-[.7rem]">
                                       {{Str::limit($beneficiary->title, 100)}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700">
                                        <img class="rounded-lg" id="showImage"  src="{{ (!empty($beneficiary->image))? url('upload/image-folder/beneficiary-folder/'. $beneficiary->image): url('upload/no-image.png') }}">
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap text-center w-[10rem]">
                                    <div class="text-left text-gray-700 space-x-2 flex items-center justify-center">
                                            <!-- Modal toggle -->
                                            <button data-modal-target="default-modal{{ $beneficiary->id }}" data-modal-toggle="default-modal{{ $beneficiary->id }}" class="block text-white bg-green-400 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-3 py-1 text-center" type="button">
                                                Edit
                                            </button>

                                            <!-- Main modal -->
                                            <div id="default-modal{{ $beneficiary->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Edit Beneficiary Details
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal{{ $beneficiary->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form action={{ route('admin.beneficiary.update', $beneficiary->id ) }} method="POST" enctype="multipart/form-data">
                                                            @csrf @method('PATCH')
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Title</label>
                                                                    <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title" value="{{$beneficiary->title}}">
                                                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Description</label>
                                                                    <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10">{{$beneficiary->description}}</textarea>
                                                                    @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Image</label>
                                                                    <input type="file" class="text-base leading-relaxed text-gray-600" name="image">
                                                                    @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Beneficiary</button>
                                                                <button data-modal-hide="default-modal{{ $beneficiary->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <form action="{{ route('admin.beneficiary.delete', $beneficiary->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit flex jusify-center items-center">
                                                {{--  <svg class="fill-red-400" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="30"><path d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z"/></svg>  --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </main>
    </section>


</x-admin-layout>
