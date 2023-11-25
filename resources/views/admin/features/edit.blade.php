<x-admin-layout>
    <section class="mt-5 m-8 bg-white 2xl:min-h-[87vh] rounded-lg ">



                    <div class="p-5  flex items-center justify-between">
                        <h1 class="text-slate-600 tracking-wider 2xl:text-2xl font-semibold">Edit Article</h1>
                        <a class=" rounded-md text-white hover:bg-gray-100" href={{ route('admin.features.index') }}>
                            <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="40"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg>
                        </a>
                    </div>

                    <hr>

                    <div class="w-full p-5">

                    {{--  FORM   --}}
                    <form action="{{route('admin.features.update', $features->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="flex flex-col lg:flex-row space-y-2 lg:space-x-4 mb-4 items-center">
                            <div class=" w-full">
                                <label class="block text-gray-600 text-sm font-medium tracking-wider mb-2" for="title">Title</label>
                                <input class=" border border-gray-200 rounded w-full py-2 px-3 text-gray-700 leading-tight" id="title" name="title" type="text" value = "{{$features->title}}">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex space-x-2">
                                <div>
                                    <label class="block text-gray-600 text-sm font-medium mb-2">Upload your image here</label>
                                    <input type="file" id="feature_image" class="text-xs rounded text-gray-700 leading-tight border border-gray-200"  name="feature_image"  value = "{{$features->feature_image}}">
                                    @error('feature_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="">
                                    <label class="text-xs">Image</label>
                                    <div class="w-16">
                                        <img id="showImage" src="{{ (!empty($features->feature_image))? url('upload/image-folder/features-folder/'. $features->feature_image): url('upload/no-image.png') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Description</label>
                            <div class="overflow-x-auto h-[50vh]">
                                <textarea id="editor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"id="description" name="description" type="text">
                                    {{$features->description}}
                                </textarea>
                            </div>

                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>


                    {{--  <div class="mb-4">
                        <label class="block text-gray-700 text-xs font-bold mb-2" for="status">
                          Status
                        </label>
                        <input class="shadow appearance-none border rounded text-green-500 leading-tight" id="status" name="status" type="checkbox" placeholder=""
                        {{ $features->status == '1' ? 'checked': '' }}
                        >
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>  --}}

                      <div class="mt-5">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                         Update Article
                        </button>

                      </div>
                    </form>
                  </div>


    </section>


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

    @section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endsection


</x-admin-layout>
