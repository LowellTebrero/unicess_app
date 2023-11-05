<x-admin-layout>

    <section class="rounded-xl shadow m-8 mt-5 p-5 text-slate-700 bg-white min-h-[87vh]">

     <h1 class=" font-semibold text-2xl tracking-wider">Others Settings Overview </h1>

        <div class="rounded-xl mt-12 h-full flex justify-around">

            <div>
                @foreach ($templates as  $template)
                <div class="mb-7 flex space-x-4">

                    <h1 class="text-green-500 text-sm">{{ $template->template_name }}</h1>
                    <a href={{ route('admin.template.download', $template->template_name) }} class="text-red-500 text-sm">Download</a>

                </div>

                <div class="bg-slate-100 rounded-xl">
                    <h1 class="text-center font-medium py-4">UPDATE HERE..</h1>
                    <form action="{{ route('admin.template.update', $template->id) }}" class="flex flex-col p-4 space-y-2" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <input type="file" class="text-sm" name="template_name">
                        @error('template_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <button type="submit" class="bg-blue-400 text-white rounded-lg px-2 py-2 text-sm font-medium">Update file</button>
                    </form>

                </div>
                @endforeach
            </div>

            <div>
                <div class=" flex items-center flex-col">
                    <h1 class="mb-2">Year Section</h1>

                    <div class="flex flex-col space-y-2 ">

                    <select>
                        @foreach ($years as $year )
                            <option>{{ $year->year }}</option>
                        @endforeach
                    </select>

                    <form action="{{ route('admin.yearpost.upload') }}" method="POST" class="flex flex-col space-y-2">
                        @csrf

                        <div class="flex flex-col">
                            <input type="text" placeholder="Add Year" name="year">
                            @error('year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded-lg">Submit</button>
                    </form>
                    </div>
                </div>
            </div>


        </div>

        <div class="rounded-xl mt-12 h-full flex justify-around">

                <div class="flex py-2 w-full justify-center flex-col items-center mt-12">

                    <div class="space-y-2">
                        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

                            <!-- Trigger for Modal -->
                            <button class="bg-blue-500 p-2 rounded-md text-white mt-10" type="button" @click="showModal = true">+ add faculty</button>

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

                        <div class=" grid grid-flow-row-dense grid-cols-6 grid-rows-6 w-full">
                            @foreach ($faculties as $faculty)

                                <div class="bg-slate-100 m-2 px-1 text-center text-sm cols rounded-lg drop-shadow">{{ $faculty->name }}</div>


                            @endforeach
                        </div>
                    </div>

                </div>
        </div>


    </section>

    <x-messages/>

</x-admin-layout>
