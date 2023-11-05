<div>

    <style>
        [x-cloak] { display: none }
    </style>

    <div class="py-12 xl:py-5  px-5 w-full ">

        <div class=" flex py-5 px-10 justify-between ">
            <h1 class="text-2xl text-slate-700">Article Dashboard</h1>
            {{--  Modal Starts here  --}}

            <x-alpine-modal>

                <x-slot name="scripts" class="">
                    <h1 class="text-sm bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-sm xl:text-xs flex">+ Create Article</h1>
              </x-slot>


              <x-slot name="title">
                <h1>Create Article</h1>
            </x-slot>
                    <!-- content -->
                    <div class="w-full px-5 py-1 mt-2">

                        <form x-on:company-added.window="showModal = false"  wire:submit.prevent="saveArticle" >
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title"> Title </label>
                                <input  wire:model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4" wire:ignore>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description"> Description </label>
                                <textarea id="editor" wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" placeholder=""></textarea>
                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="status"> Status </label>
                            <input wire:model="status" class="shadow appearance-none border rounded text-green-500 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" type="checkbox" placeholder="">
                            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6  flex flex-col">
                            {{--  @if ($feature_image)
                            <img src="{{ $feature_image->temporaryUrl() }}" width="200">
                             @endif  --}}
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="feature_image"> Image </label>
                            <input type="file" id="feature_image" wire:model="feature_image" class="shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="feature_image" placeholder="">
                            @error('feature_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                          <div class="flex items-center justify-between ">
                            <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">Create Article</button>
                          </div>

                        </form>


                    </div>
                </x-alpine-modal>

     </div>
        {{--  Modal End here  --}}


        <div class="max-w-full mx-auto sm:px-6  lg:px-8 ">
            @if ($features->isEmpty())
            @else
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
                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 font-semibold xl:text-sm"> Date </th>

                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 font-semibold xl:text-sm"> Title </th>

                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 font-semibold xl:text-sm"> Description </th>

                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 font-semibold xl:text-sm"> Status </th>

                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 font-semibold xl:text-sm"> Image </th>

                                <th scope="col" class="text-md  px-6 py-4 text-left text-gray-800 font-semibold xl:text-sm"> Action </th>
                              </tr>
                              @endif
                            </thead>
                            <tbody >
                                @foreach ($features as $feature )

                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900">
                                        {{ $feature->updated_at->diffForHumans() }}
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ Str::limit($feature->title, 50) }}
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {!! Str::limit($feature->description, 10) !!}
                                    </td>

                                    <td class="text-sm text-green-600 font-light px-6 py-4 whitespace-nowrap">

                                        @if ($feature->status == '0')
                                             <span class="text-red-500">hidden</span>
                                        @else
                                            visible
                                        @endif
                                    </td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap w-16">

                                        <img class="rounded-2xl" id="showImage" src="{{ (!empty($feature->feature_image))? url('upload/image-folder/features-folder/'. $feature->feature_image): url('upload/no-image.png') }}" alt="">
                                    </td>

                                    <td class="text-sm text-blue-500 font-light px-6 py-4 my-auto whitespace-nowrap flex  mt-2">
                                      <a href="{{ route('admin.features.edit', $feature->id) }}">
                                        Edit
                                      </a>



                                      <form action="{{ route('admin.features.delete', $feature->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
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

    @section('scripts')
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


    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endsection


</div>
