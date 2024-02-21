
    <style>
        @keyframes scale {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .animate-scale {
            animation: scale 2s ease-in-out infinite;
        }

    </style>

    <div class="hidden xl:block w-[14rem]  2xl:w-[25rem]">


    <div class="h-full  flex flex-col space-y-4 justify-between ">
        {{--  Proposal Summary  --}}
        <div class="h-full flex flex-col p-5 rounded-lg  bg-white">
            <h1 class="text-gray-700 text-sm text-center 2xl:text-[1.1rem] tracking-wider font-medium">Project Monitoring</h1>
            <div class="justify-between flex mt-2 2xl:mt-3 flex-col space-y-2 ">

                <button
                    class="border border-gray-400 h-[8vh] bg-gradient-to-r from-green-200 to-green-500  w-full rounded-lg p-5  flex space-x-5 items-center relative overflow-hidden  duration-100"
                    type="button" x-data="{}"
                    x-on:click="window.livewire.emitTo('finished-proposal', 'show')">

                        <svg class="fill-white hidden xl:block" xmlns="http://www.w3.org/2000/svg" height="50"
                            width="50">
                            <path d="m20 32.4-7.85-7.85 2.4-2.4L20 27.6l13.45-13.45 2.4 2.4Z" />
                        </svg>
                        <h1 class="text-sm font-semibold text-white tracking-wider xl:text-xs 2xl:text-sm"> FINISHED </h1>
                        <h1 class="text-xl 2xl:text-3xl font-bold text-white">
                        {{ $finishedProposal }}</h1>
                </button>

                <button
                    class="border border-gray-400 h-[8vh] bg-gradient-to-r from-sky-400 to-blue-500 w-full  rounded-lg p-5 flex space-x-5 items-center relative overflow-hidden  duration-100"
                    type="button" x-data="{}"
                    x-on:click="window.livewire.emitTo('ongoing-proposal', 'show')">


                    <svg class="fill-white hidden xl:block" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                        viewBox="0 0 24 24">
                        <path
                            d="M15.25 5q-.525 0-.888-.363T14 3.75q0-.525.363-.888t.887-.362q.525 0 .888.363t.362.887q0 .525-.363.888T15.25 5Zm0 16.5q-.525 0-.888-.363T14 20.25q0-.525.363-.888T15.25 19q.525 0 .888.363t.362.887q0 .525-.363.888t-.887.362Zm4-13q-.525 0-.888-.363T18 7.25q0-.525.363-.888T19.25 6q.525 0 .888.363t.362.887q0 .525-.363.888t-.887.362Zm0 9.5q-.525 0-.888-.363T18 16.75q0-.525.363-.888t.887-.362q.525 0 .888.363t.362.887q0 .525-.363.888T19.25 18Zm1.5-4.75q-.525 0-.888-.363T19.5 12q0-.525.363-.888t.887-.362q.525 0 .888.363T22 12q0 .525-.363.888t-.887.362ZM2 12q0-3.925 2.613-6.75t6.412-3.2q.4-.05.688.238T12 3q0 .4-.263.7t-.662.35q-3.025.35-5.05 2.6T4 12q0 3.125 2.025 5.363t5.05 2.587q.4.05.663.35T12 21q0 .425-.288.713t-.687.237Q7.2 21.575 4.6 18.75T2 12Zm10 2q-.825 0-1.413-.588T10 12q0-.125.013-.263t.062-.262L8.7 10.1q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l1.375 1.375q.1-.025.525-.075q.825 0 1.413.588T14 12q0 .825-.588 1.413T12 14Z" />
                    </svg>

                    <h1 class="text-sm font-semibold text-white  tracking-wider xl:text-xs 2xl:text-sm">ONGOING</h1>
                    <h1 class=" text-xl 2xl:text-3xl font-bold  rounded-3xl text-white">{{ $ongoingProposal }}</h1>
                </button>

                <button
                    class="border border-gray-400 h-[8vh] bg-gradient-to-l from-orange-600 via-orange-400 to-yellow-300   w-full rounded-lg p-5 space-x-5   items-center relative overflow-hidden flex "
                    type="button" x-data="{}"
                    x-on:click="window.livewire.emitTo('pending-proposal', 'show')">



                    <svg class="fill-white hidden xl:block" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24">
                        <path
                            d="M4 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h8.41A7 7 0 0 0 16 23a7 7 0 0 0 7-7a7 7 0 0 0-5-6.7V8l-6-6H4m0 2h7v5h5a7 7 0 0 0-7 7a7 7 0 0 0 1.26 4H4V4m12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m-1 1v5l3.61 2.16l.75-1.22l-2.86-1.69V12H15Z" />
                    </svg>
                    <h1 class="text-sm font-semibold text-white tracking-wider xl:text-xs 2xl:text-sm">PENDING</h1>
                    <h1 class="text-xl 2xl:text-3xl text-white font-bold ">{{ $projectProposal }}</h1>

                </button>
            </div>
        </div>

        <div class="h-full flex flex-col p-5 2xl:px-5 px-3 rounded-lg   bg-white text-gray-800">

            <div id="default-carousel" class="relative w-full h-[100%]" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative overflow-hidden rounded-lg h-[100%]">
                    <!-- Item 1 -->
                    <div class="hidden duration-900 ease-in-out" data-carousel-item>
                    <h1 class="text-xs 2xl:text-sm font-medium tracking-wider text-gray-700 flex justify-center">
                        <svg class="mr-1 animate-scale 2xl:block hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#f7b602" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h5.175q.4 0 .763.15t.637.425L12 6h9q.425 0 .713.288T22 7q0 .425-.288.713T21 8H7.85q-1.55 0-2.7.975T4 11.45V18l1.975-6.575q.2-.65.738-1.037T7.9 10h12.9q1.025 0 1.613.813t.312 1.762l-1.8 6q-.2.65-.737 1.038T19 20z"/></svg>
                        New Project Created</h1>

                    <div class="flex flex-col items-center justify-center space-y-1 2xl:space-y-3 pt-2 2xl:pt-4">

                        @if ($latestfour->isEmpty())
                        <div class="flex space-x-2 items-center justify-center h-[100%]">
                            <h1 class="text-gray-400 tracking-wide text-xs 2xl:text-sm">Its empty here</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#999999" stroke-linecap="round"><circle cx="12" cy="12" r="9.5"/><path d="M8.43 16.761a11.8 11.8 0 0 1 1.534-.193A28.847 28.847 0 0 1 12 16.5c.712 0 1.414.023 2.036.068c.618.045 1.15.11 1.534.193"/><path fill="#999999" d="M9.5 10c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C8.14 10 8.26 10 8.5 10H9zm6 0c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C14.14 10 14.26 10 14.5 10h.5z"/></g></svg>
                        </div>
                        @else

                        @foreach ($latestfour as $four )
                            <div class="hover:bg-slate-100 border rounded-lg w-[98%] m-1 shadow p-2 flex space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><g fill="none"><path fill="#FFB02E" d="m15.385 7.39l-2.477-2.475A3.121 3.121 0 0 0 10.698 4H4.126A2.125 2.125 0 0 0 2 6.125V13.5h28v-3.363a2.125 2.125 0 0 0-2.125-2.125H16.888a2.126 2.126 0 0 1-1.503-.621"/><path fill="#FCD53F" d="M27.875 30H4.125A2.118 2.118 0 0 1 2 27.888V13.112C2 11.945 2.951 11 4.125 11h23.75c1.174 0 2.125.945 2.125 2.112v14.776A2.118 2.118 0 0 1 27.875 30"/></g></svg>
                                <h1 class="text-xs">{{ Str::limit($four->project_title, 12) }}</h1>
                            </div>
                        @endforeach
                        @endif
                    </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-500 ease-in-out" data-carousel-item>
                        <h1 class="text-xs 2xl:text-sm  font-medium tracking-wider text-gray-700 flex justify-center">
                            <svg class="mr-1 animate-scale 2xl:block hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#f7b602" d="M8.5 11.5h7v-1h-7zm0-4h7v-1h-7zm10.412 12.437l-3.416-4.43q-.367-.478-.877-.743q-.51-.264-1.119-.264H5V4.615q0-.69.463-1.152Q5.925 3 6.615 3h10.77q.69 0 1.152.463q.463.462.463 1.152v14.77q0 .144-.022.285q-.022.142-.066.267M6.615 21q-.69 0-1.152-.462Q5 20.075 5 19.385V15.5h8.5q.365 0 .674.16q.309.161.536.457l3.527 4.616q-.183.127-.398.197q-.214.07-.454.07z"/></svg>
                            New Uploaded File</h1>

                    <div class="flex flex-col items-center justify-center space-y-1 2xl:space-y-3 pt-2 2xl:pt-4">

                        @if ($latestfourfile->isEmpty())
                        <div class="flex space-x-2 items-center justify-center h-[100%]">
                            <h1 class="text-gray-400 tracking-wide text-xs 2xl:text-sm">Its empty here</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#999999" stroke-linecap="round"><circle cx="12" cy="12" r="9.5"/><path d="M8.43 16.761a11.8 11.8 0 0 1 1.534-.193A28.847 28.847 0 0 1 12 16.5c.712 0 1.414.023 2.036.068c.618.045 1.15.11 1.534.193"/><path fill="#999999" d="M9.5 10c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C8.14 10 8.26 10 8.5 10H9zm6 0c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C14.14 10 14.26 10 14.5 10h.5z"/></g></svg>
                        </div>
                        @else

                        @foreach ($latestfourfile as $four )
                            <div class="hover:bg-slate-100 border rounded-lg w-[98%] shadow p-2 flex space-x-2">
                                @if ($four->mime_type == 'image/jpeg' || $four->mime_type == 'image/png' || $four->mime_type == 'image/jpg')
                                    <img src="{{ asset('img/image-icon.png') }}" class="xl:w-[1.1rem]" width="30">
                                @elseif ($four->mime_type == 'text/plain')
                                    <img src="{{ asset('img/text-document.png') }}" class="xl:w-[1.1rem]" width="30">
                                @elseif ($four->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                    <img src="{{ asset('img/docx.png') }}" class="xl:w-[1.1rem]" width="30">
                                    @else
                                    <img src="{{ asset('img/pdf.png') }}" class="xl:w-[1.1rem]" width="30">
                                @endif
                                <h1 class="text-xs">{{ Str::limit($four->file_name, 12) }}</h1>
                            </div>
                        @endforeach
                        @endif
                    </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-500 ease-in-out" data-carousel-item>
                        <h1 class="text-xs 2xl:text-sm font-medium tracking-wider text-gray-700 flex justify-center items-center text-center">
                            <svg class="mr-1 animate-scale 2xl:block hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#f7b602" d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2M7 9.5C7 8.7 7.7 8 8.5 8s1.5.7 1.5 1.5S9.3 11 8.5 11S7 10.3 7 9.5m5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81M15.5 11c-.8 0-1.5-.7-1.5-1.5S14.7 8 15.5 8s1.5.7 1.5 1.5s-.7 1.5-1.5 1.5"/></svg>
                            New Account Registered</h1>

                        @if ($latestfouruser->isEmpty())
                        <div class="flex space-x-2  items-center justify-center h-[100%]">
                            <h1 class="text-gray-400 tracking-wide text-xs 2xl:text-sm">Its empty here</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#999999" stroke-linecap="round"><circle cx="12" cy="12" r="9.5"/><path d="M8.43 16.761a11.8 11.8 0 0 1 1.534-.193A28.847 28.847 0 0 1 12 16.5c.712 0 1.414.023 2.036.068c.618.045 1.15.11 1.534.193"/><path fill="#999999" d="M9.5 10c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C8.14 10 8.26 10 8.5 10H9zm6 0c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C14.14 10 14.26 10 14.5 10h.5z"/></g></svg>
                        </div>
                        @else

                        <div class="flex flex-col items-center  justify-center space-y-1 2xl:space-y-3 pt-2 2xl:pt-4">
                        @foreach ($latestfouruser as $four )
                            <div class="hover:bg-slate-100 border rounded-lg w-[98%] shadow p-2 flex space-x-2">
                                @if($four->gender == 'Female')
                                <img src="{{ asset('/img/female.svg') }}" class="w-[1.2rem] border-2 rounded-full border-slate-600 ">
                                @elseif($four->gender == 'Male')
                                <img src="{{ asset('/img/male.svg') }}" class="w-[1.2rem] border-2 rounded-full border-slate-600 ">
                                @else
                                <img src="{{ asset('/upload/profile.png') }}" class="w-[1.2rem] ">
                                @endif
                                <h1 class="text-xs">{{ Str::limit($four->email, 12) }}</h1>
                            </div>
                        @endforeach
                        </div>
                        @endif
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-500 ease-in-out" data-carousel-item>
                        <h1 class="text-xs 2xl:text-sm font-medium tracking-wider text-gray-700 flex justify-center items-center text-center">
                            <svg class="mr-1 animate-scale 2xl:block hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024"><path fill="#f7b602" d="M160 894c0 17.7 14.3 32 32 32h286V550H160zm386 32h286c17.7 0 32-14.3 32-32V550H546zm334-616H732.4c13.6-21.4 21.6-46.8 21.6-74c0-76.1-61.9-138-138-138c-41.4 0-78.7 18.4-104 47.4c-25.3-29-62.6-47.4-104-47.4c-76.1 0-138 61.9-138 138c0 27.2 7.9 52.6 21.6 74H144c-17.7 0-32 14.3-32 32v140h366V310h68v172h366V342c0-17.7-14.3-32-32-32m-402-4h-70c-38.6 0-70-31.4-70-70s31.4-70 70-70s70 31.4 70 70zm138 0h-70v-70c0-38.6 31.4-70 70-70s70 31.4 70 70s-31.4 70-70 70"/></svg>
                            New Evaluation Created</h1>

                        @if ($latestfourevaluation->isEmpty())
                        <div class="flex space-x-2 items-center justify-center h-[100%]">
                            <h1 class="text-gray-400 tracking-wide text-xs 2xl:text-sm">Its empty here</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#999999" stroke-linecap="round"><circle cx="12" cy="12" r="9.5"/><path d="M8.43 16.761a11.8 11.8 0 0 1 1.534-.193A28.847 28.847 0 0 1 12 16.5c.712 0 1.414.023 2.036.068c.618.045 1.15.11 1.534.193"/><path fill="#999999" d="M9.5 10c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C8.14 10 8.26 10 8.5 10H9zm6 0c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C14.14 10 14.26 10 14.5 10h.5z"/></g></svg>
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center space-y-1 2xl:space-y-3 pt-2 2xl:pt-4">
                            @foreach ($latestfourevaluation as $four )
                                <div class="hover:bg-slate-100 border rounded-lg w-[98%] shadow p-2 flex space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#44a1f8" fill-rule="evenodd" d="M4.172 3.172C3 4.343 3 6.229 3 10v4c0 3.771 0 5.657 1.172 6.828C5.343 22 7.229 22 11 22h2c3.771 0 5.657 0 6.828-1.172C21 19.657 21 17.771 21 14v-4c0-3.771 0-5.657-1.172-6.828C18.657 2 16.771 2 13 2h-2C7.229 2 5.343 2 4.172 3.172M7.25 8A.75.75 0 0 1 8 7.25h8a.75.75 0 0 1 0 1.5H8A.75.75 0 0 1 7.25 8m0 4a.75.75 0 0 1 .75-.75h8a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75M8 15.25a.75.75 0 0 0 0 1.5h5a.75.75 0 0 0 0-1.5z" clip-rule="evenodd"/></svg>
                                    <h1 class="text-xs">{{ Str::limit($four->users->name) }}</h1>
                                </div>
                            @endforeach
                        </div>
                        @endif

                    </div>
                    <!-- Item 5 -->
                    <div class="hidden duration-500 ease-in-out" data-carousel-item>
                        <h1 class="text-xs 2xl:text-sm text-center font-medium tracking-wider text-gray-700 flex justify-center items-center">
                            <svg class="mr-1 animate-scale 2xl:block hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffbb00" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2L9.19 8.63L2 9.24l5.46 4.73L5.82 21z"/></svg>
                            Highest Evaluation Points
                        </h1>

                        @if ($latestfourpoints->isEmpty())
                        <div class="flex space-x-2 items-center justify-center h-[100%]">
                            <h1 class="text-gray-400 tracking-wide text-xs 2xl:text-sm">Its empty here</h1>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#999999" stroke-linecap="round"><circle cx="12" cy="12" r="9.5"/><path d="M8.43 16.761a11.8 11.8 0 0 1 1.534-.193A28.847 28.847 0 0 1 12 16.5c.712 0 1.414.023 2.036.068c.618.045 1.15.11 1.534.193"/><path fill="#999999" d="M9.5 10c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C8.14 10 8.26 10 8.5 10H9zm6 0c.24 0 .36 0 .433.123c.073.122.03.2-.055.356a1 1 0 0 1-1.756 0c-.085-.156-.128-.234-.055-.356C14.14 10 14.26 10 14.5 10h.5z"/></g></svg>
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center space-y-1 2xl:space-y-3 pt-2 2xl:pt-4">
                            @foreach ($latestfourpoints as $four )
                                <div class="hover:bg-slate-100 border rounded-lg w-[98%] shadow p-2 flex space-x-2 relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32"><g fill="none"><path fill="#0074BA" d="M17.328 11.51c-.2-.02-.4-.04-.6-.08c-1.24-.22-2.4-.78-3.34-1.64c-2.74-2.11-6.01-4.77-7.68-7.78h-.35c-1.45 0-2.36 1.56-1.65 2.82c1.32 2.33 3.18 4.31 5.42 5.77c.76.59 1.7.91 2.66.91z"/><path fill="#F8312F" d="m16.737 11.295l-.58-4.075l-2.61-4.29c-.33-.58-.95-.93-1.62-.93H9.75l6.215 9.476a8.06 8.06 0 0 1-.287.034v.01h4.53c.97 0 1.9-.32 2.66-.91a16.55 16.55 0 0 0 5.42-5.77c.72-1.27-.2-2.83-1.64-2.83h-.35c-2.71 2.83-5.94 5.67-8.68 7.78c-.418.382-.484.705-.537.965c-.048.23-.085.41-.344.54"/><path fill="#D3D3D3" d="m16.562 10.06l.18 1.27a6.645 6.645 0 0 0 2.876-1.54c2.74-2.11 5.01-4.77 6.68-7.78h-4.57zm-.188 1.45h-.046l.2.24zm-.406-.031c-.097.012-.194.021-.29.031l-.2.24l.21-.327a6.662 6.662 0 0 1-3.3-1.633C9.648 7.68 7.17 5.01 5.5 2h4.388z"/><path fill="#00A6ED" d="M22.108 2.01h-2.04c-.67 0-1.28.35-1.62.93l-5.22 8.58h2.78z"/><path fill="#D3883E" d="m16.608 15.67l.83 1.72c.1.2.29.35.51.38l1.85.28c.55.08.78.78.37 1.18l-1.28 1.28c-.19.19-.25.47-.17.73l.59 1.71c.2.57-.36 1.11-.91.87l-2.14-.96a.638.638 0 0 0-.54 0l-2.14.96c-.54.24-1.11-.3-.91-.87l.59-1.71c.09-.26.02-.54-.17-.73l-1.28-1.28c-.4-.4-.18-1.1.37-1.18l1.85-.28c.22-.03.41-.17.51-.38l.83-1.72c.27-.52.99-.52 1.24 0"/><path fill="#FFB02E" d="M15.99 30c5.545 0 10.04-4.607 10.04-10.29c0-5.683-4.495-10.29-10.04-10.29c-5.545 0-10.04 4.607-10.04 10.29C5.95 25.393 10.445 30 15.99 30"/><path fill="#FCD53F" d="M16 28.76c-2.36 0-4.58-.94-6.24-2.65a9.098 9.098 0 0 1-2.59-6.4c0-2.42.92-4.69 2.59-6.4a8.69 8.69 0 0 1 12.49 0c3.44 3.53 3.44 9.27 0 12.8c-1.68 1.71-3.9 2.65-6.25 2.65m-.01-16.87c-1.95 0-3.91.76-5.39 2.29a7.872 7.872 0 0 0-2.23 5.53c0 2.09.79 4.05 2.23 5.53a7.476 7.476 0 0 0 5.39 2.29c2.04 0 3.95-.81 5.39-2.29c2.97-3.05 2.97-8.01 0-11.06a7.46 7.46 0 0 0-5.39-2.29"/><path fill="#6D4534" d="m16.6 15.66l.83 1.72c.1.2.29.35.51.38l1.85.28c.55.08.78.78.37 1.18l-1.28 1.28c-.19.19-.25.47-.17.73l.59 1.71c.2.57-.36 1.11-.91.87l-2.14-.96a.637.637 0 0 0-.54 0l-2.14.96c-.54.24-1.11-.3-.91-.87l.59-1.71c.09-.26.02-.54-.17-.73l-1.28-1.28c-.4-.4-.18-1.1.37-1.18l1.85-.28c.22-.03.41-.17.51-.38l.83-1.72c.27-.52.99-.52 1.24 0"/></g></svg>
                                    <h1 class="text-xs">{{ Str::limit($four->users->name)}}</h1>
                                    <h1 class="absolute right-2 top-1 bg-white rounded-full p-2 py-1 shadow-sm border text-xs z-10">{{ $four->total_points }}</h1>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-0 2xl:bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-2 2xl:w-3 h-2 2xl:h-3 rounded-full bg-gray-300 hover:bg-gray-500" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-2 2xl:w-3 h-2 2xl:h-3 rounded-full bg-gray-300 hover:bg-gray-500" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-2 2xl:w-3 h-2 2xl:h-3 rounded-full bg-gray-300 hover:bg-gray-500" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-2 2xl:w-3 h-2 2xl:h-3 rounded-full bg-gray-300 hover:bg-gray-500" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    <button type="button" class="w-2 2xl:w-3 h-2 2xl:h-3 rounded-full bg-gray-300 hover:bg-gray-500" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                </div>
                <!-- Slider controls -->

            </div>
        </div>
    </div>
</div>




