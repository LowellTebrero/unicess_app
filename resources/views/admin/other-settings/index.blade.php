<x-admin-layout>

    <style>
        [x-cloak] { display: none}
    </style>

    @section('title', 'Other | ' . config('app.name', 'UniCESS'))

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <?php flash()->addError($error); ?>
        @endforeach
    @endif

    <section class="rounded-xl shadow m-8 mt-5 text-slate-700 bg-white h-[82vh] 2xl:min-h-[87vh]">

        <div class="p-5 py-4">
            <h1 class=" font-semibold  text-lg 2xl:text-2xl tracking-wider">Others Settings </h1>
        </div>
        <hr>
        <div class="flex">
            <div class="m-5 w-1/2 flex flex-col  space-y-6 p-5 pt-0 2xl:p-10 ">
                <div class="w-full bg-white border shadow-sm  rounded-lg text-gray-700 mt-0">


                    <div class="p-5 flex justify-between">
                        <div>
                            <h1 class="tracking-wider font-medium text-gray-600 text-xs 2xl:text-base">UPDATE PROPOSAL TEMPLATE HERE</h1>

                        </div>

                            @if ($templates->isEmpty())

                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Upload File
                            </button>
                            @else

                            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Add File(s)
                            </button>
                            @endif


                            <!-- Main modal -->
                            <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                               Upload Template File(s)
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action={{ route('admin.templatepost.upload') }} method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="p-4 space-y-4 flex flex-col">

                                                <label class="text-sm 2xl:text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                    Upload template file here...
                                                </label>
                                                <input type="file" multiple name="template_file[]"  class="text-sm 2xl:text-base border leading-relaxed text-white">

                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="Submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit here</button>
                                                <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <hr>
                    <div class="p-4">

                        @foreach ($templates as $template )
                          @foreach ($template->medias as $media )
                          <div class="flex justify-between space-y-2">
                            <h1>{{ $media->file_name }}</h1>
                            <div class="flex space-x-2 ">
                                <a href={{ url('download-media', $media->id) }} class="text-white bg-green-400 rounded-lg px-2 py-1 text-xs">Download</a>
                                <form action={{ route('admin.template.delete', ['id' => $media->id, 'templateId' => $template->id]) }} method="POST" onsubmit="return confirm ('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button class="text-white bg-red-400 rounded-lg px-2 py-1 text-xs" type="submit">Delete</button>
                                </form>

                            </div>
                          </div>
                          @endforeach
                        @endforeach

                    </div>

                </div>


                <div class="w-full bg-white border rounded-lg shadow-sm">
                    <div class="p-5 flex justify-between">
                        <h1 class="tracking-wider font-medium text-gray-600 text-xs 2xl:text-base">UPDATE YEAR HERE...</h1>
                        <h1 class="tracking-wider text-xs">Example: (2008)</h1>
                    </div>

                    <hr>

                    <div class="flex flex-col space-y-2 p-5">

                    <select class="rounded border-gray-500 border  text-xs 2xl:text-sm text-gray-700">
                        @foreach ($years as $year )
                            <option>{{ $year->year }}</option>
                        @endforeach
                    </select>

                    <form action="{{ route('admin.yearpost.upload') }}" method="POST" class="flex flex-col space-y-3">
                        @csrf

                        <div class="flex flex-col">
                            <input type="text" placeholder="Add Year" name="year" class="rounded text-xs 2xl:text-sm text-gray-700" onkeypress="return isNumber(event)" maxlength="4">
                            @error('year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-lg text-sm">Submit Year</button>
                    </form>
                    </div>
                </div>

            </div>

            <div class="flex w-7/12 p-4 ">

                    <div class="flex py-2  flex-col  w-full">

                        <div class="space-y-2">
                            <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

                                <!-- Trigger for Modal -->
                                <div class="flex justify-between items-center pb-4">
                                    <h1 class="tracking-wider text-gray-600 font-medium">FACULTY NAME</h1>
                                    <button class="bg-blue-400 hover:bg-blue-500 p-2 rounded-lg text-white text-sm" type="button" @click="showModal = true">+ Add faculty</button>
                                </div>


                                <!-- Modal -->
                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal" id="add_post_modal"  >

                                <!-- Modal inner -->
                                    <div class="w-1/4 px-6 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                                        x-show="showModal"
                                        x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        @click.away="showModal = false">

                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-between mb-10 ">
                                            <h5 class="mr-3 text-black max-w-none">Add Faculty</h5>

                                            <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>


                                        <!-- content -->
                                        <div class="w-full">

                                            <form x-on:company-added.window="showModal = false"  class="w-full" method="POST" action="{{ route('admin.facultypost.upload') }}" >
                                                @csrf
                                                <div class="mb-3 w-full">
                                                    <label class="text-gray-500" for="name">Faculty name:</label>
                                                    <input type="text" wire:model="name" name="name" class="w-full rounded-md outline-none outline-0">
                                                    @error('name') <span class="text-red-500 text-center text-xs">{{ $message }}</span> @enderror
                                                </div>

                                                <div class="w-full">
                                                    <button class="bg-blue-500 text-white p-2 rounded-md w-full"  type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="overflow-x-auto h-[60vh] 2xl:h-[70vh] bg-white border rounded-lg">
                            <table class="table-auto w-full border-collapse">
                                <thead class="text-xs font-semibold uppercase text-gray-400">
                                    <tr class="sticky top-0 w-full bg-gray-50">

                                        <th class="p-2">
                                            <div class="text-left font-semibold">Faculty Name</div>
                                        </th>
                                        <th class="p-2">
                                            <div class="text-left font-semibold">Created</div>
                                        </th>


                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 text-sm ">

                                    @foreach ($faculties as $faculty)
                                    <tr>
                                        <td class="p-2">
                                            <div class="text-gray-600 text-xs 2xl:text-md">{{ $faculty->name }}</div>
                                        </td>
                                        <td class="p-2">
                                            <div class="text-left text-gray-600 text-xs 2xl:text-md">{{ $faculty->created_at->diffForHumans() }}</div>
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

    {{--  Phone Number Javascript  --}}
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
