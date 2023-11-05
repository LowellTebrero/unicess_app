<x-admin-layout>




    <div class="py-12 px-4 w-3/5  m-auto ">

        <div class="max-w-full mx-auto sm:px-6 lg:px-8 mt-16">
            <div class="bg-white shadow-sm sm:rounded-lg drop-shadow-lg h-3/4">

                    <div class="p-5  flex items-center justify-between">
                    <h1 class="text-slate-700">Edit Article</h1>
                    <a class=" rounded-md text-white" href={{ route('admin.features.index') }}>
                        <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="40"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg>
                    </a>

                    </div>
                    <hr>





                    <div class="w-full p-5 drop-shadow-md">

                    {{--  FORM   --}}
                    <form action="{{route('admin.features.update', $features->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                              Title
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder=""
                            value = "{{$features->title}}">
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>


                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                              Description
                            </label>
                            <textarea id="editor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                            focus:outline-none focus:shadow-outline" id="description" name="description" type="text"
                            placeholder="">{{$features->description}}
                            </textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>


                    <div class="mb-4">
                        <label class="block text-gray-700 text-xs font-bold mb-2" for="status">
                          Status
                        </label>
                        <input class="shadow appearance-none border rounded text-green-500 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" type="checkbox" placeholder=""
                        {{ $features->status == '1' ? 'checked': '' }}
                        >
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>


                      <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                          Image
                        </label>
                        <input type="file" id="feature_image" class="shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="feature_image" placeholder=""
                        value = "{{$features->feature_image}}">
                        @error('feature_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>





                    <div class="">
                        <label for=""></label>
                        <div class="p-2 w-48 ">
                            <img id="showImage" src="{{ (!empty($features->feature_image))? url('upload/image-folder/features-folder/'. $features->feature_image): url('upload/no-image.png') }}" alt="">
                        </div>
                    </div>


                      <div class="flex items-center justify-between mt-5">
                        <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                         Update Article
                        </button>

                      </div>
                    </form>

                  </div>

            </div>
        </div>
    </div>


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
