<x-admin-layout>

    @section('title', 'Article/Event | ' . config('app.name', 'UniCESS'))
    <section class="bg-white mt-5 m-8 h-[87vh] rounded-lg text-gray-700">
        <header class="p-4 py-2">
            <h1 class="2xl:text-2xl tracking-wider font-semibold text-gray-600">Article/Event Section</h1>
        </header>
        <hr>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <?php flash()->addError($error); ?>
            @endforeach
        @endif


        <main class="flex flex-col m-10 space-y-12 mt-12">
            <div class="bg-white shadow p-2 rounded-lg border">
                <div class="flex justify-between mb-2">
                    <h1 class="tracking-wider">Article Overview</h1>

                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        + Add Article Post
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add Article Post
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action={{ route('admin.article.store') }} method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Title</label>
                                            <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title">
                                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Description</label>
                                            <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10"></textarea>
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
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                        <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-[25vh] overflow-x-auto">
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
                                    <div class="font-semibold text-center">
                                        Image
                                    </div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">
                                        Status
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
                            @foreach ($articles as $article)
                            <tr class="hover:bg-gray-100">
                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700 xl:text-[.7rem]">
                                        {{ \Carbon\Carbon::parse($article->created_at)->format('M d, Y,  g:i:s A')}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left text-gray-700  xl:text-[.7rem]">
                                       {{Str::limit($article->title, 100)}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700">
                                        <img class="rounded-lg" id="showImage"  src="{{ (!empty($article->image))? url('upload/image-folder/features-folder/'. $article->image): url('upload/no-image.png') }}">
                                    </div>
                                </td>

                                <td class="text-sm text-green-600 font-light text-center px-2 py-4 whitespace-nowrap">
                                    <input class="article-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                    type="checkbox"  data-article-id="{{ $article->id }}" data-article-status="{{ $article->status }}" {{ $article->status == 'open' ? 'checked' : '' }} />
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
                                                        <form action={{ route('admin.article.update', $article->id ) }} method="POST" enctype="multipart/form-data">
                                                            @csrf @method('PATCH')
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Title</label>
                                                                    <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title" value="{{$article->title}}">
                                                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Description</label>
                                                                    <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10">{{$article->description}}</textarea>
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

                                        <form action="{{ route('admin.article.delete', $article->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
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
            </div>

            <div class="bg-white shadow p-2 rounded-lg border">
                <div class="flex justify-between mb-2">
                    <h1 class="tracking-wider">Event Overview</h1>

                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal-event" data-modal-toggle="default-modal-event" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        + Add Event Post
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal-event" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add event Post
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-event">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action={{ route('admin.event.store') }} method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-4 md:p-5 space-y-4">
                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Title</label>
                                            <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title">
                                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex flex-col">
                                            <label class="text-base leading-relaxed text-gray-200">Description</label>
                                            <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10"></textarea>
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
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                                        <button data-modal-hide="default-modal-event" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-[25vh] overflow-x-auto">
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
                                    <div class="font-semibold text-center">
                                        Image
                                    </div>
                                </th>

                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">
                                        Status
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
                            @foreach ($events as $event)
                            <tr class="hover:bg-gray-100">
                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700 xl:text-[.7rem]">
                                        {{ \Carbon\Carbon::parse($event->created_at)->format('M d, Y,  g:i:s A')}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <div class="text-left text-gray-700  xl:text-[.7rem]">
                                       {{Str::limit($event->title, 100)}}
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <div class="text-left text-gray-700">
                                        <img class="rounded-lg" id="showImage"  src="{{ (!empty($event->image))? url('upload/image-folder/event-folder/'. $event->image): url('upload/no-image.png') }}">
                                    </div>
                                </td>

                                <td class="p-3 whitespace-nowrap">

                                    <div class="text-center text-gray-700 2xl:text-xs xl:text-[.6rem]">
                                        <input
                                        class="task-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                        type="checkbox" data-task-id="{{ $event->id }}"
                                        data-task-status="{{ $event->status }}" {{ $event->status == 'open' ? 'checked' : '' }} />
                                    </div>

                                </td>

                                <td class="p-3 whitespace-nowrap text-center w-[10rem]">
                                    <div class="text-left text-gray-700 space-x-2 flex items-center justify-center">
                                            <!-- Modal toggle -->
                                            <button data-modal-target="default-modal-edit-event{{ $event->id }}" data-modal-toggle="default-modal-edit-event{{ $event->id }}" class="block text-white bg-green-400 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-3 py-1 text-center" type="button">
                                                Edit
                                            </button>

                                            <!-- Main modal -->
                                            <div id="default-modal-edit-event{{ $event->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Edit event Details
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-edit-event{{ $event->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form action={{ route('admin.event.update', $event->id ) }} method="POST" enctype="multipart/form-data">
                                                            @csrf @method('PATCH')
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Title</label>
                                                                    <input type="text" class="text-base leading-relaxed text-gray-600 rounded" name="title" value="{{$event->title}}">
                                                                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                                </div>

                                                                <div class="flex flex-col">
                                                                    <label class="text-base leading-relaxed text-gray-200">Description</label>
                                                                    <textarea name="description" class="text-base leading-relaxed text-gray-600 rounded" id="" cols="30" rows="10">{{$event->description}}</textarea>
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
                                                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update event</button>
                                                                <button data-modal-hide="default-modal-edit-event{{ $event->id }}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <form action="{{ route('admin.event.delete', $event->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
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
            </div>


        </main>

    <section/>

        @section('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Toastr -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script>
            $('.task-checkbox').on('change', function() {
                var checkbox = $(this);
                var taskId = checkbox.data('task-id');
                var status = checkbox.prop('checked') ? 'open' : 'close';

                // Send AJAX request to update status when checkbox is clicked
                $.ajax({
                    url: '{{ route('admin.features.update-event-status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        task_id: taskId,
                        status: status
                    },
                    success: function(data) {

                        toastr.success(data.message);
                        // You can also update the UI or perform other actions after the update
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        </script>

        @endsection
</x-admin-layout>

    <script>
        $('.article-checkbox').on('change', function() {
            var checkbox = $(this);
            var articleId = checkbox.data('article-id');
            var status = checkbox.prop('checked') ? 'open' : 'close';

            // Send AJAX request to update status when checkbox is clicked
            $.ajax({
                url: '{{ route('admin.features.update-article-status') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    article_id: articleId,
                    status: status
                },
                success: function(data) {

                    toastr.success(data.message);
                    // You can also update the UI or perform other actions after the update
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>


    <script type="text/javascript">

        $(document).ready(function(){
            $('#feature_image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>
