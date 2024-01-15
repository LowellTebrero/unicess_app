{{--  University Updates  --}}
<section class="bg-slate-100">
    <div class="min-h-[55vh] flex items-center justify-center sm:p-8 sm:mx-8 mx-4 p-8 py-10  flex-col sm:flex-row ">

        <img class="absolute h-full w-full opacity-0 md:opacity-0 lg:opacity-100" src="{{ asset('img/arrow-bg.png') }}">

        {{--  <a  href="#" class="m-4 text-lg w-full  xl:text-lg  sm:text-[1.1rem] 2xl:text-2xl bg-white xl:w-64 drop-shadow-xl justify-center p-2  rounded-lg flex flex-col text-blue-900 items-center  min-h-[23vh] font-bold hover:bg-gray-100">
            <img class="my-3 sm:w-[3.4rem] w-[2rem] lg:w-[3rem]" src="{{ asset('img/partners.png') }}">
            Partners
        </a>  --}}

        <!-- Modal toggle -->
        <button data-modal-target="default-modal-partner" data-modal-toggle="default-modal-partner"
            class="m-4 text-lg w-full  xl:text-lg  sm:text-[1.1rem] 2xl:text-2xl bg-white xl:w-64 drop-shadow-xl justify-center p-2  rounded-lg flex flex-col text-blue-900 items-center  min-h-[23vh] font-bold hover:bg-gray-100"
            type="button">
            <img class="my-3 sm:w-[3.4rem] w-[2rem] lg:w-[5rem]" src="{{ asset('img/partners.png') }}">
            Partners
        </button>

        <!-- Main modal -->
        <div id="default-modal-partner" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative  w-[90%]  h-[100vh] m-2 sm:m-0 md:h-[80vh] bg-white rounded-lg shadow">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                    <!-- Modal header -->
                    <div class="sticky top-0 bg-white">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-300 ">
                            <h3 class="text-xl tracking-wider font-semibold text-gray-600 ">
                                CESO Partners
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="default-modal-partner">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>

                        </div>
                        <h1 class="p-4 text-gray-600 text-sm 2xl:text-base">
                            CESO Partners refer to individuals or entities who collaborate and share responsibilities, resources,
                            and risks in pursuit of a common goal or objective. In various contexts, partners can include
                            business associates, co-owners, collaborators, or individuals engaged in a mutual relationship.
                        </h1>
                    </div>

                    <!-- Modal body -->
                    <div class="p-4 md:p-5  gap-4 grid grid-cols-1 2xl:grid-cols-2 ">
                        @foreach ($partners as $partner)
                            <a href="#" class="w-full bg-white hover:bg-gray-200 border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                <div class="w-full ">
                                    <img class="rounded-tl-lg rounded-bl-lg h-full object-cover w-full" src="{{ !empty($partner->image) ? url('upload/image-folder/partner-folder/' . $partner->image) : url('upload/no-image.png') }}">
                                </div>

                                <div class="flex flex-col space-y-4 p-4 w-full h-full">
                                    <h5 class="mb-2 text-xs sm:text-sm tracking-wide lg:text-lg 2xl:text-xl font-bold text-gray-700">
                                        {{ Str::limit($partner->title) }}
                                    </h5>
                                    <p class="mb-3 text-xs 2xl:text-sm font-normal text-gray-800 ">
                                        {{ Str::limit($partner->description, 800) }}
                                    </p>


                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>


        <!-- Modal toggle -->
        <button data-modal-target="default-modal-beneficiary" data-modal-toggle="default-modal-beneficiary"
            class="m-4 text-lg w-full  xl:text-lg  sm:text-[1.1rem] 2xl:text-2xl bg-white xl:w-64 drop-shadow-xl justify-center p-2  rounded-lg flex flex-col text-blue-900 items-center  min-h-[23vh] font-bold hover:bg-gray-100"
            type="button">
            <img class="my-3 sm:w-[3.4rem] w-[2rem] lg:w-[5rem]" src="{{ asset('img/beneficiary.png') }}">
            Beneficiary
        </button>

        <!-- Main modal -->
        <div id="default-modal-beneficiary" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative  w-[90%]  h-[100vh] m-2 sm:m-0 md:h-[80vh] bg-white rounded-lg shadow">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow h-full overflow-x-auto">
                    <!-- Modal header -->
                    <div class="sticky top-0 bg-white">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-300 ">
                        <h3 class="text-xl tracking-wider font-semibold text-gray-600 ">
                            CESO Beneficiary
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal-beneficiary">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <h1 class="p-4 text-gray-600 text-xs 2xl:text-base">
                        CESO Beneficiaries refer to individuals or entities who collaborate and share responsibilities, resources,
                        and risks in pursuit of a common goal or objective. In various contexts, partners can include
                        business associates, co-owners, collaborators, or individuals engaged in a mutual relationship.
                    </h1>
                    </div>

                    <div class="p-4 md:p-5  gap-4 grid grid-cols-1 2xl:grid-cols-2 ">
                        @foreach ($beneficiaries as $beneficiary)
                            <a href="#" class="w-full bg-white hover:bg-gray-200 border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                <div class="w-full ">
                                    <img class="rounded-tl-lg rounded-bl-lg h-full object-cover w-full" src="{{ !empty($beneficiary->image) ? url('upload/image-folder/beneficiary-folder/' . $beneficiary->image) : url('upload/no-image.png') }}">
                                </div>

                                <div class="flex flex-col space-y-4 p-4 w-full h-full">
                                    <h5 class="mb-2 text-xs sm:text-sm tracking-wide lg:text-lg 2xl:text-xl font-bold text-white ">
                                        {{ Str::limit($beneficiary->title) }}
                                    </h5>
                                    <p class="mb-3 text-xs 2xl:text-sm font-normal text-gray-700">
                                        {{ Str::limit($beneficiary->description, 800) }}
                                    </p>


                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>


    </div>
</section>
