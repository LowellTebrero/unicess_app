@role('Partners/Linkages')
@php
$notifs = auth()->user()->unreadNotifications->count();
$notifications = auth()->user()->unreadNotifications;
@endphp

<div class="mx-10">
    <h1 class="tracking-wider 2xl:text-2xl text-slate-800 font-medium">Dashboard Section</h1>
</div>

<section class="mx-5 flex flex-col justify-between h-48">
    <div class="flex xl:flex-row flex-col md:flex-row justify-between h-48">
        <div class="w-full m-5 rounded-lg bg-slate-100 hover:-translate-y-1  transition-all border shadow-md xl:px-5  2xl:px-10 py-9 flex ">
            <img src="{{ asset('/img/businessman.png') }}" alt="" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20">
            <h1 class="font-thick text-gray-900 tracking-wide xl:text-xs 2xl:text-base">Your Role

                <span class="block text-lg font-semibold xl:text-xs 2xl:text-lg">
                    @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $name )
                    {{ $name }}
                    @endforeach
                    @endif
                </span>
            </h1>
        </div>

        <div class="w-full m-5 rounded-lg bg-slate-100 border shadow-md hover:-translate-y-1 xl:px-5 transition-all  2xl:px-10 py-9 flex ">
            <img src="{{ asset('/img/Partner-hand.png') }}" alt="" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20">
            <h1 class="font-thick text-gray-900 tracking-wide xl:text-xs 2xl:text-base">Partner
                <span class="block text-lg font-semibold xl:text-xs 2xl:text-lg"><h1 class="">{{ $user->partners->partners_name  }}</h1></span>
            </h1>
        </div>

        <div class="w-full m-5 rounded-lg bg-slate-100   transition-all border shadow-md xl:px-5  2xl:px-10 py-9 flex">
            <img src="{{ asset('/img/new-proposal.png') }}" alt="" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20">

            <x-alpine-modal >

                <x-slot name="scripts">
                    <h1 class="font-thick text-gray-900 tracking-wide xl:text-xs 2xl:text-base">New Proposal
                        <span class="block text-left text-2xl font-semibold xl:text-base 2xl:text-3xl">{{$notifs}}</span>
                    </h1>
                </x-slot>

                <x-slot name="title" >
                    <h1> Create Event</h1>
                </x-slot>

                {{--  Content  --}}
                <div class="m-12">
                    @forelse ($notifications as $notification )
                    <hr>
                    <h1 class="text block">  {{$notification->data['project_title']}}
                        <span class="text-[.7rem] text-gray-500 block">New account:</span>
                        <span class="text-[.6rem] font-thin text-gray-500 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                    </h1>
                    <a class="text-blue-500 text-[.7rem] py-2 " href={{ route('markasread', $notification->id) }} data-id="{{ $notification->id }}">
                        Mark as read
                    </a>
                    @empty
                    <h1 class="text-center">No notifications</h1>
                    @endforelse
                </div>
            </x-alpine-modal>
        </div>

        {{--  bg-gradient-to-tl from-violet-500 to-sky-400  --}}
        <div class="w-full m-5 rounded-lg bg-slate-100 hover:-translate-y-1  transition-all border shadow-md   xl:px-5  2xl:px-10 py-9 flex ">
        <img src="{{ asset('/img/proposal-paper.png') }}" alt="" class="2xl:w-24 xl:mr-5 2xl:mr-8  xl:w-16 xl:h-16 2xl:h-20">
            <h1 class="font-thick text-gray-900 tracking-wide xl:text-xs 2xl:text-base">Total Proposal
                <span class="block text-2xl font-semibold xl:text-base 2xl:text-3xl">{{ $allProposal->count() }}</span>
            </h1>
        </div>
    </div>

    <section class="w-full flex-col  space-y-4 flex 2xl:py-8  lg:flex-row xl:px-4 xl:flex-row lg:space-x-6 lg:space-y-0 xl:space-x-8 mt-7
     bg-white rounded-xl text-white sm:flex-col md:flex-col md:space-x-0 md:space-y-4 sm:space-y-4 sm:w-full xl:shadow-none">

        <div class="flex flex-col justify-center h-full w-full ">
            <!-- Table -->
            <div class="w-full  mx-auto bg-white  rounded-md border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100 flex justify-between">
                    <h2 class="font-semibold text-gray-600 xl:text-sm">Proposal Dashboard</h2>
                </header>
                <div class="py-3 px-2">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full relative">
                            <thead class="text-[.7rem] font-semibold uppercase text-gray-400 bg-white top-0 sticky ">
                                <tr>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Faculty Name</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Project Title</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Started Date</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Finished Date</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-left">Uploaded</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-center">Status</div></th>
                                    <th class="p-2 whitespace-nowrap"><div class="font-semibold text-center">Action</div></th>
                                </tr>
                            </thead>

                            <tbody class="text-xs divide-y divide-gray-100">
                                @foreach ($allProposal as $proposal)
                                <tr>
                                    <td class="py-3 px-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="{{ (!empty($proposal->user->avatar))? url('upload/image-folder/profile-image/'. $proposal->user->avatar): url('upload/no-image.png') }}" width="30" height="30"></div>
                                            <div class="font-medium text-gray-800 text-[.7rem]">{{ $proposal->user->first_name }}</div>
                                        </div>
                                    </td>

                                    <td class="py-3 px-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-gray-500 2xl:text-sm xl:text-[.7rem]">{{  Str::limit( $proposal->project_title, 80) }}</div>
                                    </td>

                                    <td class="py-3 px-2 whitespace-nowrap">
                                        <div class="text-md text-left text-gray-700 xl:text-[.6rem] 2xl:text-sm">{{  \Carbon\Carbon::parse($proposal->started_date)->format('F d Y')}}  </div>
                                    </td>
                                    <td class="py-3 px-2 whitespace-nowrap">
                                        <div class="text-md text-left text-gray-700 xl:text-[.6rem] 2xl:text-sm">{{ \Carbon\Carbon::parse($proposal->finished_date)->format("F d Y")}}</div>
                                    </td>

                                    <td class="p3 whitespace-nowrap">
                                        <div class="text-left text-gray-700 2xl:text-sm xl:text-[.6rem]">{{ \Carbon\Carbon::parse($proposal->created_at)->format('F d Y')}}</div>
                                    </td>

                                    <td class="py-3 px-2 whitespace-nowrap">
                                        @if ($proposal->authorize == 'pending')
                                        <div class="text-md text-center text-red-400 xl:text-[.7rem] 2xl:text-sm">{{ $proposal->authorize}}</div>
                                        @elseif ($proposal->authorize == 'ongoing')
                                        <div class="text-md text-center text-blue-500 xl:text-[.7rem] 2xl:text-sm">{{ $proposal->authorize}}</div>
                                        @elseif ($proposal->authorize == 'finished')
                                        <div class="text-md text-center text-green-700 xl:text-[.7rem] 2xl:text-sm">{{ $proposal->authorize}}</div>
                                        @endif
                                    </td>

                                    <td class="py-3 px-2 whitespace-nowrap flex items-center justify-center">

                                        <div x-cloak  x-data="{ 'showModal': false }" @keydown.escape="showModal = false" class="" >

                                            <!-- Trigger for Modal -->
                                            <button class="" type="button" @click="showModal = true">
                                                <svg class="fill-slate-500" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 96 960 960" width="20"><path d="M480.118 726Q551 726 600.5 676.382q49.5-49.617 49.5-120.5Q650 485 600.382 435.5q-49.617-49.5-120.5-49.5Q409 386 359.5 435.618q-49.5 49.617-49.5 120.5Q310 627 359.618 676.5q49.617 49.5 120.5 49.5Zm-.353-58Q433 668 400.5 635.265q-32.5-32.736-32.5-79.5Q368 509 400.735 476.5q32.736-32.5 79.5-32.5Q527 444 559.5 476.735q32.5 32.736 32.5 79.5Q592 603 559.265 635.5q-32.736 32.5-79.5 32.5ZM480 856q-146 0-264-83T40 556q58-134 176-217t264-83q146 0 264 83t176 217q-58 134-176 217t-264 83Zm0-300Zm-.169 240Q601 796 702.5 730.5 804 665 857 556q-53-109-154.331-174.5-101.332-65.5-222.5-65.5Q359 316 257.5 381.5 156 447 102 556q54 109 155.331 174.5 101.332 65.5 222.5 65.5Z"/></svg>
                                            </button>

                                            <!-- Modal -->
                                            <div class="fixed inset-0 z-50  flex items-center justify-center overflow-auto bg-black bg-opacity-80" x-show="showModal">

                                                <!-- Modal inner -->
                                                <div class="w-2/3 py-4 text-left bg-white rounded-lg shadow-lg" x-show="showModal"
                                                x-transition:enter="motion-safe:ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" @click.away="showModal = false">

                                                <!-- Title / Close-->
                                                <div class="flex items-center justify-between px-4 py-1">
                                                    <h5 class="mr-3 text-black max-w-none text-xs">{{  Str::limit( $proposal->project_title) }}</h5>
                                                    <button type="button" class=" z-50 cursor-pointer text-red-500 text-xl font-semibold" @click="showModal = false">X</button>
                                                </div>
                                                <hr>

                                                <!-- content -->
                                                <div>
                                                    <iframe class=" 2xl:w-[100%] drop-shadow mt-2 w-full h-[80vh]" src="{{ $proposal->getFirstMediaUrl('proposalPdf') }}"></iframe>
                                                </div>
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
            <div class="mt-3 xl:ml-2 2xl:ml-0">
            <h1>{{ $allProposal->links() }}</h1>
            </div>
        </div>
    </section>
</section>
@endrole
