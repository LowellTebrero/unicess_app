
<section class="flex xl:flex-col lg:flex-col flex-col items-center  h-full bg-slate-200 relative p-10 text-gray-700">
    {{--  <img class="invisible md:visible absolute right-0 top-0 z-0 w-full h-full" src="{{ asset('img/ps-bg.png') }}">  --}}
    <h1 class="font-bold text-blue-900 text-2xl my-10">Program and Services</h1>

    <div class="flex flex-wrap items-center justify-center 2xl:mx-60 p-5 ">
        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-1.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Physical Fitness & Sport Development</h1>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal-physical" data-modal-toggle="default-modal-physical" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-physical" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Physical Fitness & Sport Development
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-physical">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Physical Fitness & Sport Development')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                        @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-physical" data-modal-toggle="popup-modal-physical" data-modal-hide="default-modal-physical" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                            Click here other details
                                        </button>
                                        @endguest

                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div id="popup-modal-physical" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-physical" data-modal-toggle="default-modal-physical" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-2.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Information Communication & Education</h1>

            <!-- Modal toggle -->
            <button data-modal-target="default-modal-information" data-modal-toggle="default-modal-information" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-information" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Information Communication & Education
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-information">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Information Communication & Education')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                        @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-information" data-modal-toggle="popup-modal-information" data-modal-hide="default-modal-information" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                                            Click here other details
                                        </button>
                                        @endguest

                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div id="popup-modal-information" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-information" data-modal-toggle="default-modal-information" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-3.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Literacy, Numeracy & Language Enhancement</h1>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal-literacy" data-modal-toggle="default-modal-literacy" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-literacy" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Literacy, Numeracy & Language Enhancement
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-literacy">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Literacy, Numeracy & Language Enhancement')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg physical-image h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                         @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-literacy" data-modal-toggle="popup-modal-literacy" data-modal-hide="default-modal-literacy" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                                            Click here other details
                                        </button>
                                        @endguest

                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div id="popup-modal-literacy" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-literacy" data-modal-toggle="default-modal-literacy" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-4.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Cultural Development</h1>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal-cultural" data-modal-toggle="default-modal-cultural" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-cultural" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Cultural Development
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-cultural">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Cultural Development')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg physical-image h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                        @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-cultural" data-modal-toggle="popup-modal-cultural" data-modal-hide="default-modal-cultural" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                                            Click here other details
                                        </button>
                                        @endguest
                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div id="popup-modal-cultural" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-cultural" data-modal-toggle="default-modal-cultural" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-5.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Livelihood, Technical and Business Management</h1>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal-livelihood" data-modal-toggle="default-modal-livelihood" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-livelihood" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Livelihood, Technical and Business Management
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-livelihood">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Livelihood, Technical and Business Management')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg physical-image h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                        @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-livelihood" data-modal-toggle="popup-modal-livelihood" data-modal-hide="default-modal-livelihood" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                                            Click here other details
                                        </button>
                                        @endguest
                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div id="popup-modal-livelihood" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-livelihood" data-modal-toggle="default-modal-livelihood" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-6.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Environmental Conservation & Disaster Preparedness</h1>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal-environmental" data-modal-toggle="default-modal-environmental" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-environmental" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Environmental Conservation & Disaster Preparedness
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-environmental">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Environmental Conservation & Disaster Preparedness')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg physical-image h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                        @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-environmental" data-modal-toggle="popup-modal-environmental" data-modal-hide="default-modal-environmental" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                                            Click here other details
                                        </button>
                                        @endguest
                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div id="popup-modal-environmental" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-environmental" data-modal-toggle="default-modal-environmental" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-7.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Management & Leadership Development</h1>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal-management" data-modal-toggle="default-modal-management" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-management" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Management & Leadership Development
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-management">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Management & Leadership Development')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg physical-image h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                        @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-management" data-modal-toggle="popup-modal-management" data-modal-hide="default-modal-management" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                                            Click here other details
                                        </button>
                                        @endguest
                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div id="popup-modal-management" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-management" data-modal-toggle="default-modal-management" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="bg-white w-62 h-60 flex  flex-col justify-between p-3 items-center rounded-2xl m-4  lg:m-4 xl:m-5">
            <img class="w-16 lg:w-16 xl:w-[24]" src="{{ asset('img/ps-8.png') }}" alt="">
            <h1 class="text-center p-2 mt-5 text-blue-900 font-semibold text-xs md:text-md lg:text-md xl:text-xs 2xl:text-[.9rem] w-40 lg:w-48 xl:w-54 2xl:w-64">Special Institute & Teaching Training Program</h1>
            <!-- Modal toggle -->
            <button data-modal-target="default-modal-special" data-modal-toggle="default-modal-special" class="bg-yellow-500 rounded border-2 border-gray-500 px-2 py-1 text-white font-semibold" type="button">
                Read more
            </button>

            <!-- Main modal -->
            <div id="default-modal-special" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full text-gray-700">
                <div class="relative p-4 w-[90%] h-[90%] ">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow  h-full overflow-x-auto">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 sticky top-0 z-10 bg-white">
                            <h3 class="text-xl font-semibold ">
                                Special Institute & Teaching Training Program
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-special">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <div class="px-4 pt-2">
                            <p class="text-sm">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5  grid grid-cols-1 2xl:grid-cols-2 gap-4">
                            @foreach ($programservices as $progserv )
                            @if ($progserv->status == 'Special Institute & Teaching Training Program')
                                <div class="w-full bg-white border border-gray-300 rounded-lg shadow flex flex-col sm:flex-row">
                                    <div class="w-full xl:w-3/4 2xl:w-full">
                                        <img class="rounded-tl-lg rounded-bl-lg physical-image h-full object-cover w-full" src="{{ (!empty($progserv->image))? url('upload/image-folder/program-services-folder/'. $progserv->image): url('upload/CESO.png') }}" alt="" />
                                    </div>
                                    <div class="p-5 flex flex-col justify-between w-full">
                                        <div class="">
                                            <a href="#">
                                                <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600">{{ $progserv->title }}</h5>
                                            </a>
                                            <p class="mb-3 font-normal text-xs text-gray-600">{{ Str::limit($progserv->description, 800) }}</p>
                                        </div>

                                        @auth
                                        <a href="#" class="w-[15rem] inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Click here other details
                                        </a>
                                        @endauth

                                        @guest
                                        <button data-modal-target="popup-modal-special" data-modal-toggle="popup-modal-special" data-modal-hide="default-modal-special" class="w-[15rem] block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                                            Click here other details
                                        </button>
                                        @endguest
                                    </div>
                                </div>
                            @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div id="popup-modal-special" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-1/2 h-1/2 ">
                    <div class="relative bg-white rounded-lg shadow-lg w-full h-full flex flex-col xl:flex-row">

                        <div class="w-full">
                            <img src="{{ url('upload/CESO.png') }}" class="h-[20vh] xl:h-full w-full object-cover rounded-tl-lg rounded-bl-lg">
                        </div>

                        <div class="p-4 md:p-5 w-full">
                            <div class="mb-5">
                                <h3 class="text-sm md:text-lg 2xl:text-2xl font-medium text-gray-800 tracking-wider">LOGIN/REGISTER ACCOUNT?</h3>
                                <hr>
                            </div>

                            <a href={{ route('login') }} class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Yes, Im sure</a>
                            <button data-modal-hide="popup-modal-special" data-modal-toggle="default-modal-special" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        <hr>
    </div>
</section>

