
    <style>
        [x-cloak] { display: none }
    </style>

<x-admin-layout>

        <section class="m-8 mt-5 rounded-lg shadow-md bg-slate-100">

    <div class=" flex justify-between mb-5 p-10">
        <h1 class="text-xl">Event Dashboard</h1>


    <x-alpine-modal class="">

        <x-slot name="scripts" class="m-16">
            <h1 class="text-sm bg-blue-600 px-2 py-2 rounded-md text-white xl:text-[.8rem] 2xl:text-sm xl:text-xs flex">+ Create Event</h1>
        </x-slot>

          <x-slot name="title" >
            <h1> Create Event</h1>
      </x-slot>

        {{--  Content  --}}
        <div class="m-12">

            <form action="{{route('admin.other-events-ceso-store-events')}}" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                  Title
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
              Description
            </label>
            <textarea id="editor" class="w-[50rem] h-52 " name="description"></textarea>
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
                <input type="file" id="image" class="shadow appearance-none border rounded  py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  name="image" placeholder="">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>



            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                 Create Event
                </button>

              </div>
            </form>

        </div>
    </x-alpine-modal>
    </div>



            @if ($event->isEmpty())
            @else
            <div class="items-center p-10 w-full">


                            <table class="w-full">
                                <thead class="border-b">

                                <tr class="text-black">
                                    <th scope="col" class="text-md xl:text-[.8rem] 2xl:text-md px-3 py-4 text-left text-gray-800 font-semibold">
                                    Created
                                    </th>
                                    <th scope="col" class="text-md xl:text-[.8rem] 2xl:text-md   py-4 text-left text-gray-800 font-semibold">
                                    Title
                                    </th>
                                    <th scope="col" class="text-md  xl:text-[.8rem] 2xl:text-md  py-4 text-left text-gray-800 font-semibold">
                                    Description
                                    </th>
                                    <th scope="col" class="text-md xl:text-[.8rem] 2xl:text-md   py-4 text-left text-gray-800 font-semibold">
                                    Status
                                    </th>
                                    <th scope="col" class="text-md  xl:text-[.8rem] 2xl:text-md  py-4 text-left text-gray-800 font-semibold">
                                    Image
                                    </th>

                                    <th scope="col" class="text-md xl:text-[.8rem] 2xl:text-md   py-4 text-left text-gray-800 font-semibold">
                                    Option
                                    </th>
                                </tr>
                                @endif
                            </thead>
                            <tbody >
                                @foreach ($event as $latest )
                                <tr class="border-b w-full">
                                    <td class="px-3 py-4 whitespace-nowrap text-xs w-32 font-medium text-gray-900 xl:text-[.6rem]"> {{ $latest->updated_at->diffForHumans() }}</td>
                                    <td class=" py-4 whitespace-nowrap  w-52 text-sm font-medium text-gray-900 xl:text-[.7rem]"> {{Str::limit($latest->title, 20)}}</td>
                                    <td class="text-sm text-gray-900 font-light xl:w-96 2xl:w-1/2   py-4 whitespace-nowrap xl:text-[.7rem]">{!! Str::limit($latest->description, 60) !!}</td>
                                    <td class="text-sm text-green-600 font-light  w-32 py-4 whitespace-nowrap xl:text-[.7rem]">
                                        @if ($latest->status == '0')
                                             <span class="text-red-500">hidden</span>
                                        @else
                                            visible
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900 font-light pr-5  py-3 whitespace-nowrap w-16">
                                        <img class="rounded-2xl " id="showImage" src="{{ (!empty($latest->image))? url('upload/image-folder/event-folder/'. $latest->image): url('upload/no-image.png') }}"   alt="">
                                    </td>

                                    <td class="text-sm text-blue-500 font-light  py-4 my-auto whitespace-nowrap flex  mt-2 ">
                                      <a href="{{ route('admin.other-events-ceso-edit-events', $latest->id) }}"> Edit</a>
                                        <form action="{{ route('admin.other-events-ceso-delete-events', $latest->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
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
    <x-messages/>
    </section>

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


