<x-admin-layout>


    <div class="py-12 w-full ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-2  flex items-center justify-between">
                <h1></h1>
                <a class=" rounded-md text-white" href={{ route('admin.latest-news.index') }}>
                    <svg class="fill-red-600" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48"><path d="m448 730 112-112 112 112 43-43-113-111 111-111-43-43-110 112-112-112-43 43 113 111-113 111 43 43ZM120 576l169-239q13-18 31-29.5t40-11.5h420q24.75 0 42.375 17.625T840 356v440q0 24.75-17.625 42.375T780 856H360q-22 0-40-11.5T289 815L120 576Zm75 0 154 220h431V356H349L195 576Zm585 0V356v440-220Z"/></svg>
                </a>
                </div>


                <div class="w-full p-5">
                    <form action="{{route('admin.latest-news.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                          Title
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                      <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                          Description
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text" placeholder=""></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                      <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                          Status
                        </label>
                        <input class="shadow appearance-none border rounded text-green-500 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status" type="checkbox" placeholder="">
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                      <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                          Image
                        </label>
                        <input type="file" id="image" class="shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="image" placeholder="">
                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for=""></label>
                        <div class="p-2">
                            <img id="showImage" src="{{ asset('upload/no-image.png') }}" width="200px" alt="">
                        </div>
                    </div>

                      <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                         Create Event
                        </button>

                      </div>
                    </form>
                  </div>

            </div>
        </div>
    </div>

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






</x-admin-layout>
