    <style>
        [x-cloak] { display: none }
        #scrollButtonContainer {
            transition: opacity 2s ease-in-out;
        }

        #scrollButtonContainer.hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>

<x-admin-layout>

    <div id="scrollButtonContainer">
        <button id="scrollToBottom" class="fixed bg-blue-500 shadow-md hover:bg-blue-700 hover:shadow-gray-700 border px-2 py-2 rounded-full z-20 bottom-5 right-4 hover:scale-110 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" fill-rule="evenodd" d="M12 3.25a.75.75 0 0 1 .75.75v14.19l4.72-4.72a.75.75 0 1 1 1.06 1.06l-6 6a.75.75 0 0 1-1.06 0l-6-6a.75.75 0 1 1 1.06-1.06l4.72 4.72V4a.75.75 0 0 1 .75-.75" clip-rule="evenodd"/></svg>
        </button>
    </div>


    <section class="text-gray-700 p-5 rounded-lg m-8 mt-5 bg-white relative">



        <section class="mt-4 w-[95%] mx-auto text-gray-700">

            <form action="{{ route('admin.evaluation.update', $evaluation->id) }}" method="POST">
                @csrf @method("PATCH")

                @include('admin.evaluation.show._filter_header_show')

                <div class="flex flex-col xl:flex-row border-x border-b border-zinc-500 bg-slate-50">
                    <div class="w-full border-r border-zinc-500  p-5">
                        <h1 class=" text-md font-semibold tracking-wider">I. Administrative Work</h1>
                        @include('admin.evaluation.show._filter_chairmanship')
                        @include('admin.evaluation.show._filter_membership')
                        @include('admin.evaluation.show._filter_advisorship')
                        @include('admin.evaluation.show._filter_oics')
                        @include('admin.evaluation.show._filter_judge')
                    </div>

                    <div class="w-full p-5 ">
                        <h1 class=" text-md font-semibold tracking-wider">II. Institution Building</h1>
                        @include('admin.evaluation.show._filter_resource')
                        @include('admin.evaluation.show._filter_chairmanship_membership')
                        @include('admin.evaluation.show._filter_facilitation')
                    </div>
                </div>

                <div class="pt-12 ">
                    <div class="p-5 border-x border-t border-zinc-500 bg-slate-50">
                        <p class="font-bold">
                            B. COMMUNITY OUTREACH ---20 pts. (Ceiling Points)
                            (Should show proof of involvement e.g., TOUS.O, Certificate of Appearance/Activity Attendance
                            Monitoring Form)
                        </p>


                    </div>
                </div>

                <div class=" space-y-4 border p-6 border-zinc-500 bg-slate-50">

                    <div class="flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Training Director/Coordinator - Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="training_director_local" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->training_director_local }}" name="training_director_local" type="text">
                            <div class="py-2 training_director_locals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->training_director_locals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->training_director_locals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->training_director_locals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->training_director_locals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Training Director/Coordinator - International <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="training_director_international" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->training_director_international }}" name="training_director_international" type="text">
                            <div class="py-2 training_director_internationals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->training_director_internationals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->training_director_internationals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->training_director_internationals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->training_director_internationals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Resource Speaker/Trainer - Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="resource_speaker_local" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->resource_speaker_local }}" name="resource_speaker_local" type="text">
                            <div class="py-2 resource_speaker_locals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->resource_speaker_locals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->resource_speaker_locals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->resource_speaker_locals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->resource_speaker_locals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Resource Speaker/Trainer - International <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="resource_speaker_international" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->resource_speaker_international }}" name="resource_speaker_international" type="text">
                            <div class="py-2 resource_speaker_internationals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->resource_speaker_internationals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->resource_speaker_internationals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->resource_speaker_internationals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->resource_speaker_internationals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Facilitator moderator - Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="facilitator_moderator_local" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->facilitator_moderator_local }}" name="facilitator_moderator_local" type="text">
                            <div class="py-2 facilitator_moderator_locals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->facilitator_moderator_locals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->facilitator_moderator_locals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->facilitator_moderator_locals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->facilitator_moderator_locals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Facilitator moderator - International <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="facilitator_moderator_international" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->facilitator_moderator_international }}" name="facilitator_moderator_international" type="text">
                            <div class="py-2 facilitator_moderator_internationals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->facilitator_moderator_internationals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->facilitator_moderator_internationals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->facilitator_moderator_internationals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->facilitator_moderator_internationals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-12">
                        <div class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Reactor panel member- Local/National <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="reactor_panel_member_local" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->reactor_panel_member_local }}" name="reactor_panel_member_local" type="text">
                            <div class="py-2 reactor_panel_member_locals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->reactor_panel_member_locals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->reactor_panel_member_locals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->reactor_panel_member_locals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->reactor_panel_member_locals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>

                        <div  class="w-full">
                            <label class="block  text-sm font mb-2" for="username">Reactor panel member- International  <span class="text-xs xl:block 2xl:inline-block">  (10 pts. per Training) </span></label>
                            <input onkeypress="return isNumber(event)" id="reactor_panel_member_international" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->reactor_panel_member_international }}" name="reactor_panel_member_international" type="text">
                            <div class="py-2 reactor_panel_member_internationals">
                                <x-alpine-modal>

                                    <x-slot name="scripts">
                                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                    </x-slot>

                                    <x-slot name="title">Proof of file</x-slot>

                                    <!-- content -->
                                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                        <div class="bg-blue-600 w-full rounded-lg">
                                            @foreach ($evaluation->evaluationfile as $image)
                                            @if ($image->reactor_panel_member_internationals !== null)
                                                <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                    {{--  Modal Starts here  --}}
                                                    <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                        <!-- Trigger for Modal -->

                                                        <!-- Modal -->
                                                        <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                            <!-- Modal inner -->
                                                            <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                <!-- Title / Close-->
                                                                <div class="flex items-center justify-between px-4 py-1">
                                                                    <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                </div>
                                                                <hr>

                                                                <!-- content -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-alpine-modal>

                                                        <x-slot name="scripts">
                                                            <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                @endif

                                                                <div class="text-xs ml-2 text-left">
                                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->reactor_panel_member_internationals) }}</span>
                                                                </div>
                                                            </div>
                                                        </x-slot>
                                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->reactor_panel_member_internationals) }}</span></x-slot>
                                                        <div class="w-[70rem]">
                                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->reactor_panel_member_internationals))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                        </div>
                                                    </x-alpine-modal>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </x-alpine-modal>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block  text-sm font mb-2" for="username">Technical Assistance/Consultancy  <span class="text-xs ">  (10 pts. per Training) </span></label>
                        <input onkeypress="return isNumber(event)" id="techinical_assistance" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->technical_assistance }}" name="technical_assistance"  type="text">
                        <div class="py-2 techinical_assistances">
                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                </x-slot>

                                <x-slot name="title">Proof of file</x-slot>

                                <!-- content -->
                                <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                    <div class="bg-blue-600 w-full rounded-lg">
                                        @foreach ($evaluation->evaluationfile as $image)
                                        @if ($image->technical_assistances !== null)
                                            <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                {{--  Modal Starts here  --}}
                                                <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                    <!-- Trigger for Modal -->

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                        <!-- Modal inner -->
                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                            </div>
                                                            <hr>

                                                            <!-- content -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <x-alpine-modal>

                                                    <x-slot name="scripts">
                                                        <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                            @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                            <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                            @else
                                                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                            @endif

                                                            <div class="text-xs ml-2 text-left">
                                                                <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->technical_assistances) }}</span>
                                                            </div>
                                                        </div>
                                                    </x-slot>
                                                    <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->technical_assistances) }}</span></x-slot>
                                                    <div class="w-[70rem]">
                                                        <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->technical_assistances))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                    </div>
                                                </x-alpine-modal>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </x-alpine-modal>
                        </div>
                    </div>

                    <div>
                        <label class="block  text-sm font mb-2" for="username">Judge  <span class="text-xs ">  (10 pts. per Training) </span></label>
                        <input onkeypress="return isNumber(event)" id="judge_community" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->judge_community }}" name="judge_community"  type="text">
                        <div class="py-2 judge_communitys">
                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                </x-slot>

                                <x-slot name="title">Proof of file</x-slot>

                                <!-- content -->
                                <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                    <div class="bg-blue-600 w-full rounded-lg">
                                        @foreach ($evaluation->evaluationfile as $image)
                                        @if ($image->judge_communitys !== null)
                                            <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                {{--  Modal Starts here  --}}
                                                <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                    <!-- Trigger for Modal -->

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                        <!-- Modal inner -->
                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                            </div>
                                                            <hr>

                                                            <!-- content -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <x-alpine-modal>

                                                    <x-slot name="scripts">
                                                        <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                            @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                            <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                            @else
                                                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                            @endif

                                                            <div class="text-xs ml-2 text-left">
                                                                <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->judge_communitys) }}</span>
                                                            </div>
                                                        </div>
                                                    </x-slot>
                                                    <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->judge_communitys) }}</span></x-slot>
                                                    <div class="w-[70rem]">
                                                        <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->judge_communitys))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                    </div>
                                                </x-alpine-modal>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </x-alpine-modal>
                        </div>
                    </div>

                    <div>
                        <label class="block  text-sm font mb-2" for="username">Commencement/Guest Speaker  <span class="text-xs ">  (10 pts. per Training) </span></label>
                        <input onkeypress="return isNumber(event)" id="commencement_guest_speaker" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->commencement_guest_speaker }}" name="commencement_guest_speaker" type="text">
                        <div class="py-2 commencement_guest_speakers">
                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                </x-slot>

                                <x-slot name="title">Proof of file</x-slot>

                                <!-- content -->
                                <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                    <div class="bg-blue-600 w-full rounded-lg">
                                        @foreach ($evaluation->evaluationfile as $image)
                                        @if ($image->commencement_guest_speakers !== null)
                                            <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                {{--  Modal Starts here  --}}
                                                <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                    <!-- Trigger for Modal -->

                                                    <!-- Modal -->
                                                    <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                        <!-- Modal inner -->
                                                        <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                            x-transition:enter="motion-safe:ease-out duration-300"
                                                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                            <!-- Title / Close-->
                                                            <div class="flex items-center justify-between px-4 py-1">
                                                                <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                            </div>
                                                            <hr>

                                                            <!-- content -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <x-alpine-modal>

                                                    <x-slot name="scripts">
                                                        <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                            @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                            <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                            @else
                                                            <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                            @endif

                                                            <div class="text-xs ml-2 text-left">
                                                                <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->commencement_guest_speakers) }}</span>
                                                            </div>
                                                        </div>
                                                    </x-slot>
                                                    <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->commencement_guest_speakers) }}</span></x-slot>
                                                    <div class="w-[70rem]">
                                                        <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->commencement_guest_speakers))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                    </div>
                                                </x-alpine-modal>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </x-alpine-modal>
                        </div>
                    </div>
                </div>


                <div class="pt-12 pb-12 ">
                    <div class="p-8 border-t border-zinc-600 border-x bg-slate-50">
                        <p class="font-bold">
                            C. Service to the Adopted Barangay/institutions ----50 pts. (Ceiling Points)
                            (Should show proof of involvement e.g., T.O/S.O, Activity Attendance Monitoring Form)
                        </p>
                    </div>

                    <div class="w-full border border-zinc-600 p-8 bg-slate-50">


                        <h1 class="text-md font-semibold mt-4">I. Participation in the extension and training per day:</h1>

                        <div class="my-4 flex flex-col space-y-4">

                            <div class="w-full">
                                <h1 class="text-sm">Coordinator/Organizer/consultants <span class="text-xs">(10 pts. per day) </span> </h1>
                                <input onkeypress="return isNumber(event)" id="coordinator_organizer_consultants" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->coordinator_organizer_consultants }}"  name="coordinator_organizer_consultants"  type="text">
                                <div class="py-2 coordinator_organizer_consultantses">
                                    <x-alpine-modal>

                                        <x-slot name="scripts">
                                            <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                        </x-slot>

                                        <x-slot name="title">Proof of file</x-slot>

                                        <!-- content -->
                                        <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                            <div class="bg-blue-600 w-full rounded-lg">
                                                @foreach ($evaluation->evaluationfile as $image)
                                                @if ($image->coordinator_organizer_consultantses !== null)
                                                    <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                        {{--  Modal Starts here  --}}
                                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                            <!-- Trigger for Modal -->

                                                            <!-- Modal -->
                                                            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                                <!-- Modal inner -->
                                                                <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                    x-transition:enter="motion-safe:ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                    <!-- Title / Close-->
                                                                    <div class="flex items-center justify-between px-4 py-1">
                                                                        <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                        <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                    </div>
                                                                    <hr>

                                                                    <!-- content -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <x-alpine-modal>

                                                            <x-slot name="scripts">
                                                                <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                    @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                    <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                    @else
                                                                    <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                    @endif

                                                                    <div class="text-xs ml-2 text-left">
                                                                        <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->coordinator_organizer_consultantses) }}</span>
                                                                    </div>
                                                                </div>
                                                            </x-slot>
                                                            <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->coordinator_organizer_consultantses) }}</span></x-slot>
                                                            <div class="w-[70rem]">
                                                                <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->coordinator_organizer_consultantses))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                            </div>
                                                        </x-alpine-modal>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </x-alpine-modal>
                                </div>
                            </div>

                            <div class="w-full">
                                <label class="block  text-sm font mb-2" for="username">Resource person/lecturer <span class="text-xs"> (8 pts. per day)  </span></label>
                                <input onkeypress="return isNumber(event)" id="resource_person_lecturer" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->resource_person_lecturer }}"  name="resource_person_lecturer"  type="text">
                                <div class="py-2 resource_person_lecturers">
                                    <x-alpine-modal>

                                        <x-slot name="scripts">
                                            <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                        </x-slot>

                                        <x-slot name="title">Proof of file</x-slot>

                                        <!-- content -->
                                        <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                            <div class="bg-blue-600 w-full rounded-lg">
                                                @foreach ($evaluation->evaluationfile as $image)
                                                @if ($image->resource_person_lecturers !== null)
                                                    <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                        {{--  Modal Starts here  --}}
                                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                            <!-- Trigger for Modal -->

                                                            <!-- Modal -->
                                                            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                                <!-- Modal inner -->
                                                                <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                    x-transition:enter="motion-safe:ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                    <!-- Title / Close-->
                                                                    <div class="flex items-center justify-between px-4 py-1">
                                                                        <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                        <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                    </div>
                                                                    <hr>

                                                                    <!-- content -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <x-alpine-modal>

                                                            <x-slot name="scripts">
                                                                <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                    @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                    <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                    @else
                                                                    <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                    @endif

                                                                    <div class="text-xs ml-2 text-left">
                                                                        <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->resource_person_lecturers) }}</span>
                                                                    </div>
                                                                </div>
                                                            </x-slot>
                                                            <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->resource_person_lecturers) }}</span></x-slot>
                                                            <div class="w-[70rem]">
                                                                <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->resource_person_lecturers))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                            </div>
                                                        </x-alpine-modal>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </x-alpine-modal>
                                </div>
                            </div>


                            <div class="w-full">
                                <label class="block  text-sm font mb-2" for="username">Facilitator <span class="text-xs"> (6 pts. per day)  </span></label>
                                <input onkeypress="return isNumber(event)" id="facilitator" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->facilitator }}"   name="facilitator" type="text">
                                <div class="py-2 facilitators">
                                    <x-alpine-modal>

                                        <x-slot name="scripts">
                                            <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                        </x-slot>

                                        <x-slot name="title">Proof of file</x-slot>

                                        <!-- content -->
                                        <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                            <div class="bg-blue-600 w-full rounded-lg">
                                                @foreach ($evaluation->evaluationfile as $image)
                                                @if ($image->facilitators !== null)
                                                    <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                        {{--  Modal Starts here  --}}
                                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                            <!-- Trigger for Modal -->

                                                            <!-- Modal -->
                                                            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                                <!-- Modal inner -->
                                                                <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                    x-transition:enter="motion-safe:ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                    <!-- Title / Close-->
                                                                    <div class="flex items-center justify-between px-4 py-1">
                                                                        <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                        <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                    </div>
                                                                    <hr>

                                                                    <!-- content -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <x-alpine-modal>

                                                            <x-slot name="scripts">
                                                                <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                    @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                    <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                    @else
                                                                    <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                    @endif

                                                                    <div class="text-xs ml-2 text-left">
                                                                        <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->facilitators) }}</span>
                                                                    </div>
                                                                </div>
                                                            </x-slot>
                                                            <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->facilitators) }}</span></x-slot>
                                                            <div class="w-[70rem]">
                                                                <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->facilitators))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                            </div>
                                                        </x-alpine-modal>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </x-alpine-modal>
                                </div>
                            </div>


                            <div class="w-full">
                                <label class="block  text-sm font mb-2" for="username">Member <span class="text-xs"> (4 pts. per day)  </span></label>
                                <input onkeypress="return isNumber(event)" id="member" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->member }}"  name="member"  type="text">
                                <div class="py-2 members">
                                    <x-alpine-modal>

                                        <x-slot name="scripts">
                                            <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                                        </x-slot>

                                        <x-slot name="title">Proof of file</x-slot>

                                        <!-- content -->
                                        <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                                            <div class="bg-blue-600 w-full rounded-lg">
                                                @foreach ($evaluation->evaluationfile as $image)
                                                @if (!empty($image->members))
                                                    <div class="bg-white  flex w-full  xl:w-[30rem] rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

                                                        {{--  Modal Starts here  --}}
                                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="absolute right-0 top-1" >

                                                            <!-- Trigger for Modal -->

                                                            <!-- Modal -->
                                                            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                                                                <!-- Modal inner -->
                                                                <div class="w-1/4 py-4 text-left bg-white rounded-lg -lg" x-show="showModal"
                                                                    x-transition:enter="motion-safe:ease-out duration-300"
                                                                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = true">

                                                                    <!-- Title / Close-->
                                                                    <div class="flex items-center justify-between px-4 py-1">
                                                                        <h5 class="mr-3 text-black max-w-none text-xs">Rename file</h5>
                                                                        <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                                    </div>
                                                                    <hr>

                                                                    <!-- content -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <x-alpine-modal>

                                                            <x-slot name="scripts">
                                                                <div class="flex p-5 xl:p-3 2xl:p-5 ">

                                                                    @if ($image->mime_type == 'image/jpeg' || $image->mime_type == 'image/png' || $image->mime_type == 'image/jpg')
                                                                    <img src="{{ asset('img/image-icon.png') }}" class="2xl:w-[2.5rem]" width="30">
                                                                    @else
                                                                    <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2.5rem] xl:w-[1.5rem]" width="30">
                                                                    @endif

                                                                    <div class="text-xs ml-2 text-left">
                                                                        <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->members) }}</span>
                                                                    </div>
                                                                </div>
                                                            </x-slot>
                                                            <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->members) }}</span></x-slot>
                                                            <div class="w-[70rem]">
                                                                <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->members))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
                                                            </div>
                                                        </x-alpine-modal>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </x-alpine-modal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                Total Points: <span id="total">0</span>

                <input onkeypress="return isNumber(event)" type="text" name="status" value="evaluated" hidden="true">
                <div class="py-12">


                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full" type="button">
                    Validate Evaluation
                    </button>

                    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure?</h3>
                                    <button  type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I’m sure
                                    </button>
                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </section>
    </section>



