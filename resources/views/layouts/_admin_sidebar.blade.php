
    <div class="min-h-screen bg-gradient-to-t from-blue-500 to-blue-800 transition-all fixed subsidebar xl:w-[10rem] 2xl:w-[14rem]">

        <nav class="flex-grow pr-2 pl-2 pb-4 space-y-2 md:block md:pb-0 navigation ">


        <div class="flex items-center py-3 justify-between px-4 xl:px-0 xl:justify-center space-x-2">
            <!-- Logo -->
            <img src="{{ asset('img/logo.png') }}" width="45" class="logo">
            <a class="text-lg font-bold tracking-wider text-yellow-400" href="{{ route('lnu') }}">UniCESS</a>
            <button class="close-button lg:block xl:hidden">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

            <x-custom-nav-link class="nav-item " :href="route('admin.dashboard.index')" wire:navigate :active="request()->routeIs('admin.dashboard.*')">
                <svg class="fill-white mr-2 " xmlns="http://www.w3.org/2000/svg" height="35"
                    viewBox="0 96 960 960" width="30">
                    <path
                        d="M120 216h330v330H120V216Zm60 59v188-188Zm330-59h330v330H510V216Zm83 59v188-188ZM120 606h330v330H120V606Zm60 81v189-189Zm465-81h60v135h135v60H705v135h-60V801H510v-60h135V606Zm-75-330v210h210V276H570Zm-390 0v210h210V276H180Zm0 390v210h210V666H180Z" />
                </svg>
                {{ __('Dashboard') }}
            </x-custom-nav-link>

            <x-custom-nav-link class="nav-item" :href="route('admin.points.index')" wire:navigate :active="request()->routeIs('admin.points*')">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35"
                    viewBox="0 -960 960 960" width="30">
                    <path
                        d="M479.765-340Q538-340 579-380.765q41-40.764 41-99Q620-538 579.235-579q-40.764-41-99-41Q422-620 381-579.235q-41 40.764-41 99Q340-422 380.765-381q40.764 41 99 41Zm.235 60q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM70-450q-12.75 0-21.375-8.675Q40-467.351 40-480.175 40-493 48.625-501.5T70-510h100q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T170-450H70Zm720 0q-12.75 0-21.375-8.675-8.625-8.676-8.625-21.5 0-12.825 8.625-21.325T790-510h100q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T890-450H790ZM479.825-760Q467-760 458.5-768.625T450-790v-100q0-12.75 8.675-21.375 8.676-8.625 21.5-8.625 12.825 0 21.325 8.625T510-890v100q0 12.75-8.675 21.375-8.676 8.625-21.5 8.625Zm0 720Q467-40 458.5-48.625T450-70v-100q0-12.75 8.675-21.375 8.676-8.625 21.5-8.625 12.825 0 21.325 8.625T510-170v100q0 12.75-8.675 21.375Q492.649-40 479.825-40ZM240-678l-57-56q-9-9-8.629-21.603.37-12.604 8.526-21.5 8.896-8.897 21.5-8.897Q217-786 226-777l56 57q8 9 8 21t-8 20.5q-8 8.5-20.5 8.5t-21.5-8Zm494 495-56-57q-8-9-8-21.375T678.5-282q8.5-9 20.5-9t21 9l57 56q9 9 8.629 21.603-.37 12.604-8.526 21.5-8.896 8.897-21.5 8.897Q743-174 734-183Zm-56-495q-9-9-9-21t9-21l56-57q9-9 21.603-8.629 12.604.37 21.5 8.526 8.897 8.896 8.897 21.5Q786-743 777-734l-57 56q-8 8-20.364 8-12.363 0-21.636-8ZM182.897-182.897q-8.897-8.896-8.897-21.5Q174-217 183-226l57-56q8.8-9 20.9-9 12.1 0 20.709 9Q291-273 291-261t-9 21l-56 57q-9 9-21.603 8.629-12.604-.37-21.5-8.526ZM480-480Z" />
                </svg>
                {{ __('Points') }}
            </x-custom-nav-link>

            <x-custom-nav-link :href="route('admin.evaluation.index')" :active="request()->routeIs('admin.evaluation.*')">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35"
                    viewBox="0 -960 960 960" width="30">
                    <path
                    d="m434-255 229-229-39-39-190 190-103-103-39 39 142 142ZM220-80q-24 0-42-18t-18-42v-680q0-24 18-42t42-18h361l219 219v521q0 24-18 42t-42 18H220Zm331-554v-186H220v680h520v-494H551ZM220-820v186-186 680-680Z" />
                </svg>
                {{ __('Evaluation') }}
            </x-custom-nav-link>

            <x-custom-nav-link :href="route('admin.users.main')" :active="request()->routeIs('admin.users.*')">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35"
                    viewBox="0 96 960 960" width="30">
                    <path
                        d="M400 571q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM80 892v-94q0-35 17.5-63t50.5-43q72-32 133.5-46T400 632h23q-6 14-9 27.5t-5 32.5h-9q-58 0-113.5 12.5T172 746q-16 8-24 22.5t-8 29.5v34h269q5 18 12 32.5t17 27.5H80Zm587 44-10-66q-17-5-34.5-14.5T593 834l-55 12-25-42 47-44q-2-9-2-25t2-25l-47-44 25-42 55 12q12-12 29.5-21.5T657 600l10-66h54l10 66q17 5 34.5 14.5T795 636l55-12 25 42-47 44q2 9 2 25t-2 25l47 44-25 42-55-12q-12 12-29.5 21.5T731 870l-10 66h-54Zm27-121q36 0 58-22t22-58q0-36-22-58t-58-22q-36 0-58 22t-22 58q0 36 22 58t58 22ZM400 511q39 0 64.5-25.5T490 421q0-39-25.5-64.5T400 331q-39 0-64.5 25.5T310 421q0 39 25.5 64.5T400 511Zm0-90Zm9 411Z" />
                </svg>
                {{ __('Accounts') }}
            </x-custom-nav-link>

            <x-custom-nav-link :href="route('admin.inventory.index')" :active="request()->routeIs('admin.inventory.*')">
                <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35"
                    viewBox="0 96 960 960" width="30">
                    <path
                        d="M140 896q-23 0-41.5-18.5T80 836V316q0-23 18.5-41.5T140 256h281l60 60h339q23 0 41.5 18.5T880 376H455l-60-60H140v520l102-400h698L833 850q-6 24-22 35t-41 11H140Zm63-60h572l84-340H287l-84 340Zm0 0 84-340-84 340Zm-63-460v-60 60Z" />
                </svg>
                {{ __('Inventory') }}
            </x-custom-nav-link>

            {{--  Manage LNU HOME Collapse  --}}
            <div class="relative w-full px-2  overflow-hidden mt-8 ">

                <input class="peer absolute top-0 inset-x-0 w-full h-12 opacity-0 z-10 cursor-pointer"
                    type="checkbox">
                <div class="  h-12 w-full flex items-center">
                    <svg class="mx-2 fill-white" xmlns="http://www.w3.org/2000/svg" height="35"
                        viewBox="0 96 960 960" width="28">
                        <path
                            d="M250 766h180v-60H250v60Zm400 0h60v-60h-60v60ZM250 606h180v-60H250v60Zm400 0h60V386h-60v220ZM250 446h180v-60H250v60ZM132 936q-24 0-42-18t-18-42V276q0-24 18-42t42-18h696q24 0 42 18t18 42v600q0 24-18 42t-42 18H132Zm0-60h696V276H132v600Zm0 0V276v600Z" />
                    </svg>
                    <span
                        class="text-md text-slate-200 font-medium xl:text-xs 2xl:text-sm ">Others</span>
                </div>

                <div
                    class="absolute top-3 right-3 text-white transition-transform duration-500 rotate-0 peer-checked:rotate-180 ">

                    {{--  Arrow Icon  --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>

                {{--  Content  --}}
                <div
                    class="bg-gray-700 rounded overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-48">
                    <div class=" flex flex-col">

                        <x-custom-nav-link :href="route('admin.other-events-ceso-events')" :active="request()->routeIs('admin.other-events-ceso-events')">
                            {{--  <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                height="35" viewBox="0 96 960 960" width="30">
                                <path
                                    d="M596.817 836Q556 836 528 807.817q-28-28.183-28-69T528.183 670q28.183-28 69-28T666 670.183q28 28.183 28 69T665.817 808q-28.183 28-69 28ZM180 976q-24 0-42-18t-18-42V296q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600V486H180v430Zm0-490h600V296H180v130Zm0 0V296v130Z" />
                            </svg>  --}}
                            {{ __('Events') }}
                        </x-custom-nav-link>

                        <x-custom-nav-link :href="route('admin.features.index')" :active="request()->routeIs('admin.features.index')">
                            {{--  <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                height="35" viewBox="0 96 960 960" width="30">
                                <path
                                    d="M596.817 836Q556 836 528 807.817q-28-28.183-28-69T528.183 670q28.183-28 69-28T666 670.183q28 28.183 28 69T665.817 808q-28.183 28-69 28ZM180 976q-24 0-42-18t-18-42V296q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600V486H180v430Zm0-490h600V296H180v130Zm0 0V296v130Z" />
                            </svg>  --}}
                            {{ __('Article') }}
                        </x-custom-nav-link>


                    </div>
                </div>
            </div>
            {{--  End of Manage Account Collapse   --}}


            {{--  Manage Account Collapse  --}}
            <div class="relative w-full px-2  overflow-hidden mt-3">

                <input class="peer absolute top-0 inset-x-0 w-full h-12 opacity-0 z-10 cursor-pointer"
                    type="checkbox">
                <div class="  h-12 w-full flex items-center  overflow-hidden">
                    <svg class="fill-white mx-2" xmlns="http://www.w3.org/2000/svg" height="35"
                        viewBox="0 96 960 960" width="30">
                        <path
                            d="m382 976-18.666-126.667Q346.333 843 328.5 832.667 310.666 822.333 296.333 811L178 863.666 79.333 691l106.334-78.666q-1.667-8.334-2-18.167-.334-9.834-.334-18.167 0-8.333.334-18.167.333-9.833 2-18.167L79.333 461 178 288.334 296.333 341q14.333-11.333 32.334-21.667 18-10.333 34.667-16L382 176h196l18.666 126.667Q613.667 309 631.833 319q18.167 10 31.834 22L782 288.334 880.667 461l-106.334 77.333q1.667 9 2 18.834.334 9.833.334 18.833 0 9-.334 18.5Q776 604 774 613l106.333 78-98.666 172.666-118-52.666q-14.333 11.333-32 22t-35.001 16.333L578 976H382Zm98.667-266.667q55.333 0 94.333-39T614 576q0-55.333-39-94.333t-94.333-39q-55.667 0-94.5 39-38.834 39-38.834 94.333t38.834 94.333q38.833 39 94.5 39Zm0-66.666q-27.667 0-47.167-19.5T414 576q0-27.667 19.5-47.167t47.167-19.5q27.666 0 47.166 19.5 19.5 19.5 19.5 47.167t-19.5 47.167q-19.5 19.5-47.166 19.5ZM480 576Zm-42.667 333.334h85l14-110q32.334-8 60.834-24.5T649 735l103.667 44.334 39.667-70.667L701 641q4.334-16 6.667-32.167Q710 592.667 710 576q0-16.667-2-32.833Q706 527 701 511l91.334-67.667-39.667-70.667L649 417.333q-22.666-25-50.833-41.833-28.167-16.834-61.834-22.834l-13.666-110h-85l-14 110q-33 7.334-61.501 23.834Q333.666 393 311 417l-103.667-44.334-39.667 70.667L259 510.667Q254.666 527 252.333 543T250 576q0 16.667 2.333 32.667T259 641l-91.334 67.667 39.667 70.667L311 734.667q23.333 23.667 51.833 40.167t60.834 24.5l13.666 110Z" />
                    </svg>
                    <span
                        class="text-md text-slate-200 font-medium xl:text-xs 2xl:text-sm ">Settings</span>
                </div>

                <div
                    class="absolute top-3 right-3 text-white transition-transform duration-500 rotate-0 peer-checked:rotate-180 ">

                    {{--  Arrow Icon  --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>

                {{--  Content  --}}
                <div
                    class="bg-gray-700 rounded overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-48">

                    <div class="flex flex-col">
                        <a class="xl:text-xs flex items-center px-4 py-2 mt-2 text-md font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href={{ route('admin.roles.index') }}>
                            {{--  <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                height="35" viewBox="0 96 960 960" width="30">
                                <path
                                    d="M400 571q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM80 892v-94q0-35 17.5-63t50.5-43q72-32 133.5-46T400 632h23q-6 14-9 27.5t-5 32.5h-9q-58 0-113.5 12.5T172 746q-16 8-24 22.5t-8 29.5v34h269q5 18 12 32.5t17 27.5H80Zm587 44-10-66q-17-5-34.5-14.5T593 834l-55 12-25-42 47-44q-2-9-2-25t2-25l-47-44 25-42 55 12q12-12 29.5-21.5T657 600l10-66h54l10 66q17 5 34.5 14.5T795 636l55-12 25 42-47 44q2 9 2 25t-2 25l47 44-25 42-55-12q-12 12-29.5 21.5T731 870l-10 66h-54Zm27-121q36 0 58-22t22-58q0-36-22-58t-58-22q-36 0-58 22t-22 58q0 36 22 58t58 22ZM400 511q39 0 64.5-25.5T490 421q0-39-25.5-64.5T400 331q-39 0-64.5 25.5T310 421q0 39 25.5 64.5T400 511Zm0-90Zm9 411Z" />
                            </svg>  --}}
                            <span>Role</span>
                        </a>
                        <a class="xl:text-xs flex items-center px-4 py-2 mt-2 text-md font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                            href={{ route('admin.template.index') }}>
                            {{--  <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                height="35" viewBox="0 96 960 960" width="30">
                                <path
                                    d="M280 644q-28 0-48-20t-20-48q0-28 20-48t48-20q28 0 48 20t20 48q0 28-20 48t-48 20Zm0 172q-100 0-170-70T40 576q0-100 70-170t170-70q72 0 126 34t85 103h356l113 113-167 153-88-64-88 64-75-60h-51q-25 60-78.5 98.5T280 816Zm0-60q58 0 107-38.5t63-98.5h114l54 45 88-63 82 62 85-79-51-51H450q-12-56-60-96.5T280 396q-75 0-127.5 52.5T100 576q0 75 52.5 127.5T280 756Z" />
                            </svg>  --}}
                            <span>Other Settings</span>
                        </a>
                    </div>
                </div>
            </div>
            {{--  End of Manage Account Collapse   --}}
        </nav>
    </div>
