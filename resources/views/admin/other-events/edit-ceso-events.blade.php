<x-admin-layout>

    <section class="bg-white shadow-sm sm:rounded-lg m-8 mt-5 2xl:min-h-[87vh] h-[85vh]">
        <div class="p-5 py-4 flex items-center justify-between">
            <h1 class="text-lg tracking-wider text-gray-600 font-semibold 2xl:text-2xl">Edit Event</h1>
            <a class="hover:bg-gray-200 rounded-md text-white" href={{ route('admin.other-events-ceso-events') }}>
                <svg class="fill-black" xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 96 960 960" width="40"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg>
            </a>
        </div>
        <hr>

        <div class="w-full p-5 2xl:py-5">
            <form action="{{route('admin.other-events-ceso-update-events', $latestEvents->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="flex space-x-4 ">
                <div class="mb-4 w-full">
                    <label class="block text-gray-600 text-sm font-medium mb-2">Event Title:</label>
                    <input class="xl:text-sm appearance-none border border-slate-300 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder=""
                    value = "{{$latestEvents->title}}">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="xl:flex items-center">

                    <div class="mb-4">
                        <label class="block text-gray-600 text-sm font-semibold tracking-wider mb-2" for="description">Image</label>
                        <input type="file" id="image" class="shadow appearance-none border rounded xl:text-xs  px-3 text-gray-700 leading-tight"  name="image"
                        value="{{$latestEvents->image}}">
                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="p-2 w-48 xl:w-16 ">
                        <img id="showImage" src="{{ (!empty($latestEvents->image))? url('upload/image-folder/event-folder/'. $latestEvents->image): url('upload/no-image.png') }}" alt="">
                    </div>
                </div>

                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 text-sm font-medium mb-2">Description</label>
                    <div class="overflow-x-auto h-[40vh] rounded">
                        <textarea class="summernote appearance-none w-full px-3 text-gray-700 leading-tight text-sm" id="editor" name="description" type="text">
                            {{$latestEvents->description}}
                        </textarea>
                    </div>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>



                <div class="mt-5">
                    <button class=" bg-blue-500 hover:bg-blue-700 text-white font-semibold tracking-wider py-2 px-4 rounded-lg" type="submit">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </section>


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
