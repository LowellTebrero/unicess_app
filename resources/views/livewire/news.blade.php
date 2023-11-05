<div>

    <style>
        [x-cloak] { display: none }
    </style>

    <div class="py-12 xl:py-5 px-5 w-full ">

        <div class=" flex py-5 px-10 justify-between">
            <h1 class="text-2xl text-slate-700 xl:text-lg" >News Dashboard</h1>

            {{--  Modal Starts here  --}}

            <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" >

                <!-- Trigger for Modal -->
                <button class="bg-green-500 p-2 rounded-md text-white" type="button" @click="showModal = true">+ Create News</button>

                <!-- Modal -->
                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal">

                    <!-- Modal inner -->
                    <div class="w-1/2  py-4 mx-auto text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                x-transition:enter="motion-safe:ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                @click.away="showModal = false">


                    <!-- Title / Close-->
                    <div class="flex items-center justify-between mb-5 px-4 py-1">
                        <h5 class="mr-3 text-black max-w-none">Add news</h5>
                        <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                    </div>
                    <hr>



                    <!-- content -->
                    <div class="w-full px-5 py-1 mt-2">

                            <form x-on:company-added.window="showModal = false"  wire:submit.prevent="saveNews" >
                                @csrf
                              <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title"> Title </label>
                                <input  wire:model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4" wire:ignore>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description"> Description </label>
                                <textarea textarea id="description" wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" placeholder=""></textarea>
                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                              <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="status"> Status </label>
                                <input wire:model="status" class="shadow appearance-none border rounded text-green-500 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" type="checkbox" placeholder="">
                                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                              <div class="mb-6  flex flex-col">

                                @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" width="200">
                                 @endif
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description"> Image </label>
                                <input type="file" id="image" wire:model="image" class="shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="image" placeholder="">
                                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                              <div class="flex items-center justify-between ">
                                <button class="w-full bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                                 Create News
                                </button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
     </div>
        {{--  Modal End heere  --}}


        <div class="max-w-full mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white shadow-sm sm:rounded-lg drop-shadow-lg h-3/4">

             <div class="flex flex-col p-5">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="flex p-2 my-2 justify-between">


                        </div>

                        <div class="overflow-hidden">

                            <table class="min-w-full">
                            <thead class="border-b">
                              <tr class="text-black">
                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 xl:text-sm font-semibold">
                                   Date
                                </th>
                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 xl:text-sm font-semibold">
                                   Title
                                </th>
                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 xl:text-sm font-semibold">
                                  Description
                                </th>
                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 xl:text-sm font-semibold">
                                  Status
                                </th>
                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 xl:text-sm font-semibold">
                                  Image
                                </th>

                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 xl:text-sm font-semibold">
                                 Action
                                </th>
                              </tr>
                            </thead>
                            <tbody >
                                @foreach ($news as $newsupdate )

                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900 xl:text-xs">
                                        {{ $newsupdate->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 xl:text-xs">
                                        {{Str::limit($newsupdate->title, 15)}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap xl:text-xs">
                                        {!! Str::limit($newsupdate->description, 50) !!}
                                    </td>
                                    <td class="text-sm text-green-600 font-light px-6 py-4 whitespace-nowrap xl:text-xs">

                                        @if ($newsupdate->status == '0')
                                             <span class="text-red-500">hidden</span>
                                        @else
                                            visible
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap w-16">

                                        <img class="rounded-2xl" id="showImage" src="{{ (!empty($newsupdate->image))? url('upload/image-folder/news-folder/'. $newsupdate->image): url('upload/no-image.png') }}" alt="">
                                    </td>

                                    <td class="text-sm text-blue-500 font-light px-6 py-4 my-auto whitespace-nowrap flex  mt-2">
                                      <a href="{{ route('admin.latest-news.edit', $newsupdate->id) }}">
                                        Edit
                                      </a>



                                      <form action="{{ route('admin.latest-news.delete', $newsupdate->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500" href="">
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
        </div>
    </div>

    <x-messages/>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>


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
        @endpush


</div>
