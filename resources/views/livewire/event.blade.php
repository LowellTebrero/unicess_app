<div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">

    <style>
        [x-cloak] { display: none }
    </style>

    <div class="py-24 mt-16 xl:py-12 px-5 w-full ">
        <div class=" flex py-5 px-10 justify-between">
            <h1 class="text-2xl text-slate-700 xl:text-lg 2xl:text-2xl" >Events Dashboard</h1>

        {{--  Modal Starts here  --}}

        <x-alpine-modal>

            <x-slot name="scripts" class="">
                <h1 class="text-sm">+ Create Event</h1>
          </x-slot>


          <x-slot name="title">
            <h1>Create Event</h1>
        </x-slot>

            <!-- content -->
            <div class="w-full px-5 py-1 mt-2">

                    <form x-on:company-added.window="showModal = false"  wire:submit.prevent="saveEvent" >
                        @csrf
                      <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title"> Title </label>

                        <input  wire:model="title" class="xl:text-sm shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="">

                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                      <div class="mb-4" wire:ignore>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description"> Description </label>
                        <textarea id="description" wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" placeholder=""></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="xl:flex xl:justify-between">

                      <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status"> Status </label>
                        <input wire:model="status" class="shadow appearance-none border rounded text-green-500 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" type="checkbox" placeholder="">
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                      <div class="mb-6  flex flex-col">

                        @if ($image)
                        Photo Preview:
                        <img src="{{ $image->temporaryUrl() }}" width="100">
                         @endif
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description"> Image </label>

                        <input type="file" id="image" wire:model="image" class="xl:text-sm shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="image" placeholder="">
                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                      <div class="flex items-center justify-between ">
                        <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                         Create Event
                        </button>
                      </div>
                    </form>
                </div>
            </x-alpine-modal>

 </div>
{{--  Modal End heere  --}}

        <section class="max-w-full mx-auto sm:px-6 lg:px-8 ">
            @if ($latests->isEmpty())
            @else
            <div class="bg-white shadow-sm sm:rounded-lg drop-shadow-lg h-3/4">

                <div class="flex flex-col p-5">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">

                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="border-b">

                                <tr class="text-black">
                                    <th scope="col" class="text-md xl:text-sm 2xl:text-md px-6 py-4 text-left text-gray-800 font-semibold">
                                    Date
                                    </th>
                                    <th scope="col" class="text-md xl:text-sm 2xl:text-md  px-6 py-4 text-left text-gray-800 font-semibold">
                                    Title
                                    </th>
                                    <th scope="col" class="text-md  xl:text-sm 2xl:text-md px-6 py-4 text-left text-gray-800 font-semibold">
                                    Description
                                    </th>
                                    <th scope="col" class="text-md xl:text-sm 2xl:text-md  px-6 py-4 text-left text-gray-800 font-semibold">
                                    Status
                                    </th>
                                    <th scope="col" class="text-md  xl:text-sm 2xl:text-md px-6 py-4 text-left text-gray-800 font-semibold">
                                    Image
                                    </th>

                                    <th scope="col" class="text-md xl:text-sm 2xl:text-md  px-6 py-4 text-left text-gray-800 font-semibold">
                                    Option
                                    </th>
                                </tr>
                                @endif
                            </thead>
                            <tbody >
                                @foreach ($latests as $latest )
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900 xl:text-xs "> {{ $latest->updated_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 xl:text-xs "> {{Str::limit($latest->title, 15)}}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap xl:text-xs "> {!! Str::limit($latest->description, 50 ) !!}</td>
                                    <td class="text-sm text-green-600 font-light px-6 py-4 whitespace-nowrap xl:text-xs ">
                                        @if ($latest->status == '0')
                                             <span class="text-red-500">hidden</span>
                                        @else
                                            visible
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap w-16">
                                        <img class="rounded-2xl" id="showImage" src="{{ (!empty($latest->image))? url('upload/image-folder/event-folder/'. $latest->image): url('upload/no-image.png') }}"   alt="">
                                    </td>

                                    <td class="text-sm text-blue-500 font-light px-6 py-4 my-auto whitespace-nowrap flex  mt-2">
                                      <a href="{{ route('admin.latest-events.edit', $latest->id) }}"> Edit</a>
                                        <form action="{{ route('admin.latest-events.delete', $latest->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">
                                                <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 96 960 960" width="30"><path d="M261 936q-24.75 0-42.375-17.625T201 876V306h-41v-60h188v-30h264v30h188v60h-41v570q0 24-18 42t-42 18H261Zm438-630H261v570h438V306ZM367 790h60V391h-60v399Zm166 0h60V391h-60v399ZM261 306v570-570Z"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </section>
    </div>
    <x-messages/>

</div>



    @push('scripts')
    <script>
        $('#description').summernote({
            minHeight: 200,
            placeholder: 'Write here ...',
            focus: false,
            airMode: false,
            fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
            fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
            dialogsInBody: true,
            dialogsFade: true,
            disableDragAndDrop: false,
            toolbar: [
              // [groupName, [list of button]]
              ['para', ['style', 'ul', 'ol', 'paragraph']],
              ['fontsize', ['fontsize']],
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough', 'superscript', 'subscript']],
              ['height', ['height']],
              ['misc', ['undo', 'redo', 'print', 'help', 'fullscreen']]
            ],
            popover: {
                air: [
                  ['color', ['color']],
                  ['font', ['bold', 'underline', 'clear']]
                ]
              },
              print: {
                //'stylesheetUrl': 'url_of_stylesheet_for_printing'
              },
        callbacks: {
            onChange: function(contents, $editable) {
             @this.set('description', contents);
            }
          }
        });
        $('#description').summernote({airMode: true,placeholder:'Try the airmode'});

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    @endpush
