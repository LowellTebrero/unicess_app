<div class="mt-6 ">
    <h1 class="py-4  text-sm font-medium">4. OIC Function (depends on the length of time and what level)<span class="text-xs 2xl:block xl:inline-block"> (1 pt. for every 2 cumulative days)</span></h1>
    <div class="mb-4">
            <input onkeypress="return isNumber(event)" id="oic" class="input-number border-zinc-400 appearance-none border rounded w-full py-2 px-3  leading-tight text-sm focus:outline-none" name="oic" value="{{ $evaluation->oic }}" type="text">
            <div class="py-2 oic">
                <x-alpine-modal>

                    <x-slot name="scripts">
                        <div class="bg-blue-600 px-2 py-2 rounded-md text-white text-xs flex">Proof of Points</div>
                    </x-slot>

                    <x-slot name="title">Proof of file</x-slot>

                    <!-- content -->
                    <div class="px-5 py-1 mt-5 flex flex-col items-center justify-center space-y-2">

                        <div class="bg-blue-600 w-full rounded-lg">
                            @foreach ($evaluation->evaluationfile as $image)
                            @if ($image->oics !== null)
                                <div class="bg-white  flex w-full  xl:w-48 -md rounded-lg hover:bg-slate-200  transition-all m-2 relative ">

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
                                                    <span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->oics) }}</span>
                                                </div>
                                            </div>
                                        </x-slot>
                                        <x-slot name="title"><span class="xl:text-[.7rem] 2xl:text-xs">{{ Str::limit($image->oics) }}</span></x-slot>
                                        <div class="w-[70rem]">
                                            <iframe class=" mt-2 w-full h-[80vh]" src="{{ (!empty($image->oics))? url('file/'. $image->path): url('upload/no-image.png') }}"></iframe>
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
