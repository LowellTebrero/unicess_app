    <style>
        [x-cloak] { display: none }
    </style>


    <x-app-layout>

    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    @if (Auth::user()->authorize == 'checked')
        @unlessrole('admin|New User')
            <style>
                [x-cloak] {display: none}
            </style>

            <section class="m-8 rounded-lg  relative mt-4 2xl:mt-5 h-[82vh] 2xl:h-[87vh]  bg-white text-gray-700 overflow-x-auto">

                @if ($proposals == null)
                <div class="flex justify-between p-5 py-3">
                    <h1 class="text-lg tracking-wide">404 Error: Not Found</h1>
                    <a href={{ URL::previous() }} class="text-red-500 text-lg font-medium dynamic-link hover:bg-gray-200 rounded focus:bg-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <hr>
                <div class="flex items-center justify-center mt-12">
                    <h1 class="text-2xl tracking-wide text-gray-700">404 Error:<span class="text-red-500"> Not Found</span> </h1>
                </div>

                @else
                <div class="p-4 flex justify-between items-center bg-white sticky top-0 z-10">
                    <h1 class="font-semibold tracking-wider md:text-lg text-base xl:text-2xl">Show Program/Projects</h1>
                    <a href={{ URL::previous() }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <hr>

                <div>
                    <h1 class="text-sm p-4">{{ $proposals->project_title }}</h1>
                </div>
                <main class="p-4 grid 2xl:grid-cols-8 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-1  gap-2">

                    @foreach($uniqueProposalFiles as $proposalfile)

                    @if ($proposalfile->collection_name == 'proposalPdf')
                        <div class="w-[10rem]  xl:w-[12rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-proposal" data-modal-toggle="default-modal-proposal" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Proposal Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-proposal" tabindex="-1" aria-hidden="true" class="modal-wrapper hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                            Proposal Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-proposal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                                @if ($media->collection_name == 'proposalPdf')

                                                    <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                            <!-- Modal toggle -->
                                                        <button data-modal-target="proposal-media-modal{{ $media->id}}" data-modal-toggle="proposal-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                            @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'text/plain')
                                                                <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @else
                                                                <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @endif
                                                            <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                        </button>
                                                    </div>

                                                    <div id="proposal-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                    <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="proposal-media-modal{{ $media->id}}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div>
                                                                    @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                    <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                    @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                    <div class="p-5 flex items-center flex-col">
                                                                        <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                        <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                    </div>

                                                                    @else
                                                                        <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'moaPdf')
                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-moa" data-modal-toggle="default-modal-moa" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">MOA  Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-moa" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                            MOA Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-moa">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                                @if ($media->collection_name == 'moaPdf')

                                                    <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                        <!-- Modal toggle -->
                                                        <button data-modal-target="moa-media-modal{{ $media->id}}" data-modal-toggle="moa-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                            @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'text/plain')
                                                                <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @else
                                                                <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @endif
                                                            <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                        </button>
                                                    </div>

                                                    <div id="moa-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                    <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="moa-media-modal{{ $media->id}}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div>
                                                                    @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                    <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                    @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                    <div class="p-5 flex items-center flex-col">
                                                                        <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                        <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                    </div>

                                                                    @else
                                                                        <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'otherFile')

                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button  data-modal-target="default-modal-otherfile" data-modal-toggle="default-modal-otherfile" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Other Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-otherfile" tabindex="-1" aria-hidden="true" class="folder modal-wrapper hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                                <div class="relative p-4 w-full max-w-5xl h-[80%]">

                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">

                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">Other Folder</h3>
                                            <button type="button" class="CloseButton text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-otherfile">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>


                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                                @if ($media->collection_name == 'otherFile')

                                                    <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                        <!-- Modal toggle -->
                                                        <button data-modal-target="otherfile-media-modal{{ $media->id}}" data-modal-toggle="otherfile-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                            @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'text/plain')
                                                                <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @else
                                                                <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @endif
                                                            <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                        </button>
                                                    </div>

                                                    <div id="otherfile-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                                <!-- Modal header -->
                                                                <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                    <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="otherfile-media-modal{{ $media->id}}">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div>
                                                                    @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                    <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                    @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                    <div class="p-5 flex items-center flex-col">
                                                                        <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                        <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                    </div>

                                                                    @else
                                                                        <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'travelOrderPdf')
                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-travelorder" data-modal-toggle="default-modal-travelorder" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4"> Travel Order Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-travelorder" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                            Travel Order Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-travelorder">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                            @if ($media->collection_name == 'travelOrderPdf')

                                            <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="">
                                                    <!-- Modal toggle -->
                                                <button data-modal-target="travelorder-media-modal{{ $media->id}}" data-modal-toggle="travelorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                        @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                            <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'text/plain')
                                                            <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                            <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @else
                                                            <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @endif
                                                        <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                </button>
                                                </div>

                                                <div id="travelorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="travelorder-media-modal{{ $media->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div>
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <div class="p-5 flex items-center flex-col">
                                                                    <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                    <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                </div>

                                                                @else
                                                                    <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'specialOrderPdf')
                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-specialorder" data-modal-toggle="default-modal-specialorder" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Special Order Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-specialorder" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Special Order Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-specialorder">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 grid grid-cols-3 gap-3">
                                            @foreach ($proposals->medias as $media)
                                            @if ($media->collection_name == 'specialOrderPdf')

                                                <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="specialorder-media-modal{{ $media->id}}" data-modal-toggle="specialorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                            @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'text/plain')
                                                                <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @else
                                                                <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @endif
                                                            <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                    </button>
                                                </div>

                                                <div id="specialorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="specialorder-media-modal{{ $media->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div>
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <div class="p-5 flex items-center flex-col">
                                                                    <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                    <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                </div>

                                                                @else
                                                                    <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'officeOrderPdf')
                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-officeorder" data-modal-toggle="default-modal-officeorder" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Office Order Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-officeorder" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Office Order Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-officeorder">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                            @if ($media->collection_name == 'officeOrderPdf')
                                                <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="officeorder-media-modal{{ $media->id}}" data-modal-toggle="officeorder-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                            @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'text/plain')
                                                                <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @else
                                                                <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @endif
                                                            <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                    </button>
                                                </div>

                                                <div id="officeorder-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="officeorder-media-modal{{ $media->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div>
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <div class="p-5 flex items-center flex-col">
                                                                    <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                    <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                </div>

                                                                @else
                                                                    <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'Attendance')
                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-attendance" data-modal-toggle="default-modal-attendance" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Attendance Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-attendance" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Attendance Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-attendance">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                            @if ($media->collection_name == 'Attendance')

                                                <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="attendance-media-modal{{ $media->id}}" data-modal-toggle="attendance-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                        @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                            <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'text/plain')
                                                            <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                            <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @else
                                                            <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @endif
                                                        <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                    </button>
                                                </div>

                                                    <div id="attendance-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="attendance-media-modal{{ $media->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div>
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <div class="p-5 flex items-center flex-col">
                                                                    <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                    <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                </div>

                                                                @else
                                                                    <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'AttendanceMonitoring')
                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-attendancemonitoring" data-modal-toggle="default-modal-attendancemonitoring" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Attendance Monitoring Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-attendancemonitoring" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Attendance Monitoring Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-attendancemonitoring">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                            @if ($media->collection_name == 'AttendanceMonitoring')

                                                <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                    <!-- Modal toggle -->
                                                    <button data-modal-target="attendancemonitoring-media-modal{{ $media->id}}" data-modal-toggle="attendancemonitoring-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                        @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                            <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'text/plain')
                                                            <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                            <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @else
                                                            <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @endif
                                                        <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                    </button>
                                                </div>

                                                    <div id="attendancemonitoring-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="attendancemonitoring-media-modal{{ $media->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div>
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <div class="p-5 flex items-center flex-col">
                                                                    <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                    <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                </div>

                                                                @else
                                                                    <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'NarrativeFile')

                        <div class="w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] bg-white  shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-narrative" data-modal-toggle="default-modal-narrative" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Narrative Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-narrative" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Narrative Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-narrative">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 grid grid-cols-3 gap-3">

                                                @foreach ($proposals->medias as $media)
                                                @if ($media->collection_name == 'NarrativeFile')
                                                    <div type="button" class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                        <!-- Modal toggle -->
                                                        <button data-modal-target="narrative-media-modal{{ $media->id}}" data-modal-toggle="narrative-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                            @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'text/plain')
                                                                <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @else
                                                                <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                            @endif
                                                            <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>
                                                        </button>
                                                    </div>


                                                    <div id="narrative-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="narrative-media-modal{{ $media->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div>
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <div class="p-5 flex items-center flex-col">
                                                                    <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                    <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                </div>

                                                                @else
                                                                    <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{  $media->getUrl() }}"></iframe></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    @endif
                                                @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif

                    @if ($proposalfile->collection_name == 'TerminalFile')
                        <div class="bg-white w-[10rem]  xl:w-[11rem] xl:h-[17vh] 2xl:h-[12vh] shadow-md rounded-lg hover:bg-slate-100 transition-all relative">

                            <!-- Modal toggle -->
                            <button data-modal-target="default-modal-terminal" data-modal-toggle="default-modal-terminal" class="buttonModal text-sm p-4 text-center h-full flex flex-col space-y-4 items-center w-full" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <span class="text-xs mt-4">Terminal Folder</span>
                            </button>

                            <!-- Main modal -->
                            <div id="default-modal-terminal" tabindex="-1" aria-hidden="true" class="folder hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-5xl h-[80%]">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow h-full overflow-x-hidden">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t z-10 sticky top-0 bg-white">
                                            <h3 class="text-xl font-semibold text-gray-600">
                                                Terminal Folder
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-terminal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>

                                        <div class="p-4 grid grid-cols-3 gap-3">

                                            @foreach ($proposals->medias as $media)
                                            @if ($media->collection_name == 'TerminalFile')

                                                <div class="w-full shadow rounded-lg transition-all  relative" id="media_id{{ $media->id }}">
                                                <!-- Modal toggle -->
                                                    <button data-modal-target="terminal-media-modal{{ $media->id}}" data-modal-toggle="terminal-media-modal{{ $media->id}}"  class="space-x-2 p-4 flex bg-gray-100 hover:bg-gray-200 justify-start items-center rounded w-full" type="button">
                                                        @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                            <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'text/plain')
                                                            <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                            <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @else
                                                            <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                                        @endif
                                                        <span class="text-xs">{{ Str::limit($media->file_name, 25) }}</span>

                                                    </button>
                                                </div>

                                                <div id="terminal-media-modal{{ $media->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-5xl h-[90%]">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow h-full overflow-hidden">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t">
                                                                <h3 class="text-md font-semibold text-gray-600">
                                                                    {{ $media->file_name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="terminal-media-modal{{ $media->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div>
                                                                @if ($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png' || $media->mime_type == 'image/jpg')
                                                                <div><img class="shadow w-full " src="{{  $media->getUrl() }}"></div>
                                                                @elseif ($media->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                                <div class="p-5 flex items-center flex-col">
                                                                    <h1 class="text-center">This file format does not support viewing download only.</h1>
                                                                    <a href={{ url('download-media', $media->id) }} class="text-sm hover:text-red-600 text-red-500">Click here to download</a>
                                                                </div>

                                                                @else
                                                                    <div><iframe class="shadow mt-2 w-full h-[80vh]" src="{{$media->getUrl() }}"></iframe></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>

                     @endif
                @endforeach
                </main>
                @endif
            </section>

            @endunlessrole

            @elseif (Auth::user()->authorize == 'close')

            <div class="flex items-center justify-center h-[80vh]">
                <div class="mt-14">
                <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
                </div>
                <h1 class="text-2xl text-slate-700 font-bold">
                    <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                    Your account have been declined for some reason, <br> the admin is reviewing your account details
                    <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
                </h1>
            </div>

            @elseif (Auth::user()->authorize == 'pending')

            <div class="flex items-center justify-center h-[80vh]">
                <div class="mt-14">
                <iframe src="https://embed.lottiefiles.com/animation/133760"></iframe>
                </div>
                <h1 class="text-2xl text-slate-700 font-bold">
                    <span> <img src="{{ asset('img/caution-1.png') }}" class="xl:w-[4rem] " width="200" alt=""></span>
                    You are not authorize yet, <br> Please fill-out your Profile Information
                    <span class="block text-lg mt-3 font-medium">Here are the hint to get authorize:</span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Select your role</li></span>
                    <span class="block text-sm mt-1 font-medium ml-3"><li>Fill out your Profile Information</li></span>
                </h1>
        </div>
    @endif

</x-app-layout>

    <script src="{{ asset('js/lightbox.js') }}"></script>




