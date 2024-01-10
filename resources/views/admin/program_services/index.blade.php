<x-admin-layout>

    @section('title', 'Program and Services | ' . config('app.name', 'UniCESS'))

    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <?php flash()->addError($error); ?>
    @endforeach
    @endif
    <section class="bg-white rounded-lg mt-4 2xl:mt-5 m-8 h-[82vh] 2xl:h-[87vh]">

        <header class="p-4 py-2">
            <h1 class="2xl:text-2xl tracking-wider font-semibold text-gray-600">Program and Services Section</h1>
        </header>
        <hr>

        <main class="p-10">
            <div class="h-[60vh] overflow-x-auto ">
                <table class="table-auto w-full relative">
                    <thead class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Created</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Title</div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">
                                   Program Status
                                </div>
                            </th>

                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">
                                    Image
                                </div>
                            </th>

                            <th class="p-2 whitespace-nowrap w-[10rem]">
                                <div class="font-semibold text-center">
                                    Option
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="text-xs divide-y divide-gray-100 ">
                        @foreach ($programservices as $article)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3 whitespace-nowrap w-[5rem]">
                                <div class="text-left text-gray-700 xl:text-[.7rem]">
                                    {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y,  g:i:s A')}}
                                </div>
                            </td>

                            <td class="p-3 whitespace-nowrap">
                                <div class="text-left text-gray-700  xl:text-[.7rem]">
                                    {{Str::limit($article->title, 50)}}
                                </div>
                            </td>
                            <td class="text-xs text-green-600 flex space-x-2 items-center font-light text-left px-2 pr-10 py-4 whitespace-nowrap">
                                <h1>{{Str::limit($article->status, 100)}}</h1>
                                <!-- Modal toggle -->
                                <button data-modal-target="default-modal-edit-status{{ $article->id }}" data-modal-toggle="default-modal-edit-status{{ $article->id }}" class="block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-xs px-3 py-1 text-center" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#68bf7b" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925l-2 2H5v14h14v-6.95l2-2V19q0 .825-.587 1.413T19 21zm4-7v-2.425q0-.4.15-.763t.425-.637l8.6-8.6q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4q0 .375-.137.738t-.438.662l-8.6 8.6q-.275.275-.637.438t-.763.162H10q-.425 0-.712-.288T9 14m12.025-9.6l-1.4-1.4zM11 13h1.4l5.8-5.8l-.7-.7l-.725-.7L11 11.575zm6.5-6.5l-.725-.7zl.7.7z"/></svg>
                                </button>

                                <!-- Main modal -->
                                <div id="default-modal-edit-status{{ $article->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Edit Program Status
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-edit-status{{ $article->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->

                                                <div class="p-4 md:p-5 space-y-4">
                                                    <div class="flex justify-between">
                                                        <div class="flex flex-col space-y-2">
                                                            <label for="" class="text-white text-[.7rem]">Physical Fitness & Sport Development</label>
                                                            <input class="physical-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-physical-id="{{ $article->id }}" data-physical-status="{{ $article->status }}" {{ $article->status == 'Physical Fitness & Sport Development' ? 'checked' : '' }} />

                                                            <label for="" class="text-white text-[.7rem]">Information Communication & Education</label>
                                                            <input class="information-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-information-id="{{ $article->id }}" data-information-status="{{ $article->status }}" {{ $article->status == 'Information Communication & Education' ? 'checked' : '' }} />

                                                            <label for="" class="text-white text-[.7rem]">Literacy, Numeracy & Languange Enhancement</label>
                                                            <input class="literacy-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-literacy-id="{{ $article->id }}" data-literacy-status="{{ $article->status }}" {{ $article->status == 'Literacy, Numeracy & Languange Enhancement' ? 'checked' : '' }} />

                                                            <label for="" class="text-white text-[.7rem]">Cultural Development</label>
                                                            <input class="cultural-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-cultural-id="{{ $article->id }}" data-cultural-status="{{ $article->status }}" {{ $article->status == 'Cultural Development' ? 'checked' : '' }} />
                                                        </div>

                                                        <div class="flex flex-col space-y-2">
                                                            <label for="" class="text-white text-[.7rem]">Livelihood Technical & Business Management</label>
                                                            <input class="livelihood-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-livelihood-id="{{ $article->id }}" data-livelihood-status="{{ $article->status }}" {{ $article->status == 'Livelihood Technical & Business Management' ? 'checked' : '' }} />

                                                            <label for="" class="text-white text-[.7rem]">Environmental Conversation & Disaster Preparedness</label>
                                                            <input class="environmental-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-environmental-id="{{ $article->id }}" data-environmental-status="{{ $article->status }}" {{ $article->status == 'Environmental Conversation & Disaster Preparedness' ? 'checked' : '' }} />

                                                            <label for="" class="text-white text-[.7rem]">Management & Leardership Development</label>
                                                            <input class="management-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-management-id="{{ $article->id }}" data-management-status="{{ $article->status }}" {{ $article->status == 'Management & Leardership Development' ? 'checked' : '' }} />

                                                            <label for="" class="text-white text-[.7rem]">Special Institute & Teaching Training Program</label>
                                                            <input class="special-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                                            type="checkbox"  data-special-id="{{ $article->id }}" data-special-status="{{ $article->status }}" {{ $article->status == 'Special Institute & Teaching Training Program' ? 'checked' : '' }} />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button data-modal-hide="default-modal-edit-status{{ $article->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                </div>

                                        </div>
                                    </div>
                                </div>

                            </td>

                            <td class="p-3 whitespace-nowrap w-[5rem]">
                                <div class="text-left text-gray-700">
                                    <img class="rounded-lg" id="showImage"  src="{{ (!empty($article->image))? url('upload/image-folder/program-services-folder/'. $article->image): url('upload/no-image.svg') }}">
                                </div>
                            </td>



                            <td class="p-3 whitespace-nowrap text-center w-[10rem]">
                                <div class="text-left text-gray-700 space-x-2 flex items-center justify-center">
                                        <!-- Modal toggle -->
                                        <button data-modal-target="default-modal-edit-article{{ $article->id }}" data-modal-toggle="default-modal-edit-article{{ $article->id }}" class="block text-white bg-green-400 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-3 py-1 text-center" type="button">
                                            Edit
                                        </button>

                                        <!-- Main modal -->
                                        <div id="default-modal-edit-article{{ $article->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Edit article Details
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-edit-article{{ $article->id }}">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <form action={{ route('admin.program-services.update', $article->id ) }} method="POST" enctype="multipart/form-data">
                                                        @csrf @method('PATCH')
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <div class="flex flex-col">
                                                                <label class="text-base leading-relaxed text-gray-200">Title</label>

                                                                <input type="text" class="text-base leading-relaxed text-gray-600 rounded" value="{{ $article->title }}">
                                                                <input type="text" class="text-base leading-relaxed text-gray-600 rounded"value="{{ $article->title }}" name="title" hidden>
                                                                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="flex flex-col">
                                                                <label class="text-base leading-relaxed text-gray-200">Description</label>
                                                                <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10">{{ $article->description }}</textarea>
                                                                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                                                            </div>
                                                            <div class="flex flex-col">
                                                                <label class="text-base leading-relaxed text-gray-200">Image</label>
                                                                <input type="file" class="text-base leading-relaxed text-gray-600" name="image">
                                                                @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update article</button>
                                                            <button data-modal-hide="default-modal-edit-article{{ $article->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    <form action="{{ route('admin.program-services.delete', $article->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit flex jusify-center items-center">
                                            {{--  <svg class="fill-red-400" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="30"><path d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z"/></svg>  --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none" stroke="#ff4d4d" stroke-linecap="round" stroke-width="1.5"><path d="M9.17 4a3.001 3.001 0 0 1 5.66 0" opacity=".5"/><path d="M20.5 6h-17m15.333 2.5l-.46 6.9c-.177 2.654-.265 3.981-1.13 4.79c-.865.81-2.195.81-4.856.81h-.774c-2.66 0-3.99 0-4.856-.81c-.865-.809-.953-2.136-1.13-4.79l-.46-6.9"/><path d="m9.5 11l.5 5m4.5-5l-.5 5" opacity=".5"/></g></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>

    </section>
</x-admin-layout>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        $('.physical-checkbox').on('change', function() {
            var checkbox = $(this);
            var physicalId = checkbox.data('physical-id');
            var status = checkbox.prop('checked') ? 'Physical Fitness & Sport Development' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-physical') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    physical_id: physicalId,
                    status: status
                },
                success: function(data) {
                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.information-checkbox').on('change', function() {
            var checkbox = $(this);
            var informationId = checkbox.data('information-id');
            var status = checkbox.prop('checked') ? 'Information Communication & Education' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-information') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    information_id: informationId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.literacy-checkbox').on('change', function() {
            var checkbox = $(this);
            var literacyId = checkbox.data('literacy-id');
            var status = checkbox.prop('checked') ? 'Literacy, Numeracy & Languange Enhancement' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-literacy') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    literacy_id: literacyId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.cultural-checkbox').on('change', function() {
            var checkbox = $(this);
            var culturalId = checkbox.data('cultural-id');
            var status = checkbox.prop('checked') ? 'Cultural Development' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-cultural') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cultural_id: culturalId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.livelihood-checkbox').on('change', function() {
            var checkbox = $(this);
            var livelihoodId = checkbox.data('livelihood-id');
            var status = checkbox.prop('checked') ? 'Livelihood Technical & Business Management' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-livelihood') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    livelihood_id: livelihoodId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.environmental-checkbox').on('change', function() {
            var checkbox = $(this);
            var environmentalId = checkbox.data('environmental-id');
            var status = checkbox.prop('checked') ? 'Environmental Conversation & Disaster Preparedness' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-environmental') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    environmental_id: environmentalId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.management-checkbox').on('change', function() {
            var checkbox = $(this);
            var managementId = checkbox.data('management-id');
            var status = checkbox.prop('checked') ? 'Management & Leardership Development' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-management') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    management_id: managementId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('.special-checkbox').on('change', function() {
            var checkbox = $(this);
            var specialId = checkbox.data('special-id');
            var status = checkbox.prop('checked') ? 'Special Institute & Teaching Training Program' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.program-services.update-status-special') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    special_id: specialId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    location.reload();
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });




    </script>