</x-admin-layout>

    <script>

        function toggleVisibility() {
            var toggleButton = document.getElementById('toggleButton');
            var userDetailDiv = document.getElementById('userDetailDiv');

            // Toggle the display property of the button and div
            toggleButton.style.display = (toggleButton.style.display === 'none') ? 'block' : 'none';
            userDetailDiv.style.display = (userDetailDiv.style.display === 'none') ? 'block' : 'none';
        }


        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>



    <script>
            // Get the anchor tag and its container
        var scrollToBottomButton = document.getElementById('scrollToBottom');
        var scrollButtonContainer = document.getElementById('scrollButtonContainer');

        // Function to toggle visibility of the scroll button based on scroll position
        function toggleScrollButtonVisibility() {
            if (window.scrollY + window.innerHeight >= document.body.scrollHeight) {
                // If scrolled to bottom, hide the button with animation
                scrollButtonContainer.classList.add('hidden');
            } else {
                // If not scrolled to bottom, show the button with animation
                scrollButtonContainer.classList.remove('hidden');
            }
        }

        // Add event listener to scroll event
        window.addEventListener('scroll', function() {
            toggleScrollButtonVisibility();
        });

        // Add event listener to the anchor tag
        scrollToBottomButton.addEventListener('click', function(event) {
            // Prevent default behavior
            event.preventDefault();

            // Scroll to bottom of the page
            window.scrollTo(0, document.body.scrollHeight);
        });

        // Initially check scroll position to toggle visibility
        toggleScrollButtonVisibility();
    </script>

    <script>
            // Call updateTotal() when the page finishes loading
        window.onload = function() {
            updateTotal();
        };

        // Add event listeners to input fields to call updateTotal() when their values change
        var inputFields = document.getElementsByClassName('input-number');
        for (var i = 0; i < inputFields.length; i++) {
            inputFields[i].addEventListener('input', updateTotal);

        }


        function updateTotal() {
            // Get all input elements with class "input-number"
            var inputFields = document.getElementsByClassName('input-number');

            // Initialize total
            var total = 0;

            // Loop through each input field and add its value to total
            for (var i = 0; i < inputFields.length; i++) {
                // Get the value of the input field
                var value = inputFields[i].value.trim(); // Remove leading/trailing whitespace

                console.log("Input value:", value); // Log the input value

                // Check if the value is a valid number
                if (!isNaN(value) && value !== '') {
                    // Convert the value to a number and add it to the total
                    total += parseFloat(value);
                }
            }

            console.log("Total:", total); // Log the total value

            // Display the total in the HTML element with id "total"
            document.getElementById('total').textContent = total;
            document.getElementById('usertotal').textContent = total;
        }
    </script>

