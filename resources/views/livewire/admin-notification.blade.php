<div>

     <button class="relative" type="button" x-data="{}" x-on:click="window.livewire.emitTo('admin-notification', 'show')">
                    <h1 class="text-red-500 font-black absolute z-10 right-1 top-0">{{ $notifs }}</h1>
                    <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="25" viewBox="0 96 960 960" width="30"><path d="M160 856v-60h84V490q0-84 49.5-149.5T424 258v-29q0-23 16.5-38t39.5-15q23 0 39.5 15t16.5 38v29q81 17 131 82.5T717 490v306h83v60H160Zm320 120q-32 0-56-23.5T400 896h160q0 33-23.5 56.5T480 976Z"/></svg>
    </button>


    <x-modals wire:model="show">
        <!-- Title / Close-->
        <div class="flex items-center justify-between mb-5 px-4 pt-4">
            <h5 class="mr-3 text-gray-500 max-w-none">{{ $notifs }}</h5>
            <button type="button" class=" z-50 cursor-pointer text-gray-500 focus:text-red-600 text-md focus:bg-red-100 hover:bg-gray-100 rounded font-semibold  px-2 py-1" @click="show = false">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <hr>

        <!-- content -->
        <div class="w-full">
            <div class="overflow-x-auto p-5">

                <div class="flex flex-col drop-shadow-lg backdrop-blur-sm  px-3 h-[30vh] overflow-y-auto overflow-x-hidden relative">


                    <div class="sticky top-0 ">
                        <h1 class="font-semibold  mb-3 text-sm text-gray-800">Notifications</h1>
                    </div>

                    {{--  {{ dd($notifications) }}  --}}
                    @forelse (auth()->user()->unreadnotifications as $notification )

                    <hr>

                    @foreach($notification->data as $key => $value)



                    @if (($key = 'project_title') == !null )
                    <h1 class="text-[.6rem]"> {{ $value }}
                        <span class="text-[.7rem] text-gray-500 inline-block">New Proposal:</span>
                        <span class="text-[.6rem] font-thin text-gray-500 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                    </h1>
                    @elseif (($key = 'email') == !null )
                    <h1 class="text-xs"> {{ $value }}
                        <span class="text-[.7rem] text-gray-500 inline-block">New Account:</span>
                        <span class="text-[.6rem] font-thin text-gray-500 inline-block">{{ $notification->created_at->diffForHumans() }}</span>
                    </h1>
                    @endif
                    @endforeach





                    <a class="text-blue-500  text-[.7rem] py-2 " href={{ route('markasread', $notification->id) }} data-id="{{ $notification->id }}">
                        Mark as read
                    </a>

                    @empty

                    <h1 class="text-center">No notifications</h1>
                    @endforelse
                </div>

            </div>
    </div>

    </x-modals>
</div>
