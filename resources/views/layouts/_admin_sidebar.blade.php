

<div
    class="sidebar-toggle shadow-2xl h-screen bg-gradient-to-t from-blue-500 to-blue-800 transition-all fixed  xl:w-[12rem] 2xl:w-[14rem]">

    <nav class="flex-grow pr-2 pl-2 pb-4 space-y-2 md:block md:pb-0 navigation ">

        <div class="flex items-center py-3 justify-between px-4 xl:px-0 xl:justify-center space-x-2">
            <!-- Logo -->
            <img src="{{ asset('img/logo.png') }}" width="45" class="logo">
            <a class="text-lg font-bold tracking-wider text-yellow-400" href="{{ route('lnu') }}">UniCESS</a>
            <button class="close-button lg:block xl:hidden">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <x-custom-nav-link class="nav-item" :href="route('admin.dashboard.index')" wire:navigate :active="request()->routeIs('admin.dashboard.*')">
            <svg class="fill-white mr-2 " xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 96 960 960"
                width="30">
                <path
                    d="M120 216h330v330H120V216Zm60 59v188-188Zm330-59h330v330H510V216Zm83 59v188-188ZM120 606h330v330H120V606Zm60 81v189-189Zm465-81h60v135h135v60H705v135h-60V801H510v-60h135V606Zm-75-330v210h210V276H570Zm-390 0v210h210V276H180Zm0 390v210h210V666H180Z" />
            </svg>
            <span class="sidebar-text">{{ __('Dashboard') }}</span>
        </x-custom-nav-link>

        <x-custom-nav-link class="nav-item" :href="route('admin.points.index')" wire:navigate :active="request()->routeIs('admin.points*')">
            <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960"
                width="30">
                <path
                    d="M479.765-340Q538-340 579-380.765q41-40.764 41-99Q620-538 579.235-579q-40.764-41-99-41Q422-620 381-579.235q-41 40.764-41 99Q340-422 380.765-381q40.764 41 99 41Zm.235 60q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM70-450q-12.75 0-21.375-8.675Q40-467.351 40-480.175 40-493 48.625-501.5T70-510h100q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T170-450H70Zm720 0q-12.75 0-21.375-8.675-8.625-8.676-8.625-21.5 0-12.825 8.625-21.325T790-510h100q12.75 0 21.375 8.675 8.625 8.676 8.625 21.5 0 12.825-8.625 21.325T890-450H790ZM479.825-760Q467-760 458.5-768.625T450-790v-100q0-12.75 8.675-21.375 8.676-8.625 21.5-8.625 12.825 0 21.325 8.625T510-890v100q0 12.75-8.675 21.375-8.676 8.625-21.5 8.625Zm0 720Q467-40 458.5-48.625T450-70v-100q0-12.75 8.675-21.375 8.676-8.625 21.5-8.625 12.825 0 21.325 8.625T510-170v100q0 12.75-8.675 21.375Q492.649-40 479.825-40ZM240-678l-57-56q-9-9-8.629-21.603.37-12.604 8.526-21.5 8.896-8.897 21.5-8.897Q217-786 226-777l56 57q8 9 8 21t-8 20.5q-8 8.5-20.5 8.5t-21.5-8Zm494 495-56-57q-8-9-8-21.375T678.5-282q8.5-9 20.5-9t21 9l57 56q9 9 8.629 21.603-.37 12.604-8.526 21.5-8.896 8.897-21.5 8.897Q743-174 734-183Zm-56-495q-9-9-9-21t9-21l56-57q9-9 21.603-8.629 12.604.37 21.5 8.526 8.897 8.896 8.897 21.5Q786-743 777-734l-57 56q-8 8-20.364 8-12.363 0-21.636-8ZM182.897-182.897q-8.897-8.896-8.897-21.5Q174-217 183-226l57-56q8.8-9 20.9-9 12.1 0 20.709 9Q291-273 291-261t-9 21l-56 57q-9 9-21.603 8.629-12.604-.37-21.5-8.526ZM480-480Z" />
            </svg>
            <span class="sidebar-text">{{ __('Points') }}</span>
        </x-custom-nav-link>

        <x-custom-nav-link :href="route('admin.evaluation.index')" :active="request()->routeIs('admin.evaluation.*')">
            <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 -960 960 960"
                width="30">
                <path
                    d="m434-255 229-229-39-39-190 190-103-103-39 39 142 142ZM220-80q-24 0-42-18t-18-42v-680q0-24 18-42t42-18h361l219 219v521q0 24-18 42t-42 18H220Zm331-554v-186H220v680h520v-494H551ZM220-820v186-186 680-680Z" />
            </svg>
            <span class="sidebar-text">{{ __('Evaluation') }}</span>
        </x-custom-nav-link>

        <x-custom-nav-link :href="route('admin.users.main')" :active="request()->routeIs('admin.users.*')">
            <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 96 960 960"
                width="30">
                <path
                    d="M400 571q-66 0-108-42t-42-108q0-66 42-108t108-42q66 0 108 42t42 108q0 66-42 108t-108 42ZM80 892v-94q0-35 17.5-63t50.5-43q72-32 133.5-46T400 632h23q-6 14-9 27.5t-5 32.5h-9q-58 0-113.5 12.5T172 746q-16 8-24 22.5t-8 29.5v34h269q5 18 12 32.5t17 27.5H80Zm587 44-10-66q-17-5-34.5-14.5T593 834l-55 12-25-42 47-44q-2-9-2-25t2-25l-47-44 25-42 55 12q12-12 29.5-21.5T657 600l10-66h54l10 66q17 5 34.5 14.5T795 636l55-12 25 42-47 44q2 9 2 25t-2 25l47 44-25 42-55-12q-12 12-29.5 21.5T731 870l-10 66h-54Zm27-121q36 0 58-22t22-58q0-36-22-58t-58-22q-36 0-58 22t-22 58q0 36 22 58t58 22ZM400 511q39 0 64.5-25.5T490 421q0-39-25.5-64.5T400 331q-39 0-64.5 25.5T310 421q0 39 25.5 64.5T400 511Zm0-90Zm9 411Z" />
            </svg>
             <span class="sidebar-text">{{ __('Accounts') }}</span>
        </x-custom-nav-link>

        <x-custom-nav-link :href="route('admin.inventory.index')" :active="request()->routeIs('admin.inventory.*')">
            <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 96 960 960"
                width="30">
                <path
                    d="M140 896q-23 0-41.5-18.5T80 836V316q0-23 18.5-41.5T140 256h281l60 60h339q23 0 41.5 18.5T880 376H455l-60-60H140v520l102-400h698L833 850q-6 24-22 35t-41 11H140Zm63-60h572l84-340H287l-84 340Zm0 0 84-340-84 340Zm-63-460v-60 60Z" />
            </svg>
             <span class="sidebar-text">{{ __('Inventory') }}</span>
        </x-custom-nav-link>

        {{--  Manage LNU HOME Collapse  --}}
        <div class="relative w-full px-2 mt-8 hover:bg-gray-700 rounded-lg">

            <input class="peer absolute top-0 inset-x-0 w-full h-12 opacity-0 z-10 cursor-pointer" type="checkbox">
            <div class="h-12 w-full flex items-center">
                <svg class="mx-2 fill-white" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 96 960 960"
                    width="28">
                    <path
                        d="M250 766h180v-60H250v60Zm400 0h60v-60h-60v60ZM250 606h180v-60H250v60Zm400 0h60V386h-60v220ZM250 446h180v-60H250v60ZM132 936q-24 0-42-18t-18-42V276q0-24 18-42t42-18h696q24 0 42 18t18 42v600q0 24-18 42t-42 18H132Zm0-60h696V276H132v600Zm0 0V276v600Z" />
                </svg>
                <h5 class="text-slate-200 font-medium text-xs 2xl:text-sm sidebar-text">Others</h5>
            </div>

            <div
                class="absolute top-3 right-3 text-white transition-transform duration-500 rotate-0 peer-checked:rotate-180 ">

                {{--  Arrow Icon  --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>

            {{--  Content  --}}
            <div class="bg-gray-700 rounded overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-48">
                <div class="flex flex-col">

                    <x-custom-nav-link :href="route('admin.article-event.index')" :active="request()->routeIs('admin.article-event.index')">
                        {{ __('Article/Event') }}
                    </x-custom-nav-link>

                    <x-custom-nav-link :href="route('admin.partner-beneficiary.index')" :active="request()->routeIs('admin.partner-beneficiary.index')">
                        {{ __('Partner/Beneficiary') }}
                    </x-custom-nav-link>

                    <x-custom-nav-link :href="route('admin.program-services.index')" :active="request()->routeIs('admin.program-services.index')">
                        {{ __('Program & Services') }}
                    </x-custom-nav-link>

                </div>
            </div>
        </div>
        {{--  End of Manage Account Collapse   --}}

        {{--  Manage Account Collapse  --}}
        <div class="relative w-full px-2 overflow-hidden mt-3 hover:bg-gray-700 rounded-lg">

            <input class="peer absolute top-0 inset-x-0 w-full h-12 opacity-0 z-10 cursor-pointer" type="checkbox">
            <div class="h-12 w-full flex items-center  overflow-hidden">
                <svg class="fill-white mx-2" xmlns="http://www.w3.org/2000/svg" height="35" viewBox="0 96 960 960"
                    width="30">
                    <path
                        d="m382 976-18.666-126.667Q346.333 843 328.5 832.667 310.666 822.333 296.333 811L178 863.666 79.333 691l106.334-78.666q-1.667-8.334-2-18.167-.334-9.834-.334-18.167 0-8.333.334-18.167.333-9.833 2-18.167L79.333 461 178 288.334 296.333 341q14.333-11.333 32.334-21.667 18-10.333 34.667-16L382 176h196l18.666 126.667Q613.667 309 631.833 319q18.167 10 31.834 22L782 288.334 880.667 461l-106.334 77.333q1.667 9 2 18.834.334 9.833.334 18.833 0 9-.334 18.5Q776 604 774 613l106.333 78-98.666 172.666-118-52.666q-14.333 11.333-32 22t-35.001 16.333L578 976H382Zm98.667-266.667q55.333 0 94.333-39T614 576q0-55.333-39-94.333t-94.333-39q-55.667 0-94.5 39-38.834 39-38.834 94.333t38.834 94.333q38.833 39 94.5 39Zm0-66.666q-27.667 0-47.167-19.5T414 576q0-27.667 19.5-47.167t47.167-19.5q27.666 0 47.166 19.5 19.5 19.5 19.5 47.167t-19.5 47.167q-19.5 19.5-47.166 19.5ZM480 576Zm-42.667 333.334h85l14-110q32.334-8 60.834-24.5T649 735l103.667 44.334 39.667-70.667L701 641q4.334-16 6.667-32.167Q710 592.667 710 576q0-16.667-2-32.833Q706 527 701 511l91.334-67.667-39.667-70.667L649 417.333q-22.666-25-50.833-41.833-28.167-16.834-61.834-22.834l-13.666-110h-85l-14 110q-33 7.334-61.501 23.834Q333.666 393 311 417l-103.667-44.334-39.667 70.667L259 510.667Q254.666 527 252.333 543T250 576q0 16.667 2.333 32.667T259 641l-91.334 67.667 39.667 70.667L311 734.667q23.333 23.667 51.833 40.167t60.834 24.5l13.666 110Z" />
                </svg>
                <h5 class="text-slate-200 font-medium text-xs 2xl:text-sm sidebar-text">Settings</h5>
            </div>

            <div
                class="absolute top-3 right-3 text-white transition-transform duration-500 rotate-0 peer-checked:rotate-180 ">
                {{--  Arrow Icon  --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </div>

            {{--  Content  --}}
            <div class="bg-gray-700 rounded overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-48">

                <div class="flex flex-col">
                    {{-- <a class="text-xs flex items-center px-4 py-2 mt-2 text-md font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href={{ route('admin.roles.index') }}>

                        <span>Role</span>
                    </a> --}}

                    <a class="text-xs flex items-center px-4 py-2 mt-2 text-md font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href={{ route('admin.calendar.index') }}><span>Calendar</span>
                    </a>

                    <a class="text-xs flex items-center px-4 py-2 mt-2 text-md font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                        href={{ route('admin.template.index') }}>
                       <span>Other Settings</span>
                    </a>
                </div>
            </div>
        </div>

        <x-custom-nav-link :href="route('admin.trash.index')" :active="request()->routeIs('admin.trash*')" class="dynamic-link">
            <svg class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="#ffffff" fill-rule="evenodd" d="M10.31 2.25h3.38c.217 0 .406 0 .584.028a2.25 2.25 0 0 1 1.64 1.183c.084.16.143.339.212.544l.111.335a1.25 1.25 0 0 0 1.263.91h3a.75.75 0 0 1 0 1.5h-17a.75.75 0 0 1 0-1.5h3.09a1.25 1.25 0 0 0 1.173-.91l.112-.335c.068-.205.127-.384.21-.544a2.25 2.25 0 0 1 1.641-1.183c.178-.028.367-.028.583-.028m-1.302 3a2.757 2.757 0 0 0 .175-.428l.1-.3c.091-.273.112-.328.133-.368a.75.75 0 0 1 .547-.395a3.2 3.2 0 0 1 .392-.009h3.29c.288 0 .348.002.392.01a.75.75 0 0 1 .547.394c.021.04.042.095.133.369l.1.3l.039.112c.039.11.085.214.136.315z" clip-rule="evenodd"/><path fill="#ffffff" d="M5.915 8.45a.75.75 0 1 0-1.497.1l.464 6.952c.085 1.282.154 2.318.316 3.132c.169.845.455 1.551 1.047 2.104c.591.554 1.315.793 2.17.904c.822.108 1.86.108 3.146.108h.879c1.285 0 2.324 0 3.146-.108c.854-.111 1.578-.35 2.17-.904c.591-.553.877-1.26 1.046-2.104c.162-.813.23-1.85.316-3.132l.464-6.952a.75.75 0 0 0-1.497-.1l-.46 6.9c-.09 1.347-.154 2.285-.294 2.99c-.137.685-.327 1.047-.6 1.303c-.274.256-.648.422-1.34.512c-.713.093-1.653.095-3.004.095h-.774c-1.35 0-2.29-.002-3.004-.095c-.692-.09-1.066-.256-1.34-.512c-.273-.256-.463-.618-.6-1.302c-.14-.706-.204-1.644-.294-2.992z"/><path fill="#ffffff" d="M9.425 10.254a.75.75 0 0 1 .821.671l.5 5a.75.75 0 0 1-1.492.15l-.5-5a.75.75 0 0 1 .671-.821m5.15 0a.75.75 0 0 1 .671.82l-.5 5a.75.75 0 0 1-1.492-.149l.5-5a.75.75 0 0 1 .82-.671"/></svg>
            <span class="sidebar-text">{{ __('Trash') }}</span>
        </x-custom-nav-link>



        {{--  End of Manage Account Collapse   --}}
    </nav>
</div>

