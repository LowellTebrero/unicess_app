<div class="flex justify-evenly 2xl:space-x-5 xl:space-x-2 p-5 pb-0 xl:text-xs ">
    <div class="flex flex-col w-full">
            <div class="min-w-full inline-block align-middle">

                <div class="flex justify-between ">
                    <div></div>
                    <div class="flex flex-row space-x-1 p-4 py-2" id="showOptionDelete" style="display: none">
                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="YesDelete">Trash</button>
                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="selectAll">Select all</button>
                        <button class="text-xs rounded text-white px-2 py-1 bg-red-500" id="cancelButton">Cancel</button>
                    </div>
                </div>

                <div class="overflow-x-auto h-[67vh] border">

                    <table class="min-w-full divide-y divide-gray-200 ">
                        <thead>
                        <tr class="sticky top-0 bg-gray-100 z-10">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th scope="col" class="px-6 pr-0 py-3 text-left text-xs font-medium text-gray-500 uppercase w-[10rem]">Document Type</th>
                            <th scope="col" class="px-6 pr-0 py-3 text-left text-xs font-medium text-gray-500 uppercase w-[7rem]">Size</th>
                            <th scope="col" class="px-6 pr-0 py-3 text-left text-xs font-medium text-gray-500 uppercase w-[10rem]">Uploaded</th>
                            <th scope="col" class="text-left text-xs font-medium text-gray-500 uppercase w-[5rem]">Action</th>
                        </tr>
                        </thead>


                        <tbody class="divide-y divide-gray-200">
                            @foreach ($medias as $media )
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-200"  id="media_id{{ $media->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800">
                                        <div type="button" class="relative ">

                                            <x-alpine-modal>

                                                <x-slot name="scripts">

                                                    <div class="flex items-center space-x-2">
                                                        <div class="flex" target="__blank">
                                                            <div class="hidden lg:block">
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <img src="{{ asset('img/image-icon.png') }}"
                                                                    class="2xl:w-[2rem]" width="30" alt="">

                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <img src="{{ asset('img/docx.png') }}" class="2xl:w-[2rem]" width="25" alt="">
                                                                @else
                                                                <img src="{{ asset('img/pdf.png') }}" class="2xl:w-[2rem]"
                                                                    width="30" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div>
                                                            {{  Str::limit($media->file_name, 30) }}
                                                        </div>

                                                    </div>
                                                </x-slot>

                                                <x-slot name="title">
                                                    <span class="">{{ Str::limit($media->file_name) }}</span>
                                                </x-slot>

                                                <div class="w-[50rem]">
                                                    @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')

                                                    <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>

                                                    @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                    <div class="p-5 flex items-center flex-col">
                                                        <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                        <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                    </div>
                                                    @else
                                                    <div>
                                                    <iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe>
                                                    </div>
                                                    @endif
                                                </div>
                                            </x-alpine-modal>


                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-800 ">{{ $media->collection_name }}</td>
                                    <td class="px-6 py-4 pr-0 whitespace-nowrap text-xs text-gray-800 ">{{ $media->human_readable_size }}</td>
                                    <td class="px-6 py-4 pr-0 whitespace-nowrap text-xs text-gray-800 "> {{ \Carbon\Carbon::parse($media->created_at)->format('M d, y g:i:s A') }}</td>
                                    <td class="whitespace-nowrap text-left text-xs font-medium relative ">

                                        <div x-cloak  x-data="{'showModal{{ $media->id }}': false }" @keydown.escape="showModal{{ $media->id }} = true" class="absolute right-2 top-7 ">

                                            <!-- Modal -->
                                            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="showModal{{ $media->id }}">

                                                <!-- Modal inner -->
                                                <div class="w-1/2 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal{{ $media->id }}"
                                                    x-transition:enter="motion-safe:ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal{{ $media->id }} = false">

                                                    <!-- Title / Close-->
                                                    <div class="flex items-center justify-between px-4 py-1">
                                                        <h5 class="mr-3 text-black max-w-none text-sm">Detail file</h5>
                                                        <button type="button" class="z-50 cursor-pointer text-red-500 hover:bg-gray-200 rounded px-2 py-1 text-xl font-semibold" @click="showModal{{ $media->id }} = false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <hr>

                                                    <!-- content -->
                                                    <div>
                                                        <div class="p-4 md:p-5 space-y-2 ">
                                                            <h1 class="text-md  tracking-wide">
                                                            Uploaded on : {{ \Carbon\Carbon::parse($media->created_at)->format('M d, Y,  g:i:s A')}}
                                                            </h1>

                                                            <h1 class="text-md  tracking-wide">
                                                            File name: {{ Str::limit($media->file_name, 70) }}
                                                            </h1>

                                                            <h1 class="text-md  tracking-wide">
                                                            File type: {{ $media->mime_type }}
                                                            </h1>
                                                            <h1 class="text-md  tracking-wide">
                                                            File size: {{ $media->size }} kb
                                                            </h1>
                                                            <h1 class="text-md  tracking-wide">
                                                            Document type: {{ $media->collection_name }}
                                                            </h1>
                                                            <h1 class="text-md  tracking-wide">
                                                            File Owner :
                                                            @foreach ($users as $user )
                                                                @if ($user->id == $media->name)
                                                                    {{ $user->name }}
                                                                @endif
                                                            @endforeach
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--  <!-- Main modal -->
                                            <div id="default-modal{{ $media->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            File details
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal{{ $media->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-2 ">
                                                            <h1 class="text-md text-white tracking-wide">
                                                            Uploaded on : {{ \Carbon\Carbon::parse($media->created_at)->format('M d, Y,  g:i:s A')}}
                                                            </h1>

                                                            <h1 class="text-md text-white tracking-wide">
                                                            File name: {{ Str::limit($media->file_name, 70) }}
                                                            </h1>

                                                            <h1 class="text-md text-white tracking-wide">
                                                            File type: {{ $media->mime_type }}
                                                            </h1>
                                                            <h1 class="text-md text-white tracking-wide">
                                                            File size: {{ $media->size }} kb
                                                            </h1>
                                                            <h1 class="text-md text-white tracking-wide">
                                                            Document type: {{ $media->collection_name }}
                                                            </h1>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>  --}}


                                            <div class="checkbox-wrapper-12 absolute  left-[-2rem] top-[-0.5rem]">
                                                <div class="cbx">
                                                  <input type="checkbox" class="hidden-checkbox" name="ids" value="{{ $media->id }}" style="display: none">
                                                  <label for="cbx-12"></label>
                                                  <svg fill="none" viewBox="0 0 15 14" height="12" width="14">
                                                    <path d="M2 8.36364L6.23077 12L13 2"></path>
                                                  </svg>
                                                </div>
                                            </div>

                                            <div type="button" class="dropdownButtons relative" style="display: block">

                                                <div class="absolute left-4 lg:left-[-0.55rem] bottom-[2.5rem]">
                                                    <x-tooltip-modal>
                                                        <!-- Modal toggle -->
                                                        <div class="flex flex-col space-y-2 items-start pl-2 text-gray-600 ">
                                                            <button class="block text-xs hover:text-black" type="button" @click="showModal{{ $media->id }} = true">Detail</button>
                                                            {{--  <button data-modal-target="default-modal{{ $media->id }}" data-modal-toggle="default-modal{{ $media->id }}" class="block text-xs hover:text-black" type="button">Details</button>  --}}
                                                            <a href={{ route('admin.inventory.admin-download-media', $media->id) }} class="block text-xs hover:text-black" x-data="{dropdownMenu: false}">Download</a>
                                                            @if ($media->count() > 1)
                                                            <button class="DeleteButton block text-slate-800 text-xs hover:bg-gray-200 w-full text-left hover:text-black" type="button">Move to Trash</button>
                                                            @else
                                                            <form action="{{ route('inventory-trash-media', $media->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm ('Are you sure?')" >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="block text-slate-800 text-xs hover:text-black" type="submit">
                                                                    Move to Trash
                                                                </button>
                                                            </form>
                                                            @endif


                                                        </div>

                                                    </x-tooltip-modal>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        $(document).ready(function () {
            // Get the toggle all button
            var DeleteButton = $('#selectAll');
            var deleteSelectedButton = $('#YesDelete');
            // Get all checkboxes inside the foreach loop
            var checkboxes = $('.hidden-checkbox');

            // Add click event listener to the toggle all button
            DeleteButton.on('click', function () {
                // Check if all checkboxes are checked
                var allChecked = checkboxes.toArray().every(function (checkbox) {
                    return checkbox.checked;
                });

                // If all checkboxes are checked, reset all checkboxes; otherwise, check all checkboxes
                checkboxes.each(function () {
                    this.checked = !allChecked;
                });
            });

            deleteSelectedButton.on('click', function () {
                // Filter out the checked checkboxes
                var checkedCheckboxes = $('.hidden-checkbox:checked');

                // Create an array to store the IDs of checked checkboxes
                var all_ids = checkedCheckboxes.map(function () {
                    return $(this).val();
                }).get();

                if (all_ids.length > 0) {
                    // Perform deletion logic for the checked checkboxes
                    if (confirm('Are you sure you want move this to trash?')) {
                        $.ajax({
                            url: "{{ route('inventory.trash-media-json') }}",
                            type: "DELETE",
                            data: {
                                ids: all_ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                checkedCheckboxes.each(function () {
                                    // Replace 'proposal_id' with the appropriate ID prefix
                                    $('#media_id' + $(this).val()).remove();
                                });
                                if (response.success) {
                                    toastr.success(response.success);
                                    // Additional logic if needed
                                } else if (response.error) {
                                    toastr.error(response.error);
                                    // Additional error handling logic
                                }
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error('Error in AJAX request');
                            }
                        });
                    }
                } else {
                    toastr.warning('No checkboxes are selected for deletion.');
                }
            });
        });



        $(document).ready(function () {

            $('.DeleteButton').on('click', function () {
                var hiddenCheckboxes = $('.hidden-checkbox');
                var dropdownButton = $('.dropdownButtons');
                $('#showOptionDelete').css('display', 'block');

                hiddenCheckboxes.each(function () {
                    if ($(this).css('display') === 'none' || $(this).css('display') === '') {
                        $(this).css('display', 'block');
                    } else {
                        $(this).css('display', 'none');
                    }
                });

                dropdownButton.each(function () {
                    if ($(this).css('display') === 'block') {
                        $(this).css('display', 'none');
                    } else {
                        $(this).css('display', 'block');
                    }
                });
            });

            $('#cancelButton').on('click', function () {
                var hiddenCheckbox = $('.hidden-checkbox');
                var tooltipButtons = $('.dropdownButtons');

                hiddenCheckbox.each(function () {
                    if ($(this).css('display') === 'block') {
                        $(this).prop('checked', false);
                        $(this).css('display', 'none');
                    }
                });

                $('#showOptionDelete').css('display', 'none');

                tooltipButtons.each(function () {
                    if ($(this).css('display') === 'none') {
                        $(this).css('display', 'block');
                    } else {
                        $(this).css('display', 'none');
                    }
                });
            });
        });



    </script>
