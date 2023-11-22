<x-admin-layout>

    <section class="m-8 mt-5 rounded-lg shadow-md bg-white 2xl:min-h-[87vh] h-[85vh]">

        <header class="flex justify-between items-center p-5 py-4">
            <h1 class="font-semibold text-gray-600 tracking-wider text-lg 2xl:text-2xl">Create Event Section</h1>
            <a class="hover:bg-gray-200 rounded-md text-white" href={{ route('admin.other-events-ceso-events') }}>
                <svg class="fill-black" xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 96 960 960" width="25"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg>
            </a>
        </header>
        <hr>

        <div>
            <div class="m-12 mt-5 text-gray-700">
                <form action="{{route('admin.other-events-ceso-store-events')}}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="flex space-x-4">
                        <div class="mb-4 w-full">
                            <label class="block text-gray-600 text-sm font-semibold tracking-wider mb-2">Project Title</label>
                            <input class=" border border-slate-300  rounded w-full py-2 px-3 text-gray-600  leading-tight" id="title" name="title" type="text" placeholder="">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror


                        </div>

                        <div class="mb-6 flex flex-col">
                            <label class="block text-gray-600 font-semibold tracking-wider text-xs" for="description">Image</label>
                            <input type="file" class="appearance-none border rounded mt-3 px-3 text-xs text-gray-600" name="image">
                            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-4 overflow-x-auto h-[55vh] 2xl:h-[50vh]">
                        <label class="block text-gray-600 text-sm font-semibold mb-2 tracking-wider">Description</label>
                        <textarea id="editor" class="w-[50rem] h-52" name="description"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>





                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold  text-sm tracking-wider py-2 px-4 rounded-lg" type="submit">
                            Create Event
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </section>


</x-admin-layout>


    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
