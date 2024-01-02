    <script src="{{ asset('js/lightbox.js') }}"></script>
<x-app-layout>

    @php
    $maxLength = 18; // Adjust the maximum length as needed
    @endphp

    @if (Auth::user()->authorize == 'checked')
        @hasanyrole('Faculty extensionist|Extension coordinator')
            <style>
                [x-cloak] {display: none}
            </style>

            <section class="m-8  rounded-lg  relative mt-5 h-[82vh] 2xl:min-h-[87vh]  bg-white text-gray-700 overflow-x-auto">
                <div class="p-4 flex justify-between items-center bg-white sticky top-0 z-10">
                    <h1 class="font-semibold tracking-wider md:text-lg text-base xl:text-2xl">Show Program/Projects</h1>
                    <a href={{ route('allProposal.index') }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
                <hr>

                <main class="p-4 grid 2xl:grid-cols-7 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2  gap-3 ">
                    @foreach ($proposal->medias as $mediaLibrary)
                        <div data-tooltip-target="tooltip-proposal" type="button" class="relative">

                            <x-alpine-modal>

                                <x-slot name="scripts">
                                    <div class="flex space-x-2 p-4 bg-slate-100 hover:bg-slate-200 shadow-sm rounded">
                                        <div>
                                            @if ($mediaLibrary->mime_type == 'image/jpeg' || $mediaLibrary->mime_type == 'image/png' || $mediaLibrary->mime_type == 'image/jpg')
                                            <img src="{{asset('img/image-icon.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                            @elseif ($mediaLibrary->mime_type == 'text/plain')
                                            <img src="{{asset('img/text-document.png') }}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                            @elseif ($mediaLibrary->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                            <img src="{{asset('img/docx.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                            @else
                                            <img src="{{asset('img/pdf.png')}}" class="xl:w-[2.5rem] w-[3rem]" width="30">
                                            @endif
                                        </div>

                                        <div class="text-[.7rem] text-left">
                                        @if (strlen($mediaLibrary->file_name) <= 10)
                                        <span>{{ Str::limit($mediaLibrary->file_name, 20) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                        @else
                                        <span>{{ Str::limit($mediaLibrary->file_name, 15) }} {{ substr($mediaLibrary->file_name, -$maxLength) }}</span>
                                        @endif
                                        </div>
                                    </div>
                                </x-slot>

                                <x-slot name="title">
                                    <span>{{ Str::limit($mediaLibrary->file_name) }}</span>
                                </x-slot>

                                <div class="w-[50rem]">

                                    <iframe class="2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $mediaLibrary->getUrl() }}" ></iframe>
                                </div>
                            </x-alpine-modal>
                        </div>
                    @endforeach
                </main>
            </section>

            @endrole

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




