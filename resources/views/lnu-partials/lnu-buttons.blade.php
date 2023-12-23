{{--  University Updates  --}}
<section class="bg-slate-100">
    <div class="min-h-[55vh] flex items-center justify-center sm:p-8 sm:mx-8 mx-4 p-8 py-10  flex-col sm:flex-row ">

        {{--  <img class="absolute h-full w-full opacity-0 md:opacity-0 lg:opacity-100" src="{{ asset('img/arrow-bg.png') }}" alt="">  --}}

        {{--  <a  href="#" class="m-4 text-lg w-full  xl:text-lg  sm:text-[1.1rem] 2xl:text-2xl bg-white xl:w-64 drop-shadow-xl justify-center p-2  rounded-lg flex flex-col text-blue-900 items-center  min-h-[23vh] font-bold hover:bg-gray-100">
            <img class="my-3 sm:w-[3.4rem] w-[2rem] lg:w-[3rem]" src="{{ asset('img/partners.png') }}" alt="">
            Partners
        </a>  --}}

        <!-- Modal toggle -->
        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
            class="m-4 text-lg w-full  xl:text-lg  sm:text-[1.1rem] 2xl:text-2xl bg-white xl:w-64 drop-shadow-xl justify-center p-2  rounded-lg flex flex-col text-blue-900 items-center  min-h-[23vh] font-bold hover:bg-gray-100"
            type="button">
            <img class="my-3 sm:w-[3.4rem] w-[2rem] lg:w-[3rem]" src="{{ asset('img/partners.png') }}" alt="">
            Partners
        </button>

        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative  w-full max-w-7xl h-[80vh] bg-white rounded-lg shadow">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow h-full">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-300">
                        <h3 class="text-xl tracking-wider font-semibold text-gray-600 ">
                            CESO Partners
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <h1 class="p-4 text-gray-600 xl:text-xs 2xl:text-base">
                        CESO Partners refer to individuals or entities who collaborate and share responsibilities, resources,
                        and risks in pursuit of a common goal or objective. In various contexts, partners can include
                        business associates, co-owners, collaborators, or individuals engaged in a mutual relationship.
                        Partnership implies a shared commitment to success, often involving the pooling of expertise,
                        capital, or efforts to achieve collective outcomes.
                    </h1>
                    <div class="p-4 md:p-5  grid gap-2 grid-cols-1 lg:grid-cols-2">
                        @foreach ($partners as $partner)
                            <a href="#"
                                class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <img class="object-cover w-full rounded-tl-lg rounded-bl-lg h-96 md:h-auto md:w-48 "
                                    src="{{ !empty($partner->image) ? url('upload/image-folder/partner-folder/' . $partner->image) : url('upload/no-image.png') }}"
                                    alt="">

                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ Str::limit($partner->title, 50) }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                        {{ Str::limit($partner->description, 75) }}</p>
                                </div>
                            </a>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>




        <a href="#"
            class="m-4 xl:text-lg h-[5vh] text-lg sm:text-[1.1rem] 2xl:text-2xl bg-white w-full xl:w-64  drop-shadow-xl justify-center p-2   rounded-lg flex flex-col text-blue-900 items-center  min-h-[23vh] font-bold hover:bg-gray-100">
            <img class="my-3 sm:w-[3.4rem] w-[2rem] lg:w-[3rem]" src="{{ asset('img/beneficiary.png') }}"
                alt="">
            Beneficiary
        </a>

        {{--  <a class="m-4 xl:text-lg 2xl:text-2xl text-lg sm:text-[1.1rem] bg-white w-full xl:w-64  drop-shadow-xl justify-center p-2 rounded-lg flex flex-col text-blue-900 items-center  min-h-[23vh] font-bold hover:bg-gray-100">
            <img class="my-3 sm:w-[3.4rem] w-[2rem] lg:w-[3rem]" src="{{ asset('img/faculties.png') }}" alt="">
            Faculties
        </a>  --}}
    </div>
</section>
