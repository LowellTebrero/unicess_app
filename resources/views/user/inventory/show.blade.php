<x-app-layout>
@hasanyrole('Faculty extensionist|Extension coordinator')
    <style>
        [x-cloak] { display: none }
        .upload-form button:disabled,
        .upload-form button[disabled]
        {
        border: 1px solid #999999;
        background-color: #cccccc;
        color: #666666;
        }
    </style>
        <section class="bg-white shadow rounded-xl min-h-[87vh] overflow-hidden m-8 mt-5 relative">

            <div class="bg-blue-200 bg-opacity-40 h-full absolute  z-10" id="mySidebar">
                <div class="w-[0rem] bg-gray-600 h-full transition-all" id="subSidebar">
                    <div class="p-4 w-full h-full transition-all" style="display: none" id="sidebar-title">
                        <div class="flex justify-between text-white">
                            <h1 class="tracking-wider">Options</h1>
                            <a href="javascript:void(0)" class="closebtn text-2xl" onclick="closeNav()">×</a>
                        </div>

                        <div class="py-2 space-y-2 flex flex-col transition-all ">
                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = true">

                                <!-- Trigger for Modal -->
                                <button class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" type="button" @click="showModal = true">
                                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 32 32"><path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z"/><path fill="currentColor" d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z"/></svg>
                                     Upload Proposal
                                </button>

                                <!-- Modal -->
                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40" x-show="showModal" >

                                    <!-- Modal inner -->
                                    <div class="w-1/4  text-left bg-gray-700 rounded-lg shadow-lg" x-show="showModal"
                                        x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-end px-4 rounded-tl rounded-tr py-4 pb-2 ">

                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="showModal = false">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                            </button>

                                        </div>


                                        <!-- content -->
                                        <div class="p-6 pt-2 space-y-4 flex-col flex items-center justify-center">
                                            <form action="{{ route('inventroy-update-user-proposal', $proposals->id) }}" method="POST" enctype="multipart/form-data" class="upload-form" >
                                                @csrf @method('PUT')
                                                <div class="px-5 py-1 mt-5 flex flex-col">

                                                    <div class="flex flex-col mb-4">
                                                        <label for="" class="text-sm font-light  mb-1">Proposal PDF</label>
                                                        <input type="file" name="proposal_pdf" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
                                                    </div>

                                                    <div class="flex flex-col mb-4">
                                                        <label for="" class="text-sm font-light  mb-1">Memorandum of Agreement PDF</label>
                                                        <input type="file" name="moa" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
                                                    </div>

                                                    <div class="flex flex-col  mb-4">
                                                        <label for="" class="text-sm font-light  mb-1">Other Files</label>
                                                        <input type="file" multiple name="other_files[]" class="text-xs text-slate-700 border file:bg-transparent file:border-none  file:bg-gray-100 file:mr-4 file:py-2 file:px-4">
                                                    </div>

                                                    <div class="mb-2">
                                                        <button class="bg-blue-500  text-white rounded-md p-2" type="submit" id="upload-file"disabled>Upload File</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = true">

                                <!-- Trigger for Modal -->
                                <button class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" type="button" @click="showModal = true">
                                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 32 32"><path fill="currentColor" d="M12 12h2v12h-2zm6 0h2v12h-2z"/><path fill="currentColor" d="M4 6v2h2v20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8h2V6zm4 22V8h16v20zm4-26h8v2h-8z"/></svg>
                                      Proposal Details
                                </button>

                                <!-- Modal -->
                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-40" x-show="showModal" >

                                    <!-- Modal inner -->
                                    <div class="w-1/4  text-left bg-gray-700 rounded-lg shadow-lg" x-show="showModal"
                                        x-transition:enter="motion-safe:ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-end px-4 rounded-tl rounded-tr py-4 pb-2 ">

                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="showModal = false">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                            </button>

                                        </div>


                                        <!-- content -->
                                        <div class="p-6 pt-2 space-y-4 flex-col flex items-center justify-center">
                                            <div class="w-2/1 p-4 border-r h-full">

                                                <div class="flex space-y-3 flex-col mb-2">

                                                    <div class="w-full">
                                                        <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title"> Program Title</label>
                                                        <input type="text" disabled class=" xl:text-xs  appearance-none border-b-2 border-indigo-500  rounded bg-white shadow w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                                                        value = "{{$proposals->programs->program_name}}">
                                                    </div>

                                                    <div class="w-full">

                                                        <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-xs" for="title"> Project Title</label>
                                                        <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                                                        value = "{{$proposals->project_title}}">
                                                    </div>
                                                </div>

                                                <div class="flex space-x-4 mb-2">
                                                    <div class="w-full ">

                                                        <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title"> Started date:</label>
                                                        <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                                                        value = "{{ \Carbon\Carbon::parse($proposals->started_date)->format("F-d-Y")}}">
                                                    </div>

                                                    <div class="w-full">

                                                        <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title">  Finished date:</label>
                                                        <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                                                        value = "{{ \Carbon\Carbon::parse($proposals->finished_date)->format("F-d-Y")}}">
                                                    </div>
                                                </div>

                                                <div class="flex space-x-3 mb-2">
                                                    <div class="w-full">
                                                        <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title">Project Leader</label>
                                                        <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                                                        value = "{{$proposals->project_title}}">
                                                    </div>
                                                    <div class="w-full">
                                                        <label class="block text-gray-700 text-sm font-semibold mb-1  xl:text-[.7rem]" for="title">Uploaded at:</label>
                                                        <input type="text" disabled class=" xl:text-xs shadow appearance-none border-b-2 border-indigo-500  border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="program_title" name="program_title"
                                                        value = "{{\Carbon\Carbon::parse($proposals->created_at)->format("F-d-Y")}}">
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="px-2 py-2 bg-white border w-full border-blue-600 rounded-xl text-blue-600 xl:text-[.8rem] 2xl:text-xs xl:text-xs space-x-2 flex" href={{ url('download', $proposals->id) }}>
                                <svg class="fill-white mr-1" xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 96 960 960" width="20"><path d="M220 896q-24 0-42-18t-18-42V693h60v143h520V693h60v143q0 24-18 42t-42 18H220Zm260-153L287 550l43-43 120 120V256h60v371l120-120 43 43-193 193Z"/></svg>
                                Download Zip
                            </a>

                        </div>
                    </div>
                </div>
            </div>

                <div class="flex justify-between p-4">
                    <h1 class="tracking-wider text-sm"> {{ $proposals->project_title }} </h1>
                    <a class="text-red-500 text-xl font-bold hover:bg-gray-200 focus:bg-red-200 rounded" href={{ route('inventory.index') }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <hr>



                <div class="w-full flex flex-col p-4">

                    <div class="flex justify-start pl-2 text-lg">
                        <button class="openbtn" onclick="openNav()">☰</button>
                    </div>

                    <div class="px-10">
                        @include('user.inventory.show._show-media')
                        {{--  @include('user.inventory.show._show-other-media')  --}}
                    </div>

                </div>

        </section>
        <x-messages/>




        <script>


            $('input[type=file]').change(function(){
            if($('input[type=files]').val()==''){
                $('#upload-file').attr('disabled',true)
            }
            else{
            $('#upload-file').attr('disabled',false);
            }})

            function openNav() {
                document.getElementById("mySidebar").style.width = "100%";
                document.getElementById("subSidebar").style.width = "15rem";
                document.getElementById("sidebar-title").style.display= "inline-block";
              }

            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("subSidebar").style.width = "0";
                document.getElementById("sidebar-title").style.display= "none";
              }



        </script>

    @else

        <h1>404 Error</h1>

    @endrole
</x-app-layout>
