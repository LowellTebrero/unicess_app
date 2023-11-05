<x-app-layout>
    <style> [x-cloak] { display: none}</style>
    <section class="m-8 min-h-[87vh] bg-white mt-5  rounded-lg shadow text-slate-700">

        <div class=" flex justify-between p-5">
            <h1 class="text-sm  tracking-wide">{{ $proposals->project_title }}</h1>
            <a href={{ route('User-dashboard.index') }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <hr>

        <div class="p-4 ">
                <div class="flex w-full justify-between p-5">
                    <div>
                        <img src="{{ asset('img/track.svg') }}" width="300">

                        <div class=" text-xs flex flex-row justify-between pt-2 ">
                            <div class="flex flex-col">
                                <h1>Uploaded at</h1>
                                <h1>{{ $proposal->created_at->format('M. d, Y') }}</h1>
                            </div>
                            <div class="flex flex-col">
                                <h1>Started date</h1>
                                <h1>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $proposal->started_date)->format('M. d, Y') }}
                                </h1>
                            </div>
                            <div class="flex flex-col">
                                <h1>Ended date</h1>
                                <h1>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $proposal->finished_date)->format('M. d, Y') }}
                                </h1>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-y-2 xl:text-xs text-sm tracking-wider text-gray-600 flex-col  items-end ">
                        <h1>Proposal ID: {{ $proposal->id }}</h1>
                        <h1>Status: {{ strtoupper($proposal->authorize) }}</h1>
                        @include('user.dashboard.show-user._see-details-show-user-proposal')
                        <a href={{ route('inventory.show', $proposal->id) }} class="bg-blue-500 px-2 py-2 rounded text-white hover:bg-blue-600">Go to Inventory</a>
                    </div>
                </div>



                <div class="mt-4 m-5 min-h-[50vh] bg-gray-200 space-y-2 text-sm tracking-wider rounded">

                    <div class="flex justify-between py-2 px-4  tracking-wide bg-gray-600 text-white">
                        <h1>Time</h1>
                        <h1>Information</h1>

                    </div>

                    <div class="px-4 space-y-1">
                        <div class="flex justify-between w-full  xl:text-[.7rem] 2xl:text-[.8rem]">
                            <h1>{{ $proposal->created_at }} </h1>
                            <h1> Proposal uploaded</h1>

                        </div>

                        <div class="flex justify-between w-full xl:text-[.7rem] 2xl:text-[.8rem] ">
                            @foreach ($proposal->medias as $mediaLibrary)
                                @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'proposalPdf'))
                                    <span class="block">{{ $mediaLibrary->created_at }}</span>
                                    <h1>{{ Str::limit($mediaLibrary->file_name) }} file uploaded</h1>
                                @endif
                            @endforeach
                        </div>

                        <div class="flex justify-between w-full  xl:text-[.7rem] 2xl:text-[.8rem]">
                            @foreach ($proposal->medias as $mediaLibrary)
                                @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'specialOrderPdf'))
                                    <span class="block">{{ $mediaLibrary->created_at }}</span>
                                    <h1>{{ Str::limit($mediaLibrary->file_name) }} file uploaded</h1>
                                @endif
                            @endforeach
                        </div>


                        @foreach ($proposal->medias as $mediaLibrary)
                            @if (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'MoaPDF'))
                                <div class="flex justify-between w-full xl:text-[.7rem] 2xl:text-[.8rem]">
                                    <span class="block">{{ $mediaLibrary->created_at }}</span>
                                    <h1>{{ Str::limit($mediaLibrary->file_name) }} file uploaded</h1>
                                </div>
                            @elseif(!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'officeOrder'))
                                <div class="flex justify-between w-full xl:text-[.7rem] 2xl:text-[.8rem] ">
                                    <span class="block">{{ $mediaLibrary->created_at }}</span>
                                    <h1>{{ Str::limit($mediaLibrary->file_name) }} file uploaded</h1>
                                </div>
                            @elseif (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'travelOrder'))
                                <div class="flex justify-between w-full xl:text-[.7rem] 2xl:text-[.8rem] ">
                                    <span class="block">{{ $mediaLibrary->created_at }}</span>
                                    <h1>{{ Str::limit($mediaLibrary->file_name) }} file uploaded</h1>
                                </div>
                            @elseif (!empty($mediaLibrary->model_id) && !empty($mediaLibrary->collection_name == 'otherFile'))
                                <div class="flex justify-between w-full xl:text-[.7rem] 2xl:text-[.8rem] ">
                                    <span class="block">{{ $mediaLibrary->created_at }}</span>
                                    <h1>{{ Str::limit($mediaLibrary->file_name) }} file uploaded</h1>
                                </div>
                            @endif
                        @endforeach


                    </div>

                </div>


        </div>
    </section>

</x-app-layout>
