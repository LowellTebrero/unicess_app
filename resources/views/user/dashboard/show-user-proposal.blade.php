<x-app-layout>

    @php($count=0)
    <style> [x-cloak] { display: none}</style>
    <section class="m-8 h-[82vh] 2xl:h-[87vh] bg-white mt-4 2xl:mt-5  rounded-lg shadow text-slate-700 ">

        <div class="flex justify-between p-5 py-3">
            <h1 class="text-sm  tracking-wide">{{ $proposals->project_title }}</h1>
            <a href={{ route('User-dashboard.index') }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <hr>

        <div class="p-4">
                <div class="flex w-full justify-between p-5 py-0">
                    <div>
                        <img src="{{ asset('img/track.svg') }}" width="300">

                        <div class=" text-xs flex flex-row justify-between pt-2 text-gray-600">
                            <div class="flex flex-col">
                                <h1>Uploaded at</h1>
                                <h1>{{ $proposal->created_at->format('M. d, Y') }}</h1>
                            </div>
                            <div class="flex flex-col">
                                <h1>Started date</h1>
                                <h1>{{ $proposal->started_date == null ? 'No date' : $proposal->started_date->format('M. d, Y') }}</h1>
                            </div>
                            <div class="flex flex-col">
                                <h1>Ended date</h1>
                                <h1>{{ $proposal->finished_date == null ? 'No date' :  $proposal->finished_date->format('M. d, Y') }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-y-2 text-xs tracking-wider text-gray-600 flex-col  items-end ">
                        <h1>Project ID: {{ $proposal->id }}</h1>
                        <h1>Status: {{ strtoupper($proposal->authorize) }}</h1>
                        @include('user.dashboard.show-user._see-details-show-user-proposal')
                        <a href={{ route('inventory.show', ['id' => $proposal->id, 'notification' => $proposal->id ]) }} class="bg-blue-500 px-2 py-2 rounded text-white hover:bg-blue-600">Go to Inventory</a>
                    </div>
                </div>



                <div class="m-5 overflow-x-auto h-[40vh] 2xl:h-[50vh] bg-gray-200 space-y-2 text-sm tracking-wider rounded">

                    <div class="flex justify-between py-2 px-4  tracking-wide bg-gray-600 text-white sticky top-0">
                        <h1>Time</h1>
                        <h1>Information</h1>
                    </div>

                    <div class="px-4 space-y-1">
                        <div class="flex justify-between w-full text-[.7rem] 2xl:text-[.8rem]">
                            <h1>{{ $proposal->created_at }} </h1>
                            <h1> Proposal uploaded</h1>
                        </div>

                        @foreach ($proposal->medias as $mediaLibrary)
                        @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name))
                        <div class="flex justify-between w-full text-[.7rem] 2xl:text-[.8rem] ">
                            <span class="block">{{ $mediaLibrary->created_at }}</span>
                            <h1>{{ Str::limit($mediaLibrary->file_name, 90) }} file uploaded</h1>
                        </div>
                        @endif
                        @endforeach
                    </div>


                </div>
        </div>
    </section>

</x-app-layout>


    <script>

        var count = {{ $count }};


        $(document).on('click', '.remove-table-row', function(){
            count--;
            $(this).parents('tr').remove();

        });


        $('#add').click(function(){
            count++;
            addDivAndSetSelectName(count);
        });


        function addDivAndSetSelectName(index){

            $('#table').append(
                `<tr>
                    <td class="pr-4 pt-2">
                        <select name="member[`+index+`][id]" class="rounded-md xl:text-xs w-full border-zinc-400" id="member" required>
                            @foreach ($members as $id => $name )
                            <option value="{{ $id }}"
                            >{{ $name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="pr-4 pt-2">
                        <select  name="member[`+index+`][type]" class="rounded-md xl:text-xs w-full border-zinc-400" required>
                            <option value="">Select Type </option>
                            @foreach ($parts_names as $id => $name )
                            <option value="{{ $name }}"
                            @if ($id == old('parts_names_id'))
                                selected="selected"
                            @endif
                            >{{ $name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="pr-2">
                        <button type="button" class="bg-red-500 remove-table-row text-xs text-white px-2 py-1 rounded">Remove</button>
                    </td>
                </tr>`
            );
        }

    </script>
