    <style>[x-cloak] { display: none }</style>

<x-admin-layout>

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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->training_director_local }}" name="training_director_local" type="text">
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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->training_director_international }}" name="training_director_international" type="text">
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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->resource_speaker_local }}" name="resource_speaker_local" type="text">
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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->resource_speaker_international }}" name="resource_speaker_international" type="text">
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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->facilitator_moderator_local }}" name="facilitator_moderator_local" type="text">
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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->facilitator_moderator_international }}" name="facilitator_moderator_international" type="text">
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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->reactor_panel_member_local }}" name="reactor_panel_member_local" type="text">
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
                            <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->reactor_panel_member_international }}" name="reactor_panel_member_international" type="text">
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
                        <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->technical_assistance }}" name="technical_assistance"  type="text">
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
                        <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->judge_community }}" name="judge_community"  type="text">
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
                        <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none"value="{{ $evaluation->commencement_guest_speaker }}" name="commencement_guest_speaker" type="text">
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
                                <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->coordinator_organizer_consultants }}"  name="coordinator_organizer_consultants"  type="text">
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
                                <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->resource_person_lecturer }}"  name="resource_person_lecturer"  type="text">
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
                                <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->facilitator }}"   name="facilitator" type="text">
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
                                <input onkeypress="return isNumber(event)" class=" border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" value="{{ $evaluation->member }}"  name="member"  type="text">
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
                                                @if ($image->members !== null)
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

                <input onkeypress="return isNumber(event)" type="text" name="status" value="evaluated" hidden="true">
                <div class="py-12">
                    <button type="submit" class="bg-blue-500 text-white px-3 w-full py-2 rounded-lg text-xl">Validate</button>
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


