<section class="flex xl:flex-col lg:flex-col flex-col items-center  h-full bg-slate-200 relative p-10">
<img class="invisible md:visible absolute right-0 top-0 w-full h-full" src="{{ asset('img/ps-bg.png') }}" alt="">

<h1 class="font-bold text-blue-900 text-2xl my-10">Program and Services</h1>

<div class="z-20 flex flex-wrap items-center justify-center 2xl:mx-60 p-5">
    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-1.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Physical Fitness & Sport Development</h1>

        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Physical Fitness & Sport Development</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>





    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-2.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Information Communication & Education</h1>
        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Information Communication & Education<</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-3.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Literacy, Numeracy & Language Enhancement</h1>
        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Literacy, Numeracy & Language Enhancement</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-4.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Cultural Development</h1>
        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Cultural Development</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-5.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Livelihood, Technical and Business Management</h1>
        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Livelihood, Technical and Business Management</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-6.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Environmental Conservation & Disaster Preparedness</h1>
        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Environmental Conservation & Disaster Preparedness</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-7.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Management & Leadership Development</h1>
        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Management & Leadership Development</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
        <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-8.png') }}" alt="">
        <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Special Institute & Teaching Training Program</h1>
        {{--  Modal Starts here  --}}
        <div x-cloak  x-data="{ 'showModal': false }"  @keydown.escape="showModal = false" >

        <!-- Trigger for Modal -->
        <div class="flex justify-between py-4 px-10">
            <div class="">
                <button class="my-5 bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button" @click="showModal = true">Read more</button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal" id="add_post_modal"  >

        <!-- Modal inner -->
            <div class="w-1/4 px-4 py-4 mx-auto text-left bg-white rounded-lg shadow-lg"
                x-show="showModal"
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="showModal = false">

                <!-- Title / Close-->
                <div class="flex items-center justify-between mb-2 ">
                    <h5 class="mr-3 text-black text-xs text-slate-600 max-w-none">Program and Services</h5>

                    <button type="button" class=" z-50 cursor-pointer" @click="showModal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- content -->
                <div class="w-full flex flex-col space-y-2">
                    <img class="" src="{{ asset('img/about-2.png') }}" alt="">
                    <h1 class="font-semibold 2xl:text-lg xl:text-sm text-slate-600">Special Institute & Teaching Training Program</h1>

                    <p class="2xl:text-sm xl:text-xs text-slate-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Adipisci exercitationem sed dignissimos voluptatem eos nam a impedit rem reiciendis odio dicta blanditiis repellat, quasi perspiciatis consectetur? Voluptatem commodi a enim? Quae porro molestiae excepturi eligendi libero provident harum expedita in, illo dolorum quisquam veritatis eveniet perferendis, iure aut labore saepe.</p>

                </div>
            </div>
        </div>
        </div>
    </div>
</div>

</section>
