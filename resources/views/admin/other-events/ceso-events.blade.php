<x-admin-layout>

    <style>
        [x-cloak] { display: none }
    </style>

    <section class="m-8 mt-5 rounded-lg shadow-md bg-white 2xl:min-h-[87vh] h-[85vh]">

        <div class="flex justify-between p-5 py-4">
            <h1 class="font-semibold text-gray-600 tracking-wider text-lg 2xl:text-2xl">Event Section</h1>
        </div>
        <hr>

        <div class="p-5">
            <a href={{ route('admin.other-events-ceso-create-events') }} class="bg-blue-500 text-sm rounded-lg px-3 py-2 text-white">+ Create Event</a>
        </div>

            @if ($event->isEmpty())
            @else
            <div class="m-10 mt-0 mx-5 px-0 overflow-x-auto h-[65vh] 2xl:h-[70vh] rounded-lg border ">
                <table class="table-auto w-full relative">
                    <thead
                        class="text-[.7rem] font-semibold uppercase text-gray-400 bg-gray-50 top-0 sticky z-10">
                        <tr>
                            <th class="p-2 whitespace-nowrap w-[5rem]">
                                <div class="font-semibold text-left">Created</div>
                            </th>

                            <th class="p-2 whitespace-nowrap  w-[45rem]">
                                <div class="font-semibold text-left">Title</div>
                            </th>

                            <th class="p-2 whitespace-nowrap w-[2rem]">
                                <div class="font-semibold text-center">
                                    Image
                                </div>
                            </th>

                            <th class="p-2 whitespace-nowrap w-[5rem]">
                                <div class="font-semibold text-right">
                                    Status
                                </div>
                            </th>

                            <th class="p-2 whitespace-nowrap w-[3rem]">
                                <div class="font-semibold text-right">
                                    Option
                                </div>
                            </th>
                        </tr>
                    </thead>


                    <tbody class="text-xs divide-y divide-gray-100 ">

                        @foreach ($event as $latest )
                            <tr class="hover:bg-gray-100">

                                <td class="p-3 whitespace-nowrap w-[5rem]">
                                    <a href="{{ route('admin.other-events-ceso-edit-events', $latest->id) }}">
                                    <div class="text-left text-gray-700 xl:text-[.7rem]">
                                        {{ \Carbon\Carbon::parse($latest->created_at)->format('M d, Y,  g:i:s A')}}
                                    </div>
                                    </a>
                                </td>

                                <td class="p-3 whitespace-nowrap">
                                    <a href="{{ route('admin.other-events-ceso-edit-events', $latest->id) }}">
                                    <div class="text-left text-gray-700  xl:text-[.7rem]">
                                       {{Str::limit($latest->title, 100)}}
                                    </div>
                                    </a>
                                </td>


                                <td class="p-3 whitespace-nowrap w-[3rem]">
                                    <a href="{{ route('admin.other-events-ceso-edit-events', $latest->id) }}">
                                    <div class="text-left text-gray-700">
                                        <img class="rounded-lg" id="showImage"  src="{{ (!empty($latest->image))? url('upload/image-folder/event-folder/'. $latest->image): url('upload/no-image.png') }}">
                                    </div>
                                    </a>
                                </td>

                                <td class="p-3 whitespace-nowrap">

                                    <div class="text-right text-gray-700 2xl:text-xs xl:text-[.6rem]">
                                        <input
                                        class="task-checkbox mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                        type="checkbox" data-task-id="{{ $latest->id }}"
                                        data-task-status="{{ $latest->status }}" {{ $latest->status == 'open' ? 'checked' : '' }} />
                                    </div>

                                </td>


                                <td class="p-3 whitespace-nowrap  text-right">
                                    <div class="text-right text-gray-700 ">
                                        <form action="{{ route('admin.other-events-ceso-delete-events', $latest->id) }}" method="POST" onsubmit="return confirm ('Are you sure?')">
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
            @endif

    </section>

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
                url: '{{ route('admin.tasks.update-status') }}',
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

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    @endsection

</x-admin-layout>


